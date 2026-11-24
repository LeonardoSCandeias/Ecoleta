<?php
$pageTitle   = 'Sobre';
$activePage  = 'sobre';

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
    <main class="page-wrap">
        <section class="about-hero">
            <span class="eyebrow">NOSSA HISTÓRIA</span>
            <h1>Tecnologia a serviço<br><span>de um mundo melhor.</span></h1>
            <p>O Ecoleta é um projeto acadêmico que propõe aproximar pessoas de práticas mais conscientes de descarte e reciclagem.</p>
        </section>
        <section class="about-columns">
            <article class="about-block">
                <span class="feature-icon icon-green">◎</span>
                <h2>Nosso propósito</h2>
                <p>Facilitar a organização de informações sobre coletas e pontos de recebimento, tornando o descarte correto mais acessível e compreensível.</p>
            </article>
            <article class="about-block">
                <span class="feature-icon icon-yellow">✦</span>
                <h2>Nossa visão</h2>
                <p>Contribuir para uma cultura de responsabilidade ambiental, na qual tecnologia e participação da comunidade caminhem juntas.</p>
            </article>
            <article class="about-block">
                <span class="feature-icon icon-blue">♡</span>
                <h2>Nossos valores</h2>
                <p>Consciência, colaboração, acessibilidade, transparência e respeito ao meio ambiente orientam a proposta do Ecoleta.</p>
            </article>
        </section>
        <section class="impact-banner">
            <div>
                <span class="eyebrow light">FAÇA PARTE</span>
                <h2>O próximo passo pode ser seu.</h2>
                <p>Registre uma solicitação ou conheça os pontos demonstrativos.</p>
            </div>
            <a class="btn btn-light" href="coletas.php">Começar agora →</a>
        </section>
    </main>


<?php require __DIR__ . '/includes/footer.php'; ?>
