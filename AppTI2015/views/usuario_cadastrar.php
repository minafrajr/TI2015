<?php require_once 'header.php' ?>
    <form id="frm1" method="post" action="" onsubmit="return validaFormCadastroUsuario()" enctype="multipart/form-data">
        <table id="usuario" cellspacing="10">
            <tr>
                <td><label for="nome">Nome:</label></td>
                <td>
                    <input required type="text" id="nome" name="nome" Placeholder="Digite seu nome">
                    <em>*</em>
                </td>
            </tr>
            <tr>
                <td><label for="email">E-mail:</label></td>
                <td>
                    <input required type="email" id="email" name="email" placeholder="Digite seu e-mail">
                    <em>*</em>
                </td>
            </tr>
            <tr>
                <td><label for="dataNascimento">Data de Nascimento:</label></td>
                <td>
                    <input required type="date" name="dataNascimento" id="dataNascimento">
                    <em>*</em>
                </td>
            </tr>
            <tr>
                <td><label for="senha">Senha:</label></td>
                <td>
                    <input required pattern=".{6,}" placeholder="Mínimo 6 caracteres" type="password" id="senha" name="senha">
                    <em>*</em>
                </td>
            </tr>
            <tr>
                <td><label for="conf_senha">Confirmar Senha:</label></td>
                <td>
                    <input required pattern=".{6,}" placeholder="Mínimo 6 caracteres" type="password" id="conf_senha" name="conf_senha">
                    <em>*</em>
                </td>
            </tr>
            <tr>
                <td colspan="2">* Campos Obrigatorios</td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="Enviar" value="OK">
                </td>
                <td>
                    <button type="button" id="cancelar">Cancelar</button>
                </td>
            </tr>
        </table>
        <br />
    </form>
<?php require_once 'footer.php' ?>