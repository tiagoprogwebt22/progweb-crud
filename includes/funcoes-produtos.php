<?php
// funcoes-produtos.php

require "conecta.php";

function lerProdutos($conexao){
    //$sql = "SELECT id, nome, preco, quantidade, descricao, fabricante_id
    //FROM produtos ORDER BY nome";

    $sql = "SELECT produtos.id, produtos.nome AS produto, produtos.quantidade, 
    produtos.preco, produtos.descricao, fabricantes.nome AS fabricante
    FROM produtos INNER JOIN fabricantes 
    ON produtos.fabricante_id = fabricantes.id ORDER BY produto";

    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

    $produtos = [];
    
    while( $produto = mysqli_fetch_assoc($resultado) ){
        array_push( $produtos, $produto );
    }

    return $produtos;    
}

function inserirProduto($conexao, $nome, $preco, $quantidade, 
                        $descricao, $fabricanteId){
    $sql = "INSERT INTO produtos(nome, preco, quantidade, descricao, fabricante_id) VALUES('$nome', $preco, $quantidade, 
    '$descricao', $fabricanteId)";

    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}

function lerUmProduto($conexao, $id){    
    $sql = "SELECT id, nome, preco, quantidade, descricao, fabricante_id
     FROM produtos WHERE id = $id";
    
    $resultado = mysqli_query($conexao, $sql) 
                or die(mysqli_error($conexao));
    
    return mysqli_fetch_assoc($resultado);
} // final lerUmProduto




function atualizarProduto($conexao, $id, $nome, $preco, $quantidade, $descricao, $fabId){

    $sql = "UPDATE produtos SET nome = '$nome', preco = $preco, 
    quantidade = $quantidade, descricao = '$descricao', 
    fabricante_id = $fabId    
    WHERE id = $id";
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
} // final atualizarFabricante


function excluirProduto($conexao, $id) {
    $sql = "DELETE FROM produtos WHERE id = $id";
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}




function formataMoeda($valor){
    return "R$ ".number_format($valor, 2, ",", ".");
    // 5000.00   -> R$ 5.000,00
}
