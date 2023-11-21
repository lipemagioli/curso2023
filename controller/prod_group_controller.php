<?php

include("../dao/prod_group_dao.php");
$prodGroupDAO = new ProdGroupDAO();
$errors = array();

/**
 * verificar se existe 'id' 
 * @package controller
 */
if((isset($_POST['id'])) && ($_POST['id']=="b0df282a-0d67-40e5-8558-c9e93b7befed")){
    getProdGroup();
}
/**
 *verificar se existe 'save' 
 * @package controller
 */
if (isset($_POST['save'])) {
    saveProdGroup();
}
/**
 * verificar se existe 'remove' 
 * @package controller
 */
if (isset($_POST['remove'])) {
    removeProdGroup();
}
/**
 * verificar se existe 'get_edir_values' 
 * @package controller
 */
if (isset($_POST['get_edit_values'])){
    getProdGroupById();
}
/**
 *  verificar se existe 'edit' 
 * @package controller
 */
if (isset($_POST['edit'])){
    editProdGroup();
}
/**
 * Função para json_enconde 
 * @package controller
 */
function getProdGroup(){
    global $prodGroupDAO;
    $output = $prodGroupDAO->getProdGroup($_POST);
    echo json_encode($output);
}
/**
 * Função para retornar jason_encode
 * @package controller
 */
function getProdGroupById(){
    global $prodGroupDAO;
    $output = $prodGroupDAO->getProdGroupById($_POST['id']);
    echo json_encode($output);
}
/**
 * Função para salvar Grupo de produto
 * @package controller
 */
function saveProdGroup() {
    global $prodGroupDAO;
    $name = $_POST['name'];
    $description = $_POST['description'];


    if (isset($name) && isset($description)) {

        $id = $prodGroupDAO->insertProdGroup($name,$description );
 
        $retorno = ($id >= 1 ? "Item $name cadastrado com sucesso!" : "Erro ao cadastrar!");
        echo $retorno;
    } 
    exit();
}
/**
 * Função para editar Grupo de produto
 * @package controller
 */
function editProdGroup() {
    global $prodGroupDAO;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_POST['id'];

    if (isset($name) && isset($description) && isset($id)) {

        $ok = $prodGroupDAO->editProdGroup($name,$description,$id );
 
        $retorno = ($ok ? "Item $id editado com sucesso!" : "Erro ao editar !");
        echo $retorno;
    }
    
    exit();
}
/**
 * Função para remover Grupo de produto
 * @package controller
 */
function removeProdGroup() {
    global $prodGroupDAO;
    $id = $_POST['id'];

    if (isset($id)) {

        $ok = $prodGroupDAO->deleteProdGroup($id);
 
        $retorno = ($ok ? "Item $id deletado com sucesso!" : "Erro ao deletar!");
        echo $retorno;
    } 
    exit();
}
