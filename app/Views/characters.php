<!DOCTYPE html>
<html lang = "en">
<head>
    <!-- Required meta tags -->
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel = "stylesheet" integrity = "sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin = "anonymous">

    <!-- Icon FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" integrity="sha384-ZrFbK7Lg1g3pD8GHRM8foamqOOZStb8YjoK5u3LNL4z7AuDKtfGPFDfl4PU18Ii6" crossorigin="anonymous">
    
    <!-- PageData -->
    <title>Personajes</title>
    <link rel = "icon" href = "<?= base_url('public/images/Marvel_Icon.png'); ?>">

    <!-- Styles -->
    <style>
        body {
            height            : 100vh;
            margin            : 0;
            display           : flex;
            justify-content   : center;
            /* align-items       : center; */
            background        : linear-gradient(270deg, #fa4f14, #3145d1);
            background-size   : 400% 400%;
            -webkit-animation : AnimationName 30s ease infinite;
            -moz-animation    : AnimationName 30s ease infinite;
            animation         : AnimationName 30s ease infinite;
        }

        @-webkit-keyframes AnimationName {
            0%{background-position:0% 50%}
            50%{background-position:100% 50%}
            100%{background-position:0% 50%}
        }
        @-moz-keyframes AnimationName {
            0%{background-position:0% 50%}
            50%{background-position:100% 50%}
            100%{background-position:0% 50%}
        }
        @keyframes AnimationName {
            0%{background-position:0% 50%}
            50%{background-position:100% 50%}
            100%{background-position:0% 50%}
        }

        .profile-icon {
            width         : 60px;
            height        : 60px;
            object-fit    : cover;
            border-radius : 50%;
            overflow      : hidden;
        }
    </style>
</head>
<body>
    <div class = "container">
        <img src = "<?= base_url('public/images/Marvel_Logo.png'); ?>" class = "mt-3 img-thumbnail mx-auto d-block w-50" alt = "Marvel Logo">
        <h3 class = "mt-5 mb-3 text-center">Listado de personajes</h3>
        
        <div class = "mb-3 d-flex justify-content-between gap-3 align-items-center">
            <a href = "<?php echo base_url().'create'; ?>" class = "btn btn-primary">Crear</a>
            <div class = "input-group">
                <input type = "search" id = "form-search" class = "form-control" />
                <button type = "button" class = "btn btn-outline-info" id = "btn-search">Search <i class = "fas fa-search"></i></button>
            </div>
        </div>

        <div class = "row">
            <div class = "col-sm-12">
                <div class = "table table-responsive">
                    <table class = "table table-hover table-bordered">
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    <?php foreach($characters as $key): ?>
                        <tr id = "character_<?php echo $key['id_character']; ?>" class = "tr_characters">
                            <td>
                                <img 
                                    src   = "
                                        <?php
                                            if (filter_var($key['image'], FILTER_VALIDATE_URL)) {
                                                echo($key['image']);
                                            } else {
                                                echo("public/uploads/".$key['image']);
                                            }
                                        ?>
                                    "
                                    alt   = "<?php echo("Imagen referente al personaje ".$key['name']); ?>"
                                    class = "img-fluid profile-icon"
                                />
                            </td>
                            <td><?php echo($key['name']); ?></td>
                            <td><?php echo($key['description']); ?></td>
                            <td><a href = "<?php echo base_url().'getCharacter/'.$key['id_character']; ?>" class = "btn btn-warning">Editar</a></td>
                            <td><a href="<?php echo base_url().'delete/'.$key['id_character'] ?>" class = "btn btn-danger">Eliminar</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity = "sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin = "anonymous"></script>
    <script src = "https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type = "text/javascript">
        // Mensajes de confirmación de creación de personaje
        const message = "<?php echo $message; ?>";
        if (message == "1") {
            Swal.fire({
                icon  : 'success',
                title : 'Éxito con la creación',
                text  : 'El personaje fue creado correctamente.'
            });
        } else if (message == "0") {
            Swal.fire({
                icon  : 'error',
                title : 'Error con la creación',
                text  : 'El personaje no pudo ser creado, intente de nuevo.'
            });
        } else if (message == "2") {
            Swal.fire({
                icon  : 'success',
                title : 'Éxito con la actualización',
                text  : 'El personaje fue actualizado con éxito.'
            });
        } else if (message == "3") {
            Swal.fire({
                icon  : 'error',
                title : 'Error con la actualización',
                text  : 'El personaje no pudo ser actualizado, intente de nuevo.'
            });
        } else if (message == "4") {
            Swal.fire({
                icon  : 'success',
                title : 'Éxito con la eliminación',
                text  : 'El personaje fue eliminado con éxito.'
            });
        } else if (message == "5") {
            Swal.fire({
                icon  : 'error',
                title : 'Error con la eliminación',
                text  : 'El personaje no pudo ser eliminación, intente de nuevo.'
            });
        }

        // Busqueda y filtrado de personajes mediante su nombre
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('form-search');
            const characters  = document.querySelectorAll('.tr_characters');

            searchInput.addEventListener('input', () => {
                const searchTerm = searchInput.value.toLowerCase();

                characters.forEach((character) => {
                    const name = character.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    if (name.includes(searchTerm)) {
                        character.classList.remove('d-none');
                    } else {
                        character.classList.add('d-none');
                    }
                });
            });
        });
    </script>
</body>
</html>