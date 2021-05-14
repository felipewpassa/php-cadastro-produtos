<div class="col-md-8 mx-auto p-5">
    <div class="card">
        <div class="card-header">
            Cadastrar Produto
        </div>
        <?=Session::alert('Produto')?>
        <div class="card-body">
            <form name="categoria" method="POST" action="<?=URL?>/produtos/cadastrar" enctype="multipart/form-data">
                <div class="mb-2">
                    <label for="nmProduto" class="form-label">*Nome:</label>
                    <input id="nmProduto" name="nmProduto" maxlength="120" type="text" class="form-control <?= $data['nmProdutoErro'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $data['nmProdutoErro'] ?>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="dsProduto" class="form-label">*Descrição:</label>
                    <input id="dsProduto" name="dsProduto" maxlength="255" type="text" class="form-control <?= $data['dsProdutoErro'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $data['dsProdutoErro'] ?>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="idCategoria" class="form-label">*Categoria:</label>
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
                </div>
                <div class="mt-4">
                    <table class="table table-bordered" id="table_field">
                        <tr>
                            <th>Descrição</th>
                            <th>Imagem</th>
                            <th>
                                <input class="btn btn-sm btn-secondary" type="button" name="add" id="add" value="Adicionar">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <input type="submit" value="Salvar" class="btn btn-primary">
                </div>
            </form>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var html = `
        <tr>
            <td>
                <div class="input-group input-group-sm">
                    <input class="form-control" maxlength="255" type="text" name="dsImagem[]">
                </div>
            </td>
            <td>
                <div class="input-group input-group-sm">
                    <input class="form-control" type="file" name="image[]" accept="image/jpeg, image/png">
                </div>
            </td>
            <td>
                <div class="input-group input-group-sm">
                    <button class="btn btn-light" type="button" name="remove" id="remove">
                        <i class="bi bi-x-lg"></i>
                        Remover
                    </button>
                </div>
            </td>
        </tr>`;
        $("#add").click(function() {
            $("#table_field").append(html);
        });
        $("#table_field").on('click', '#remove', function() {
            $(this).closest('tr').remove();
        })
    });

</script>