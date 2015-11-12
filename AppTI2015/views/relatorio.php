<?php require_once 'header.php' ?>
    <form id="relatorio" method="post" action="">
        <div class="linha">
            <div class="label"><label for="group">Agrupar por:</label></div>
            <div class="campo">
                <select name="group" id="group">
                    <option value="ano" <?= $view['group'] === 'ano' ? 'selected' : '' ?>>Ano</option>
                    <option value="mes" <?= $view['group'] === 'mes' ? 'selected' : '' ?>>Mês</option>
                    <option value="semana" <?= $view['group'] === 'semana' ? 'selected' : '' ?>>Semana</option>
                </select>
            </div>
            <div class="clear"></div>
        </div>
    </form>

    <table>
        <caption>Relatório agrupado por <?= $view['group'] ?></caption>
        <thead>
            <tr>
                <th>Ano</th>
                <?php if ($view['group'] === 'mes'): ?>
                    <th>Mês</th>
                <?php elseif ($view['group'] === 'semana'): ?>
                    <th>Início da semana</th>
                    <th>Fim da Semana</th>
                <?php endif ?>
                <th>Tarefas concluídas</th>
                <th>Média de tempo</th>
                <th>Pontuação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($view['relatorio'] as $linha): ?>
                <tr>
                    <td><?= $linha['ano'] ?></td>
                    <?php if ($view['group'] === 'mes'): ?>
                        <td><?= $linha['mes'] ?></td>
                    <?php elseif ($view['group'] === 'semana'): ?>
                        <td><?= $linha['inicio_semana'] ?></td>
                        <td><?= $linha['fim_semana'] ?></td>
                    <?php endif ?>
                    <td><?= $linha['total'] ?></td>
                    <td><?= $linha['media_tempo'] ?></td>
                    <td><?= $linha['pontos'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php require_once 'footer.php' ?>