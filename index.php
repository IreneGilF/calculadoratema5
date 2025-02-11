<?php
require_once 'src/Calculadora.php';

use App\Calculadora;

// Inicializamos variables
$resultado = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numero1 = $_POST['numero1'] ?? null;
    $numero2 = $_POST['numero2'] ?? null;
    $operacion = $_POST['operacion'] ?? '';

    $calc = new Calculadora();

    try {
        switch ($operacion) {
            case 'suma':
                $resultado = $calc->suma($numero1, $numero2);
                break;
            case 'resta':
                $resultado = $calc->resta($numero1, $numero2);
                break;
            case 'multiplicacion':
                $resultado = $calc->multiplicacion($numero1, $numero2);
                break;
            case 'division':
                if ($numero2 == 0) {
                    throw new Exception("No se puede dividir entre cero.");
                }
                $resultado = $calc->division($numero1, $numero2);
                break;
            case 'raiz':
                $resultado = $calc->raiz($numero1);
                break;
            default:
                throw new Exception("Operación no válida.");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; }
        .result { margin-top: 20px; padding: 10px; background-color: #f4f4f4; border: 1px solid #ccc; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Calculadora PHP</h1>
    <form method="POST">
        <label for="numero1">Número 1:</label>
        <input type="number" name="numero1" id="numero1" required>
        <br><br>

        <label for="numero2">Número 2 (opcional para raíz):</label>
        <input type="number" name="numero2" id="numero2">
        <br><br>

        <label for="operacion">Operación:</label>
        <select name="operacion" id="operacion" required>
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>
            <option value="raiz">Raíz Cuadrada</option>
        </select>
        <br><br>

        <button type="submit">Calcular</button>
    </form>

    <?php if ($resultado !== ''): ?>
        <div class="result">Resultado: <strong><?= htmlspecialchars($resultado) ?></strong></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="result error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
</body>
</html>