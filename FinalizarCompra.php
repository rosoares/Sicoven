<?php
include './Cabecalho.php';
error_reporting(0);
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#form-endereco").hide();
        $("#troco").hide();
		$("#form-pagamento input").on('change', function(){
			var val = $('input[name=Pagamento]:checked', '#form-pagamento').val();
			if(val == 3){
				$("#form-endereco").show();
                $("#troco").show();
			}
            else if(val == 2){
                $("#form-endereco").hide();
                $("#troco").show();
            }
			else{
				$("#form-endereco").hide();
                $("#troco").hide();
			}
		});
	})
</script>

<script type="text/javascript">
    function MascaraTroco(obj){
        switch (obj.value.length) {
            case 2:
            obj.value = obj.value + ",";
            break;
            }
    }
</script>

<br><br>
<div class="row">
    <h2>Finalizar Compra</h2>
</div>

<div class="row">
    <div class="col-md-offset-1 text-left">
        <h3 class="page-header">Pagamento</h3>
    </div>
</div>

<form action="Finalizar.php" method="post" id="form-pagamento" class="form-group col-md-offset-1">
    <div class="radio">
        <label>
            <input type="radio" name="Pagamento" id="Pagamento1" value="1">
            Ir buscar na loja (Pagamento no ato da busca)
        </label>
    </div>
    <?php if ($_SESSION['facebook'] != 1) {
    ?>
    <div class="radio">
        <label>
            <input type="radio" name="Pagamento" id="Pagamento2" value="2">
            Entrega no endreço cadastrado (Pagamento no ato da entrega)
        </label>
    </div>
    <?php  } ?>
    <div class="radio">
        <label>
            <input type="radio" name="Pagamento" id="Pagamento3" value="3">
            Entrega em novo endereço (Pagamento no ato da entrega)
        </label>
    </div>
    <hr>
    <div id="form-endereco">
    	<div class="row">
    		<div class="col-xs-4">
    			<label>Rua:</label>
    			<input required="" name="rua" class="form-control" type="text" name="Rua">
    		</div>
    	</div>
    	<br>
    	<div class="row">
    		<div class="col-xs-3">
    			<label>Bairro:</label>
    			<input required="" name="bairro" class="form-control" type="text" name="Bairro">
    		</div>
    	</div>
    	<br>
    	<div class="row">
    		<div class="col-xs-1">
    			<label>Número:</label>
    			<input required="" name="numero" class="form-control" type="text" name="Numero">
    		</div>
    	</div>
    	<br>
    	<div class="row">
    		<div class="col-xs-4">
    			<label>Complemento:</label>
    			<input name="complemento" class="form-control" type="text" name="Complemento">
    		</div>
    	</div>
    	<br>
    	<div class="row">
    		<div class="col-xs-4">
    			<label>Referências:</label>
    			<input name="referencias" class="form-control" type="text" name="Referencias">
    		</div>
    	</div>
    	<hr>
    </div>
    <div id="troco">
        <div class="row">
            <div class="col-xs-2">
                <label>Troco (R$):</label>
                <input name="troco" class="form-control" maxlength="5" type="text" name="troco" onkeypress="MascaraTroco(this)">
            </div>
        </div>
        <div class="row" style="position: relative; left: 1%;">
            <h5 class="text-danger">(OBS) Deixe o campo de troco vazio se não precisar de troco</h5>
        </div>
        <br>
    </div>
    
    <button type="submit" class="btn btn-success">Finalizar Compra</button>
</form>