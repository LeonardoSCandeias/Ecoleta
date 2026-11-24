<?php
$activePage = $activePage ?? '';
$navItems = [
    'index'   => ['index.php',   'Início'],
    'coletas' => ['coletas.php', 'Coletas'],
    'pontos'  => ['pontos.php',  'Pontos de coleta'],
    'sobre'   => ['sobre.php',   'Sobre'],
    'contato' => ['contato.php', 'Contato'],
];
?>
    <header class="topbar">
        <a class="brand" href="index.php">
            <span class="brand-mark">♻</span>
            <span>ecoleta<span class="brand-dot">.</span></span>
        </a>
        <button class="menu-toggle" aria-label="Abrir menu" aria-expanded="false">☰</button>
        <nav class="nav">
<?php foreach ($navItems as $key => [$href, $label]): ?>
            <a href="<?= $href ?>"<?= $activePage === $key ? ' class="active"' : '' ?>><?= $label ?></a>
<?php endforeach; ?>
        </nav>
        <div class="nav-account" data-account></div>
    </header>