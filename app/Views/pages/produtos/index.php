<div class="container py-4">
    <div class="card">
        <div class="card-header">
            Produtos
            <a href="<?=URL?>/produtos/cadastrar" class="btn btn-primary">Cadastrar</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Imagens</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['produtos'] as $key => $produto): ?>
                        <tr class="<?= $key%2!=0 ? 'table-light' : '' ?>">
                            <td><?= $key ?></td>
                            <td><?= substr($produto[0]['nmProduto'], 0, 30) ?></td>
                            <td>
                                <div id="carouselExampleIndicators" class="carousel carousel-dark slide" style="width: 140px; height: 140px" data-bs-ride="carousel" >
                                    <div class="carousel-indicators">
                                        <?php $count = 0; foreach ($produto as $key => $imagem): ?>
                                            <button type="button" data-bs-target="#btnActions" <?= $key===0 ? 'class="active" aria-current="true"' : ''?> data-bs-slide-to="<?= $key ?>" aria-label="<?= 'Imagem '.$key+=1 ?>"></button>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="carousel-inner">
                                        <?php foreach ($produto as $key => $imagem): ?>
                                            <div class="carousel-item <?= $key===0 ? 'active' : ''?>">
                                                <img src="<?= URL.'/public/uploads/produtos/'.$imagem['nomeDoArquivo'] ?>" class="d-block w-100" alt="<?= $imagem['nomeDoArquivo'] ?>">
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </td>
                        </tr> 
                    <?php endforeach ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>
