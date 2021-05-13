<div class="col-md-8 mx-auto p-5">
    <div class="card">
        <div class="card-header">
            Cadastrar Produto
        </div>
        <?=Session::alert('Produto')?>
        <div class="card-body">
            <form name="categoria" method="POST" action="<?=URL?>/produtos/cadastrar" enctype="multipart/form-data">
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
                            <?= $categoria->dsCategoria ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $data['idCategoriaErro'] ?>
                </div>

                <div class="input-field mt-5">
                    <table id="table_field">
                        <tr>
                            <td>Descricao</td>
                            <td>Imagem</td>
                            <td><input class="btn btn-primary" type="button" name="add" id="add" value="Adicionar"></td>
                        </tr>
                    </table>
                </div>

                <input type="submit" value="Salvar" class="btn btn-primary mt-5">
            </form>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var html = `
        <tr>
            <td><input class="form-control" type="text" name="dsImagem[]"></td>
            <td><input class="form-control" type="file" name="image[]" accept="image/jpeg, image/png"></td>
            <td><input class="btn btn-danger" type="button" name="remove" id="remove" value="Remover"></td>
        </tr>`;
        $("#add").click(function() {
            $("#table_field").append(html);
        });
        $("#table_field").on('click', '#remove', function() {
            $(this).closest('tr').remove();
        })
    });

</script>