<?php

include("../dao/prod_dao.php");
$prodDAO = new ProdDAO();
$errors = array();

/**
 * Verificando se existe o ID
 * @package controller
 */
if((isset($_POST['id'])) && ($_POST['id']=="b0df282a-0d67-40e5-8558-c9e93b7befed")){
    getProd();
}
/**
 * Verificando se existe 'save'
 * @package controller
 */
if (isset($_POST['save'])) {
    saveProd();
    
}
/**
 * Verificando se existe 'dados_grupo'
 * @package controller
 */
if (isset ($_POST['dados_grupo'])){
    dadosGrupo();
}
/**
 * Verificando se existe 'remove'
 * @package controller
 */
if (isset($_POST['remove'])) {
    removeProd();
}
/**
 * Verificando se existe 'get_edit_values'
 * @package controller
 */
if (isset($_POST['get_edit_values'])){
    getProdById();
}
/**
 * Verificando se existe 'edit'
 * @package controller
 */
if (isset($_POST['edit'])){
    editProd();
}
/**
 * Função para pegar o produto 
 * @package controller
 */
function getProd(){
    global $prodDAO, $errors;
    $output = $prodDAO->getProd($_POST);
    echo json_encode($output);
}
/**
 * Função  json_encode
 * @package controller
 */
function getProdById(){
    global $prodDAO;
    $output = $prodDAO->getProdById($_POST['id']);
    echo json_encode($output);
}
/**
 * Função para salvar o produto
 * @package controller
 */
function saveProd() {
    global $prodDAO, $errors;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id_grupo = $_POST['id_grupo'];


    if (isset($name) && isset($description) && isset($id_grupo)) {

        $id = $prodDAO->insertProd($name,$description, $id_grupo );
 
        $retorno = ($id >= 1 ? "Cadastrado com sucesso!" : "Erro ao cadastrar!");
        echo $retorno;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit();
}
/**
 * Função para editar o produto 
 * @package controller
 */
function editProd() {
    global $prodDAO;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_POST['id'];
    $idgrupo = $_POST['id_grupo'];

    if (isset($name) && isset($description) && isset($id)) {

        $ok = $prodDAO->editProd($name,$description,$id, $idgrupo );
 
        $retorno = ($ok ? "Item $id editado com sucesso!" : "Erro ao editar !");
        echo $retorno;
    }
    
    exit();
}
/**
 * Função para remover o produto 
 * @package controller
 */
function removeProd() {
    global $prodDAO;
    $id = $_POST['id'];

    if (isset($id)) {

        $ok = $prodDAO->delete($id);
 
        $retorno = ($ok ? "Item $id deletado com sucesso!" : "Erro ao deletar!");
        echo $retorno;
    } 
    exit();
}

/**
 * Função para recuperar os dados de produto
 * @package controller
 */
function dadosGrupo(){
    global $prodDAO;
    $dados = $prodDAO->getDadosGrupo();
    echo json_encode($dados);
}

