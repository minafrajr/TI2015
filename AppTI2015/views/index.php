<?php require_once 'header.php' ?>
    <form id="filtro" method="post" action="">
        <div class="linha">
            <div class="label"><label for="duracao">Duração até:</label></div>
            <div class="campo">
                <input type="range" name="duracao" id="duracao" min="0" max="23" step="1"
                       value="<?= $view['duracao'] ?>" />
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
    Não há tarefas cadastradas!
<?php else: ?>

    <div id="tarefas">
        <?php foreach ($view['result'] as $tarefa): ?>
            <form action="/tarefa_concluir.php" class="concluir-tarefa" method="post">
                <div class="tarefa">
                    <div class="nome">
                        <div class="descricao-tarefa"><?= $tarefa['NomTar'] ?></div>
                        <div class="importancia-tarefa"><?= $tarefa['PonTar'] ?></div>
                    </div>
                    <div class="detalhe hide">
                        <div class="linha">
                            <div class="label"><label for="data_<?= $tarefa['CodTar'] ?>">Data:</label></div>
                            <div class="campo">
                                <input class="data" id="data_<?= $tarefa['CodTar'] ?>"
                                       name="data"
                                       type="datetime-local" value="<?= $tarefa['DatIniTar'] ?>" />
                            </div>
                        </div>

                        <div class="linha">
                            <div class="label"><label for="duracao_<?= $tarefa['CodTar'] ?>">Duração:</label></div>
                            <div class="campo">
                                <input class="duracao" id="duracao_<?= $tarefa['CodTar'] ?>"
                                       type="time" name="duracao"
                                       value="<?= $tarefa['TepTar'] ?>" />
                            </div>
                        </div>
                        <div class="linha">
                            <div class="label"><label for="descricao_<?= $tarefa['CodTar'] ?>">Descrição</label>
                            </div>
                            <div class="campo">
                                    <textarea
                                        id="descricao_<?= $tarefa['CodTar'] ?>"
                                        name="descricao"><?= $tarefa['DesTar'] ?></textarea>
                            </div>
                        </div>
                        <div class="linha">
                            <div class="label">&nbsp;</div>
                            <div class="campo">
                                <button type="button" class="finalizar">Finalizar</button>
                                <button type="button" class="excluir">Excluir</button>
                                <button type="button" class="salvar">Salvar</button>
                            </div>
                        </div>
                        <input type="hidden" name="acao" class="acao" />
                        <input type="hidden" name="CodTar" value="<?= $tarefa['CodTar'] ?>" />
                    </div>
                </div>
            </form>
        <?php endforeach ?>
    </div>

<?php endif ?>
<?php require_once 'footer.php' ?>