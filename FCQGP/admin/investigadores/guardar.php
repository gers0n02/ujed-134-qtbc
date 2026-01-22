<?php
session_start();
require '../../config/config.php';

$nombre = trim($_POST['nombre']);
$lgac = trim($_POST['lgac']);
$sei = trim($_POST['sei']);
$sni = trim($_POST['sni']);
$pro_dep = trim($_POST['pro_dep']);

$cvNombre = null;
$fotoNombre = null;

if (!empty($_FILES['cv']['name'])) {
    if ($_FILES['cv']['type'] !== 'application/pdf') {
        die("El CV debe ser PDF");
    }

    $cvNombre = uniqid() . ".pdf";
    move_uploaded_file(
        $_FILES['cv']['tmp_name'],
        "../../uploads/cvs/" . $cvNombre
    );
}

if (!empty($_FILES['foto']['name'])) {
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $fotoNombre = uniqid() . "." .$ext;

    move_uploaded_file(
        $_FILES['foto']['tmp_name'],
        "../../uploads/fotos/" . $fotoNombre
    );
}

$sql = "INSERT INTO investigadores (nombre, lgac, sei, sni, pro_dep, cv, foto) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $nombre, $lgac, $sei, $sni, $pro_dep, $cvNombre, $fotoNombre);
$stmt->execute();

header("Location: index.php");
exit();
?>