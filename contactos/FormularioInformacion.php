<?php
include('conexion.php'); // Incluir el archivo de conexión



if ($_POST) {


    $nombre = $_POST['txtnombre'];
    $correo = $_POST['txtcorreo'];
    $telefono = $_POST['txtTelefono'];
    $mensaje = $_POST['txtmensaje'];

    $objconexion = new conexion();
    $sql = "INSERT INTO contactos (id_contacto , Nombre, Correo, Telefono, Mensaje)
    VALUES (NULL, '$nombre',  '$correo', '$telefono', '$mensaje' )";
    $objconexion->ejecutar($sql);

    header('location: usuarios.php');
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Formulario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(90deg, rgba(45, 194, 196, 1) 0%, rgba(0, 127, 150, 1) 35%);

        }




        h1 {
            color: #007f96;
            font-size: 28px;
            text-align: center;
            margin-bottom: 20px;
        }


        input:focus,
        textarea:focus {
            border-color: #2dc2c4;
            outline: none;
            box-shadow: 0 0 8px rgba(45, 194, 196, 0.5);
        }


    </style>
</head>

<body>
    <div class="container mt-2">
        <br>
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-lg-6">
                <div class="card border-0  cards">
                    <div class="card-body">
                        <form action="FormularioInformacion.php" method="POST">
                            <h1>Formulario de Información</h1>

                            <label for="txtnombre">Nombre del Usuario</label>
                            <input class="form-control" type="text" name="txtnombre" id="txtnombre" required><br>

                            <label for="txtcorreo">Correo Electrónico</label>
                            <input class="form-control" type="email" name="txtcorreo" id="txtcorreo" required><br><br>

                            <label for="txtTelefono">Teléfono</label>
                            <input class="form-control" type="text" name="txtTelefono" id="txtTelefono" required><br><br>

                            <label for="txtmensaje">Mensaje</label>
                            <textarea class="form-control" name="txtmensaje" id="txtmensaje" rows="4" required></textarea><br><br>

                            <div class="btn-group gap-2">
                                <input class="btn btn-success" type="submit" name="enviar" value="Enviar">
                                <a class="btn btn-secondary" href="./usuarios.php">Regresar</a>
                            </div>
                        </form>
                    </div>
                </div>
<br>
            </div>
        </div>

</body>

</html>