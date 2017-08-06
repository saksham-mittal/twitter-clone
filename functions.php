<?php
    // This code belongs to Saksham Mittal 

    session_start();

    $link = mysqli_connect("", "", "", "");                 // First parameter- Host server, Second- Username, Third- Password, Fourth- Database name

    if(mysqli_connect_error()) {
        echo "There was an error connecting to the database";
    }

    if(array_key_exists('function', $_GET)) {
        if($_GET['function'] == "logout") {
            session_unset();
        }   
    }

    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'min'),
            array(1 , 'sec')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    function displayTweets($type) {
        
        global $link;
        
        if($type == 'public') {
            $whereClause = "";
        } else if($type == 'isFollowing') {

            $query = "SELECT * FROM `isFollowing` WHERE `follower` = '".mysqli_real_escape_string($link, $_SESSION['id'])."'";
            $result = mysqli_query($link, $query);

            $whereClause = "";
            
            while($row = mysqli_fetch_assoc($result)) {
                
                if($whereClause == "") {
                    $whereClause = "WHERE";
                } else {
                    $whereClause .= " OR";
                }
                $whereClause .= " `userid` = ".$row['isFollowing'];
            }
        
        } else if($type == 'yourtweets') {
            
            $whereClause = "WHERE `userid` = ".mysqli_real_escape_string($link, $_SESSION['id']);
            
        } else if($type == 'search') {
            
            echo "<p class='lead'>Showing results for '".mysqli_real_escape_string($link, $_GET['q'])."':</p>";
            
            $whereClause = "WHERE `tweet` LIKE '%".mysqli_real_escape_string($link, $_GET['q'])."%'";
            
        } else if(is_numeric($type)) {
            
            $userQuery = "SELECT * FROM `users` WHERE id = '".mysqli_real_escape_string($link, $type)."' LIMIT 1";

            $user = mysqli_fetch_assoc(mysqli_query($link, $userQuery));
            
            echo "<h2>@".mysqli_real_escape_string($link, $user['username'])."<small class='text-muted'>'s Tweets</small></h2><br>";
            
            $whereClause = "WHERE `userid` = '".mysqli_real_escape_string($link, $type)."'";
            
        }
        
        $query = "SELECT * FROM `tweets` ".$whereClause." ORDER BY `datetime` DESC";
        
        $result = mysqli_query($link, $query);
        
        if(mysqli_num_rows($result) == 0) {
            echo "<h5><small class='text-muted'>There are no tweets to display.</small></h5>";
        } else {
            
            while($row = mysqli_fetch_assoc($result)) {
                
                $userQuery = "SELECT * FROM `users` WHERE id = '".mysqli_real_escape_string($link, $row['userid'])."' LIMIT 1";

                $user = mysqli_fetch_assoc(mysqli_query($link, $userQuery));
                
                echo "<div class='tweet' style='margin-bottom: 15px; margin-right: 20px;'><p style='padding-left: 20px; padding-top: 8px; padding-bottom: 8px; border-top-left-radius: 6px; border-top-right-radius: 6px; background-color: #F5F8FA;'><a href='?page=publicprofiles&userid=".$user['id']."'><strong>@".$user['username']."</strong></a> <span class='time'>".time_since(time() - strtotime($row['datetime']))." ago</span></p><p style='padding-left: 20px;'>";
                
                if($type == 'search') {
                    
                    $word = mysqli_real_escape_string($link, $_GET['q']);
                    echo preg_replace("/".$word."/i", "<mark>\$0</mark>", $row['tweet']);
                    
                } else {

                    echo $row['tweet'];
                
                }
                
                if($row['userid'] != $_SESSION['id']) {
                    
                    echo "</p><p style='padding-left: 20px;'><a href='#' class='toggleFollow btn btn-outline-primary pr-2 pl-2 pt-1 pb-1 mb-1 mt-1' data-userId = '".$row['userid']."'>";
                
                    $isFollowingQuery = "SELECT * FROM `isFollowing` WHERE `follower` = '".mysqli_real_escape_string($link, $_SESSION['id'])."' AND `isFollowing` = '".mysqli_real_escape_string($link, $row['userid'])."' LIMIT 1";

                    $isFollowingQueryResult = mysqli_query($link, $isFollowingQuery);

                    if(mysqli_num_rows($isFollowingQueryResult) > 0) {
                        echo "Unfollow <i class='icon ion-minus-round'></i>";
                    } else {
                        echo "Follow <i class='icon ion-plus-round'></i>";
                    }

                    echo "</a></p></div>";
                    
                } else {
                    echo "</p></div>";
                }
                
            }
            
        }
        
    }

    function displaySearch() {
        
        if(array_key_exists('id', $_SESSION)) {
            
            echo '
                <form class="form-inline">
                    <input type="hidden" name="page" value="search">
                    <input type="text" name="q" class="form-control mb-2 mr-sm-2 mb-sm-0" id="search" placeholder="Search">
                    <button type="submit" class="btn btn-primary">Search Tweets</button>
                </form>';
            
        } else {
        
            echo '
                <form class="form-inline">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="search" placeholder="Search">
                    <button type="submit" class="btn btn-primary">Search Tweets</button>
                </form>';
            
        }
        
    }

    function displayTweetBox() {
        
        if(array_key_exists('id', $_SESSION)) {
            
            echo '
            <div class="alert alert-success" id="tweetSuccess">Your tweet was posted successfully.</div>
            <div class="alert alert-danger" id="tweetFail"></div>
            <div class="form">
                <textarea class="form-control" id="tweetContent" rows="4" style="resize: none;" placeholder="Your Tweet..."></textarea>
                <button class="btn btn-primary mt-3" id="postTweetButton">Post Tweet <i class="icon ion-compose ml-1" id="compose"></i></button>
            </div>';
            
        }
        
    }

    function displayUsers() {
        
        global $link;
        
        if(array_key_exists('id', $_SESSION)) {
            $query = "SELECT * FROM `users` WHERE `id` != '".$_SESSION['id']."'";
        } else {
            $query = "SELECT * FROM `users` WHERE `id`";
        }
        
        $result = mysqli_query($link, $query);
        
        while($row = mysqli_fetch_assoc($result)) {
        
                echo "<p class='lead'> <a href='?page=publicprofiles&userid=".$row['id']."'>@".$row['username']."</a></p>";
        
        }
        
    }

?>