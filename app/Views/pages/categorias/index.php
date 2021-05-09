<div class="container py-5">
    <div class="card">
        <div class="card-header">
            Categorias
            <a href="<?=URL?>/categorias/cadastrar" class="btn btn-primary">Cadastrar</a>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <?php foreach ($data['categorias'] as $categoria): ?>
                    <li class="list-group-item"><?= $categoria->dsCategoria ?></li>
                <?php endforeach ?> 
            </ul>
        </div>
    </div>
</div>