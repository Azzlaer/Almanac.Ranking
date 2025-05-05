<?php
// Leer el archivo YAML
$yamlFile = 'Z:\Servidores\Valheim\12\BepInEx\config\Almanac\Players\PlayerListData.yml';
$yamlContent = file_get_contents($yamlFile);

// Parsear el YAML manualmente
$data = [];
foreach (explode("\n", $yamlContent) as $line) {
    $line = trim($line);
    if (empty($line) || strpos($line, '#') === 0) continue;

    if (substr($line, -1) == ':') {
        $currentKey = rtrim($line, ':');
        $data[$currentKey] = [];
    } elseif (isset($currentKey) && strpos($line, ':') !== false) {
        list($key, $value) = array_map('trim', explode(':', $line, 2));
        $data[$currentKey][$key] = is_numeric($value) ? (int)$value : $value;
    }
}

// Función para ordenar el arreglo
function sortTable($array, $key, $order) {
    usort($array, function ($a, $b) use ($key, $order) {
        if ($a[$key] == $b[$key]) return 0;
        return ($order === 'ASC') ? ($a[$key] <=> $b[$key]) : ($b[$key] <=> $a[$key]);
    });
    return $array;
}

// Obtener parámetros de ordenamiento
$sortKey = $_GET['sort'] ?? 'completed_achievements';
$order = $_GET['order'] ?? 'DESC';

// Transformar los datos
$players = [];
foreach ($data as $name => $stats) {
    $players[] = array_merge(['name' => $name], $stats);
}

// Ordenar los datos
$players = sortTable($players, $sortKey, $order);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valheim Player Ranking</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Valheim Player Ranking</h1>
        <table>
            <thead>
                <tr>
                    <th><a href="?sort=name&order=<?= $order === 'ASC' ? 'DESC' : 'ASC' ?>">NOMBRE</a></th>
                    <th><a href="?sort=completed_achievements&order=<?= $order === 'ASC' ? 'DESC' : 'ASC' ?>">LOGROS</a></th>
                    <th><a href="?sort=total_kills&order=<?= $order === 'ASC' ? 'DESC' : 'ASC' ?>">MONSTERS</a></th>
                    <th><a href="?sort=total_deaths&order=<?= $order === 'ASC' ? 'DESC' : 'ASC' ?>">MUERTES</a></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($players as $player): ?>
                    <tr>
                        <td><?= htmlspecialchars($player['name']) ?></td>
                        <td><?= $player['completed_achievements'] ?></td>
                        <td><?= $player['total_kills'] ?></td>
                        <td><?= $player['total_deaths'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
