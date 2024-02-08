<!doctype html>
<html lang = "en">
    <head>
        <!-- Required meta tags -->
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel = "stylesheet" integrity = "sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin = "anonymous">
        
        <!-- PageData -->
        <title>Creación de personaje</title>
        <link rel = "icon" href = "<?php base_url('public/images/Marvel_Icon.png'); ?>">

        <!-- Styles -->
        <style>
            body {
                height            : 100vh;
                margin            : 0;
                display           : flex;
                justify-content   : center;
                align-items       : center;
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
        </style>
    </head>
    <body>
        <div class = "container">
            <img src = "<?= base_url('public/images/Marvel_Logo.png'); ?>" class = "mt-3 img-thumbnail mx-auto d-block w-50" alt="Marvel Logo">
            <h1 class = "mt-5 mb-5 text-center">Crear personaje</h1>
            <form method = "POST" action = "<?php echo base_url().'create' ?>" enctype = "multipart/form-data">
                <div class = "row">
                    <div class = "mb-3 col-sm-12 col-md-6 col-lg-6">
                        <label for = "name" class = "form-label">Nombre:</label>
                        <input type = "text" id = "name" name = "name" class = "form-control" placeholder = "Iron Man" required>
                    </div>
                    <div class = "mb-3 col-sm-12 col-md-6 col-lg-6">
                        <label for = "image" class = "form-label">Imagen:</label>
                        <input type = "file" id = "image" name = "image" class = "form-control" accept="image/*" required>
                    </div>
                    <div class = "mb-5 col-12">
                        <label for = "description" class = "form-label ">Descripción:</label>
                        <textarea type = "text" id = "description" name = "description" class = "form-control" rows="5" placeholder = "Es un multimillonario industrial, anterior Director General de Industrias Stark y miembro fundador de los Vengadores." required></textarea>
                    </div>
                    <div class = "mb-3 col-12 w-100">
                        <div class = "row g-2">
                            <div class = "col-sm-12 col-md-6">
                                <a href = "<?php echo base_url(); ?>" class = "btn btn-secondary w-100">Regresar</a>
                            </div>
                            <div class = "col-sm-12 col-md-6">
                                <button class = "btn btn-primary w-100" type = "submit">Crear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity = "sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin = "anonymous"></script>
        <script src = "https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
