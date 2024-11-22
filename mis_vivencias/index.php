<?php
include 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Trabajo Final</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container d-flex justify-content-center">
            <span class="navbar-brand mb-0 h1">Trabajo final</span>
        </div>
    </nav>
    <div class="text-center py-3 titulo-seccion">
    <h5 class="mb-0">Mis momentos en estos 7 años en la escuela</h5>
</div>
    <div class="container mt-4 titulo">
        <h1 class="text-center">Mis recuerdos en la Escuela</h1>

        <div class="text-end mb-4">
            <a href="añadir.php" class="btn btn-success">Añadir recuerdo</a>
        </div>

        <div class="row">
            <?php
            $sql = "SELECT * FROM vivencias ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-6 mb-3">';
                    echo '<div class="card">';
                    if ($row['imagen']) {
                        echo '<img src="' . htmlspecialchars($row['imagen']) . '" class="card-img-top" alt="Imagen de la vivencia">';
                    }
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($row['titulo']) . '</h5>';
                    echo '<p class="card-text">' . htmlspecialchars($row['descripcion']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center">No hay recuerdos registrados.</p>';
            }
            ?>
        </div>
    </div>
    <div class="loqueaprendi">
    <h3><u>Lo que aprendí</u></h3>
    <div class="contenido-cuadro">
    <p>Aprendí muchas cosas de mis profesores, amigos y familia. Durante estos años, desarrollé habilidades para manejarme en distintos entornos como la pasantía, la construcción y el dibujo.<p> 
            <p>También aprendí a reparar notebooks y a programar en varios lenguajes como C++, Java, JavaScript y Python.</p>
        <p>La pandemia me hizo darme cuenta de lo especial que es compartir momentos con los amigos que hice en la escuela. 
            <p>Me alegra haber pasado este tiempo aquí y haber aprendido tanto. Muchas gracias, profesores y amigos.<p>
    </div>
</div>
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; <?php echo date('Y'); ?> Mis Recuerdos. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
