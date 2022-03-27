<?php // require_once __DIR__ . '/../includes/header.php'; 
?>
<?php debugear($resultado) ?>
<?php if ($resultado) : ?>

<span>Felicidades <?= $nombre; ?> Confirmaste tu cuenta</span>
<a href="/login">Iniciar Sessión</a>
<?php else : ?>
<span>Token Inválido</span>
<p>No sé encontró este token</p>
<a href="/">Ir a inicio</a>

<?php endif; ?>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>