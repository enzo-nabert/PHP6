<?php
require_once File::build_path(array('model','Model.php'));

class ModelVoiture extends Model{
   
  private $marque;
  private $couleur;
  private $immatriculation;
  private $debug = true;
  protected static $object = "voiture";


    public function __construct($data = array())  {
        foreach ($data as $key => $value){
            if($key != 'action') {
                $this->$key = $value;
            }
        }

    }
  // getters
  public function get($attribut){
      return $this->$attribut;
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

//  public static function getAllVoitures(){
//      $pdo = Model::$pdo;
//      $rep = $pdo->query("SELECT * FROM voiture");
//      $rep->setFetchMode(PDO::FETCH_CLASS,'ModelVoiture');
//      return $rep->fetchAll();
//  }

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

  public static function update($data){
      echo "je suis là";
      $pdo = Model::$pdo;
      $sql = "UPDATE Voiture SET marque = :marque , couleur = :couleur WHERE immatriculation = :immatriculation";

      $req = $pdo->prepare($sql);
      $req->execute($data);
  }

  public static function deleteByImmat($immat){
      $sql = "DELETE FROM voiture WHERE immatriculation = :immat";
      $pdo = Model::$pdo;
      $req = $pdo->prepare($sql);
      $htmlSpecialImmat = htmlspecialchars($immat);
      $values = array('immat' => $htmlSpecialImmat);
      $req->execute($values);
  }
}
?>