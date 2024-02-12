<?php

ob_start();
require_once "MonPDO.php";


if($monPDO){
    $req = 'SELECT l.id_lieu AS "id_lieu", l.nom_lieu AS "nom", COUNT(p.id_personnage) AS nombre_personnage
    FROM lieu l
    INNER JOIN personnage p ON l.id_lieu = p.id_lieu
    AND p.id_lieu = l.id_lieu
    GROUP BY l.id_lieu
    ORDER BY nombre_personnage DESC     
    ';
    $stmt =$monPDO->prepare($req);
    $stmt->execute();
    $villages = $stmt->fetchAll();
    ?><table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Nom village</th>
            <th scope="col">Nombre d'habitant</th>
          </tr>
        </thead>
        <tbody>
            <?php
    foreach($villages as $village){
         ?>
          <tr>
          <td><a href="detail.village.php?id_lieu=<?=$village['id_lieu']?>&nom=<?=$village['nom']?>" class="badge badge-light text-dark text-decoration-none" ><?=$village['nom']?></a></td>
          <td><?=$village['nombre_personnage']?></td>
          </tr>
      <?php
    }
    ?> </tbody>
    </table><?php
    
} 

$title = "Villages";
$content = ob_get_clean(); 
require_once "template.php";

?>