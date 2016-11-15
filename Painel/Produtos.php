<?php 
include 'Cabecalho.html';
include 'Menu.php';
include '../Classes/Produtos.php';
$produtos  = new Produtos();
$id = $_GET['id'];

$result = $produtos->ListaProduto($id);
$prod = mysqli_fetch_array($result);
$result_categorias = $produtos->ListaCategorias();
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Cadastrar Produto</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xs-4">
                <label>Nome:</label>
                <input class="form-control" type="text" name="nome" value="<?php echo $prod['nome'] ?>" required="" maxlength="50">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-2">
                <label>Estoque:</label>
                <input class="form-control" type="text" name="estoque" value="<?php echo $prod['estoque'] ?>" required="" placeholder="Quantidade" maxlength="5">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-2">
                <label>Preço (R$):</label>
                <input class="form-control" type="text" name="preco" value="<?php echo $prod['preco'] ?>" required="" placeholder="Preço" maxlength="5">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-3">
                <label>Descição:</label>
                <textarea name="descricao" class="form-control" cols="60" rows="2"><?php echo $prod['descricao'] ?></textarea>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-4">
                <label>Categoria</label>
                <select name="categoria" class="form-control">
                <?php
                    while ($categorias = mysqli_fetch_array($result_categorias)):
                    	if($categorias['id'] != $prod['id_categoria']){
                ?>
                    <option value="<?php echo $categorias['id'] ?>"><?php echo $categorias['nome'] ?></option>
                    <?php
                		}
                		else{
                     ?>
                     <option selected="" value="<?php echo $categorias['id'] ?>"><?php echo $categorias['nome'] ?></option>
                <?php 
            			}
                    endwhile;
                ?>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-2">
                <label>Imagem:</label>
                <input type="file" name="imagem">
            </div>
        </div>
        <hr>
        <button class="btn btn-primary" name="Alterar" type="submit">Alterar</button>
    </form>
</div>

<?php

if (isset($_POST['Alterar'])) {
    $nome = $_POST['nome'];
    $estoque = $_POST['estoque'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $id_categoria  = $_POST['categoria'];
    if (isset($_FILES['imagem'])) {
        $nome_arquivo = $_FILES['imagem']['name'];
        $extensao = substr($nome_arquivo, -4);
        $diretorio = "../Imagens/";
        $diretorio_final = $diretorio . $nome_arquivo ;
        $diretorio_banco = "./Imagens/". $nome_arquivo;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio_final);
    }
    else{
    	$diretorio_banco = $prod['img'];
    }
    
if($produtos->AlterarProduto($id,$nome, $estoque, $preco, $descricao, $diretorio_banco, $id_categoria)){
    echo '<script>alert("Alterado !");
    	  location.href = "ProdutosCadastrados.php";	
    </script>';
}
}
?>