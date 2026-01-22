<?php
$sql = "SELECT * FROM tesis WHERE investigador_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo "<p>No hay tesis registradas.</p>";
} else {
    while ($row = $res->fetch_assoc()) {
        echo "<div class='item'>
                <h3>{$row['nombre_tesis']}</h3>
                <p><em>{$row['nombre_alumno']}</em> ({$row['anio_terminacion']})</p>
              </div>";
    }
}
?>