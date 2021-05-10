<div class="container py-5">
    <div class="card">
        <div class="card-header">
            Categorias
            <a href="<?=URL?>/categorias/cadastrar" class="btn btn-primary">Cadastrar</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['categorias'] as $key => $categoria): ?>
                        <tr class="<?= $key%2!=0 ? 'table-light' : '' ?>">
                            <td><?= $categoria->idCategoria ?></td>
                            <td><?= substr($categoria->dsCategoria, 0, 30) ?></td>
                            <td>
                                <a href="<?= URL.'/categorias/editar/'.$categoria->idCategoria ?>" class="btn btn-sm btn-warning">Editar</a>
                            </td>
                        </tr> 
                    <?php endforeach ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>