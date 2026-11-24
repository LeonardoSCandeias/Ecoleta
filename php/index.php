<?php
$pageTitle   = 'Início';
$activePage  = 'index';
$metaDescription = 'Ecoleta: organização de coletas e descarte consciente de resíduos.';

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
    <main>
        <section class="hero">
            <div class="hero-copy">
                <span class="eyebrow">CUIDAR DO PLANETA COMEÇA PERTO</span>
                <h1>Pequenas atitudes.<br><span>Grandes mudanças.</span></h1>
                <p>Organize suas solicitações de coleta, encontre pontos de descarte e faça parte de uma cidade mais limpa.</p>
                <div class="hero-actions">
                    <a class="btn btn-primary" href="coletas.php">Solicitar coleta <span>→</span></a>
                    <a class="btn btn-ghost" href="pontos.php">Encontrar pontos</a>
                </div>
                <div class="hero-note">
                    <span class="online-dot"></span> Uma iniciativa por um futuro mais sustentável
                </div>
            </div>
            <div class="hero-art">
                <div class="art-orbit orbit-one"></div>
                <div class="art-orbit orbit-two"></div>
                <div class="plant-pot">🌱</div>
                <div class="art-leaf leaf-one">🍃</div>
                <div class="art-leaf leaf-two">🌿</div>
                <div class="art-tag">♻ Descarte consciente</div>
            </div>
        </section>
        <section class="section-head">
            <div>
                <span class="eyebrow">O QUE VOCÊ PRECISA?</span>
                <h2>O Ecoleta facilita o caminho.</h2>
            </div>
            <p>Ferramentas simples para transformar intenção em atitude.</p>
        </section>
        <section class="feature-grid">
            <article class="feature-card">
                <div class="feature-icon icon-green">♻</div>
                <span class="feature-kicker">01 / COLETA</span>
                <h3>Agende uma coleta</h3>
                <p>Registre o material, informe o endereço e acompanhe suas solicitações.</p>
                <a href="coletas.php" class="text-link">Acessar coletas <span>→</span></a>
            </article>
            <article class="feature-card">
                <div class="feature-icon icon-yellow">⌖</div>
                <span class="feature-kicker">02 / LOCALIZAÇÃO</span>
                <h3>Encontre um ponto</h3>
                <p>Consulte locais de recebimento e filtre por tipo de material.</p>
                <a href="pontos.php" class="text-link">Ver pontos <span>→</span></a>
            </article>
            <article class="feature-card">
                <div class="feature-icon icon-blue">✉</div>
                <span class="feature-kicker">03 / CONEXÃO</span>
                <h3>Fale com a equipe</h3>
                <p>Envie dúvidas, sugestões ou compartilhe sua experiência.</p>
                <a href="contato.php" class="text-link">Entrar em contato <span>→</span></a>
            </article>
        </section>
        <section class="impact-banner">
            <div>
                <span class="eyebrow light">NOSSO PROPÓSITO</span>
                <h2>Um futuro mais limpo<br>é uma construção coletiva.</h2>
                <p>Conheça a proposta por trás do Ecoleta e descubra como participar.</p>
            </div>
            <a class="btn btn-light" href="sobre.php">Conheça o projeto →</a>
        </section>
    </main>
<?php require __DIR__ . '/includes/footer.php'; ?>