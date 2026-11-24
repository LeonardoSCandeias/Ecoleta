<?php
$pageTitle   = 'Entrar';
$bodyClass   = 'auth-page';
$pageScripts = ['js/auth.js'];
$showFooter  = false;

require __DIR__ . '/includes/head.php';
?>
    <a class="auth-back" href="index.php">← Voltar ao início</a>
    <main class="auth-shell">
        <section class="auth-aside">
            <a class="brand brand-light" href="index.php">
                <span class="brand-mark">♻</span>
                <span>ecoleta<span class="brand-dot">.</span></span>
            </a>
            <div>
                <span class="eyebrow light">BEM-VINDO DE VOLTA</span>
                <h1>Boas escolhas<br>geram mudanças.</h1>
                <p>Acesse sua conta e continue fazendo parte de uma rede mais consciente.</p>
            </div>
            <span class="aside-foot">Cada atitude conta. 🌿</span>
        </section>
        <section class="auth-form-wrap">
            <form class="auth-form" id="login-form">
                <span class="eyebrow">SUA CONTA</span>
                <h2>Entrar no Ecoleta</h2>
                <p class="muted">Informe seus dados de acesso.</p>
                <label>E-mail
                    <input name="email" type="email" autocomplete="email" required placeholder="voce@email.com">
                </label>
                <label>Senha
                    <input name="password" type="password" autocomplete="current-password" required placeholder="Sua senha">
                </label>
                <button class="btn btn-primary btn-full" type="submit">Entrar <span>→</span></button>
                <p class="auth-switch">Ainda não tem conta? <a href="cadastro.php">Criar conta</a></p>
                <p class="demo-note">Autenticação integrada com sessão PHP e banco de dados MySQL.</p>
            </form>
        </section>
    </main>
<?php require __DIR__ . '/includes/footer.php'; ?>