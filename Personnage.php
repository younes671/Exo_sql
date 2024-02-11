<?php

ob_start(); 
require_once "MonPDO.php";


if($monPDO){
    $req = 'SELECT nom_personnage AS "Nom", adresse_personnage AS "Adresse"
    FROM personnage';
    $stmt =$monPDO->prepare($req);
    $stmt->execute();
    $personnages = $stmt->fetchAll();
    ?><table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Nom</th>
            <th scope="col">Adresse</th>
          </tr>
        </thead>
        <tbody>
            <?php
    foreach($personnages as $personnage){
         ?>
          <tr>
          <td><?=$personnage['Nom']?></td>
          <td><?=$personnage['Adresse']?></td>
          </tr>
      <?php
    }
    ?> </tbody>
    </table><?php
}

$title = "Personnages";
$content = ob_get_clean(); 
require_once "template.php";


?>