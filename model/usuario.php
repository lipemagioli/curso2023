<?php

class Usuario
{
    private $nome;
    private $email;
    private $senha;
    private $tipo;
 /**
** Construtor
* @package view
*/
    public function __construct($nome, $email, $senha, $tipo)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->tipo = $tipo;
    }
}

