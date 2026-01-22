<?php
session_start();
require '../../config/config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
}

$id = (int) $_GET['id'];

$sql = "SELECT * FROM investigadores WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$investigador = $stmt->get_result()->fetch_assoc();

if (!$investigador) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Facultad de Ciencias Químicas - UJED. Información, investigaciones y alumnado.">
    <title>Editar Investigador</title>

    <!-- ícono -->
    <link rel="icon" href="assets/img/icono.png" type="image/png">

    <!-- normalización --> 
    <link rel="preload" href="<?php echo BASE_URL; ?>assets/css/normalize.css" as="style">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/normalize.css">

    <link rel="preload" href="<?php echo BASE_URL; ?>assets/css/style.css" as="style">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">

    <link rel="preload" href="<?php echo BASE_URL; ?>assets/css/admin.css" as="style">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/admin.css">

    <link rel="preload" href="<?php echo BASE_URL; ?>assets/css/investigadores.css" as="style">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/investigadores.css">

    <!-- fuentes -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:wght@400;700&display=swap" crossorigin="crossorigin" as="font">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">

</head>

<?php include('../includes/sidebar.php'); ?>

<div class="form-wrapper main-content">
    <div class="form-card">
        <h2>Editar investigador</h2>

        <form action="actualizar.php" method="POST" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?= $investigador['id'] ?>">
                </div>

                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" value="<?= htmlspecialchars($investigador['nombre']) ?>" required>
                </div>

                <div class="form-group">
                    <label>LGAC</label>
                    <input type="text" name="lgac" value="<?= htmlspecialchars($investigador['lgac']) ?>">
                </div>

                <div class="form-group">
                    <label>SEI</label>
                    <select name="sei" required>
                        <option value="Candidato" <?= ($investigador['sei']=="Candidato") ? "selected" : "" ?>>Candidato a Investigador</option>
                        <option value="Investigador estatal nivel I" <?= ($investigador['sei']=="Investigador estatal nivel I") ? "selected" : "" ?>>Investigador estatal nivel I</option>
                        <option value="Investigador estatal honorífico" <?= ($investigador['sei']=="Investigador estatal honorifico") ? "selected" : "" ?>>Investigador estatal honorífico</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>SNI</label>
                    <select name="sni" required>
                        <option value="No" <?= ($investigador['sni']=="No") ? "selected" : "" ?>>No</option>
                        <option value="Candidato" <?= ($investigador['sni']=="Candidato") ? "selected" : "" ?>>Candidato</option>
                        <option value="I"  <?= ($investigador['sni']=="I") ? "selected" : "" ?>>I</option>
                        <option value="II"  <?= ($investigador['sni']=="II") ? "selected" : "" ?>>II</option>
                        <option value="III"  <?= ($investigador['sni']=="III") ? "selected" : "" ?>>III</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>PRODEP</label>
                    <select name="pro_dep" required>
                        <option value="Sí" <?= ($investigador['pro_dep']=="Sí") ? "selected" : "" ?>>Sí</option>
                        <option value="No" <?= ($investigador['pro_dep']=="No") ? "selected" : "" ?>>No</option>
                    </select>
                </div>

                <?php if ($investigador['foto']): ?>
                    <div class="form-group full">
                        <p>Foto actual:</p>
                        <img src="../../uploads/fotos/<?= $investigador['foto'] ?>" width="120">
                    </div>
                <?php endif; ?>

                <div class="form-group full">
                    <label>Nueva foto (opcional)</label>
                    <input type="file" name="foto" accept="image/*">
                </div>

                <?php if ($investigador['cv']): ?>
                    <div class="form-group full">
                        <p>
                            CV actual:
                            <a href="../../uploads/cvs/<?= $investigador['cv'] ?>" target="_blank">
                                Ver PDF
                            </a>
                        </p>
                    </div>
                <?php endif; ?>

                <div class="form-group full">
                    <label>Nuevo CV (opcional)</label>
                    <input type="file" name="cv" accept="application/pdf">
                </div>
            </div>

            <div class="form-actions">
                <a href="index.php" class="btn-cancel">Cancelar</a>
                <button type="submit" class="btn-save">Guardar cambios</button>
            </div>
        </form>
    </div>
</div>

<?php include('../includes/footer.php'); ?>