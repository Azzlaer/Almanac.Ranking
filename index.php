<?php
// Leer y parsear YAML manualmente
$yamlFile = 'Z:\Servidores\Valheim\12\BepInEx\config\Almanac\Players\PlayerListData.yml';
$yamlContent = file_get_contents($yamlFile);

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

// Ordenamiento
function sortTable($array, $key, $order) {
    usort($array, function ($a, $b) use ($key, $order) {
        return $order === 'ASC' ? ($a[$key] <=> $b[$key]) : ($b[$key] <=> $a[$key]);
    });
    return $array;
}

$sortKey = $_GET['sort'] ?? 'completed_achievements';
$order = $_GET['order'] ?? 'DESC';
$nextOrder = $order === 'ASC' ? 'DESC' : 'ASC';

$players = [];
foreach ($data as $name => $stats) {
    $players[] = array_merge(['name' => $name], $stats);
}
$players = sortTable($players, $sortKey, $order);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>🏆 Ranking de Valheim</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h1>🏹 Ranking de Jugadores - Valheim</h1>
    <table>
        <thead>
        <tr>
            <th><a href="?sort=name&order=<?= $nextOrder ?>">🧝 Nombre <?= $sortKey === 'name' ? ($order === 'ASC' ? '🔼' : '🔽') : '' ?></a></th>
            <th><a href="?sort=completed_achievements&order=<?= $nextOrder ?>">🎖️ Logros <?= $sortKey === 'completed_achievements' ? ($order === 'ASC' ? '🔼' : '🔽') : '' ?></a></th>
            <th><a href="?sort=total_kills&order=<?= $nextOrder ?>">⚔️ Asesinatos <?= $sortKey === 'total_kills' ? ($order === 'ASC' ? '🔼' : '🔽') : '' ?></a></th>
            <th><a href="?sort=total_deaths&order=<?= $nextOrder ?>">💀 Muertes <?= $sortKey === 'total_deaths' ? ($order === 'ASC' ? '🔼' : '🔽') : '' ?></a></th>
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
    <p class="footer">Actualizado automáticamente - Valheim Stats 🛡️</p>
</div>
</body>
</html>
