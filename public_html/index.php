<?php
ini_set( 'display_errors', 0 );
session_start();

 require_once('model/dao/loginDao.php');


 $login = new LoginDao();

if($_SESSION['usuario'] <> ""){

$usuario = $_SESSION['usuario'];

 $login->deleta($usuario);

}

 session_destroy();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Deviation  
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20100328

-->
<html lang="pt-br">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<!-- <script type="text/javascript" src="js/tradutor.js"></script> -->

<title>IVET</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

<script type="text/javascript">

// $(document).ready(function(){
 
//     $(".excluir").unbind("click");
//     $(".excluir").bind("click", function () {


//         var checkeds = new Array();
//         $("input[type=checkbox][name='check[]']:checked").each(function(){

//            // valores inteiros usa-se parseInt
//            //checkeds.push(parseInt($(this).val()));
//            // string
//            checkeds.push( $(this).val());
//         });
         

//     var $selecionados = document.querySelectorAll('td [type="checkbox"]:checked')

//          alert($selecionados.length);
//     for(let i = 0; i < $selecionados.length; i++) {
//            //alert(i);
//         $selecionados[i].parentNode.parentNode.remove()
//     }

//     dados = checkeds;

//        alert(dados);

//        $.ajax({
//           type: "POST",
//           url: "../controller/sequenciaController.php",
//           data: dados,
//           success: function(data){
//            // console.log(data);

//               alert(data);
//           } 
//         });



//         });

// });


</script> 

<style>
    /* Remove combobox*/
  #google_translate_element {
        display: none;
  }

    /* Remove barra do google*/
    .goog-te-banner-frame {
        display: none !important;
    }
    body {
        position: static !important;
        top: 0 !important;
    }
    


.tradutor{

    float: right;
    margin: 0;
    width: 200px;  
}
       

</style>

</head>

<body>
<div id="wrapper">

  <div id="header">

     <div id="google_translate_element"></div>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


<div  class="tradutor">
   
    <ul class="nav" >
    <a href="javascript:trocarIdioma('pt');" alt="portugues" ><img width="40px" height="25px" src="images/br.png" /></a>
    <a href="javascript:trocarIdioma('en');" alt="ingles" ><img width="40px" height="25px" src="images/en.png"  /></a>
    <a href="javascript:trocarIdioma('es');" alt="espanhol" ><img width="40px" height="25px" src="images/es.png"  /></a>
    </ul>

</div>

    <div id="logo">
      <h1><a href="#">IVET   </a></h1>
      <p> Influenza Virus Evolution  <a href="http://templated.co" rel="nofollow">Tool</a></p>
    </div>
  </div>

    </div>
  <!-- end #header -->
  


<script type="text/javascript">

var comboGoogleTradutor = null; //Varialvel global

    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'pt',
            includedLanguages: 'en,es,pt',
            layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
        }, 'google_translate_element');

        comboGoogleTradutor = document.getElementById("google_translate_element").querySelector(".goog-te-combo");
    }

    function changeEvent(el) {
        if (el.fireEvent) {
            el.fireEvent('onchange');
        } else {
            var evObj = document.createEvent("HTMLEvents");

            evObj.initEvent("change", false, true);
            el.dispatchEvent(evObj);
        }
    }

    function trocarIdioma(sigla) {

        if (comboGoogleTradutor) {
            comboGoogleTradutor.value = sigla;
            changeEvent(comboGoogleTradutor);//Dispara a troca
        }
    }


</script>






<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
  width: 360px;
  /*padding: 8% 0 0;*/
  margin: auto;
}
.form {
  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form button {
  font-family: "Roboto", sans-serif;
  text-transform: uppercase;
  outline: 0;
  background: #dd5827;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #FFFFFF;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}
.form button:hover,.form button:active,.form button:focus {
  background: #A83A01;
}
.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #dd5827;
  text-decoration: none;
}
.form .register-form {
  display: none;
}
.container {
  position: relative;
  z-index: 1;
  max-width: 300px;
  margin: 0 auto;
}
.container:before, .container:after {
  content: "";
  display: block;
  clear: both;
}
.container .info {
  margin: 50px auto;
  text-align: center;
}
.container .info h1 {
  margin: 0 0 15px;
  padding: 0;
  font-size: 36px;
  font-weight: 300;
  color: #1a1a1a;
}
.container .info span {
  color: #4d4d4d;
  font-size: 12px;
}
.container .info span a {
  color: #000000;
  text-decoration: none;
}
.container .info span .fa {
  color: #EF3B3A;
}
.login{
  margin: 15px 0 0;
  color: #767692;
  font-size: 13px;
  margin-right: 70px;
  margin-left: 5px;
  text-align: left; 
}

body {
  background: #76b852; /* fallback for old browsers */
  background: -webkit-linear-gradient(right, #76b852, #8DC26F);
  background: -moz-linear-gradient(right, #76b852, #8DC26F);
  background: -o-linear-gradient(right, #76b852, #8DC26F);
  background: linear-gradient(to left, #FFFDEA, #FFFDEA);
  font-family: "Roboto", sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;      
}

$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
 
</style>

<div class="login-page">
  <div class="form">
    <form class="login-form" method="post" action="controller/loginController.php">
      <div class="login"> Username: </div>
      <input type="text" name="login" />
      <div class="login"> Password: </div>
      <input type="password"  name="senha" />
      <input type="hidden" name="acao" value="aut" />
      <!-- <input type="submit" name="enviar" value="Login"/> -->
      <button>Submit</button>
      <p class="message">Not registered? <a href="view/cadastrausuario.php">Create your account heres</a></p>
    </form>
  </div>
</div>

<!-- end form for validations -->


<?php

include 'view/footer.html';
?>




