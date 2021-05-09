<div class="col-md-8 mx-auto p-5">
    <div class="card">
        <div class="card-header">
            Cadastrar categoria
        </div>
        <div class="card-body">
        <?=Session::alert('Categoria')?>
        <form name="categoria" method="POST" action="<?=URL?>/categorias/cadastrar" class="mt-2">
            <div class="mb-3">
                <label for="dsCategoria" class="form-label">*Descrição:</label>
                <input 
                    type="text" 
                    id="dsCategoria" 
                    name="dsCategoria" 
                    value="<?= $data['dsCategoria'] ?>" 
                    class="form-control <?= $data['dsCategoriaErro'] ? 'is-invalid' : '' ?>">
                
                <div class="invalid-feedback">
                    <?= $data['dsCategoriaErro'] ?>
                </div>
            </div>
            <input type="submit" value="Salvar" class="btn btn-primary">
        </form>
        </div>
    </div>
</div>