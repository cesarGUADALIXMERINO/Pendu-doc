<?php

session_start(); //Debut de session simule un début de partie
session_unset(); // Destruction de toutes les variables de la session précédente
session_destroy(); //Evite des beugs en détruisant la session d'avant, nouvelle partie

?>
<!DOCTYPE html>
<html>
<head>
  <title>Jeu pendu </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf8">
  <link rel="stylesheet" type="text/css" href="index.css">
  <script language="javascript" src="pendu.js"></script>
</head>
<body>

  <h1>Présentation du jeu</h1>
    <p>A chaque coup, le joueur propose une lettre. Si cette lettre est dans le mot au moins une fois, elle est affichée à son ou ses emplacements corrects dans le mot, sinon un élément supplémentaire du pendu apparait. 
    Si le joueur arrive à proposer toutes les lettres qui constituent le mot (donc, devine le mot) avant que le pendu soit constitué, il gagne. Dès que le pendu est constitué la partie est perdue.</p>
    <img src="http://cruciverbiste.com/wp-content/uploads/2016/02/le-pendu-1.png"></img  >
  <section class="menu">
      <ul>
        <li style="background:rgb(77,235,45) !important"><a href="pendu.html">JOUER</a></li> <!-- Lien vers la page de demande à l'utilisateur de la longeur du mot -->
      </ul>
  </section>
</body>
</html>