<?php
$pageTitle   = 'Contato';
$activePage  = 'contato';
$pageScripts = ['js/contato.js'];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
    <main class="page-wrap">
        <section class="page-heading">
            <div>
                <span class="eyebrow">ESTAMOS AQUI PARA OUVIR</span>
                <h1>Vamos conversar?</h1>
                <p>Envie sua dúvida, sugestão ou comentário para a equipe Ecoleta.</p>
            </div>
        </section>
        <section class="contact-layout">
            <aside class="contact-aside">
                <h2>Fale com a gente.</h2>
                <p>Escolha um canal ou envie uma mensagem pelo formulário.</p>
                <div class="contact-method">
                    <span>◎</span>
                    <div>
                        <small>INSTAGRAM</small>
                        <strong>@Ecoleta</strong>
                    </div>
                </div>
                <div class="contact-method">
                    <span>◉</span>
                    <div>
                        <small>WHATSAPP</small>
                        <strong>9XXXX-XX08</strong>
                    </div>
                </div>
                <div class="contact-disclaimer">
                    Os canais apresentados fazem parte da demonstração do projeto.
                </div>
            </aside>
            <section class="panel contact-form-panel">
                <form id="contact-form">
                    <label>Nome
                        <input name="name" required minlength="3" placeholder="Seu nome">
                    </label>
                    <label>E-mail
                        <input name="email" type="email" required placeholder="voce@email.com">
                    </label>
                    <label>Assunto
                        <input name="subject" required placeholder="Sobre o que deseja falar?">
                    </label>
                    <label>Mensagem
                        <textarea name="message" rows="5" required minlength="10" placeholder="Escreva sua mensagem..."></textarea>
                    </label>
                    <button class="btn btn-primary btn-full" type="submit">Enviar mensagem <span>→</span></button>
                    <p class="form-hint">Sua mensagem será validada e registrada no banco de dados da equipe Ecoleta.</p>
                </form>
            </section>
        </section>
    </main>
<?php require __DIR__ . '/includes/footer.php'; ?>