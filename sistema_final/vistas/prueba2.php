<?php 


ob_start();
session_start();

if(!isset($_SESSION['nombre'])){

    header("Location: login.php");

}else{

require 'header.php';


if (isset($_SESSION['predicciones']) && $_SESSION['predicciones'] == 1) {

?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Predicción con Modelo de Machine Learning</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .container {
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .image-container {
            text-align: center;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Predicción con Modelo de Machine Learning</h1>
        <form id="predictionForm">
            <div class="form-group">
                <label for="refValue">REF:</label>
                <input type="number" class="form-control" id="refValue" required>
            </div>
            <div class="form-group">
                <label for="reviewDateValue">Review Date:</label>
                <input type="number" class="form-control" id="reviewDateValue" required>
            </div>
            <div class="form-group">
                <label for="cocoaPercentValue">Cocoa Percent:</label>
                <input type="number" step="0.01" class="form-control" id="cocoaPercentValue" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Obtener Predicción</button>
        </form>
        <div id="predictionResult" class="mt-4" style="display: none;">
            <h2 class="text-center">Predicción:</h2>
            <p class="text-center" id="predictionOutput"></p>
        </div>
        <div class="image-container mt-4">
            <h2 class="text-center">Matriz de Correlación</h2>
            <img src="/sistemaventakk/vistas/static/correlation_matrix.png" alt="Matriz de Correlación">
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script>
        document.getElementById('predictionForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const refValue = document.getElementById('refValue').value;
            const reviewDateValue = document.getElementById('reviewDateValue').value;
            const cocoaPercentValue = document.getElementById('cocoaPercentValue').value;

            const inputValues = `${refValue},${reviewDateValue},${cocoaPercentValue}`;

            fetch(`http://localhost/sistemaventakk/vistas/prueba.php?input=${inputValues}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('predictionOutput').textContent = data.prediction[0];
                    document.getElementById('predictionResult').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching prediction:', error);
                });
        });
    </script>
</body>
</html>

<?php
    } else {
        require 'noaccesso.php';
    }
    require_once "footer.php";
}
ob_end_flush();
?>
