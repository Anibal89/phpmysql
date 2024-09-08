<?php

/* Credenciales de la base de datos MYSQL */

$host = '192.168.0.11';
$port = '3306';
$dbname = 'serverdbunisa';
$username = 'anibal'; 
$password = 'ReactJs100'; 

$dsn = "mysql:host=$host;port=$port;dbname=$dbname";

/* Credenciales de la base de datos SQL SERVER */

// $host = 'DESKTOP-0NG1OFV\SQLEXPRESS';
// $port = '1433';
// $dbname = 'serverdbunisa'; 
// $username = 'sa'; 
// $password = 'Zazque96'; 

// $dsn = "sqlsrv:Server=$host;Database=$dbname";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta que selecciona Id_Tipo_Maquina y Nombre_Tipo de la tabla
    $stmt = $pdo->query("SELECT Id_Tipo_Maquina, Nombre_Tipo FROM Tipo_Maquina");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Enviar los datos como JSON
    $response['status'] = 'success';
    $response['message'] = 'Conexión exitosa y datos obtenidos.';
    $response['data'] = $result;

} catch (PDOException $e) {
    $response['status'] = 'error';
    echo json_encode(['error' => $e->getMessage()]);
}

header('Content-Type: application/json');
echo json_encode($response);

?>