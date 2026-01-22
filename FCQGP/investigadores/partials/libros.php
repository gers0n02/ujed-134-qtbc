<?php
$sql = "SELECT * FROM libros WHERE investigador_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo "<p>No hay libros/capítulos registrados.</p>";
} else {
    while ($row = $res->fetch_assoc()) {
        echo "<div class='item'>
                <h3>{$row['titulo']}</h3>
                <p><em>{$row['autores']}</em> ({$row['anio']}). {$row['editorial']}, {$row['pais']}. {$row['tipo']}, {$row['numero_paginas']} páginas</p>
              </div>";
    }
}
?>