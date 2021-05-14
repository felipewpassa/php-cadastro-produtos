<div class="col-md-8 mx-auto p-5">
    <div class="card">
        <div class="card-header">
            Editar Produto
        </div>
        <?=Session::alert('Produto')?>
        <div class="card-body">
            <form name="produto" method="POST" action="<?=URL?>/produtos/editar/<?= $data['idProduto'] ?>" enctype="multipart/form-data">
                <div class="mb-2">
                    <label for="dsCategoria" class="form-label">*Nome:</label>
                    <input id="nmProduto" name="nmProduto" type="text" placeholder="nmProduto" class="form-control <?= $data['nmProdutoErro'] ? 'is-invalid' : '' ?>" value="<?= $data['nmProduto'] ?>" readonly>
                    <div class="invalid-feedback">
                        <?= $data['nmProdutoErro'] ?>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="dsCategoria" class="form-label">*Descrição:</label>
                    <input id="dsProduto" name="dsProduto" type="text" placeholder="dsProduto" class="form-control <?= $data['dsProdutoErro'] ? 'is-invalid' : '' ?>" value="<?= $data['dsProduto'] ?>">
                    <div class="invalid-feedback">
                        <?= $data['dsProdutoErro'] ?>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="dsCategoria" class="form-label">*Categoria:</label>
                    <select id="idCategoria" name="idCategoria" class="form-select <?= $data['idCategoriaErro'] ? 'is-invalid' : '' ?>">
                        <?php foreach($data['categorias'] as $categoria): ?>
                            <option value="<?= $categoria->idCategoria ?>" <?= $categoria->idCategoria === $data['idCategoria'] ? 'selected' : '' ?>>
                                <?= $categoria->dsCategoria ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="mt-4">
                    <table class="table table-bordered" id="table_field">
                        <tr>
                            <th>Descrição</th>
                            <th>Imagem</th>
                            <th>
                                <div class="input-group input-group-sm">
                                    <input class="btn btn-secondary" type="button" name="add" id="add" value="Adicionar">
                                </div>
                            </th>
                        </tr>

                        <?php foreach($data['imagens'] as $imagem): ?>
                            <tr>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <input class="form-control" type="text" value="<?= $imagem->dsImagem?>" disabled>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group input-group-sm">
                                        <input class="form-control" type="text" value="<?= $imagem->nomeDoArquivo?>" disabled>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" type="button" name="excluir" id="excluir" onclick="confirmDelete(<?=$imagem->idImagem?>,true)">
                                        <i class="bi bi-trash"></i>
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>

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
                    <input class="form-control" type="text" name="dsImagem[]">
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
<?php
include '../app/Views/partials/sweetAlert.php';
?>