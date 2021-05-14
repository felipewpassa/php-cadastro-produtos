<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10 pt-2 ml-2">
                    <h5>Produtos</h5>
                </div>
                <div class="col-2">
                    <a href="<?=URL?>/produtos/cadastrar" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="listProdutos" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Imagens</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['produtos'] as $keyProduto => $produto): ?>
                        <tr>
                            <td><?= $keyProduto ?></td>
                            <td><?= substr($produto[0]['nmProduto'], 0, 30) ?></td>
                            <td>
                                <div id="carouselExampleIndicators" class="carousel carousel-dark slide" style="width: 140px; height: 140px" data-bs-ride="carousel" >
                                    <div class="carousel-indicators">
                                        <?php foreach ($produto as $keyImg => $imagem): ?>
                                            <?php if ($imagem['idImagem']): ?>
                                                <button type="button" data-bs-target="#btnActions" <?= $keyImg===0 ? 'class="active" aria-current="true"' : ''?> data-bs-slide-to="<?= $keyImg ?>" aria-label="<?= 'Imagem '.$keyImg+=1 ?>"></button>
                                            <?php endif ?>
                                            <?php if (!$imagem['idImagem']): ?>
                                                Sem imagens
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </div>
                                    <div class="carousel-inner">
                                        <?php foreach ($produto as $keyImg => $imagem): ?>
                                            <div class="carousel-item <?= $keyImg===0 ? 'active' : ''?>">
                                                <img src="<?= URL.'/public/uploads/produtos/'.$imagem['nomeDoArquivo'] ?>" class="d-block w-100" alt="<?= $imagem['nomeDoArquivo'] ?>">
                                                <button onclick="confirmDelete(<?= $imagem['idImagem']?>, true)" class="btn btn-sm btn-light text-danger position-absolute top-0 end-0">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="<?= URL.'/produtos/editar/'.$keyProduto ?>" class="btn btn-sm btn-warning">Editar</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <button onclick="confirmDelete(<?=$keyProduto?>, false)" class="btn btn-sm btn-danger">Excluir</button>
                                    </li>
                                </ul>
                            </td>
                        </tr> 
                    <?php endforeach ?> 
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id, isImagem = false) {
        swal({
            title: "Tem certeza?",
            text: `Deseja excluir ${isImagem ? 'a imagem' : 'o produto'} com id = ${id}`,
            buttons: ["Cancelar", "Excluir"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                if (isImagem) {
                    executeDelete(`<?= URL.'/produtos/excluirImagem/' ?>${id}`, "<?= URL.'/produtos' ?>", 'A imagem foi excluida', 'Não foi possivel excluir a imagem') 
                } else {
                    executeDelete(`<?= URL.'/produtos/excluir/' ?>${id}`, "<?= URL.'/produtos' ?>", 'O produto foi excluido', 'Não foi possivel excluir o produto');
                }
            }
        });
    }

    function executeDelete(rotaToDelete, redirectAfterDelete, msgSuccess = '', msgError = '') {
        const request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                swal({
                    title: "Sucesso",
                    text: `${msgSuccess}`,
                    icon: "success",
                    button: "OK",
                }).then(() => {
                    window.location.href = `${redirectAfterDelete}`;
                });
            } else {
                swal({
                    title: "Erro",
                    text: `${msgError}`,
                    icon: "warning",
                    button: "OK",
                });
            }
        };
        request.open("DELETE", `${rotaToDelete}`);
        request.send();
    }

    $(document).ready(function() {
        $('#listProdutos').DataTable({
            "language": {
                "lengthMenu": "Exibindo _MENU_ por página",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Exibindo _PAGE_ de _PAGES_ páginas",
                "infoEmpty": "Não há registros cadastrados",
                "infoFiltered": "(filtrado de _MAX_ registros)",
                "search": "Pesquisar",
                "paginate": {
                    "next": "Próximo",
                    "previous": "Anterior",
                    "first": "Primeiro",
                    "last": "Último"
                },
            },
            "lengthMenu": [[7, 25, 50, -1], [7, 25, 50, "todos"]]
        });
    });
</script>