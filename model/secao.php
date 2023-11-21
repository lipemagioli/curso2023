<?php

class Secao
{
    private $nome;
    private $descricao;
/**
** Construtor
* @package view
*/
    public function __construct($nome, $descricao)
    {
        $this->nome = $nome;
        $this->descricao = $descricao;
    }
}
