<?php

ob_start();
require_once "MonPDO.php";


if($monPDO){
    $req = 'SELECT b.nom_bataille AS "Nom", DATE_FORMAT(b.date_bataille, "%d/%m/%Y") AS "date bataille", l.nom_lieu AS "Lieu"
    FROM bataille b
    INNER JOIN lieu l ON l.id_lieu = b.id_lieu
    ORDER BY YEAR(b.date_bataille) DESC
    ';
    $stmt =$monPDO->prepare($req);
    $stmt->execute();
    $batailles = $stmt->fetchAll();
    ?><table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Nom bataille</th>
            <th scope="col">Lieu bataille</th>
            <th scope="col">Date bataille</th>
          </tr>
        </thead>
        <tbody>
            <?php
    foreach($batailles as $bataille){
         ?>
          <tr>
          <td><?=$bataille['Nom']?></td>
          <td><?=$bataille['Lieu']?></td>
          <td><?=$bataille['date bataille']?></td>
          </tr>
      <?php
    }
    ?> </tbody>
    </table><?php
    
} 

$title = "Batailles";
$content = ob_get_clean(); 
require_once "template.php";

?>