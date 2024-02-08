<?php

namespace App\Models;

use CodeIgniter\Model;

class MarvelModel extends Model
{
    public function getCharacters()
    {
        // Realizar la consulta a la base de datos y retornar los resultados como un array
        $query   = $this->db->query("SELECT * FROM t_characters");
        $results = $query->getResultArray();
        return $results;
    }

    public function getCharacter($data)
    {
        // Con la table T_characters se debe retornar el personaje solicitado
        $query  = $this->db->table("t_characters");
        $result = $query->where($data);
        return $result->get()->getResultArray();
    }

    public function setCharacter($data)
    {
        // Realizar la inserción de un nuevo personaje en la base de datos
        $Characters = $this->db->table('t_characters');
        $Characters->insert($data);

        // Retornar el ultimo ID del personaje insertado
        return $this->db->insertID();
    }

    public function updatedCharacter($data, $idCharacter)
    {
        // Realizar la actualización de un personaje en la base de datos
        $Characters = $this->db->table('t_characters');
        $Characters->set($data);
        $Characters->where('id_character', $idCharacter);

        return $Characters->update();
    }

    public function deleteCharacter($idCharacter)
{
    // Realizar la eliminación de un personaje en la base de datos
    $Characters = $this->db->table('t_characters');
    $Characters->where('id_character', $idCharacter);

    return $Characters->delete();
}
}