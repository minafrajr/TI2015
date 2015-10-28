<?php require_once 'header.php' ?>
    <form class="filtro">
        <div class="linha">
            <div class="label"><label for="duracao">Duração até:</label></div>
            <div class="campo">
                <input type="range" name="duracao" id="duracao" min="0" max="23" step="1" value="0" />
                <output for="duracao"></output>
            </div>
            <div class="clear"></div>
        </div>
        <div class="linha">
            <div class="label"><label for="data">Data:</label></div>
            <div class="campo"><input type="date" id="data" /></div>
            <div class="clear"></div>
        </div>
        <div class="linha">
            <div class="label"><label for="ordenar">Ordenar por:</label></div>
            <div class="campo">
                <select id="ordenar">
                    <option value="data">Data</option>
                    <option value="duracao">Duração</option>
                </select>
            </div>
            <div class="clear"></div>
        </div>
    </form>

<?php if (empty($result)): ?>
    Não há tarefas cadastradas!
<?php else: ?>
    <div id="tarefas">
        <?php foreach ($result as $tarefa): ?>
            <div class="tarefa">
                <div class="nome">
                    <div class="descricao-tarefa"><?= $tarefa['NomTar'] ?></div>
                    <div class="importancia-tarefa"><?= $tarefa['PonTar'] ?></div>
                </div>
                <div class="detalhe hide">
                    <form>
                        <div class="linha">
                            <div class="label"><label for="data_<?= $tarefa['CodTar'] ?>">Data:</label></div>
                            <div class="campo"><input class="data" id="data_<?= $tarefa['CodTar'] ?>"
                                                      type="datetime-local" value="<?= $tarefa['DatIniTar'] ?>" /></div>
                        </div>

                        <div class="linha">
                            <div class="label"><label for="duracao_<?= $tarefa['CodTar'] ?>">Duração:</label></div>
                            <div class="campo"><input class="duracao" id="duracao_<?= $tarefa['CodTar'] ?>" type="time"
                                                      value="<?= $tarefa['TepTar'] ?>" /></div>
                        </div>
                        <div class="linha">
                            <div class="label"><label for="descricao_<?= $tarefa['CodTar'] ?>">Descrição</label></div>
                            <div class="campo">
                                <textarea id="descricao_<?= $tarefa['CodTar'] ?>"><?= $tarefa['DesTar'] ?></textarea>
                            </div>
                        </div>
                        <div class="linha">
                            <div class="label">Finalizar</div>
                            <div class="campo">
                                <input type="checkbox" class="finalizar" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>
<?php require_once 'footer.php' ?>