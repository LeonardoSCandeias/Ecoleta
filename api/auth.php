<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

try {
    $pdo = getDBConnection();

    if ($method === 'GET' && $action === 'session') {
        jsonResponse([
            'ok'   => true,
            'user' => $_SESSION['user'] ?? null,
        ]);
    }

    if ($method === 'POST' && $action === 'register') {
        $data = getJsonInput();
        $name = trim((string)($data['name'] ?? ''));
        $email = mb_strtolower(trim((string)($data['email'] ?? '')));
        $password = (string)($data['password'] ?? '');
        $confirm = (string)($data['confirm'] ?? '');

        if (mb_strlen($name) < 3) {
            jsonResponse(['ok' => false, 'message' => 'O nome deve ter pelo menos 3 caracteres.'], 422);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            jsonResponse(['ok' => false, 'message' => 'Informe um e-mail válido.'], 422);
        }
        if (mb_strlen($password) < 6) {
            jsonResponse(['ok' => false, 'message' => 'A senha deve ter pelo menos 6 caracteres.'], 422);
        }
        if ($password !== $confirm) {
            jsonResponse(['ok' => false, 'message' => 'As senhas não coincidem.'], 422);
        }

        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        if ($stmt->fetch()) {
            jsonResponse(['ok' => false, 'message' => 'Já existe uma conta com esse e-mail.'], 409);
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $insert = $pdo->prepare('INSERT INTO usuarios (nome, email, senha_hash) VALUES (:nome, :email, :senha_hash)');
        $insert->execute([
            'nome'       => $name,
            'email'      => $email,
            'senha_hash' => $hash,
        ]);

        $user = [
            'id'    => (int)$pdo->lastInsertId(),
            'name'  => $name,
            'email' => $email,
        ];
        $_SESSION['user'] = $user;

        jsonResponse(['ok' => true, 'message' => 'Conta criada com sucesso!', 'user' => $user], 201);
    }

    if ($method === 'POST' && $action === 'login') {
        $data = getJsonInput();
        $email = mb_strtolower(trim((string)($data['email'] ?? '')));
        $password = (string)($data['password'] ?? '');

        $stmt = $pdo->prepare('SELECT id, nome, email, senha_hash FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch();

        if (!$row || !password_verify($password, $row['senha_hash'])) {
            jsonResponse(['ok' => false, 'message' => 'E-mail ou senha incorretos.'], 401);
        }

        $user = [
            'id'    => (int)$row['id'],
            'name'  => $row['nome'],
            'email' => $row['email'],
        ];
        $_SESSION['user'] = $user;

        jsonResponse(['ok' => true, 'message' => 'Login realizado com sucesso!', 'user' => $user]);
    }

    if ($method === 'POST' && $action === 'logout') {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        jsonResponse(['ok' => true, 'message' => 'Sessão encerrada com sucesso.']);
    }

    jsonResponse(['ok' => false, 'message' => 'Rota de autenticação inválida.'], 404);
} catch (Throwable $e) {
    jsonResponse(['ok' => false, 'message' => 'Erro no servidor: ' . $e->getMessage()], 500);
}