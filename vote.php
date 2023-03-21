<?php
include ('Posts.php');        
$posts = new Posts();

if($_POST['post_id'] && $id_cliente) { 
    $postVote = $posts->getPostVotes($_POST['post_id']);    
    
    if($_POST['vote_type'] == 1) { //voto positivo
        if (!$posts->isUserAlreadyVoted($id_cliente, $_POST['post_id'])){
            $postVote['vote_up'] += 1;  
        }       
    } else if($_POST['vote_type'] == 0) { //voto negativo
        if(!$posts->isUserAlreadyVoted($id_cliente, $_POST['post_id'])) {
            $postVote['vote_down'] += 1;                
        }       
    }   
    
    $postVoteData = array(
        'post_id' => $_POST['post_id'],
        'id_cliente' => $id_cliente,
        'vote_up' => $postVote['vote_up'],
        'vote_down' => $postVote['vote_down'],
    );
    
    $postVoted = $posts->updatePostVote($postVoteData); 
    if($postVoted) {
        $response = array(
            'vote_up' => $postVote['vote_up'],
            'vote_down' => $postVote['vote_down'],
            'post_id' => $_POST['post_id']          
        );
        echo json_encode($response);
    }
}
?>