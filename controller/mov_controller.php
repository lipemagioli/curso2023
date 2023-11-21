<?php

include("../dao/mov_dao.php");
$movDAO = new MovDAO();

/**
 * V
 * @package controller
 */
if (isset($_POST['id']) && ($_POST['id'] == "b0df282a-0d67-40e5-8558-c9e93b7befed")) {

    getMov();
}

if (isset($_POST['save'])) {
    saveMov();
}

if (isset ($_POST['edit'])){
    editMov();
}


if (isset($_POST['remove'])) {
    removeMov();
}


if (isset($_POST['get_edit_values'])){
    getMovById();
    
}

/**
 * Verificando se existe 'dados_grupo'
 * @package controller
 */
if (isset($_POST['dados_secao'])) {
    dadosSecao();
}
if (isset($_POST['dados_relatorio'])) {
    dados_relatorio();
}

/**
 * Essa função pega o movimentacao 
 * @package controller
 */
function getMov() {
    global $movDAO;
    $output = $movDAO->getMov($_POST);

    echo json_encode($output);
}

function getMovById(){
    global $movDAO;
    $output = $movDAO->getMovById($_POST['id']);
   
    echo json_encode($output);
}

/**
 * Função para salvar o movimentacao 
 * @package controller
 */
function saveMov() {
    global $movDAO;
    $produtos = $_POST['produtos'];
    $description = $_POST['description'];
    $id_secao = $_POST['id_secao'];


    if (isset($produtos) && isset($description) && isset($id_secao)) {

        $id = $movDAO->insertMov($description, $id_secao);

        if ($id) {
            $ok = $movDAO->insertMovProdutos($produtos, $id);
        }

        $retorno = ($ok ? "Cadastrado com sucesso!" : "Erro ao cadastrar!");
    } else {
        $retorno = "Erro no cadastro de produtos";
    }
    echo $retorno;
    exit();
}

/**
 * Função para editar os atricutos do movimentacao
 * @package controller
 */
function editMov() {
    global $movDAO;
    $produtos = $_POST['produtos'];
    $description = $_POST['description'];
    $id_secao = $_POST['id_secao'];


    if (isset($produtos) && isset($description) && isset($id_secao)) {

        $id = $movDAO->editMov($description, $id_secao);

        if ($id) {
            $ok = $movDAO->editMovProdutos($produtos, $id);
        }

        $retorno = ($ok ? "Editado com sucesso!" : "Erro ao editar!");
    } else {
        $retorno = "Erro ao editar produtos";
    }
    echo $retorno;
    exit();
    
}
/**
 * Função para remover a movimentacao 
 * @package controller
 */
function removeMov() {
    global $movDAO;
    $id = $_POST['id'];

    if (isset($id)) {

        $ok = $movDAO->delete($id);
 
        $retorno = ($ok ? "Item $id deletado com sucesso!" : "Erro ao deletar!");
        echo $retorno;
    } 
    exit();
}

/**
 * Função para recuperar do banco dados do movimentacao e retornar um json
 * @package controller
 */
function dadosSecao() {
    global $movDAO;
    $dados = $movDAO->getDadosSecao();
    echo json_encode($dados);
}

function dados_relatorio() {
    global $movDAO;
    $dados = $movDAO->getDadosRelatorio();
    echo json_encode($dados);
}
