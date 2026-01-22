<?php
$sql = "SELECT * FROM investigaciones WHERE investigador_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    echo "<p>No hay investigaciones registradas.</p>";
} else {
    while ($row = $res->fetch_assoc()) {
        echo <<<HTML
        <div class="item">
            <h3>{$row['nombre_articulo']}</h3>
            <p>
                <em>{$row['autores']}</em> ({$row['nombre_revista']}, {$row['anio']}).
                volumen: {$row['volumen']},
                página: {$row['numero_pagina']}.
                DOI: {$row['doi']}.
                <a href="{$row['url']}" target="_blank">{$row['url']}</a>
            </p>
        </div>
        HTML;
    }
}
?>