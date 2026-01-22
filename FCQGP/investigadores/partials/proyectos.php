<?php
$sql = "SELECT * FROM proyectos WHERE investigador_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo "<p>No hay proyectos registrados.</p>";
} else {
    while ($row = $res->fetch_assoc()) {
        echo "<div class='item'>
                <h3>{$row['nombre']}</h3>
                <p><em>{$row['entidad_financiera']}</em></p>
                <p>clave: {$row['clave']}</p>
              </div>";
    }
}
?>