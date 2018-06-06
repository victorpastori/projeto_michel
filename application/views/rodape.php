</div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?= base_url("js/bootstrap-formhelpers.min.js")?>"></script>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready( function () {
    $('#my-table').DataTable();
    $('#table-cotas').DataTable();
    $('#table-movimentos').DataTable();
    $('#table-rendimentos').DataTable();
    $('#table-rend-clientes').DataTable();
    $('#table-rend-bruto').DataTable();
    $('#table-comissoes').DataTable();
    $('#table-lucro-total').DataTable();
    $('#table-saques').DataTable();
    $('#table-investimentos').DataTable();
} );

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    function mostraOperacao(){
                var tipo = document.getElementById("selectBanco").value;
                if (tipo == 6) {
                    document.getElementById('inputOperacao').disabled = false;
                    document.getElementById("inputOperacao").style.display = "block";
                    document.getElementById('lblOperacao').disabled = false;
                    document.getElementById("lblOperacao").style.display = "block";
                    document.getElementById('btnOperacao').disabled = false;
                    document.getElementById("btnOperacao").style.display = "inline";
            }else {
                document.getElementById('inputOperacao').disabled = true;
                document.getElementById("inputOperacao").style.display = "none";
                document.getElementById("inputOperacao").value = null;
                document.getElementById('lblOperacao').disabled = true;
                document.getElementById("lblOperacao").style.display = "none";
                document.getElementById('btnOperacao').disabled = true;
                document.getElementById("btnOperacao").style.display = "none";
            }
        }

</script>
</body>
</html>