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

    if ($senha.value === '') {
        alert('Preencha a senha');
        $senha.focus();
        return false;
    }

    return true;
}

function validaFormCadastroTarefa() {
    var $nome = document.querySelector('#nome'),
        $prioridade = document.querySelector('#prioridade'),
        $data = document.querySelector('#data'),
        $duracao = document.querySelector('#duracao');

    if ($nome.value === '') {
        alert('Preencha o campo nome');
        $nome.focus();
        return false;
    }

    if ($prioridade.value === '') {
        alert('Preencha o campo prioridade');
        $nome.focus();
        return false;
    }

    if ($data.value === '') {
        alert('Preencha o campo data');
        $nome.focus();
        return false;
    }

    if ($duracao.value === '') {
        alert('Preencha o campo duração');
        $nome.focus();
        return false;
    }

    return true;
}