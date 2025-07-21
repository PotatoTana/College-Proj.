<?php
header('Content-Type: application/json');
require_once 'config.php';

$main = isset($_GET['main']) ? $_GET['main'] : '';
$sub = isset($_GET['sub']) ? $_GET['sub'] : '';

if (empty($main) || empty($sub)) {
    echo json_encode(['error' => 'Missing parameters']);
    exit;
}

$conn->set_charset("utf8");

$menus = [];

if ($main === 'recommend') {
    if ($sub === 'new') {
        $res = $conn->query("SELECT * FROM menu_cm WHERE menu_group IN ('Food', 'Drink') ORDER BY id DESC LIMIT 5");
        while ($row = $res->fetch_assoc()) {
            $menus[] = $row;
        }
    } elseif ($sub === 'best sale') {
        $bestSaleMap = [];
        $res = $conn->query("SELECT order_details FROM orders WHERE status = 'Completed'");
        while ($row = $res->fetch_assoc()) {
            $lines = explode("\n", $row['order_details']);
            foreach ($lines as $line) {
                if (preg_match('/^(.*?)\s*(?:\((.*?)\))?\s*\*?(\d+)?\s*-\s*[\d.,]+\s*฿$/u', trim($line), $m)) {
                    $name = strtolower(trim($m[1]));
                    $qty = isset($m[3]) && $m[3] ? (int)$m[3] : 1;
                    $bestSaleMap[$name] = ($bestSaleMap[$name] ?? 0) + $qty;
                }
            }
        }
        arsort($bestSaleMap);
        $topMenuNames = array_slice(array_keys($bestSaleMap), 0, 5);

        if (!empty($topMenuNames)) {
            $placeholders = implode(',', array_fill(0, count($topMenuNames), '?'));
            $stmt = $conn->prepare("SELECT * FROM menu_cm WHERE LOWER(TRIM(name)) IN ($placeholders)");
            $stmt->bind_param(str_repeat('s', count($topMenuNames)), ...$topMenuNames);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $key = strtolower(trim($row['name']));
                if (isset($bestSaleMap[$key])) {
                    $row['total_ordered'] = $bestSaleMap[$key];
                    $menus[] = $row;
                }
            }
            $stmt->close();
        }
    }
} elseif ($main === 'drink') {
    $stmt = $conn->prepare("SELECT * FROM menu_cm WHERE menu_group = 'Drink' AND menu_type = ? ORDER BY id DESC");
    $stmt->bind_param('s', $sub);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $menus[] = $row;
    }
    $stmt->close();
} else {
    $stmt = $conn->prepare("SELECT * FROM menu_cm WHERE menu_group = ? AND menu_type = ? ORDER BY id DESC");
    $stmt->bind_param('ss', $main, $sub);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $menus[] = $row;
    }
    $stmt->close();
}

echo json_encode($menus);
$conn->close();
?>