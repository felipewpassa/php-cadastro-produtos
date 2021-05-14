<script type="text/javascript">
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
</script>