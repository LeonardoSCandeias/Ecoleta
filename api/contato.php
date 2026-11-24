<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonResponse(['ok' => false, 'message' => 'Método não permitido.'], 405);
}

try {
    $data = getJsonInput();
    $name = trim((string)($data['name'] ?? ''));
    $email = trim((string)($data['email'] ?? ''));
    $subject = trim((string)($data['subject'] ?? ''));
    $message = trim((string)($data['message'] ?? ''));

    if (mb_strlen($name) < 3) {
        jsonResponse(['ok' => false, 'message' => 'Informe um nome com pelo menos 3 caracteres.'], 422);
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        jsonResponse(['ok' => false, 'message' => 'Informe um e-mail válido.'], 422);
    }
    if ($subject === '' || mb_strlen($message) < 10) {
        jsonResponse(['ok' => false, 'message' => 'Preencha assunto e mensagem (mínimo 10 caracteres).'], 422);
    }

    $pdo = getDBConnection();
    $stmt = $pdo->prepare(
        'INSERT INTO mensagens_contato (nome, email, assunto, mensagem)
         VALUES (:nome, :email, :assunto, :mensagem)'
    );
    $stmt->execute([
        'nome'     => $name,
        'email'    => $email,
        'assunto'  => $subject,
        'mensagem' => $message,
    ]);

    jsonResponse([
        'ok'      => true,
        'id'      => (int)$pdo->lastInsertId(),
        'message' => 'Mensagem registrada no banco de dados. Obrigado pelo contato!',
    ], 201);
} catch (Throwable $e) {
    jsonResponse(['ok' => false, 'message' => 'Erro ao enviar mensagem: ' . $e->getMessage()], 500);
}