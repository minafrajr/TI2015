<?php $tela = 'Novo Usuario' ?>
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
                <td><label for="email">Email:</label></td>
                <td>
                    <input required type="email" id="email" name="email">
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
                    <input required type="password" id="senha" name="senha">
                    <em>*</em>
                </td>
            </tr>
            <tr>
                <td><label for="conf_senha">Confirmar Senha:</label></td>
                <td>
                    <input required type="password" id="conf_senha" name="conf_senha">
                    <em>*</em>
                </td>
            </tr>
            <tr>
                <td><label for="avatarToUpload">Escolher Avatar:</label></td>
                <td>
                    <input type="file" name="avatarToUpload" id="avatarToUpload">
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
                    <input type="reset" name="limpar" value="Cancelar">
                </td>
            </tr>
        </table>
        <br />
    </form>
    <script type="text/javascript" src="/js/validacao_form.js"></script>
<?php require_once 'footer.php' ?>