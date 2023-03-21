<div class="container">
   <h2>Sistema Like y Dislike con PHP</h2>     
      <div class="row" id="post-list">
         <?php
         include ('Posts.php');        
         $posts = new Posts();
         $postsData = $posts->getPosts();

         foreach($postsData as $post) {  
         ?>    
  
          <div class="col-sm-4 col-lg-4 col-md-4 post-body">          
             <div class="post-content"><?php echo $post['imagen']; ?></div>
             <div class="post-options pull-right">                   
                <a class="options" data-vote-type="1" id="post_vote_up_<?php echo $post['post_id']; ?>"><i class="glyphicon glyphicon-thumbs-up" data-original-title="Like this post"></i></a>          
                 <span class="counter" id="vote_up_count_<?php echo $post['post_id']; ?>">  <?php echo $post['vote_up']; ?></span>                      
                <a class="options"  data-vote-type="0" id="post_vote_down_<?php echo $post['post_id']; ?>"><i class="glyphicon glyphicon-thumbs-down" data-original-title="Dislike this post"></i></a>      
                <span class="counter" id="vote_down_count_<?php echo $post['post_id']; ?>">  <?php echo $post['vote_down']; ?></span>             
               </div>          
            </div>
            <?php } ?>  
         </div>      
   </div>