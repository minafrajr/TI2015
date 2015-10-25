function validaFormCadastroUsuario() {
    var $nome = document.querySelector('#nome'),
        $email = document.querySelector('#email'),
        $dataNascimento = document.querySelector('#dataNascimento'),
        $senha = document.querySelector('#senha'),
        $confSenha = document.querySelector('#conf_senha');

    if ($nome.value === '') {
        alert('Preencha o nome');
        $nome.focus();
        return false;
    }

    if ($email.value === '') {
        alert('Preencha o e-mail');
        $email.focus();
        return false;
    }

    if ($dataNascimento.value === '') {
        alert('Preencha a data de nascimento');
        $dataNascimento.focus();
        return false;
    }

    if ($senha.value === '') {
        alert('Preencha a senha');
        $senha.focus();
        return false;
    }

    if ($senha.value !== $confSenha.value) {
        alert('As senhas devem ser idênticas');
        $confSenha.focus();
        return false;
    }

    return true;
}