// O conteúdo dessa funtion só será executado quando o HTML já
// tiver sido completamente carregado pelo navegador
$(function () {
    $('.tarefa')
        .on('click', '.nome', function() {
            $(this).next().toggleClass('hide');
        })
        .on('click', '.finalizar', function() {
            if ($(this).is(':checked')) {
                var importancia = $(this).closest('.tarefa').find('.importancia-tarefa').text() | 0;
                alert('Parabéns!\nVocê Ganhou ' + (importancia * 10) + ' pontos!');
                $(this).closest('.tarefa').remove();
            }
        })
    ;

    $('.icone-menu').click(function() {
        $('.menu').toggleClass('hide').next('.container').toggleClass('margin');
    });

    $('.filtro')
        .on('input', '#duracao', function() {
            filtrar();
        })
        .on('change', '#data', function() {
            filtrar();
        })
        .on('change', '#ordenar', function() {
            var $ordem = this.value;
            $('#tarefas').find('.tarefa').each(function() {
                var self = this;
                return $.each(Array.prototype.sort.call(self, $ordem), function(i) {
                    $(this).closest('#tarefas').append(this);
                });
            });
        })
    ;

    modifyInputs();
});

function filtrar()
{
    // variável | 0 ==> convertendo valor de variável para inteiro
    var $duracao = $('#duracao').val() | 0,
        $data = $('#data').val();

    $('.tarefa').removeClass('hide').each(function() {
        var $tarefa = $(this),
        // duracao = valor do campo de duração da tarefa, dividido pelo :, primeira posição, convertido pra inteiro
            duracao = $tarefa.find('.duracao').val().split(':')[0] | 0,
            data = $tarefa.find('.data').val().split('T')[0];

        // Se duração da tarefa é menor que a duração do filtro, esconde
        if ($duracao !== 0 && duracao < $duracao - 1) {
            $tarefa.addClass('hide');
        }

        // Se a data do filtro é diferente da data da tarefa, esconde
        if ($data !== '' && $data != data) {
            $tarefa.addClass('hide');
        }
    });
}

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

function duracao(a, b)
{
    var $a = $(a).find('.duracao').val(),
        $b = $(b).find('.duracao').val();

    if ($a < $b) return -1;
    else if ($a > $b) return 1;
    return 0;
}

function data(a, b)
{
    var $a = new Date($(a).find('.data').val()),
        $b = new Date($(b).find('.data').val());

    if ($a < $b) return -1;
    else if ($a > $b) return 1;
    return 0;
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
                var evt = document.createEvent("HTMLEvents");
                evt.initEvent("input", false, true);
                inputs[i].dispatchEvent(evt);
            }
        }
    }
}





jQuery.fn.sortDomElements = (function() {
    return function(comparator) {
        return $.each(Array.prototype.sort.call(this, comparator), function(i) {
            this.parentNode.appendChild(this);
        });
    };
})();

$("#sortPlease").children().sortDomElements(function(a,b){
    akey = $(a).attr("sortkey");
    bkey = $(b).attr("sortkey");
    if (akey == bkey) return 0;
    if (akey < bkey) return -1;
    if (akey > bkey) return 1;
})
