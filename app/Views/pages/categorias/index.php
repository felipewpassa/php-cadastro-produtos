<div class="container py-5">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10 pt-2 ml-2">
                    <h5>Categorias</h5>
                </div>
                <div class="col-2">
                     <a href="<?=URL?>/categorias/cadastrar" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table" id="listCategoria">
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
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="<?= URL.'/categorias/editar/'.$categoria->idCategoria ?>" class="btn btn-sm btn-warning">Editar</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <button onclick="confirmDelete(<?=$categoria->idCategoria?>)" class="btn btn-sm btn-danger">Excluir</button>
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
    function confirmDelete(id) {
        swal({
            title: "Tem certeza?",
            text: `Deseja excluir a categoria com id = ${id}`,
            buttons: ["Cancelar", "Excluir"],
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) executeDelete(id);
        });
    }

    function executeDelete(id) {
        const request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                swal({
                    title: "Sucesso",
                    text: "A categoria foi excluida",
                    icon: "success",
                    button: "OK",
                }).then(() => {
                    window.location.href = "<?= URL.'/categorias' ?>";
                });
            } else if(this.status == 500) {
                swal({
                    title: "Erro",
                    text: "Não foi possível excluir a categoria, verifique se há produtos associados a ela e tente novamente",
                    icon: "warning",
                    button: "OK",
                });
            } else {
                swal({
                    title: "Falha",
                    text: "Não foi possivel excluir a categoria",
                    icon: "warning",
                    button: "OK",
                });
            }
        };
        request.open("DELETE", `<?= URL.'/categorias/excluir/'?>${id}`);
        request.send();
    }

    $(document).ready(function() {
        $('#listCategoria').DataTable({
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