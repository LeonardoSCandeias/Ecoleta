<?php
$pageTitle       = $pageTitle       ?? 'Início';
$bodyClass       = $bodyClass       ?? '';
$metaDescription = $metaDescription ?? '';
$pageScripts     = $pageScripts     ?? [];
$e = static fn(string $v): string => htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if ($metaDescription !== ''): ?>
    <meta name="description" content="<?= $e($metaDescription) ?>">
<?php endif; ?>
    <title>Ecoleta | <?= $e($pageTitle) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/app.js" defer></script>
<?php foreach ($pageScripts as $script): ?>
    <script src="<?= $e($script) ?>" defer></script>
<?php endforeach; ?>
</head>
<body<?= $bodyClass !== '' ? ' class="' . $e($bodyClass) . '"' : '' ?>>