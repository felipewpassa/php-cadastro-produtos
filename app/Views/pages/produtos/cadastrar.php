<div class="col-md-8 mx-auto p-5">
    <div class="card">
        <div class="card-header">
            Cadastrar Produto
        </div>
        <?=Session::alert('Produto')?>
        <div class="card-body">
            <form name="categoria" method="POST" action="<?=URL?>/produtos/cadastrar">
                <input id="nmProduto" name="nmProduto" type="text" placeholder="nmProduto"
                class="form-control <?= $data['nmProdutoErro'] ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= $data['nmProdutoErro'] ?>
                </div>

                <input id="dsProduto" name="dsProduto" type="text" placeholder="dsProduto"
                class="form-control <?= $data['dsProdutoErro'] ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= $data['dsProdutoErro'] ?>
                </div>

                <select id="idCategoria" name="idCategoria" class="form-select <?= $data['idCategoriaErro'] ? 'is-invalid' : '' ?>">
                    <option value="0" selected>Selecione uma categoria</option>
                    <?php foreach($data['categorias'] as $categoria): ?>
                        <option value="<?= $categoria->idCategoria ?>">
                            <?= $categoria->idCategoria.' - '.$categoria->dsCategoria ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <div class="invalid-feedback">
                    <?= $data['idCategoriaErro'] ?>
                </div>

                <input type="submit" value="Salvar" class="btn btn-primary">
            </form>

        </div>
    </div>
</div>