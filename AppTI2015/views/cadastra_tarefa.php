<?php require_once 'header.php' ?>
<?php require_once '../controller/cadastra_nova_tarefa_control.php' ?>
    <h1>Nova Tarefa </h1>

    <form id="frm_new_tarefa" method="post" action="">
        <table id="tarefas" cellspacing="10">
            <tr>
                <td>Nome:</td>
                <td>
                    <input type="text" name="nometarefa" placeholder="Nome da Tarefa">
                </td>
            </tr>
            <tr>
                <td>Prioridade:</td>
                <td>
                    <select name="prioridade">
                        <option nome="pri">-</option>
                        <option nome="pri">1</option>
                        <option nome="pri">2</option>
                        <option nome="pri">3</option>
                        <option nome="pri">4</option>
                        <option nome="pri">5</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Data</td>
                <td>
                    <input type="date" name="data">
                </td>
            </tr>
            <tr>
                <td>Duração</td>
                <td>
                    <input type="time" name="hora">
                </td>
            </tr>
            <tr>
                <td>Descrição</td>
                <td>
                    <input class="descricao" name="descri" type="text">
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" name="Enviar" value="OK">
                </td>
                <td>
                    <input type="reset" name="limpar" value="Cancelar"></td>
            </tr>
        </table>
    </form>
<?php require_once 'footer.php' ?>