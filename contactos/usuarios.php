<?php
include('conexion.php');

$ObjConexion = new conexion();
$sql = "SELECT * FROM `contactos`";
$contactos = $ObjConexion->consultar($sql);

if ($_GET) {
    if (isset($_GET['eliminar']) && !empty($_GET['eliminar'])) {
        $id_eliminar = $_GET['eliminar'];


        $objconexion = new conexion();


        $sql = "DELETE FROM `contactos` WHERE `id_contacto` = $id_eliminar";
        $objconexion->consultar($sql);




        header('Location: usuarios.php');
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100%;
            margin: 0;
            background: linear-gradient(90deg, rgba(45,194,196,1) 0%, rgba(0,127,150,1) 35%);
        }

        .tablacolor {
            box-shadow: 3px 9px 31px 17px rgba(3, 3, 3, 0.16) !important;
            -webkit-box-shadow: 3px 9px 31px 17px rgba(3, 3, 3, 0.16) !important;
            -moz-box-shadow: 3px 9px 31px 17px rgba(3, 3, 3, 0.16) !important;
            background-color: white !important;
            border-radius: 10px !important;
        }

        h1 {
            color: white;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Lista de Usuarios</h1>

        <div class="table-responsive tablacolor  ">
            <a class="btn btn-success " href="./FormularioInformacion.php"> Agregar</a>
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo Electronico</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contactos as $contacto) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($contacto['id_contacto']); ?></td>
                            <td><?php echo htmlspecialchars($contacto['Nombre']); ?></td>
                            <td><?php echo htmlspecialchars($contacto['Correo']); ?></td>
                            <td><?php echo htmlspecialchars($contacto['Telefono']); ?></td>
                            <td><?php echo htmlspecialchars($contacto['Mensaje']); ?></td>
                            <td><a href="?eliminar=<?php echo $contacto['id_contacto']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</a>
                            </td>



                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>