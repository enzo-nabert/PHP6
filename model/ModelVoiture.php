<?php
require_once File::build_path(array('model','Model.php'));

class ModelVoiture extends Model{
   
  private $marque;
  private $couleur;
  private $immatriculation;
  private $debug = true;
  protected static $object = "voiture";
  protected static $primary = "immatriculation";


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


}
?>