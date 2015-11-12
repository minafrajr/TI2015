// O conteúdo dessa funtion só será executado quando o HTML já
// tiver sido completamente carregado pelo navegador
$(function () {
    $('.tarefa')
        .on('click', '.nome', function() {
            $(this).next().toggleClass('hide');
        })
        .on('click', '.finalizar', function() {
            var importancia = $(this).closest('.tarefa').find('.importancia-tarefa').text() | 0,
                $form = $(this).closest('.concluir-tarefa');
            alert('Parabéns!\nVocê Ganhou ' + (importancia * 10) + ' pontos!');

            $form.find('.acao').val('finalizar');
            $form.submit();
        })
        .on('click', '.excluir', function() {
            var $form = $(this).closest('.concluir-tarefa');

            if (confirm('Tem certeza que deseja excluir esta tarefa?')) {
                $form.find('.acao').val('excluir');
                $form.submit();
            }
        })
        .on('click', '.salvar', function() {
            var $form = $(this).closest('.concluir-tarefa');

            $form.find('.acao').val('salvar');
            $form.submit();
        })
    ;

    $('.icone-menu').click(function() {
        $('.menu').toggleClass('hide').next('.container').toggleClass('margin');
    });

    $('#filtro')
        .on('change', '#duracao, #data, #ordenar', function() {
            $('#filtro').submit();
        })
    ;

    $('#relatorio').on('change', '#group', function() {
        $(this).closest('form').submit();
    });

    $('#cancelar').click(function() {
        window.location.href = '/';
    });

    modifyInputs();
});

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
        alert('As senhas devem ser idênticas!');
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

function validaFormRecuperarSenha() {
    var $senha = document.querySelector('#senha'),
        $confSenha = document.querySelector('#conf_senha');

    if ($senha.value !== $confSenha.value) {
        alert('As senhas devem ser idênticas!');
        $senha.focus();
        return false;
    }

    return true;
}

// Código retirado do site https://css-tricks.com/value-bubbles-for-range-inputs/
function modifyOffset() {
    var el, newPoint, newPlace, offset, siblings, k;
    width    = this.offsetWidth;
    newPoint = (this.value - this.getAttribute("min")) / (this.getAttribute("max") - this.getAttribute("min"));
    offset   = -1;
    if (newPoint < 0) { newPlace = 0;  }
    else if (newPoint > 1) { newPlace = width; }
    else { newPlace = width * newPoint + offset; offset -= newPoint;}
    siblings = this.parentNode.childNodes;
    for (var i = 0; i < siblings.length; i++) {
        sibling = siblings[i];
        if (sibling.id == this.id) { k = true; }
        if ((k == true) && (sibling.nodeName == "OUTPUT")) {
            outputTag = sibling;
        }
    }
    outputTag.style.left       = (newPlace - 15) + "px";
    outputTag.style.marginLeft = offset + "%";
    outputTag.innerHTML        = this.value + ':00';
}

function modifyInputs() {

    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].getAttribute("type") == "range") {
            inputs[i].oninput = modifyOffset;

            // the following taken from http://stackoverflow.com/questions/2856513/trigger-onchange-event-manually
            if ("fireEvent" in inputs[i]) {
                inputs[i].fireEvent("oninput");
            } else {
                var evt = document.create()
                Event("HTMLEvents");
                evt.initEvent("input", false, true);
                inputs[i].dispatchEvent(evt);
            }
        }
    }
}