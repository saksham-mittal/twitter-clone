<div class="container p-4">

    <div class="row">
        <div class="col-md-8 pr-5">
        
            <h2 class="display-4">Search Results</h2><br>
            
            <?php
                if(array_key_exists('q', $_GET)) {
                    if($_GET['q'] == "") {
                        echo "<p class='lead'>Nothing to search for!</p><h5><small class='text-muted'>Please enter a valid query.</small></h5>";
                    } else {
                        displayTweets('search'); 
                    }
                }
            
            ?>
            
        </div>
        <div class="col-md-4 pt-4">
        
            <?php displaySearch(); ?>
            
            <hr>
            
            <?php displayTweetBox(); ?>
        
        </div>
    </div>
    
</div>