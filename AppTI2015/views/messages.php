<?php $error = $controller->getMensagemErro() ?>
<?php if (!empty($error)): ?>
    <div class="error"><?= $error ?></div>
<?php endif ?>

<?php $success = $controller->getMensagemSucesso() ?>
<?php if (!empty($success)): ?>
    <div class="success"><?= $success ?></div>
<?php endif ?>
<br />
