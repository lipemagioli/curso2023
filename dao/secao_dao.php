<?php

include 'dbconnect.php';

class SecaoDAO extends Dbconnect {

    private $conn;
/**
 * Construtor
 * @package dao
 */
    public function __construct() {
        $dbcon = new parent();
        $this->conn = $dbcon->connect();
    }

/**
 * Função que insere dados no banco de dados
 * @package dao
 */
    public function insertSecao($name, $description) {

        $query = "INSERT INTO secao (nome, descricao) VALUES ('{$name}', '{$description}')";

        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        return mysqli_insert_id($this->conn);
    }

/**
 * Função que edita dados
 * @package dao
 */
    public function editSecao($name, $description, $id) {

        $query = "UPDATE  secao SET nome = '$name', descricao = '$description' WHERE id = '$id'";

        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        return $result;
    }

 /**
 * Função que exclui um dado de acordo com o id
 * @package dao
 */
    public function deleteSecao($id) {

        $query = "DELETE FROM secao WHERE id = '$id'";

        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        return $result;
    }
/**
 * Função que pega dados de secao
 * @package dao
 */
    public function getSecao($dados_) {
        $data = array();
        $records_per_page = 10;
        $start_from = 0;
        $current_page_number = 0;

        if (isset($dados_['rowCount'])) {
            $records_per_page = $dados_['rowCount'];
        }

        if (isset($dados_['current'])) {
            $current_page_number = $dados_['current'];
        }

        $start_from = ($current_page_number - 1) * $records_per_page;

        $query = " SELECT * FROM secao ";

        if (!empty($dados_['searchPhrase'])) {
            $query .= ' WHERE nome LIKE "%' . $dados_['searchPhrase'] . '%" '
                     . ' OR descricao LIKE "%' . $dados_['searchPhrase'] . '%" ';
        }

        $orderBy = '';

        if (isset($dados_['sort']) && is_array($dados_['sort'])) {
            foreach ($dados_['sort'] as $key => $value) {
                $orderBy .= `$key $value, `;
            }
        } else {
            $query .= ' ORDER BY id DESC ';
        }

        if ($orderBy != '') {
            $query .= ' ORDER BY ' . substr($orderBy, 0, -2);
        }

        if ($records_per_page != -1) {
            $query .= ' LIMIT ' . $start_from . ", " . $records_per_page;
        }

        $result = mysqli_query($this->conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        $query1 = "SELECT * FROM secao";
        $result1 = mysqli_query($this->conn, $query1);
        $total_records = mysqli_num_rows($result1);

        $output = array(
            'current' => intval($dados_["current"]),
            'rowCount' => 10,
            'total' => intval($total_records),
            'rows' => $data
        );

        return $output;
    }
/**
 * Função que retorna dados em um array
 * @package dao
 */
    public function getSecaoById($id) {
        $query = " SELECT * FROM secao WHERE id = $id";
        $result = mysqli_query($this->conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

}
