<div class="container py-5">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-4 mx-2 mt-1">
                    <h5>Categorias</h5>
                </div>
                <div class="col-4">
                    <input class="form-control" type="text" id="searchBar" onkeyup="filtroCategoria()" placeholder="Buscar descrição">
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
            } else {
                swal({
                    title: "Erro",
                    text: "Não foi possivel excluir a categoria",
                    icon: "warning",
                    button: "OK",
                });
            }
        };
        request.open("DELETE", `<?= URL.'/categorias/excluir/'?>${id}`);
        request.send();
    }

    function filtroCategoria() {
        var searchBarText, listCategoria, tableLines, td, txtValue;
        searchBarText = document.getElementById("searchBar").value.toUpperCase();
        listCategoria = document.getElementById("listCategoria");
        tableLines = listCategoria.getElementsByTagName("tr");

        for (var line = 0; line < tableLines.length; line++) {
            td = tableLines[line].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(searchBarText) > -1) {
                    tableLines[line].style.display = "";
                } else {
                    tableLines[line].style.display = "none";
                }
            }
        }
    }
</script>