<?php


// PagseguroPDF
// Bem vindo ao Callback
// 
// Esse arquivo é utilizado pelo pagseguroPDF para intermediar as transações do Pagseguro,
// você e o cliente. É o que deixa tudo automatizado.

if( isset( $_POST['notificationCode'] ) && isset( $_POST['notificationType'] ) ) {
	
			include_once( 'pagseguroPDF.php' );

			$pagseguroPDF = new pagseguroPDF();

			$codigoNotificacao = $_POST['notificationCode'];			
			$pagseguro = "https://ws.pagseguro.uol.com.br/v2/transactions/notifications/".$_POST['notificationCode']."?email=".PAGSEGURO_EMAIL."&token=".PAGSEGURO_TOKEN;

			$curl = curl_init( $pagseguro );
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($curl);
			$http = curl_getinfo($curl);
	       
			if($response == 'Unauthorized'){

					print_r($response);
					exit;

			}	

			curl_close($curl);
			$response = simplexml_load_string($response);

			if( count( $response -> error ) > 0 ){

					print_r($response);
					exit;

			} 

			var_dump($pagseguro);
          
			$compra[0]['transacao'] = $response->code;
			$compra[0]['produto'] = $response->reference;
			$compra[0]['status'] = $pagseguroPDF->descricaoStatus( $response->status );
			$compra[0]['nome'] = $response->sender->name;
			$compra[0]['email'] = $response->sender->email;
			$compra[0]['valor'] = $response->grossAmount;
			$compra[0]['dia'] = date("d");
			$compra[0]['mes'] = date("m");
			$compra[0]['ano'] = date("y");
			$compra[0]['data'] = date("r");

			$transacao = str_replace( "-","", $compra[0]['transacao']);
			
			$paginas = $pagseguroPDF->totalPaginas( $response->reference );
			$posicaoX = $pagseguroPDF->posicao( "X", $response->reference );
			$posicaoY = $pagseguroPDF->posicao( "Y", $response->reference );

			$arquivoCSV = fopen("compras.csv", "a");
			fputcsv( $arquivoCSV, $compra[0] );
			fclose( $arquivoCSV );
	       

			if( $response->status != 4 ){


					if( $response->status == 3 ){

							$pagseguroPDF->criaEbook( $compra[0]['produto'] , $paginas , $compra[0]['nome']."-".$compra[0]['transacao'] , $transacao, $posicaoX, $posicaoY, "arquivo" );

							$pagseguroPDF->enviaArquivo( $response->sender->email , $transacao );

							$pagseguroPDF->avisaAdmin( $compra[0]['transacao'] , $response->reference , $compra[0]['status'] );

					}
					else{

							$pagseguroPDF->avisaAdmin( $compra[0]['transacao'] , $response->reference , $compra[0]['status'] );	       	

							$pagseguroPDF->enviaEmail( $response->sender->email , $compra[0]['transacao'] , $response->reference , $compra[0]['status'] );

					}


			}
	       
	       
}

?>