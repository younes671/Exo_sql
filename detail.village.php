<?php

ob_start();
require_once "MonPDO.php";


if($monPDO){
    $req1 = 'SELECT l.id_lieu AS "id", l.nom_lieu AS "nom" 
    FROM  lieu l
    WHERE l.id_lieu = :id
    ';
    $req2 = 'SELECT l.id_lieu, p.nom_personnage AS "nom", p.adresse_personnage AS "adresse"
    FROM personnage p
    INNER JOIN specialite s ON s.id_specialite = p.id_specialite
    INNER JOIN lieu l ON l.id_lieu = p.id_lieu
    WHERE l.id_lieu = :id
    ORDER BY "nom" DESC
    ';
    $req3 = 'SELECT b.nom_bataille AS "nom_bataille", DATE_FORMAT(b.date_bataille, "%d/%m/%Y") AS "date_bataille", l.nom_lieu
    FROM bataille b
    INNER JOIN lieu l ON l.id_lieu = b.id_lieu
    WHERE l.id_lieu = :id
    ORDER BY YEAR(b.date_bataille) DESC 
    ';
    $id = $_GET["id_lieu"];
    $stmt1 =$monPDO->prepare($req1);
    $stmt1->execute(["id"=>$id]);
    $lieux = $stmt1->fetch();
    echo"<h1>".$lieux['nom']."</h1>";

    $stmt2 =$monPDO->prepare($req2);
    $stmt2->execute(["id"=>$id]);
    $personnages = $stmt2->fetchAll();

    $stmt3 =$monPDO->prepare($req3);
    $stmt3->execute(["id"=>$id]);
    $batailles = $stmt3->fetchAll();
?>   <h2>Habitants</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Personnages</th>
          <th scope="col">Adresse</th>
        </tr>
      </thead>
    <tbody>
<?php    
foreach($personnages as $personnage){
?>    <tr>
        <td><?= $personnage['nom'] ?></td>
        <td><?= $personnage['adresse'] ?></td>
      </tr>
<?php
     } 
?>  </tbody>
</table>

  <table class="table table-striped ">
  <h2>Batailles</h2>
     <thead>
       <tr>
         <th scope="col">Nom de la bataille</th>
         <th scope="col">Date</th>
       </tr>
     </thead>
   <tbody>
<?php    
foreach($batailles as $bataille){
?>    <tr>
       <td><?= $bataille['nom_bataille'] ?></td>
       <td><?= $bataille['date_bataille'] ?></td>
     </tr>
 

        </tbody>
    </table><?php
    
    }
} 

$title = "";
$content = ob_get_clean(); 
require_once "template.php";

?>