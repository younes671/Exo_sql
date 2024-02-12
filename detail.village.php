<?php

ob_start();
require_once "MonPDO.php";


if($monPDO){
    $req1 = 'SELECT l.id_lieu AS "id", l.nom_lieu AS "nom" 
    FROM  lieu l
    WHERE l.id_lieu = :id
    ';
    $req2 = 'SELECT l.id_lieu, p.nom_personnage AS "nom", l.nom_lieu
    FROM personnage p
    INNER JOIN specialite s ON s.id_specialite = p.id_specialite
    INNER JOIN lieu l ON l.id_lieu = p.id_lieu
    WHERE l.id_lieu = :id
    ORDER BY l.id_lieu
    ';
    $req3 = 'SELECT b.nom_bataille AS "nom_bataille", DATE_FORMAT(b.date_bataille, "%d/%m/%Y") AS "date_bataille", l.nom_lieu
    FROM bataille b
    INNER JOIN lieu l ON l.id_lieu = b.id_lieu
    WHERE l.id_lieu = :id
    ORDER BY l.id_lieu
    ';
    $stmt1 =$monPDO->prepare($req1);
    $id = $_GET["id_lieu"];
    $stmt1->execute(["id"=>$id]);
    $lieux = $stmt1->fetch();

    $stmt2 =$monPDO->prepare($req2);
    $id = $_GET["id_lieu"];
    $stmt2->execute(["id"=>$id]);
    $personnages = $stmt2->fetchAll();

    $stmt3 =$monPDO->prepare($req3);
    $id = $_GET["id_lieu"];
    $stmt3->execute(["id"=>$id]);
    $batailles = $stmt3->fetchAll();
?>  <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><h2>Villageois</h2></th>
          </tr>
        </thead>
        <tbody>
        <?php    
 foreach($personnages as $personnage){
?>            <tr>
                <th scope="col">Nom : </th>
                <td><?= $personnage['nom'] ?></td>
              </tr><?php
             }
             foreach($batailles as $bataille){
              ?>            <tr>
                              <th scope="col">Bataille : </th>
                              <td><?php echo $bataille['nom_bataille'] ?></td>
             </tr>
             <tr>
             <th scope="col">Date bataille : </th>
                              <td><?php echo $bataille['date_bataille'] ?></td>  
                            </tr><?php
                           }
?> 

        </tbody>
    </table><?php
    
} 

$title = "Détail village ".$_GET['nom'];
$content = ob_get_clean(); 
require_once "template.php";

?>