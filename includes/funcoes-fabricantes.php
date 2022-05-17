<?php
// funcoes-fabricantes.php

require "conecta.php";

function lerFabricantes($conexao){
    // 1) Montar a string do comando SQL
    $sql = "SELECT id, nome FROM fabricantes";

    // 2) Executar o comando
    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

    // 3) Criar um array vazio para receber os resultados
    $fabricantes = [];  // ARRAYZÃO

    // 4) Loop iterando em cada resultado, e a cada fabricante que for localizado, ele é acrescentado ao array fabricantes.
    while( $fabricante = mysqli_fetch_assoc($resultado) ){
        // array_push(nome do array principal, nome do array individual)
        array_push($fabricantes, $fabricante);
    }

    // 5) Retornando para fora da função os fabricantes localizados
    return $fabricantes; // Lista de fabricantes (Matriz)
}

//var_dump(lerFabricantes($conexao)); // teste


function inserirFabricante($conexao, $nome){
    $sql = "INSERT INTO fabricantes(nome) VALUES('$nome')";
    mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
}

