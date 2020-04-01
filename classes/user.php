<?php
class User {

    private $_db;

    function __construct($db){

    	$this->_db = $db;
    }

    public function insertImage($image, $convert){
      try{
        $stmt = $this->_db->prepare('INSERT INTO images (name, token) VALUES (:image, :token)');
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':token', $convert);
        $stmt->execute();
        header('Location: view.php?val='. $convert);
      } catch(PDOException $e){
        echo '<p class="bg-danger">'.$e->getMessage().'</p>';
      }
    }

    public function getImage($val){
      try{
        $stmt = $this->_db->prepare('SELECT * FROM images WHERE token = :token');
        $stmt->bindParam(':token', $val);
        $stmt->execute();

        return $stmt->fetchAll();
      } catch(PDOException $e){
        echo '<p class="bg-danger">'.$e->getMessage().'</p>';
      }
    }


}


?>
