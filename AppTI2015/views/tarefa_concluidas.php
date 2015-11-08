<?php require_once 'header.php' ?>
    <form id="filtro" method="post" action="">
        <div class="linha">
            <div class="label"><label for="duracao">Duração até:</label></div>
            <div class="campo">
                <input type="range" name="duracao" id="duracao" min="0" max="23" step="1" value="<?= $view['duracao'] ?>" />
                <output for="duracao"></output>
            </div>
            <div class="clear"></div>
        </div>
        <div class="linha">
            <div class="label"><label for="data">Data:</label></div>
            <div class="campo"><input type="date" id="data" name="data" value="<?= $view['data'] ?>" /></div>
            <div class="clear"></div>
        </div>
        <div class="linha">
            <div class="label"><label for="ordenar">Ordenar por:</label></div>
            <div class="campo">
                <select id="ordenar" name="ordenar">
                    <option value="PonTar" <?= $view['ordenar'] === 'PonTar' ? 'selected' : '' ?>>Pontuação</option>
                    <option value="NomTar" <?= $view['ordenar'] === 'NomTar' ? 'selected' : '' ?>>Nome</option>
                    <option value="DatIniTar" <?= $view['ordenar'] === 'DatIniTar' ? 'selected' : '' ?>>Data</option>
                    <option value="TepTar" <?= $view['ordenar'] === 'TepTar' ? 'selected' : '' ?>>Duração</option>
                </select>
            </div>
            <div class="clear"></div>
        </div>
    </form>

<?php if (empty($view['result'])): ?>
    Não há tarefas concluídas!
<?php else: ?>
    <div id="tarefas">
        <?php foreach ($view['result'] as $tarefa): ?>
            <div class="tarefa">
                <div class="nome">
                    <div class="descricao-tarefa"><?= $tarefa['NomTar'] ?></div>
                    <div class="importancia-tarefa"><?= $tarefa['PonTar'] ?></div>
                </div>
                <div class="detalhe hide">
                    <form>
                        <div class="linha">
                            <div class="label">Data:</div>
                            <div class="campo"><?= $tarefa['DatIniTar'] ?></div>
                        </div>

                        <div class="linha">
                            <div class="label">Duração:</div>
                            <div class="campo"><?= $tarefa['TepTar'] ?></div>
                        </div>
                        <div class="linha">
                            <div class="label">Descrição:</div>
                            <div class="campo"><?= $tarefa['DesTar'] ?>&nbsp;</div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>
<?php require_once 'footer.php' ?>