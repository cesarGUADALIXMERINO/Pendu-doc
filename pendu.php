<?php
  
session_start();

  if(isset($_GET["nblettre"])){
    $n=intval($_GET[ "nblettre" ]);
    $_SESSION["nblettre"]=$n;
    $_SESSION["lettre deviner"]=array_fill(0,$n,"");
  }
  $n=$_SESSION["nblettre"];
  

function debut($a,$b) {
    $r= "<div id='main'>\n";
    $r.= "<img id='pendu' src='images/$b.png'/>\n";
    $r.= "<table>\n";
    $r.="<tr>\n";
    for($i=0;$i<$a;$i++){
      $r.="<td>";
      $r.=$_SESSION["lettre deviner"][$i];
      $r.="</td>";
    }
    $r.="</tr>\n";
    $r.="</table>\n";
    $r.="<form action='pendu.php' method='get' onsubmit=\"return tester();\">\n";
    $r.=" <input id='l'  type='text' name='lettre' />\n";
    $r.="<input  type='submit' value='Nouvelle lettre' />\n";
    $r.="</form>\n";
    return $r;
}

function fin1(){
    $r= "<div id='main'>\n";
    $r.= "<img id='pendu' src='images/10.png'/>\n";
    $r.="<form action='index.php'> ";
    $r.="<input type='submit' value='Accueil'/> ";
    $r.="</form>";
    return $r;
}

function fin2(){
    echo "bravo vous avez gagné !";
    $r= "<div id='main'>\n";
    $r.="<form action='index.php'> ";
    $r.="<input type='submit' value='Accueil'/> ";
    $r.="</form>";
    return $r;
}

 ?>

<!DOCTYPE html>
<html>
<head>
  <title>Pendu</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf8">
  <link rel="stylesheet" type="text/css" href="pendu.css">
  <script language="javascript" src="pendu.js"></script>
</head>
<body>

  <h1>Pendu</h1>

<?php

if(($n>=5)&&($n<=11)){
      /*Ouvre le fichier et retourne un tableau contenant une ligne par élément*/
    $lines = file('dict.txt');
    $fichier=fopen('/home/user/web/pendu/mot.txt','w+');
    /*On parcourt le tableau $lines et on écrit le contenu de chaque ligne dans le fichier mot.txts*/
    foreach ($lines as $lineNumber => $lineContent){
      $mot=$lineContent;
      if ((strlen($mot)-1)==$n){// -1 car strlen prends en compte le retour a la ligne dans la longueur de la chaine de caractére 
          fwrite($fichier,$mot);
      }
    }
    fclose($fichier);

  // choisit un mot aléatoire dans le fichier texte créé 
  if(!isset($_SESSION["motdeviner"])){
    $l= file('mot.txt', /*FILE_IGNORE_NEW_LINES|*/FILE_SKIP_EMPTY_LINES);
    $index = array_rand($l);
    $deviner=$l[$index];
    $_SESSION["motdeviner"]=$deviner;
  }
  $deviner=$_SESSION["motdeviner"];


  if(!isset($_SESSION["nombre d'erreur"])){
    $_SESSION["nombre d'erreur"]=1;
  }
  $erreur=$_SESSION["nombre d'erreur"];

  if(!isset($_SESSION["mot trouvé"])){
    $_SESSION["mot trouvé"]="";
  }
  $motTrouve=$_SESSION["mot trouvé"];

  if(isset($_GET[ "lettre" ])){
    $lettre=$_GET[ "lettre" ];
    $lettre=strtoupper($lettre);
    if(strpbrk($deviner,$lettre)==false){
        $erreur=$erreur+1;
        $_SESSION["nombre d'erreur"]=$erreur;
    }
    else{
        for($j=0;$j<iconv_strlen($deviner);$j++){
          if($lettre==$deviner{$j}){
           $_SESSION["lettre deviner"][$j]=$lettre;
           $motTrouve=$motTrouve.$lettre;
           $_SESSION["mot trouvé"]=$motTrouve;
          }
        }
    }
  }

  if($erreur==10){
    echo fin1();
    echo "Vous avez perdu le mot était: $deviner";
  }
  else if(iconv_strlen($motTrouve)==iconv_strlen($deviner)-1){
      echo fin2();
      echo "le mot était : $deviner ";
    }
  else{
    echo debut($n,$erreur);
  }
}

else{
  echo " il n'y a pas de mot de cette taille dans le fichier";
  $r="<form action='pendu.html'> ";
  $r.="<input type='submit' value='Rejouer'/> ";
  $r.="</form>";
  echo $r;
}

?>
  <div id="erreur" style="visibility: hidden">

  </div>
</body>
</html>
