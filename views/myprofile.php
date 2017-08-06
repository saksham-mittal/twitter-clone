<div class="row ml-0 mt-0 mb-2 p-0" style="max-width: 100%;">
    <div class="col-md-12 p-0">
        <p class="lead p-5 mb-0" id="profile-nav">
            <strong><span class="profile tab ml-5 pl-5 mr-4" style="color: #155669; font-size: 23px;">
                @<?php echo $_SESSION['username'] ?>
            </span></strong>
            <span class="profile-tab mr-4"><a href="#" class="profile-links currentLink"  id="tweetLinktab">TWEETS</a>
                <span class="number text-muted">
                <?php
                    $query = "SELECT * FROM `tweets` WHERE `userid` = '".mysqli_real_escape_string($link, $_SESSION['id'])."'";
                    $result = mysqli_query($link, $query);

                    echo mysqli_num_rows($result);
                ?>
                </span>
            </span>
            <span class="profile-tab mr-4"><a href="#" class="profile-links" id="followingLinktab">FOLLOWING</a>
                <span class="number text-muted">
                    <?php
                        $query = "SELECT * FROM `isFollowing` WHERE `follower` = '".mysqli_real_escape_string($link, $_SESSION['id'])."'";
                        $result = mysqli_query($link, $query);

                        echo mysqli_num_rows($result);
                    ?>
                </span>
            </span>
            <span class="profile-tab mr-4"><a href="#" class="profile-links" id="followersLinktab">FOLLOWERS</a>
                <span class="number text-muted">
                    <?php
                        $query = "SELECT * FROM `isFollowing` WHERE `isFollowing` = '".mysqli_real_escape_string($link, $_SESSION['id'])."'";
                        $result = mysqli_query($link, $query);

                        echo mysqli_num_rows($result);
                    ?>
                </span>
            </span>
        </p>
    </div>
</div>

<div class="container p-4" id="tweetsContainer">

    <div class="row">
        <div class="col-md-8 pr-5">
            
            <div class="tweetsContainer">
                <h2 class='display-4'>Your tweets</h2><br>
                <?php
                    displayTweets('yourtweets');
                ?>
            </div>
            
            <div class="followingContainer hidden-xs-up">
                <h2 class='display-4'>People You Are Following</h2><br>
                <?php

                    $query = "SELECT * FROM `isFollowing` WHERE `follower` = '".mysqli_real_escape_string($link, $_SESSION['id'])."'";
                    $result = mysqli_query($link, $query);

                    if(mysqli_num_rows($result) == 0) {
                        echo "<p class='lead'>You don't follow anyone yet!</p>" ; 
                    }

                    while($row = mysqli_fetch_assoc($result)) {

                        $nameQuery = "SELECT * FROM `users` WHERE `id` = '".$row['isFollowing']."' LIMIT 1";
                        $row2 = mysqli_fetch_assoc(mysqli_query($link, $nameQuery));

                        echo "<p class='lead'> <a href='?page=publicprofiles&userid=".$row2['id']."'>@".$row2['username']."</a></p>";

                    }
                ?>
            </div>
            
            <div class="followersContainer hidden-xs-up">
                <h2 class='display-4'>Your Followers</h2><br>
                <?php

                    $query = "SELECT * FROM `isFollowing` WHERE `isFollowing` = '".mysqli_real_escape_string($link, $_SESSION['id'])."'";
                    $result = mysqli_query($link, $query);

                    if(mysqli_num_rows($result) == 0) {
                        echo "<p class='lead'>You have no following yet!</p>" ;  
                    }

                    while($row = mysqli_fetch_assoc($result)) {

                        $nameQuery = "SELECT * FROM `users` WHERE `id` = '".$row['follower']."' LIMIT 1";
                        $row2 = mysqli_fetch_assoc(mysqli_query($link, $nameQuery));

                        echo "<p class='lead'> <a href='?page=publicprofiles&userid=".$row2['id']."'>@".$row2['username']."</a></p>";

                    }

                ?>
            </div>
            
        </div>
        <div class="col-md-4 pt-4" id="brder">
        
            <?php displaySearch(); ?>
            
            <hr>
            
            <?php displayTweetBox(); ?>
        
        </div>
    </div>
    
</div>