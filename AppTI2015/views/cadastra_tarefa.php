<?php $tela = 'Nova Tarefa' ?>
<?php require_once 'header.php' ?>
    <form id="frm_new_tarefa" method="post" action="" onsubmit="return validaFormCadastroTarefa()">
        <div class="linha">
            <div class="label"><label for="nome"><em>*</em> Nome:</label></div>
            <div class="campo">
                <input type="text" name="nome" id="nome" required />
            </div>
        </div>
        <div class="linha">
            <div class="label">
                <label for="prioridade">
                    <em>*</em> Prioridade:
                </label>
            </div>
            <div class="campo">
                <select name="prioridade" id="prioridade" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
        </div>

        <div class="linha">
            <div class="label"><label for="data"><em>*</em> Data:</label></div>
            <div class="campo">
                <input type="datetime-local" name="data" id="data" required />
            </div>
        </div>
        <div class="linha">
            <div class="label"><label for="duracao"><em>*</em> Duração:</label></div>
            <div class="campo">
                <input type="time" name="duracao" id="duracao" required />
            </div>
        </div>
        <div class="linha">
            <div class="label"><label for="descricao">Descrição:</label></div>
            <div class="campo">
                <input class="descricao" name="descricao" id="descricao" type="text" />
            </div>
        </div>
        <div class="linha">
            <div class="label">
                <input type="submit" name="Enviar" value="OK">
            </div>
            <div class="campo">
                <input type="reset" name="limpar" value="Cancelar">
            </div>
        </div>
    </form>
<?php require_once 'footer.php' ?>