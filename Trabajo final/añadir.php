<?php
include 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $imagen = null;

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $directorio_subida = 'uploads/'; 
        if (!is_dir($directorio_subida)) {
            mkdir($directorio_subida, 0755, true);
        }
        $nombre_archivo = basename($_FILES['imagen']['name']);
        $ruta_archivo = $directorio_subida . uniqid() . '_' . $nombre_archivo;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_archivo)) {
            $imagen = $ruta_archivo; 
        }
    }

    $sql = "INSERT INTO vivencias (titulo, descripcion, imagen) VALUES ('$titulo', '$descripcion', '$imagen')";
    if ($conn->query($sql) === TRUE) {
        $mensaje = '<div class="alert alert-success">Nuevo momento añadido con éxito</div>';
    } else {
        $mensaje = '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Añadir Vivencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Mis recuerdos</a>
        </div>
    </nav>
    <div class="container mt-4">
        <h1 class="text-center">Añadir momento</h1>

        <?php if (isset($mensaje)) echo $mensaje; ?>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="añadir.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen (opcional)</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="index.php" class="btn btn-secondary">Volver</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>