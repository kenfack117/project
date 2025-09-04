<?php
// Paramètres
$host = 'localhost';
$username = 'root';
$db = 'tache';
$password = '';

// Connexion à la base
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $username, $password);
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données
        if(isset($_POST['ajouter'])){
        $description = $_POST['description'];
        $heureFin = $_POST['heureFin'];
        // Vérification des champs obligatoires

        
      //   if (empty($description) || empty($heureFin)) {
      //       die("Tous les champs sont obligatoires");
      //   }
        // Requête d'insertion
        if(isset($_POST['ajouter'])){


        $stmt = $pdo->prepare("INSERT INTO list (description,heureFin) 
                                VALUES (:description, :heureFin)");
       
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':heureFin', $heureFin);

        if ($stmt->execute()) {
            echo "Inscription réussie !";
            header('location:index.php');
        } else {
            echo "Erreur d'insertion : ";
            print_r($stmt->errorInfo());
        }
       }
}
      // if(isset($_POST['delete'])){
      //    if(!empty($_POST['ids'])){
      //       $ids = $_POST['ids'];
      //       foreach($ids as $id){
      //          $sql = "DELETE FROM list WHERE id_etudiant=?";
      //          $stmt = $pdo->prepare($sql);
      //          $stmt->execute([$id]);
      //       }
      //       header('location:todo.php');
            
      //    }else{
      //       echo "aucunes taches sélectionnée";
      //    }
      // }

      
      }
    $stmt=$pdo->query("SELECT*FROM list");
    $resultat=$stmt->fetchAll(PDO::FETCH_ASSOC);
   }catch(PDOException $e){
      echo "l'erreur de".$e ;
     }
?>