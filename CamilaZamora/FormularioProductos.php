<?php
include('conexion.php'); // Incluir el archivo de conexión

// Crear una instancia de la clase 'conexion'
$conexion = new conexion();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['imagen'])) {

    $producto = $_POST['txtproducto'];
    $precio = (float) $_POST['txtprecio'];  // Convertir a float
    $cantidad = (int) $_POST['txtcantidad']; // Convertir a int
    $total = $cantidad * $precio; // Multiplicación correcta

    // Leer el archivo de imagen como binario
    $imagen = file_get_contents($_FILES['imagen']['tmp_name']);

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO productos (producto, Precio, Cantidad, Total, Imagen) VALUES (?, ?, ?, ?, ?)";

    // Ejecutar la consulta con los parámetros
    $params = [$producto, $precio, $cantidad, $total, $imagen];

    try {
        
        $productoId = $conexion->ejecutar($sql, $params);
        header('location: ./Procesar.php');
       
    } catch (PDOException $e) {
        echo "Error al insertar el producto: " . $e->getMessage();
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            background: linear-gradient(to right, #f1e1a6,rgb(166, 247, 173)) !important ;
        }

        h1 {
            background: linear-gradient(to right, #f1e1a6,rgb(166, 247, 178));
            color: #ffffff;
            font-size: 36px;
            text-align: center;
            padding: 20px;
        }

        .botonenviar {
            background: linear-gradient(90deg, rgba(238,174,202,1) 0%, rgba(233,226,148,1) 100%)!important;
            border: none !important;
            border-radius: 5px !important;
            transition: background-color 0.3 ease !important;
        }

        button:hover {
            background-color: #f1e1a6;
        }
        .cards{
            box-shadow: 3px 9px 31px 17px rgba(3,3,3,0.16)!important;
-webkit-box-shadow: 3px 9px 31px 17px rgba(3,3,3,0.16)!important;
-moz-box-shadow: 3px 9px 31px 17px rgba(3,3,3,0.16)!important;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-lg-6">
                <div class="card border-0  cards">
                    <div class="card-body">
                        <form action="FormularioProductos.php" method="POST" enctype="multipart/form-data">

                            <label>Nombre del Producto:</label><br>
                            <input class="form-control" type="text" name="txtproducto" requerided><br>

                            <label>Precio:</label><br>
                            <input class="form-control" type="number" name="txtprecio" step="0.1" requerided><br><br>

                            <label>Cantidad:</label><br>
                            <input class="form-control" type="number" name="txtcantidad" requerided><br><br>

                            <label>Subir Imagen:</label>
                            <input class="form-control" type="file" name="imagen" requerided>

                            <div class="d-flex btn btn-group gap-2 align-items-sm-center mt-3 ">
                            <input class="btn btn-success botonenviar " type="submit" name="enviar" value="Enviar"><br><br>
                            <a class="btn btn-secondary" href="./Procesar.php">Regresar</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>

</body>

</html>