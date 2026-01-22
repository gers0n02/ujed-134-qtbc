<?php
session_start();
require '../../config/config.php';

$investigador_id = trim($_POST['investigador_id']);
$autores = $_POST['autores'];
$nombre_articulo = trim($_POST['nombre_articulo']);
$nombre_revista = trim($_POST['nombre_revista']);
$volumen = trim($_POST['volumen']);
$numero_pagina = trim($_POST['numero_pagina']);
$anio = trim($_POST['anio']);
$doi = trim($_POST['doi']);
$url = trim($_POST['url']);

$sql = "INSERT INTO investigaciones (investigador_id, autores, nombre_articulo, nombre_revista, volumen, numero_pagina, anio, doi, url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("issssssss", $investigador_id, $autores, $nombre_articulo, $nombre_revista, $volumen, $numero_pagina, $anio, $doi, $url);
$stmt->execute();

header("Location: index.php");
exit();
?>