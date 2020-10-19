<?php
require_once File::build_path(array('model','Model.php'));

class ModelVoiture {
   
  private $marque;
  private $couleur;
  private $immatriculation;
  private $debug = true;
      
  // getters      
  public function getMarque() {
    return $this->marque;  
  }

  public function getCouleur() {
    return $this->couleur;  
  }

  public function getImmatriculation() {
    return $this->immatriculation;  
  }
     
  //setters
  public function setMarque($marque2) {
    $this->marque = $marque2;
  }

  public function setCouleur($couleur2){
    $this->couleur = $couleur2;
  }

  public function setImmatriculation($immatriculation2){
    if (strlen($immatriculation2) <= 8) {
      $this->immatriculation = $immatriculation2;
    }else{
      $this->immatriculation = "erreur trop long";
    }
    
  }
      
  // un constructeur
  public function __construct($data = array())  {
      foreach ($data as $key => $value){
          if($key != 'action') {
              $this->$key = $value;
          }
      }

  }

  public static function getAllVoitures(){
      $pdo = Model::$pdo;
      $rep = $pdo->query("SELECT * FROM voiture");
      $rep->setFetchMode(PDO::FETCH_CLASS,'ModelVoiture');
      return $rep->fetchAll();
  }

  public static function getVoitureByImmat($immat) {
      $sql = "SELECT * from voiture WHERE immatriculation=:nom_tag";
      // Préparation de la requête
      $req_prep = Model::$pdo->prepare($sql);
      $values = array(
          "nom_tag" => $immat,
          //nomdutag => valeur, ...
      );
      // On donne les valeurs et on exécute la requête
      $req_prep->execute($values);

      // On récupère les résultats comme précédemment
      $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelVoiture');
      $tab_voit = $req_prep->fetchAll();
      // Attention, si il n'y a pas de résultats, on renvoie false
      if (empty($tab_voit))
          return false;
      return $tab_voit[0];
  }

  public function save()
  {
      try {
          $sql = "INSERT INTO voiture VALUES('$this->immatriculation','$this->marque','$this->couleur')";
          $pdo = Model::$pdo;
          $req = $pdo->prepare($sql);
          $req->execute();
      }catch(PDOException $e){
          if ($e->getCode() == '23000'){
              return false;
          }
      }
      return true;
  }

  public function delete(){
      $sql = "DELETE FROM voiture WHERE immatriculation = :immat";
      $pdo = Model::$pdo;
      $req = $pdo->prepare($sql);
      $values = array('immat' => $this->immatriculation);
      $req->execute($values);
  }
}
?>