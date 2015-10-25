<?php $error = getErrorMessage() ?>
<?php if (!empty($error)): ?>
    <div class="error"><?= $error ?></div>
<?php endif ?>

<?php $success = getSuccessMessage() ?>
<?php if (!empty($success)): ?>
    <div class="success"><?= $success ?></div>
<?php endif ?>
<br />
