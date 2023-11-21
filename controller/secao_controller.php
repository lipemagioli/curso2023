<?php

include("../dao/secao_dao.php");
$SecaoDAO = new SecaoDAO();
$errors = array();

/**
 * Verificar se existe 'id'
 * @package controller
 */
if((isset($_POST['id'])) && ($_POST['id']=="b0df282a-0d67-40e5-8558-c9e93b7befed")){
    getSecao();
}
/**
 * Verificar se existe 'save'
 * @package controller
 */
if (isset($_POST['save'])) {
    saveSecao();
}
/**
 * Verificar se existe 'remove'
 * @package controller
 */
if (isset($_POST['remove'])) {
    removeSecao();
}
/**
 * Verificar se existe 'get_edit_values'
 * @package controller
 */
if (isset($_POST['get_edit_values'])){
    getSecaoById();
}
/**
 * Verificar se existe 'edit'
 * @package controller
 */
if (isset($_POST['edit'])){
    editSecao();
}
/**
 * Função para pegar a secao
 * @package controller
 */
function getSecao(){
    global $SecaoDAO;
    $output = $SecaoDAO->getSecao($_POST);
    echo json_encode($output);
}
/**
 * Função para pegar a secao ID
 * @package controller
 */
function getSecaoById(){
    global $SecaoDAO;
    $output = $SecaoDAO->getSecaoById($_POST['id']);
    echo json_encode($output);
}
/**
 * Função para salvar a secao
 * @package controller
 */
function saveSecao() {
    global $SecaoDAO;
    $name = $_POST['name'];
    $description = $_POST['description'];


    if (isset($name) && isset($description)) {

        $id = $SecaoDAO->insertSecao($name,$description );
 
        $retorno = ($id >= 1 ? "Cadastrado com sucesso!" : "Erro ao cadastrar!");
        echo $retorno;
    } 
    exit();
}
/**
 * Função para editar a secao
 * @package controller
 */
function editSecao() {
    global $SecaoDAO;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_POST['id'];

    if (isset($name) && isset($description) && isset($id)) {

        $ok = $SecaoDAO->editSecao($name,$description,$id );
 
        $retorno = ($ok ? "Item $id Editado com sucesso!" : "Erro ao editar !");
        echo $retorno;
    }
    
    exit();
}
/**
 * Função para remover a secao
 * @package controller
 */
function removeSecao() {
    global $SecaoDAO;
    $id = $_POST['id'];

    if (isset($id)) {

        $ok = $SecaoDAO->deleteSecao($id);
 
        $retorno = ($ok ? "Item $id deletado com sucesso!" : "Erro ao deletar!");
        echo $retorno;
    } 
    exit();
}
