<?php
$showFooter = $showFooter ?? true;
?>
<?php if ($showFooter): ?>
    <footer class="footer">
        <a class="brand brand-footer" href="index.php">
            <span class="brand-mark">♻</span>
            <span>ecoleta<span class="brand-dot">.</span></span>
        </a>
        <p>Conectando pessoas a atitudes sustentáveis.</p>
        <span>© <?= date('Y') ?> Ecoleta. Projeto acadêmico.</span>
    </footer>
<?php endif; ?>
    <div class="toast-region" aria-live="polite"></div>
</body>
</html>