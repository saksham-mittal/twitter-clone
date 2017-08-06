<div class="container p-4">

    <div class="row">
        <div class="col-md-8 pr-5">
            
            <?php 
            
                if(array_key_exists('id', $_SESSION)) {
            ?>
                    <h2 class='display-4'>Tweets For You</h2><br>
            <?php
                    displayTweets('isFollowing');   
                } else {
                    echo "
                    <h1 class='display-2'>Join <strong><span style='color: #1C4262;'>CONNECT</span></strong> now and connect to people all around the world.</h1>
                    
                    <p class='lead'>What are you waiting for? <a href='#' data-toggle='modal' data-target='#myModal'>Sign Up</a></p>
                    
                    ";
                }
            
            ?>
            
        </div>
        <div class="col-md-4 pt-4">
        
            <?php
                if(array_key_exists('id', $_SESSION)) {
                    displaySearch(); ?>
            
                <hr>
            
            <?php 
                    displayTweetBox(); 
                }
            ?>
        
        </div>
    </div>
    
</div>