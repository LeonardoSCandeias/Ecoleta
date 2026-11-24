<?php
$pageTitle   = 'Criar conta';
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
                <span class="eyebrow light">FAÇA PARTE DA MUDANÇA</span>
                <h1>Um gesto seu<br>faz diferença.</h1>
                <p>Crie sua conta para organizar suas solicitações e acompanhar suas ações sustentáveis.</p>
            </div>
            <span class="aside-foot">Sustentabilidade começa com participação.</span>
        </section>
        <section class="auth-form-wrap">
            <form class="auth-form" id="register-form">
                <span class="eyebrow">BOAS-VINDAS</span>
                <h2>Crie sua conta</h2>
                <p class="muted">Preencha os dados para começar.</p>
                <label>Nome completo
                    <input name="name" type="text" autocomplete="name" minlength="3" required placeholder="Como podemos te chamar?">
                </label>
                <label>E-mail
                    <input name="email" type="email" autocomplete="email" required placeholder="voce@email.com">
                </label>
                <label>Senha
                    <input name="password" type="password" autocomplete="new-password" minlength="6" required placeholder="Mínimo de 6 caracteres">
                </label>
                <label>Confirmar senha
                    <input name="confirm" type="password" autocomplete="new-password" minlength="6" required placeholder="Digite a senha novamente">
                </label>
                <button class="btn btn-primary btn-full" type="submit">Criar conta <span>→</span></button>
                <p class="auth-switch">Já tem uma conta? <a href="login.php">Entrar</a></p>
                <p class="demo-note">Os dados são armazenados de forma segura no banco de dados MySQL via PHP.</p>
            </form>
        </section>
    </main>
<?php require __DIR__ . '/includes/footer.php'; ?>