<?php require_once 'header.php' ?>

<form method="post" action="">
    <table id="tarefas" cellspacing="10">
        <tr>
            <td>Email:</td>
            <td>
                <input type="text" name="email" Placeholder="seu email">
            </td>
        <tr>
            <td>Senha:</td>
            <td>
                <input type="password" name="senha" Placeholder="sua senha">
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="Enviar" value="Entrar">
            </td>

            <td>
                <input type="reset" name="limpar" value="Cancelar">
            </td>
        </tr>
    </table>
</form>
<br />

<div>
    <a href="/usuario_cadastrar.php">Cadastre-se</a>
    <a href="/usuario_recuperar_senha.php">Recuperar senha</a>
</div>

<?php require_once 'footer.php' ?>