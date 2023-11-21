<?php

/*
 *  @copyright  Copyright 2018 
 *  @author  Cesar Moreira Ribeiro
 *  @author  Moraes Caixeta
 *  @version 1
 *  @link https://github.com/cmr/controleestoque GitHub
 */


require('../util/fpdf/mysql_table.php');

class PDF extends PDF_MySQL_Table {

    private $titulo;

    function Header() {
        $this->titulo = $_GET['titulo'];
        $this->SetFont('Arial', '', 18);
        $this->Cell(0, 6, $this->titulo, 0, 1, 'C');
        $this->Ln(10);
        parent::Header();
    }

}

$id_secao = $_GET['id_relatorio'];

$link = mysqli_connect('localhost', 'root', '', 'controleestoque');

$pdf = new PDF();
$pdf->AddPage();
if ($id_secao == NULL){
    $pdf->Table($link, 'SELECT m.id as movimentacao, p.nome produto, m.descricao, s.nome as secao'
        . ' FROM produto_movimentacao pm '
        . ' INNER JOIN produto p on p.id = pm.produto_id'
        . ' INNER JOIN movimentacao m on m.id = pm.movimentacao_id'
        . ' LEFT JOIN secao s on m.id_secao = s.id');

$pdf->Output();
}
$pdf->Table($link, 'SELECT m.id as movimentacao, p.nome produto, m.descricao, s.nome as secao'
        . ' FROM produto_movimentacao pm '
        . ' INNER JOIN produto p on p.id = pm.produto_id'
        . ' INNER JOIN movimentacao m on m.id = pm.movimentacao_id'
        . ' LEFT JOIN secao s on m.id_secao = s.id'
        . ' WHERE s.id = '.$id_secao);

$pdf->Output();
?>
