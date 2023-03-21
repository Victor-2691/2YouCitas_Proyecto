<?php


class Posts{
    //conexion
    private $host  = '138.59.135.31';
    private $user  = 'tiusr2cp_grupo4';
    private $password   = ')vyEXe_G.IhT';
    private $database  = 'tiusr2cp_2youcitasbd_sitiosg4';    
    private $postTable = 'posts';
    private $postVotesTable = 'post_votes';
    private $dbConnect = false;

    public function __construct(){
        if(!$this->dbConnect){ 
          $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
          if($conn->connect_error){
             die("Error failed to connect to MySQL: " . $conn->connect_error);
          }else{
             $this->dbConnect = $conn;
          }
        }
     }

    public function getPosts(){
        $sqlQuery = 'SELECT post_id, id_cliente, imagen, fecha, vote_up, vote_down FROM posts';
        $resultado = mysqli_query($this->dbConnect, $sqlQuery);
        $row = $resultado->fetch_all(MYSQLI_ASSOC);
        return  $row;        
      }
    
    
    public function isUserAlreadyVoted($id_cliente, $post_id){
        $sqlQuery = 'SELECT post_id, id_cliente, vote FROM '.$this->postVotesTable." WHERE id_cliente = '".$id_cliente."' AND post_id = '".$post_id."'";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        return $result->num_rows;
    }   
    
    public function getPostVotes($post_id){
        $sqlQuery = 'SELECT post_id, id_cliente, vote_up, vote_down FROM '.$this->postTable." WHERE post_id = '".$post_id."'";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return  $row;
    } 
    
    public function updatePostVote($postVoteData) { 
        $sqlQuery = "UPDATE ".$this->postTable." SET vote_up = '".$postVoteData['vote_up']."' , vote_down = '".$postVoteData['vote_down']."' WHERE post_id = '".$postVoteData['post_id']."'";
        mysqli_query($this->dbConnect, $sqlQuery);      
        
        $sqlVoteQuery = "INSERT INTO ".$this->postVotesTable." (id, post_id, id_cliente,fecha) VALUES ('', '".$postVoteData['post_id']."', '".$postVoteData['id_cliente']."',now())";
        if($sqlVoteQuery) {
            mysqli_query($this->dbConnect, $sqlVoteQuery);  
            return true;            
        }   
    }

}


?>