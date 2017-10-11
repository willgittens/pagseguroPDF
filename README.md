# pagseguroPDF
Venda e proteja automaticamente seus e-books utilizando a plataforma de pagamentos Pagseguro. Seus livros vendidos de forma segura.
 
## Introdução
Já pensou em vender seus livros na internet e não sabia como automatizar o processo? Eu também tive esse problema e acabei desenvolvendo esse sistema que além de realizar a venda, também protege o livro contra cópias. Pensei em uma solução simples onde não exista a necessidade de certificado de segurança digital, realizando toda a transação no ambiente do Pagseguro.

## O que o pagseguroPDF faz
- Cria o botão para venda através da API do Pagseguro
- Informa você e o cliente de cada etapa da compra através de um modelo configurável de e-mail
- Cria um PDF personalizado com o nome e transação da compra em cada página do seu e-book
- Gera uma planilha de vendas realizadas com valor das compras, emails, etc.
- Disponibiliza link para download do E-Book personalizado

## Requisitos do sistema
- PHP 6+
- cURL habilitado

## Atenção
**Seus e-books _precisam ter o formato PDF 1.4_ para o pagseguroPDF funcionar corretamente. Versões do PDF mais recentes vão gerar erros no sistema.**

## Como configurar
1. Faça o download do pagseguroPDF
2. Crie uma pasta no seu servidor e coloque os arquivos do pagseguroPDF.
3. Faça upload dos seus livros em PDF 1.4 para a pasta LIVROS.
4. Adicione as informações sobre os seus livros no arquivo produtos.json
5. Edite o arquivo configuracoes.php e preencha os campos com os seus dados.

## Alguns detalhes da configuração
- Você pode configurar o e-mail que será enviado ao cliente com o link para download do livro e status da compra. Coloque o nome da sua empresa, endereço para imagem com o seu logo e o link para seu site.
- Você tem 3 campos para preencher com conteúdo adicional para o leitor do seu e-mail. Atenção ao preenchimento.

## Detalhes do preenchimento _produtos.json_
Veja como preencher o JSON com os dados dos seus produtos. Lembrando que a posição X e posiçãoY são referentes ao texto de proteção do PDF. Você pode personalizar o posicionamento do texto individualmente. Leia abaixo sobre como testar seu e-book para verificar se o posicionamento ficou adequado.

```json
{
  "produtos":[
    {
	 "itemDescription1": "Ebook Modelo teste 1",
	 "itemId1": "modelo-teste-1",
	 "itemAmount1": "19.90",
	 "itemQuantity1": 1,
	 "currency": "BRL",
	 "paginas": "144",
	 "posicaoX": "25",
	 "posicaoY": "-22" 
    }
  ]
}
```
## Atenção a um detalhe:
O código do produto tem que ser o mesmo que o nome do arquivo PDF na pasta LIVROS. Não utilizar espaços ou acentos. **Exemplo: modelo-teste-1.pdf**
 
## Configure sua conta no Pagseguro
No arquivo de configurações verá que você precisa informar o TOKEN e o email utilizados no Pagseguro. Um detalhe muito importante é informar a seguinte URL para a notificação de transações:

```html
http://link-para-pasta-pagseguroPDF/callback.php
```

**_Sem a url de notificação configurada no painel do Pagseguro, o sistema não funcionará corretamente._**
 
 
## Testando seus livros
No arquivo **produtos.json** você viu que é necessário atribuir uma posição para o texto que vai proteger o seu livro da pirataria. Você pode testar se o posicionamento ficou bom acessando o link:

```html
http://link-para-pasta-pagseguroPDF/teste-livro.php?produto=COD_DO_PRODUTO
```

**_Após realizar os seus testes, apague o arquivo teste-livro.php para não deixar brechas na segurança do seu conteúdo._**
 
 
## A importância do e-mail
Você verá que diversos itens no arquivo configuracoes.php são sobre sua empresa e email. No e-mail padrão que utilizei no sistema, você tem 3 campos complementares para além de informar seu cliente sobre o status da venda, você pode utilizar o e-mail como forma de promover seu blog ou outros livros que queira vender.
 
**Não perca essa chance de tentar novas vendas!**

## Criar o botão de pagamento
Agora que você já tem a biblioteca pagseguroPDF no seu servidor e já testou os seus e-books, é hora de criar o botão de pagamento. Essa é a única hora que você vai ter que trabalhar com código e serão somente 2 linhas de PHP.

Primeiro precisamos dar um include_once no arquivo onde estão as principais funções, você pode fazer isso no inicio do código. Não se esqueça de colocar o caminho correto para o arquivo de acordo com o nome da pasta onde você colocou os arquivos do pagseguroPDF. Exemplo "/pagseguroPDF/pagseguroPDF.php";

```php
<?php 
include_once("pagseguroPDF.php");
$bto_pagseguroPDF = new pagseguroPDF();
?>
```
Agora você somente precisa inserir o seguinte código no HREF do seu botão no código HTML. O sistema irá retornar a URL para você realizar a compra via Pagseguro. O usuário irá clicar e será redirecionado para o Pagseguro com as informações da venda já preenchidos de acordo com os dados no arquivo **produtos.json**

```php
<?php echo $bto_pagseguroPDF->geraBotaoPagseguro( "ID-DO-SEU-LIVRO" ); ?>
```

Pronto! Somente com isso seu botão de pagamento já será criado pelo Pagseguro e você já pode começar a vender os seus livros.


# Como o pagseguroPDF funciona?
O pagseguroPDF é uma integração com a API do Pagseguro do UOL e as bibliotecas FPDF e FPDI. Uma vez que o Pagseguro autorize, o sistema envia um e-mail para o cliente com o PDF personalizado com os dados da compra.

Isso inibe a pirataria, já que você terá como saber a fonte exata de quem vazou a cópia do seu livro na internet.
 
# Posso utilizar a vontade?
Claro!! Espero que goste do sistema, aproveite ele bem e consiga ótimas vendas.
