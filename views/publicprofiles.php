<?php 
    
    if(array_key_exists('id', $_SESSION) AND array_key_exists('userid', $_GET)) {
        
        $userQuery = "SELECT * FROM `users` WHERE id = '".mysqli_real_escape_string($link, $_GET['userid'])."' LIMIT 1";
        $user = mysqli_fetch_assoc(mysqli_query($link, $userQuery));                              

?>

    <div class="row ml-0 mt-0 mb-2 p-0" style="max-width: 100%;">
        <div class="col-md-12 p-0">
            <p class="lead p-5 mb-0" id="profile-nav">
                <strong><span class="profile tab ml-5 pl-5" style="color: #155669; font-size: 23px;">
                    <i class="icon ion-at" id="at"></i><?php echo $user['username'] ?>
                </span></strong>
                <span>
                    <?php
            
                        $isFollowingQuery = "SELECT * FROM `isFollowing` WHERE `follower` = '".mysqli_real_escape_string($link, $_SESSION['id'])."' AND `isFollowing` = '".mysqli_real_escape_string($link, $user['id'])."' LIMIT 1";

                        $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);
        
                        if(mysqli_num_rows($isFollowingQueryResult) > 0) {
                            echo "<span class='small mr-5' style='color: #155669;'>Following</span>";
                        } else {
                            echo "<span class='small mr-3' style='color: #F5F8FA;'>Following</span>";
                        }
            
                    ?>
                </span>
                <span class="profile-tab mr-4"><a class="profile-links currentLink"  id="tweetLinktab">TWEETS</a>
                    <span class="number text-muted">
                    <?php
                        $query = "SELECT * FROM `tweets` WHERE `userid` = '".mysqli_real_escape_string($link, $user['id'])."'";
                        $result = mysqli_query($link, $query);

                        echo mysqli_num_rows($result);
                    ?>
                    </span>
                </span>
                <span class="profile-tab mr-4"><a class="profile-links" id="followingLinktab">FOLLOWING</a>
                    <span class="number text-muted">
                        <?php
                            $query = "SELECT * FROM `isFollowing` WHERE `follower` = '".mysqli_real_escape_string($link, $user['id'])."'";
                            $result = mysqli_query($link, $query);

                            echo mysqli_num_rows($result);
                        ?>
                    </span>
                </span>
                <span class="profile-tab mr-4"><a class="profile-links" id="followersLinktab">FOLLOWERS</a>
                    <span class="number text-muted">
                        <?php
                            $query = "SELECT * FROM `isFollowing` WHERE `isFollowing` = '".mysqli_real_escape_string($link, $user['id'])."'";
                            $result = mysqli_query($link, $query);

                            echo mysqli_num_rows($result);
                        ?>
                    </span>
                </span>
                <span class="profile-tab" style="margin-left: 330px;">
                    <?php
                        echo "<span style='padding-left: 20px;'><a href='#' class='toggleFollow btn btn-outline-primary pr-2 pl-2 pt-1 pb-1 mb-1 mt-1' data-userId = '".$user['id']."'>";

                        $isFollowingQuery2 = "SELECT * FROM `isFollowing` WHERE `follower` = '".mysqli_real_escape_string($link, $_SESSION['id'])."' AND `isFollowing` = '".mysqli_real_escape_string($link, $user['id'])."' LIMIT 1";

                        $isFollowingQueryResult2 = mysqli_query($link, $isFollowingQuery2);

                        if(mysqli_num_rows($isFollowingQueryResult2) > 0) {
                            echo "Unfollow <i class='icon ion-minus-round'></i>";
                        } else {
                            echo "Follow <i class='icon ion-plus-round'></i>";
                        }

                        echo "</a></span>";
                    ?>
                </span>
            </p>
        </div>
    </div>

<?php   }   ?>

<div class="container p-4">

    <div class="row">
        <div class="col-md-8 pr-5">
            
            <?php 
            
                if(array_key_exists('id', $_SESSION)) {
            ?>
                    <?php if(array_key_exists('id', $_SESSION) AND array_key_exists('userid', $_GET)) { ?>
            
                        <?php displayTweets($_GET['userid']); ?>
            
                    <?php   } else {    ?>
            
                        <h2 class='display-4'>Active Users</h2><br>
            
                        <?php displayUsers(); 
            
                    }    
                } else {
                    echo "
                        <h1 class='display-2' id='banner'>Join <strong><span style='color: #1C4262;'>CONNECT</span></strong> now and connect to people all around the world.</h1>

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