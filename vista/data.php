<?php
header('Content-Type: application/json');

// Datos de conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boutique";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consultar datos de ventas
$salesQuery = "SELECT
tb_empleado.nombres as month, 
SUM(tb_venta.total_venta) as sales
FROM
tb_empleado
INNER JOIN
tb_venta
ON 
tb_empleado.id_empleado = tb_venta.empleado
        group by tb_empleado.nombres"; // Ajusta la consulta según tu tabla
$salesResult = $conn->query($salesQuery);

$salesData = [];
while ($row = $salesResult->fetch_assoc()) {
    $salesData[] = $row;
}

// Consultar datos de visitantes
$visitorsQuery = "SELECT SUM(tb_venta.total_venta) as date, MONTHNAME(tb_venta.fecha_venta) as visitors FROM tb_venta where YEAR(tb_venta.fecha_venta)=YEAR(CURDATE()) GROUP BY visitors;"; // Ajusta la consulta según tu tabla
$visitorsResult = $conn->query($visitorsQuery);

$visitorsData = [];
while ($row = $visitorsResult->fetch_assoc()) {
    $visitorsData[] = $row;
}

$conn->close();

// Devolver datos en formato JSON
echo json_encode([
    'sales' => $salesData,
    'visitors' => $visitorsData
]);
?>
