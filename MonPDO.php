<?php
       
             const HOST_NAME ="localhost";
             const DB_NAME ="gaulois";
             const USER_NAME ="root";
             const PWD ="";

           try{
               $connexion ="mysql:host=".HOST_NAME.";dbname=".DB_NAME;
               $monPDO = new PDO($connexion,USER_NAME,PWD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

           }catch(PDOException $e){
            $message = "Erreur de connexion à la DB".$e->getmessage();
            die($message);
           }
           
        
        

?>