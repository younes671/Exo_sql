<?php

ob_start();
require_once "MonPDO.php";


if($monPDO){
    $req1 = 'SELECT l.id_lieu AS "id", l.nom_lieu AS "nom" 
    FROM  lieu l
    WHERE l.id_lieu = :id
    ';
    $req2 = 'SELECT l.id_lieu, p.nom_personnage, l.nom_lieu
    FROM personnage p
    INNER JOIN specialite s ON s.id_specialite = p.id_specialite
    INNER JOIN lieu l ON l.id_lieu = p.id_lieu
    ORDER BY l.id_lieu
    ';
    $req3 = 'SELECT b.nom_bataille, l.nom_lieu
    FROM bataille b
    INNER JOIN lieu l ON l.id_lieu = b.id_lieu
    ORDER BY l.id_lieu
    ';
    $stmt =$monPDO->prepare($req1);
    $id = $_GET["id_lieu"];
    $stmt->execute(["id"=>$id]);
    $lieux = $stmt->fetchAll();
?>  <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Ingrédient</th>
            <th scope="col">Cout ingrédient</th>
            <th scope="col">Quantité</th>
          </tr>
        </thead>
        <tbody>
        <?php    
 foreach($lieux as $lieu){
?>            <tr>
                <td><?= $lieu['nom'] ?></td>
                <!-- <td><?= $detailpotion['cout'] ?></td>
                <td><?= $detailpotion['quantite'] ?></td> -->
              </tr>
<?php
             }
?> 
        </tbody>
    </table><?php
    
} 

$title = "Détail village ".$_GET['nom'];
$content = ob_get_clean(); 
require_once "template.php";

?>