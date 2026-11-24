<?php
$pageTitle   = 'Pontos de coleta';
$activePage  = 'pontos';
$pageScripts = ['js/pontos.js'];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>
    <main class="page-wrap">
        <section class="page-heading">
            <div>
                <span class="eyebrow">DESCARTE CONSCIENTE</span>
                <h1>Pontos de coleta</h1>
                <p>Explore os tipos de materiais e encontre a destinação adequada.</p>
            </div>
        </section>
        <section class="notice">
            <span>ℹ</span>
            <p><strong>Informação demonstrativa:</strong> os pontos abaixo são exemplos ilustrativos. Confirme endereço e funcionamento antes de se deslocar.</p>
        </section>
        <section class="filter-panel">
            <label class="search-box">
                <span>⌕</span>
                <input id="point-search" type="search" placeholder="Buscar por nome, endereço ou material...">
            </label>
            <select id="material-filter" aria-label="Filtrar material">
                <option value="all">Todos os materiais</option>
                <option value="Papel">Papel</option>
                <option value="Plástico">Plástico</option>
                <option value="Vidro">Vidro</option>
                <option value="Metal">Metal</option>
                <option value="Eletrônicos">Eletrônicos</option>
            </select>
        </section>
        <section class="point-grid" id="point-list">
            <article class="point-card" data-material="Papel,Plástico,Metal" data-search="ecoponto central papel plástico metal">
                <div class="point-top">
                    <span class="point-icon">♻</span>
                    <span class="point-type">RECICLÁVEIS</span>
                </div>
                <h2>Ecoponto Central</h2>
                <p>Recebimento de papel, plástico e metal limpos e separados.</p>
                <div class="point-meta">
                    <span>⌖ Endereço ilustrativo</span>
                    <strong>Av. Principal, 100</strong>
                </div>
                <div class="material-tags">
                    <span>Papel</span>
                    <span>Plástico</span>
                    <span>Metal</span>
                </div>
            </article>
            <article class="point-card" data-material="Eletrônicos" data-search="ponto tecnológico eletrônicos pilhas cabos">
                <div class="point-top">
                    <span class="point-icon icon-blue">⌁</span>
                    <span class="point-type">ESPECIAIS</span>
                </div>
                <h2>Ponto Tecnológico</h2>
                <p>Exemplo de local para descarte de pequenos eletrônicos e cabos.</p>
                <div class="point-meta">
                    <span>⌖ Endereço ilustrativo</span>
                    <strong>Rua da Tecnologia, 250</strong>
                </div>
                <div class="material-tags">
                    <span>Eletrônicos</span>
                </div>
            </article>
            <article class="point-card" data-material="Vidro" data-search="estação vidro garrafas potes">
                <div class="point-top">
                    <span class="point-icon icon-yellow">◇</span>
                    <span class="point-type">VIDRO</span>
                </div>
                <h2>Estação do Vidro</h2>
                <p>Exemplo de recebimento de garrafas e potes de vidro vazios.</p>
                <div class="point-meta">
                    <span>⌖ Endereço ilustrativo</span>
                    <strong>Rua Ambiental, 80</strong>
                </div>
                <div class="material-tags">
                    <span>Vidro</span>
                </div>
            </article>
        </section>
        <p class="no-results" id="no-points" hidden>Nenhum ponto corresponde à sua busca.</p>
    </main>
<?php require __DIR__ . '/includes/footer.php'; ?>