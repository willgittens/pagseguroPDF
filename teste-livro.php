<?php

// PagseguroPDF
// Teste de PDF
// Testa o PDF de acordo com as informações passadas no produtos.json

// Acesse:
// http://link-para-pagseguroPDF/teste-livro.php?produto=COD-DO-PROD



include_once("pagseguroPDF.php");

$teste = new pagseguroPDF();

if( isset( $_GET['produto'] ) ){

		$teste->testaEbook( $_GET['produto'] );

}


?>