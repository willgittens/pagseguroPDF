<?php

$mensagemNotificacao = '
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<title>'.EMAIL_NOMEEMPRESA.'</title>
	<link href="//fonts.googleapis.com/css?family=ABeeZee:300,400,600,700|ABeeZee:300,400,600,700|ABeeZee:300,400,600,700|ABeeZee:300,400,600,700|" rel="stylesheet" type="text/css">
<style type="text/css">
@font-face {
  font-family: "ABeeZee";
  font-style: normal;
  font-weight: 400;
  src: local("ABeeZee"), local("ABeeZee-Regular"), url(http://fonts.gstatic.com/s/abeezee/v9/TV7JXr7j4tW7mgYreANhGQ.woff2) format("woff2");
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}
</style>
</head>

<body style="font-family: "ABeeZee";">

<center>

<table width="550" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
    <tr>
        <td valign="top" width="30%">
		  <img src="'.EMAIL_LOGO.'" width="100%" >
        </td>
        <td valign="middle" style="padding-left:20px;">
<h1 style="margin:0px;">'.EMAIL_NOMEEMPRESA.'</h1>
        </td>
    </tr>
</table>

<table width="550" border="0" cellpadding="0" cellspacing="0" style="margin-top:15px;">
    <tr>
        <td valign="top" width="30%" style="padding-left:10px; padding-right:10px;">
<h4 style="font-weight:lighter; font-size:18px; margin-bottom:0px;">
Sua compra está em andamento! 
<a style="color:orange;"><h3 style="font-size:14px;">Transação: '.$transacao.'</h3></b>
<a style="color:orange;"><h3 style="font-size:14px;">Produto: '.$produto.'</h3></b>
<a style="color:orange;"><h3 style="font-size:14px;">Status: '.$status.'</h3></b>
<p style="font-size:18px;">'.EMAIL_TEXTO.'</p>
        </td>
    </tr>
</table>

<table width="550" border="0" cellpadding="0" cellspacing="0" style="margin-top:15px;">
    <tr>
        <td style="border-top:2px solid orange; padding-left:7px; padding-top:3px;">
<h5 style="margin:0px; padding:0px; font-size:16px; font-weight:lighter;">'.EMAIL_CHAMADA.'</h5>
        </td>
    </tr>
</table>

<table width="550" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
    <tr>
        <td valign="top" width="33%" style="padding:6px; padding-top:0px; padding-bottom:5px;">
		  <a href="'.EMAIL_LINK1.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" ><img src="'.EMAIL_IMAGEM1.'" width="100%" ></a>
        </td>
        <td valign="top" width="33%" style="padding:6px; padding-top:0px; padding-bottom:5px;">
		  <a href="'.EMAIL_LINK2.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" ><img src="'.EMAIL_IMAGEM2.'" width="100%" ></a>
        </td>
        <td valign="top" width="33%" style="padding:6px; padding-top:0px; padding-bottom:5px;">
		  <a href="'.EMAIL_LINK3.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" ><img src="'.EMAIL_IMAGEM3.'" width="100%" ></a>
        </td>
    </tr>
    <tr style="margin-top:0px;">
        <td valign="top" width="33%" style="padding:6px; padding-top:0px;">
<a href="'.EMAIL_LINK1.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" >'.EMAIL_TITULO1.'</a>
        </td>
        <td valign="top" width="33%" style="padding:6px; padding-top:0px;">
<a href="'.EMAIL_LINK2.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" >'.EMAIL_TITULO2.'</a>
        </td>
        <td valign="top" width="33%" style="padding:6px; padding-top:0px;">
<a href="'.EMAIL_LINK3.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" >'.EMAIL_TITULO3.'</a>
        </td>
    </tr>
</table>

<table width="550" border="0" cellpadding="0" cellspacing="0" style="margin-top:25px; margin-bottom:20px; ">
    <tr>
        <td align="center" valign="top" width="30%" style="padding-left:10px; padding-right:10px;">
<h4 style="font-weight:lighter; font-size:18px; margin-bottom:0px;">
Acesse!!<br><a href="'.EMAIL_LINKEMPRESA.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" >'.EMAIL_LINKEMPRESA.'</a>
</h4>
        </td>
    </tr>
</table>

</center>

</body>
</html>';





















$mensagemDownload = '
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<title>'.EMAIL_NOMEEMPRESA.'</title>
	<link href="//fonts.googleapis.com/css?family=ABeeZee:300,400,600,700|ABeeZee:300,400,600,700|ABeeZee:300,400,600,700|ABeeZee:300,400,600,700|" rel="stylesheet" type="text/css">
<style type="text/css">
@font-face {
  font-family: "ABeeZee";
  font-style: normal;
  font-weight: 400;
  src: local("ABeeZee"), local("ABeeZee-Regular"), url(http://fonts.gstatic.com/s/abeezee/v9/TV7JXr7j4tW7mgYreANhGQ.woff2) format("woff2");
  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000;
}
</style>
</head>

<body style="font-family: "ABeeZee";">

<center>

<table width="550" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
    <tr>
        <td valign="top" width="30%">
		  <img src="'.EMAIL_LOGO.'" width="100%" >
        </td>
        <td valign="middle" style="padding-left:20px;">
<h1 style="margin:0px;">'.EMAIL_NOMEEMPRESA.'</h1>
        </td>
    </tr>
</table>

<table width="550" border="0" cellpadding="0" cellspacing="0" style="margin-top:15px;">
    <tr>
        <td valign="top" width="30%" style="padding-left:10px; padding-right:10px;">
<h4 style="font-weight:lighter; font-size:18px; margin-bottom:0px;">
Seu pagamento foi realizado!<br> 
<a href="'.EMAIL_LINKEMPRESA.dirname($_SERVER["REQUEST_URI"]).'/compras/'.$transacao.'.pdf" style="font-size:18px;">Seu livro está pronto para ser baixado. Clique no link para acessar.</a>
        </td>
    </tr>
</table>

<table width="550" border="0" cellpadding="0" cellspacing="0" style="margin-top:15px;">
    <tr>
        <td style="border-top:2px solid orange; padding-left:7px; padding-top:3px;">
<h5 style="margin:0px; padding:0px; font-size:16px; font-weight:lighter;">'.EMAIL_CHAMADA.'</h5>
        </td>
    </tr>
</table>

<table width="550" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
    <tr>
        <td valign="top" width="33%" style="padding:6px; padding-top:0px; padding-bottom:5px;">
		  <a href="'.EMAIL_LINK1.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" ><img src="'.EMAIL_IMAGEM1.'" width="100%" ></a>
        </td>
        <td valign="top" width="33%" style="padding:6px; padding-top:0px; padding-bottom:5px;">
		  <a href="'.EMAIL_LINK2.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" ><img src="'.EMAIL_IMAGEM2.'" width="100%" ></a>
        </td>
        <td valign="top" width="33%" style="padding:6px; padding-top:0px; padding-bottom:5px;">
		  <a href="'.EMAIL_LINK3.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" ><img src="'.EMAIL_IMAGEM3.'" width="100%" ></a>
        </td>
    </tr>
    <tr style="margin-top:0px;">
        <td valign="top" width="33%" style="padding:6px; padding-top:0px;">
<a href="'.EMAIL_LINK1.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" >'.EMAIL_TITULO1.'</a>
        </td>
        <td valign="top" width="33%" style="padding:6px; padding-top:0px;">
<a href="'.EMAIL_LINK2.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" >'.EMAIL_TITULO2.'</a>
        </td>
        <td valign="top" width="33%" style="padding:6px; padding-top:0px;">
<a href="'.EMAIL_LINK3.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" >'.EMAIL_TITULO3.'</a>
        </td>
    </tr>
</table>

<table width="550" border="0" cellpadding="0" cellspacing="0" style="margin-top:25px; margin-bottom:20px; ">
    <tr>
        <td align="center" valign="top" width="30%" style="padding-left:10px; padding-right:10px;">
<h4 style="font-weight:lighter; font-size:18px; margin-bottom:0px;">
Acesse!!<br><a href="'.EMAIL_LINKEMPRESA.'" style="color:gray; text-decoration:none; border:0px; font-size:16px;" >'.EMAIL_LINKEMPRESA.'</a>
</h4>
        </td>
    </tr>
</table>

</center>

</body>
</html>';










?>