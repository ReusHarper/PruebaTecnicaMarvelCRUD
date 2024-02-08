<?php

namespace App\Controllers;

use CodeIgniter\Config\DotEnv;
use App\Models\MarvelModel;

class MarvelCrud extends BaseController
{
    // Verificar si la función setCharacters ya se ejecutó
    private $setCharactersExecuted = false;

    // Cache service
    private $cache;

    public function __construct()
    {
        $this->cache = \Config\Services::cache();
    }

    // Vistas
    public function index()
    {
        // Almacenar los personajes de la API en la base de datos si no se han establecido
        $this->setCharacters();

        // Obtener el mensaje de alerta
        $message = session('alert');

        // Instanciar el modelo
        $Crud       = new MarvelModel();
        $characters = $Crud->getCharacters();

        // Establecer los datos a enviar a la vista
        $data       = [
            "characters" => $characters,
            "message"    => $message,
        ];

        return view('characters', $data);
    }

    public function viewCreate()
    {
        return view('create');
    }

    public function viewUpdate()
    {
        return view('update');
    }

    // Operaciones CRUD
    public function create()
    {
        // Obtener el nombre de la imagen
        $imageName = $this->uploadImage();

        // Establecer los datos a insertar en la base de datos
        $data = [
            'name'        => $_POST['name'],
            'description' => $_POST['description'],
            'image'       => $imageName,
        ];

        // Instanciar el modelo y realizar la inserción
        $Crud     = new MarvelModel();
        $response = $Crud->setCharacter($data);

        // Verificar si la inserción fue exitosa
        if ($response > 0) {
            return redirect()->to(base_url())->with('alert', '1');
        } else {
            return redirect()->to(base_url())->with('alert', '0');
        }
    }

    public function update()
    {
        // Obtener el nombre de la imagen
        $imageName = $this->uploadImage();

        // Establecer los datos a actualizar en la base de datos
        $data = [
            'name'        => $_POST['name'],
            'description' => $_POST['description'],
            'image'       => $imageName,
        ];

        $idCharacter = $_POST['idCharacter'];
        $Crud        = new MarvelModel();
        $response    = $Crud->updatedCharacter($data, $idCharacter);

        // Verificar si la inserción fue exitosa
        if ($response) {
            return redirect()->to(base_url())->with('alert', '2');
        } else {
            return redirect()->to(base_url())->with('alert', '3 ');
        }
    }

    public function delete($idCharacter)
    {
		$Crud     = new MarvelModel();
		$data     = ["id_character" => $idCharacter];
		$response = $Crud->deleteCharacter($data);

		if ($response) {
			return redirect()->to(base_url().'/')->with('alert','4');
		} else {
			return redirect()->to(base_url().'/')->with('alert','5');
		}
    }

    public function uploadImage()
    {
        // Obtener el archivo de la solicitud
        $file = $this->request->getFile('image');

        // Verificar si el archivo es válido y no ha sido movido
        if ($file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move('public/uploads/', $imageName);
        }

        return $imageName;
    }

    // Getters & Setters
    public function getCharacter($idCharacter)
    {
        $data = [
            'id_character' => $idCharacter,
        ];
        $Crud      = new MarvelModel();
        $response  = $Crud->getCharacter($data);
        $character = ["data" => $response];

        return view('update', $character);
    }

    public function getUrlHash($url = '') 
    {
        // Intentar cargar las variables de entorno hasta que ambas claves estén disponibles
        while (true) {
            // Cargar las variables de entorno
            $envFilePath = WRITEPATH . '.env';
            $dotenv      = new DotEnv($envFilePath);
            $dotenv->load();

            // Obtener las claves pública y privada desde las variables de entorno
            $publicKey  = env('CI_API_KEY_PUBLIC');
            $privateKey = env('CI_API_KEY_PRIVATE');

            // Verificar si ambas claves están configuradas
            if (!empty($publicKey) && !empty($privateKey)) {
                // Establecer un timestamp en 1
                $ts = 1;

                // Crear un hash utilizando md5 y los valores de la API
                $hash = md5($ts . $privateKey . $publicKey);

                // URL formateada para su consumo
                $apiUrlCharacters = $url . '?ts=' . $ts . '&apikey=' . $publicKey . '&hash=' . $hash;

                return $apiUrlCharacters;
            }
        }
    }

    public function setCharacters()
    {
        // Verificar si la función ya se ha ejecutado
        if ($this->cache->get('setCharactersExecuted')) {
            return;
        }

        // Marcar la función como ejecutada
        $this->markSetCharactersAsExecuted();

        // Almacenar en caché la marca de la ejecución
        $this->cache->save('setCharactersExecuted', true);

        // Obtencion de la url formateada para su consumo
        $apiUrlCharacters = $this->getUrlHash('https://gateway.marvel.com:443/v1/public/characters');

        // Realizar la solicitud a la API utilizando file_get_contents
        $response = file_get_contents($apiUrlCharacters);

        // Verificar si la solicitud fue exitosa
        if ($response === false) {
            die('Error al obtener la respuesta de la API');
        }

        // Decodificar la respuesta JSON
        $data = json_decode($response, true);

        // Verificar si la decodificación fue exitosa
        if ($data === null) {
            die('Error al decodificar la respuesta JSON');
        }

        // Obtener la información de los personajes
        $result = $data['data']['results'];

        // Instanciar el modelo
        $Crud = new MarvelModel();

        // Iterar sobre los personajes y guardarlos en la base de datos
        foreach ($result as $key) {
            // print_r($key['thumbnail']['path'] . '.' . $key['thumbnail']['extension']. '<br>');
            
            $characters = [
                'name'        => $key['name'],
                'description' => $key['description'],
                'image'       => $key['thumbnail']['path'] . '.' . $key['thumbnail']['extension'],
            ];

            // Realizar la inserción de los personajes en la base de datos
            $response = $Crud->setCharacter($characters);
        }
    }

    private function markSetCharactersAsExecuted()
    {
        $this->setCharactersExecuted = true;
    }

    private function isSetCharactersExecuted()
    {
        return $this->setCharactersExecuted;
    }
}