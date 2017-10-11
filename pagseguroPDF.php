<?php


// PagseguroPDF 2.0
// Bem vindo ao código-fonte das principais funções dessa biblioteca.
//
// Qualquer dúvida só acessar a documentação em:
// https://github.com/willgittens/pagseguroPDF


require_once("configuracoes.php");


class pagseguroPDF{

			// Declarando variáveis que utilizaremos na biblioteca

			private $url;
			private $botao;
			public $notificacoes;
			private $pagseguro;


			// Esse método envia uma requisição para o Pagseguro e obtem como resposta
			// um token para criar o botão de pagamento. Ler mais em API Pagseguro.
			// Retorna: String com link para pagamento no Pagseguro ou falso em caso de erro.			

			public function geraBotaoPagseguro( $produto ){

							if( PAGSEGURO_AMBIENTE == 1 ){

									$this->url = "https://ws.pagseguro.uol.com.br/v2/checkout/";
									$this->botao = "http://pagseguro.uol.com.br/v2/checkout/payment.html";
									$this->notificacoes = "https://ws.pagseguro.uol.com.br/v2/transactions/notifications/";

							}

							else if( PAGSEGURO_AMBIENTE == 2 ){

									$this->url = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/";
									$this->botao = "https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html";
									$this->notificacoes = "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications/";

							}						
								
							$pagseguro = $this->url."?email=".PAGSEGURO_EMAIL."&token=".PAGSEGURO_TOKEN;

							$arquivoProdutos = file_get_contents( dirname(__FILE__).'/produtos.json');
							$produtos = json_decode( $arquivoProdutos );
							
							foreach( $produtos->produtos as $item ){
								
							    if( $item->itemId1 == $produto ){
							    	
							        $dadosCompra['itemDescription1'] = utf8_decode( $item->itemDescription1 );
							        $dadosCompra['itemId1'] = $item->itemId1;
							        $dadosCompra['itemAmount1'] = $item->itemAmount1;
							        $dadosCompra['itemQuantity1'] = $item->itemQuantity1;
							        $dadosCompra['currency'] = $item->currency;
							        $dadosCompra['reference'] = $item->itemId1;
							        
							    }
							    
							}		

							if( isset($dadosCompra) ){

									$dadosCompra = http_build_query( $dadosCompra );
									
									$curl = curl_init( $pagseguro );
									curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
									curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
									curl_setopt($curl, CURLOPT_POSTFIELDS, $dadosCompra);
									
									$respostaPagSeguro = curl_exec($curl);
									$http = curl_getinfo($curl);
									
									if( $http['http_code'] == "200" ) {
									
											$respostaPagSeguro= simplexml_load_string($respostaPagSeguro);
											return $this->botao.'?code='.$respostaPagSeguro->code;
									
									}else{

											return false;
											
									}


							}else{

									return false;

							}


							

			}



			// Esse método traduz o código do status vindo do Pagseguro de uma transação em texto.
			// Retorna: String com texto referente ao código do status

			public function descricaoStatus( $codigoStatus ){
				
							
							if( $codigoStatus == 1 ){ return "Aguardando pagamento"; }
							if( $codigoStatus == 2 ){ return "Em análise"; }
							if( $codigoStatus == 3 ){ return "Paga"; }
							if( $codigoStatus == 4 ){ return "Disponível"; }
							if( $codigoStatus == 5 ){ return "Em disputa"; }
							if( $codigoStatus == 6 ){ return "Devolvida"; }
							if( $codigoStatus == 7 ){ return "Cancelada"; }
							if( $codigoStatus == 8 ){ return "Debitado"; }
							if( $codigoStatus == 9 ){ return "Retenção temporária"; }
							else{ return false; }	
				
			}		


			// Esse método cria o Ebook utilizando as bibliotecas FPDF e FPDI
			// Retorna arquivo PDF

			public function criaEbook( $arquivoOriginal, $totalPaginas, $texto, $transacao, $posicaoX, $posicaoY, $output ){
				
								require_once('bibliotecas/fpdf.php');
								require_once('bibliotecas/fpdi.php');

								$contagem = 1;

								$pdf = new FPDI();
													
								while( $contagem <= $totalPaginas ) {
								
										$pdf->AddPage();
										$pdf->setSourceFile( dirname(__FILE__).'/livros/'.$arquivoOriginal.'.pdf' );
										$tplIdx = $pdf->importPage( $contagem );
										$pdf->useTemplate($tplIdx);
										
										if( $contagem > 1 ) {
										
												$pdf->SetFont('Helvetica','','6');
												$pdf->SetTextColor(0, 0, 0);
												$pdf->SetXY( $posicaoX, $posicaoY);
												$pdf->Write( 0, $texto );
										
										}
										
										$contagem++;
					
								}
								
								if( $output == "arquivo" ){

										$pdfNovo = $pdf->Output( 'S' );
										
										$novo = fopen( dirname(__FILE__)."/compras/".$transacao.".pdf", 'w' );
										fwrite( $novo, $pdfNovo );
										fclose( $novo );	
								
								}else{
								
										$pdfNovo = $pdf->Output(  );
								
								}
								

								

			}


			// Essa função verifica o total de páginas de um ebook
			// conforme configurado no produtos.json
			// Retorna: Inteiro com total de páginas

			public function totalPaginas( $produto ){
				
							$arquivoProdutos = file_get_contents('produtos.json');
							$produtos = json_decode( $arquivoProdutos );
							
							foreach( $produtos->produtos as $item ){
								
							    if( $item->itemId1 == $produto ){
							    	
									  return $item->paginas;
							        
							    }
							    
							}		
									
			}



			// Essa função verifica a posição que deve ser feita a marcação no PDF
			// conforme configurado no produtos.json
			// Retorna: Inteiro com valor da dimensao requerida

			public function posicao( $dimensao, $produto ){
				
								
							$arquivoProdutos = file_get_contents('produtos.json');
							$produtos = json_decode( $arquivoProdutos );
							
							foreach( $produtos->produtos as $item ){
								
							    if( $item->itemId1 == $produto ){
							    	
							    		if( $dimensao == "X" ) { return $item->posicaoX; }
							    		else if( $dimensao == "Y" ) { return $item->posicaoY; }
							    		else{ return false; }
									  
							    }
							    
							}		
									
				
			}		




			// Essa função verifica a posição que deve ser feita a marcação no PDF
			// conforme configurado no produtos.json
			// Retorna: Inteiro com valor da dimensao requerida

			public function testaEbook( $produto ){

					$paginas = $this->totalPaginas( $produto );
					$posicaoX = $this->posicao( "X", $produto );
					$posicaoY = $this->posicao( "Y", $produto );
					
					$this->criaEbook( $produto , $paginas , "Teste de arquivo PDF - ABCDEFGHIJKLMNOPQRSTUVXZ" , "TESTE", $posicaoX, $posicaoY, "" );

			}



			// Função envia email para o Admin informando o status da transação

			public function avisaAdmin( $transacao , $produto, $status ){
				
								$assunto = "Você vendeu um livro";
								
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
								$headers .= 'From: '.EMAIL_NOMEEMPRESA.' <'.PAGSEGURO_EMAIL.'>' . "\r\n";
								
								$mensagem = "<h1>Você vendeu um livro:</h1>";
								$mensagem .= "<p>Livro: ".$produto."</p>";
								$mensagem .= "<p>Status: ".$status."</p>";
								
								mail( PAGSEGURO_EMAIL, $assunto, $mensagem, $headers );
				
			} 



			// Função envia email para o Cliente informando o status da transação

			public function enviaEmail( $emailCliente , $transacao , $produto , $status ){	
				
							   include_once("email.php");
				
								$assunto = "Compra em andamento";				

								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
								$headers .= 'From: '.EMAIL_NOMEEMPRESA.' <'.PAGSEGURO_EMAIL.'>' . "\r\n";

								mail( $emailCliente, $assunto, $mensagemNotificacao, $headers );

			} 


			// Função envia email para o Cliente informando o link para download do E-book

			public function enviaArquivo( $emailCliente , $transacao ){
				
							   include_once("email.php");	
				
								$assunto = "Sua compra foi realizada";
								
								if( $emailNotificacoes == "" ){ $emailAdmin = $email; }
								else { $emailAdmin = $emailNotificacoes; }					

								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
								$headers .= 'From: '.EMAIL_NOMEEMPRESA.' <'.PAGSEGURO_EMAIL.'>' . "\r\n";

								mail( $emailCliente, $assunto, $mensagemDownload, $headers );

			}





}



?>
