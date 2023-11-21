<?php

class Produto
{
    private $nome;
    private $descricao;
    private $grupo;
/**
** Construtor
* @package view
*/
    public function __construct($nome, $descricao, $grupo)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->grupo = $grupo;
    }
}
