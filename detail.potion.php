<?php

ob_start();
require_once "MonPDO.php";


if($monPDO){
    $req = 'SELECT p.id_potion AS "id", p.nom_potion AS "nom", i.nom_ingredient AS "nom_ingredient", i.cout_ingredient AS "cout", c.qte AS "quantite"
    FROM potion p
    INNER JOIN composer c ON c.id_potion = p.id_potion
    INNER JOIN ingredient i ON i.id_ingredient = c.id_ingredient   
    ';
    $stmt =$monPDO->prepare($req);
    $stmt->execute();
    $detailpotions = $stmt->fetchAll();
    ?><table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Nom Potion</th>
            <th scope="col">Ingrédient</th>
            <th scope="col">Cout ingrédient</th>
            <th scope="col">Quantité</th>
          </tr>
        </thead>
        <tbody>
            <?php
    foreach($detailpotions as $detailpotion){
         
         if($detailpotion['id'] == $_GET['Numéro']){
    ?>       <tr>
             <td><?=$detailpotion['nom_ingredient']?></td>
             <td><?=$detailpotion['cout']?></td>
             <td><?=$detailpotion['quantite']?></td>
             </tr>
    <?php
            }
    
            }
            ?> </tbody>
            </table><?php
    
} 

$title = "Détail potion ".$_GET['Nom_potion'];
$content = ob_get_clean(); 
require_once "template.php";

?>