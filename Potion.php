<?php

ob_start();
require_once "MonPDO.php";


if($monPDO){
    $req = 'SELECT p.id_potion AS "Numero", p.nom_potion AS "Nom_potion", SUM(c.qte * i.cout_ingredient) AS "Cout potion"
    FROM potion p
    INNER JOIN composer c ON c.id_potion = p.id_potion
    INNER JOIN ingredient i ON i.id_ingredient = c.id_ingredient
    GROUP BY p.id_potion
    ';
    $stmt =$monPDO->prepare($req);
    $stmt->execute();
    $potions = $stmt->fetchAll();
    ?><table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Numéro Potion</th>
            <th scope="col">Nom potion</th>
            <th scope="col">Cout potion</th>
          </tr>
        </thead>
        <tbody>
            <?php
    foreach($potions as $potion){
         ?>
          <tr>
          <td><?=$potion['Numero']?></td>
          <td><a href="detail.potion.php?Numero=<?=$potion['Numero']?>&Nom_potion=<?=$potion['Nom_potion']?>" class="badge badge-light text-dark text-decoration-none" ><?=$potion['Nom_potion']?></a></td>
          <td><?=$potion['Cout potion']?></td>
          </tr>
      <?php
    }
    ?> </tbody>
    </table><?php
    
} 

$title = "Potions";
$content = ob_get_clean(); 
require_once "template.php";

?>