<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';
$allowedMaterials = ['Papel', 'Plástico', 'Vidro', 'Metal', 'Eletrônicos', 'Óleo de cozinha', 'Outros'];

try {
    $pdo = getDBConnection();

    if ($method === 'GET') {
        if (empty($_SESSION['user'])) {
            jsonResponse(['ok' => true, 'items' => []]);
        }

        $userId = (int)$_SESSION['user']['id'];
        $stmt = $pdo->prepare(
            'SELECT id, nome_contato AS name, telefone AS phone, endereco AS address,
                    material, data_desejada AS date, observacoes AS notes, status, criado_em AS createdAt
             FROM coletas
             WHERE usuario_id = :uid
             ORDER BY criado_em DESC, id DESC'
        );
        $stmt->execute(['uid' => $userId]);
        $items = $stmt->fetchAll();

        jsonResponse(['ok' => true, 'items' => $items]);
    }

    if ($method === 'POST' && $action === 'cancel') {
        $user = requireAuth();
        $data = getJsonInput();
        $id = (int)($data['id'] ?? 0);

        if ($id <= 0) {
            jsonResponse(['ok' => false, 'message' => 'ID de solicitação inválido.'], 422);
        }

        $stmt = $pdo->prepare(
            "UPDATE coletas
             SET status = 'Cancelada'
             WHERE id = :id AND usuario_id = :uid AND status = 'Recebida'"
        );
        $stmt->execute([
            'id'  => $id,
            'uid' => (int)$user['id'],
        ]);

        if ($stmt->rowCount() === 0) {
            jsonResponse(['ok' => false, 'message' => 'Não foi possível cancelar esta solicitação.'], 400);
        }

        jsonResponse(['ok' => true, 'message' => 'Solicitação cancelada.']);
    }

    if ($method === 'POST') {
        $user = requireAuth();
        $data = getJsonInput();

        $name = trim((string)($data['name'] ?? ''));
        $phone = trim((string)($data['phone'] ?? ''));
        $address = trim((string)($data['address'] ?? ''));
        $material = trim((string)($data['material'] ?? ''));
        $date = trim((string)($data['date'] ?? ''));
        $notes = trim((string)($data['notes'] ?? ''));

        if (mb_strlen($name) < 3 || $phone === '' || $address === '' || $date === '') {
            jsonResponse(['ok' => false, 'message' => 'Preencha todos os campos obrigatórios.'], 422);
        }
        if (!in_array($material, $allowedMaterials, true)) {
            jsonResponse(['ok' => false, 'message' => 'Tipo de material inválido.'], 422);
        }
        if ($date < date('Y-m-d')) {
            jsonResponse(['ok' => false, 'message' => 'A data desejada não pode ser anterior a hoje.'], 422);
        }

        $stmt = $pdo->prepare(
            "INSERT INTO coletas (usuario_id, nome_contato, telefone, endereco, material, data_desejada, observacoes, status)
             VALUES (:uid, :nome, :telefone, :endereco, :material, :data_desejada, :observacoes, 'Recebida')"
        );
        $stmt->execute([
            'uid'           => (int)$user['id'],
            'nome'          => $name,
            'telefone'      => $phone,
            'endereco'      => $address,
            'material'      => $material,
            'data_desejada' => $date,
            'observacoes'   => $notes !== '' ? $notes : null,
        ]);

        jsonResponse([
            'ok'      => true,
            'id'      => (int)$pdo->lastInsertId(),
            'message' => 'Coleta solicitada com sucesso!',
        ], 201);
    }

    jsonResponse(['ok' => false, 'message' => 'Método não permitido.'], 405);
} catch (Throwable $e) {
    jsonResponse(['ok' => false, 'message' => 'Erro ao processar coletas: ' . $e->getMessage()], 500);
}