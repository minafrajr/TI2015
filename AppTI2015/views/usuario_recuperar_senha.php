<?php require_once 'header.php' ?>
    <h2>Para recuperar sua senha, preencha os campos abaixo:</h2>
    <form method="post" action="">
        <table id="tarefas" cellspacing="10">
            <tr>
                <td>Email:</td>
                <td>
                    <input type="text" name="email" Placeholder="Seu email">
                </td>
            <tr>
                <td>Data de nascimento:</td>
                <td>
                    <input type="date" name="dataNascimento" Placeholder="Sua data de nascimento">
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