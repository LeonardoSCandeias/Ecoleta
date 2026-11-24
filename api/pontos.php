<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    jsonResponse(['ok' => false, 'message' => 'Método não permitido.'], 405);
}

try {
    $pdo = getDBConnection();
    $stmt = $pdo->query(
        'SELECT id, nome, categoria, descricao, endereco, materiais, icone, cor_icone
         FROM pontos_coleta
         WHERE ativo = 1
         ORDER BY id ASC'
    );
    $pontos = $stmt->fetchAll();

    jsonResponse(['ok' => true, 'items' => $pontos]);
} catch (Throwable $e) {
    jsonResponse(['ok' => false, 'message' => 'Erro ao carregar pontos de coleta: ' . $e->getMessage()], 500);
}