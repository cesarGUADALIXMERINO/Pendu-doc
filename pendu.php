<?php
  
session_start(); //On lance une nouvelle session

  if(isset($_GET["nblettre"])){          //Si le joueur a choisit la longueur de son mot...
    $n=intval($_GET[ "nblettre" ]);     //On stocke en convertissant de string à entier la valeur de la longueur
    $_SESSION["nblettre"]=$n;
    $_SESSION["lettre deviner"]=array_fill(0,$n,""); //On crée une liste d'une longuer du nombre le lettres
  }
  $n=$_SESSION["nblettre"];            //Dans tous les cas on lie la valeur du nombre de lettres
  

function debut($a,$b) { //Cette fonction va nous doisposer la division principale où l'on aura l'image du pendu les traits représentant les lettres du mot et la demande au joueur de la lettre à deviner
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

function fin1(){  //Fin pour le perdant
    $r= "<div id='main'>\n";
    $r.= "<img id='pendu' src='images/10.png'/>\n"; //Affichage a la suite de la derniere image 
    $r.="<form action='index.php'> "; //Formulaire de redirection vers l'accueil pour rejouer
    $r.="<input type='submit' value='Accueil'/> "; //Button de validation
    $r.="</form>";
    return $r;
}

function fin2(){  //Fin pour le gagnant, même redirection que pour le perdant
    $r= "<div id='bravo'>\n";
    $r.= "<p> Bravo vous avez gagné ! </p>\n";
    $r.= "</div>\n";
    $r.= "<div id='main'>\n";
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
    $fichier=fopen('C:\xampp\htdocs\TPs\Pendu-doc-master\mot.txt','w+');
    /*On parcourt le tableau $lines et on écrit le contenu de chaque ligne dans le fichier mot.txts*/
    foreach ($lines as $lineNumber => $lineContent){
      $mot=$lineContent; //Récupère la valeur du mot et non pas l'index
      if ((strlen($mot)-1)==$n){// -1 car strlen prends en compte le retour a la ligne dans la longueur de la chaine de caractére 
          fwrite($fichier,$mot); //Mots de la longueur désirée par le joueur transcrits dans le fichier où on va choisir un random
      }
    }
    fclose($fichier);

  // choisit un mot aléatoire dans le fichier texte créé 
  if(!isset($_SESSION["motdeviner"])){
    $l= file('mot.txt', /*FILE_IGNORE_NEW_LINES|*/FILE_SKIP_EMPTY_LINES);
    $index = array_rand($l); //choisis une ligne (dans notre cas correcpondant à un mot) parmi toutes les lignes $l du fichier mot.txt transcrit
    $deviner=$l[$index]; //fixe le mot à deviner
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

else{ //Message d'erreur si la taille désirée est inférieure à 5 ou supérieure à 11
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


<!-- linea 69 $fichier=fopen('/home/user/web/pendu/mot.txt','w+'); -->