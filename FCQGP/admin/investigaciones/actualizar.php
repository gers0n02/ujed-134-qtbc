<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = (int) $_POST['id'];

$investigador_id = trim($_POST['investigador_id']);
$autores = $_POST['autores'];
$nombre_articulo = trim($_POST['nombre_articulo']);
$nombre_revista = trim($_POST['nombre_revista']);
$volumen = trim($_POST['volumen']);
$numero_pagina = trim($_POST['numero_pagina']);
$anio = trim($_POST['anio']);
$doi = trim($_POST['doi']);
$url = trim($_POST['url']);

$sql = "UPDATE investigaciones SET investigador_id = ?, autores = ?, nombre_articulo = ?, nombre_revista = ?, volumen = ?, numero_pagina = ?, anio = ?, doi = ?, url = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issssssssi", $investigador_id, $autores, $nombre_articulo, $nombre_revista, $volumen, $numero_pagina, $anio, $doi, $url, $id);
$stmt->execute();

header("Location: index.php");
exit();
?>