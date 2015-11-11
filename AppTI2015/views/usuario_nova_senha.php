<?php require_once 'header.php' ?>
    <h2>Insira sua nova senha:</h2>
    <form method="post" action="" onsubmit="return validaFormRecuperarSenha()">
        <table id="tarefas" cellspacing="10">
            <tr>
                <td><label for="senha">Senha:</label></td>
                <td>
                    <input required pattern=".{6,}" placeholder="Mínimo 6 caracteres" type="password" id="senha" name="senha">
                </td>
            </tr>
            <tr>
                <td><label for="conf_senha">Confirmar Senha:</label></td>
                <td>
                    <input required pattern=".{6,}" placeholder="Mínimo 6 caracteres" type="password" id="conf_senha" name="conf_senha">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Enviar">
                </td>
                <td>
                    <button type="button" id="cancelar">Cancelar</button>
                </td>
            </tr>
        </table>
    </form>
<?php require_once 'footer.php' ?>