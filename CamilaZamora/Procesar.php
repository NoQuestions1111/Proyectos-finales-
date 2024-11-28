<?php
include('conexion.php');

$ObjConexion = new conexion();
$sql = "SELECT * FROM `productos`";
$productos = $ObjConexion->consultar($sql);

if ($_GET) {
    if (isset($_GET['eliminar']) && !empty($_GET['eliminar'])) {
        $id_eliminar = $_GET['eliminar'];

        // Conectar a la base de datos
        $objconexion = new conexion();

        // Consulta para eliminar el producto
        $sql = "DELETE FROM `productos` WHERE `id_producto` = $id_eliminar";
        $objconexion->consultar($sql);

        // Mensaje de éxito en la eliminación
        $_SESSION['success_message-eliminar-producto'] = "¡Producto eliminado exitosamente!";

        // Redirigir a la página de productos
        header('Location: Procesar.php');
        exit; // Termina el script después de la redirección
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100%;
            margin: 0;
            background: linear-gradient(to right, #f1e1a6, #f7a6c7) !important;
        }

        .tablacolor {
            box-shadow: 3px 9px 31px 17px rgba(3,3,3,0.16)!important;
-webkit-box-shadow: 3px 9px 31px 17px rgba(3,3,3,0.16)!important;
-moz-box-shadow: 3px 9px 31px 17px rgba(3,3,3,0.16)!important;
            background-color: white !important;
            border-radius: 10px !important;
        }

        h1{
            color: white;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center">Lista de Productos</h1>

        <div class="table-responsive tablacolor  ">
        <a class="btn btn-success " href="./FormularioProductos.php"> Agregar</a>
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($producto['id_producto']); ?></td>
                            <td><?php echo htmlspecialchars($producto['Producto']); ?></td>
                            <td><?php echo htmlspecialchars($producto['Precio']); ?></td>
                            <td><?php echo htmlspecialchars($producto['Total']); ?></td>

                            <?php
                            // Convertir el campo BLOB a Base64
                            $imagenBlob = $producto['Imagen'];  // Suponiendo que 'Imagen' es el campo BLOB
                            if ($imagenBlob) {
                                $imagenBase64 = base64_encode($imagenBlob); // Codifica la imagen en base64
                                $src = 'data:image/jpeg;base64,' . $imagenBase64; // Puedes cambiar 'image/jpeg' según el tipo de imagen
                            } else {
                                $src = ''; // Si no hay imagen, dejar la fuente vacía
                            }
                            ?>

                            <td>
                                <?php if ($src) : ?>
                                    <img src="<?php echo $src; ?>" alt="Imagen del producto" width="100" height="100">
                                <?php else : ?>
                                    <span>No disponible</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="?eliminar=<?php echo $producto['id_producto']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>