<?php

include './Cabecalho.html';
include './Menu.php';
include_once '../Classes/Produtos.php';
$produtos = new Produtos();
$result_categorias = $produtos->ListaCategorias();
?>

<script type="text/javascript">
    function MascaraDinheiro(obj) {
        switch (obj.value.length) {
            case 2:
                obj.value = obj.value + ",";
                break;
        }
    }
</script>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">Cadastrar Produto</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xs-4">
                <label>Nome:</label>
                <input class="form-control" type="text" name="nome" required="" placeholder="Nome do Produto" maxlength="50">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-2">
                <label>Estoque:</label>
                <input class="form-control" type="text" name="estoque" required="" placeholder="Quantidade" maxlength="5">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-2">
                <label>Preço (R$):</label>
                <input class="form-control" type="text" name="preco" required="" placeholder="Preço" maxlength="5" onkeypress="MascaraDinheiro(this);">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-3">
                <label>Descição:</label>
                <textarea name="descricao" class="form-control" cols="60" rows="2"></textarea>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-4">
                <label>Categoria</label>
                <select name="categoria" class="form-control">
                <?php
                    while ($categorias = mysqli_fetch_array($result_categorias)):
                ?>
                    <option value="<?php echo $categorias['id'] ?>"><?php echo $categorias['nome'] ?></option>
                <?php 
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
        <button class="btn btn-primary" name="Cadastrar" type="submit">Cadastrar</button>
    </form>
</div>
</div>

<?php

if (isset($_POST['Cadastrar'])) {
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
    
if($produtos->CadastrarProduto($nome, $estoque, $preco, $descricao, $diretorio_banco, $id_categoria)){
    echo '<script>alert("Cadastrado'.$diretorio_final. '!");</script>';
}
}
?>