<?php
    // 連接到你的數據庫
    $db = new PDO('mysql:host=localhost;dbname=testdb;charset=utf8', 'username', 'password');

    // 儲存玩家數據
    function savePlayerData($playerId, $data) {
        global $db;
        $stmt = $db->prepare("INSERT INTO player_data (player_id, data) VALUES (:playerId, :data) ON DUPLICATE KEY UPDATE data = :data");
        $stmt->execute([':playerId' => $playerId, ':data' => json_encode($data)]);
    }

    // 讀取玩家數據
    function loadPlayerData($playerId) {
        global $db;
        $stmt = $db->prepare("SELECT data FROM player_data WHERE player_id = :playerId");
        $stmt->execute([':playerId' => $playerId]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return json_decode($data['data'], true);
    }
?>
