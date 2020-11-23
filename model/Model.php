<?php
require_once File::build_path(array('config','conf.php'));
class Model{

    public static $pdo;

    public static function Init(){
        $hostname = Conf::getHostname();
        $database_name = Conf::getDatabase();
        $login = Conf::getLogin();
        $password = Conf::getPassword();
        try {
            // Connexion à la base de données
            // Le dernier argument sert à ce que toutes les chaines de caractères
            // en entrée et sortie de MySql soit dans le codage UTF-8
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage();
            }else{
                echo "erreur";
            }
            die();
        }

    }

    public static function selectAll(){
        $table_name = static::$object;
        $class_name = "Model" . ucfirst($table_name);

        $pdo = Model::$pdo;
        $rep = $pdo->query("SELECT * FROM $table_name");
        $rep->setFetchMode(PDO::FETCH_CLASS,$class_name);
        return $rep->fetchAll();
    }
}
Model::Init();