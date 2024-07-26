<?php
header('Content-Type: application/json; charset=utf-8');

// Obtener los parámetros de entrada de la URL
$input = isset($_GET['input']) ? $_GET['input'] : '2454,2019,0.76';

// Define los parámetros de entrada para el script de Python
$input_params = json_encode(array_map('floatval', explode(',', $input)));

// Define el comando para ejecutar el script de Python
$command = escapeshellcmd("python C:/xampp/htdocs/sistemaventakk/vistas/prueba.py") . ' ' . escapeshellarg($input_params);

// Ejecuta el comando y captura la salida
$output = shell_exec($command);

// Muestra la salida del script de Python
echo $output;










