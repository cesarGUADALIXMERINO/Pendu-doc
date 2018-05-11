<?php

session_start();
session_unset(); 
session_destroy(); 

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
  <section class="menu">
      <ul>
        <li style="background:maroon !important"><a href="pendu.html">JOUER</a></li> 
      </ul>
  </section>
</body>
</html>