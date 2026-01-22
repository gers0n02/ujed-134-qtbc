<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = (int) $_POST['id'];

$nombre = trim($_POST['nombre']);
$lgac = trim($_POST['lgac']);
$sei = trim($_POST['sei']);
$sni = trim($_POST['sni']);
$pro_dep = trim($_POST['pro_dep']);

$sql = "SELECT foto, cv FROM investigadores WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$actual = $stmt->get_result()->fetch_assoc();

$fotoNombre = $actual['foto'];
$cvNombre = $actual['cv'];

if (!empty($_FILES['foto']['name'])) {
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

    if ($fotoNombre && file_exists("../../uploads/fotos/" . $fotoNombre)) {
        unlink("../../uploads/fotos/" . $fotoNombre);
    }

    $fotoNombre = uniqid() . "_" . $_FILES['foto']['name'];

    move_uploaded_file(
        $_FILES['foto']['tmp_name'],
        "../../uploads/fotos/" . $fotoNombre
    );
}

if (!empty($_FILES['cv']['name'])) {
    if ($_FILES['cv']['type'] !== 'application/pdf') {
        die("El CV debe ser PDF");
    }

    if ($cvNombre && file_exists("../../uploads/cvc/" . $cvNombre)) {
        unlink("../../uploads/cvs/" . $cvNombre);
    }

    $cvNombre = uniqid() . ".pdf";
    move_uploaded_file(
        $_FILES['cv']['tmp_name'],
        "../../uploads/cvs/" . $cvNombre
    );
}

$sql = "UPDATE investigadores SET nombre = ?, lgac = ?, sei = ?, sni = ?, pro_dep = ?, foto = ?, cv = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssi", $nombre, $lgac, $sei, $sni, $pro_dep, $fotoNombre, $cvNombre, $id);
$stmt->execute();

header("Location: index.php");
exit();
?>