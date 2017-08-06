<footer class="footer mb-0">
            
            <div class="container pl-5" id="footerContainer">
                    
                <strong>&copy; <a href="index.php" id="connectFooter">CONNECT</a></strong> by <strong>SAKSHAM MITTAL</strong> - 2017
                
                <?php  if(!array_key_exists('id', $_SESSION))  {   ?>

                <span class="float-right pr-5">
                    <a style="background-color:#191919;color:white;text-decoration:none;padding:4px 6px;font-family:-apple-system, BlinkMacSystemFont, &quot;San Francisco&quot;, &quot;Helvetica Neue&quot;, Helvetica, Ubuntu, Roboto, Noto, &quot;Segoe UI&quot;, Arial, sans-serif;font-size:11px;font-weight:bold;line-height:1.2;display:inline-block;border-radius:3px;" href="https://unsplash.com/@frankiefoto?utm_medium=referral&amp;utm_campaign=photographer-credit&amp;utm_content=creditBadge" target="_blank" rel="noopener noreferrer" title="Download free do whatever you want high-resolution photos from frank mckenna"><span style="display:inline-block;padding:2px 3px;"><svg xmlns="http://www.w3.org/2000/svg" style="height:12px;width:auto;position:relative;vertical-align:middle;top:-1px;fill:white;" viewBox="0 0 32 32"><title></title><path d="M20.8 18.1c0 2.7-2.2 4.8-4.8 4.8s-4.8-2.1-4.8-4.8c0-2.7 2.2-4.8 4.8-4.8 2.7.1 4.8 2.2 4.8 4.8zm11.2-7.4v14.9c0 2.3-1.9 4.3-4.3 4.3h-23.4c-2.4 0-4.3-1.9-4.3-4.3v-15c0-2.3 1.9-4.3 4.3-4.3h3.7l.8-2.3c.4-1.1 1.7-2 2.9-2h8.6c1.2 0 2.5.9 2.9 2l.8 2.4h3.7c2.4 0 4.3 1.9 4.3 4.3zm-8.6 7.5c0-4.1-3.3-7.5-7.5-7.5-4.1 0-7.5 3.4-7.5 7.5s3.3 7.5 7.5 7.5c4.2-.1 7.5-3.4 7.5-7.5z"></path></svg></span><span style="display:inline-block;padding:2px 3px;">frank mckenna</span>
                    </a>
                </span>
                
                <?php   }   ?>
                
            </div>
            
        </footer>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalTitle">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="loginAlert"></div>
                    <form>
                        <input type="hidden" id="loginActive" name="loginActive" value="1">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon">@</div>
                                <input type="text" class="form-control" id="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Email address">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>  
                    </form>
                    <p id="txt">Don't have an account?</p>   
                    <a id="toggleLogin" href="#">Sign Up</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="loginsignupbtn">Login</button>
                </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            
            $(".nav-link").on("click", function() {
                $(".nav-link").find(".active").removeClass("active");
                $(this).addClass("active");
            });

            $('#toggleLogin').click(function() {
                if($('#loginActive').val() == "1") {
                    $('#loginActive').val("0");
                    $('#loginModalTitle').html('Sign Up');
                    $('#loginsignupbtn').html('Sign Up');
                    $('#txt').html('Already have an account?')
                    $('#toggleLogin').html('Login');
                } else {
                    $('#loginActive').val("1");
                    $('#loginModalTitle').html('Login');
                    $('#loginsignupbtn').html('Login');
                    $('#txt').html("Don't have an account?")
                    $('#toggleLogin').html('Sign Up');
                }
            });
            
            $('#loginsignupbtn').click(function() {
                $.ajax({
                    type: "POST",
                    url: "action.php?action=loginSignup",
                    data: "username=" + $('#username').val() + "&email=" + $('#email').val() + "&password=" + $('#password').val() + "&loginActive=" + $('#loginActive').val(),
                    success: function(result) {
                        if(result == "1") {
                            if($('#loginActive').val() == "0") {
                                $.ajax({
                                    type: "POST",
                                    url: "action.php?action=sendmail",
                                    data: "username=" + $('#username').val() + "&email=" + $('#email').val(),
                                    success: function(result) {
                                        if(result == "1") {
                                            $('#loginAlert').html("Please verify account first. Email has been sent!");
                                            $('#loginAlert').show();
                                        } else {
                                            $('#loginAlert').html(result);
                                            $('#loginAlert').show();
                                        }
                                    }
                                 }) 
                            } else {
                                window.location.assign("index.php");
                            }
                        } else if(result == "2") {
                            $('#loginAlert').html("Please verify account first. Email has been sent!");
                            $('#loginAlert').show();
                        } else {
                            
                            $('#loginAlert').html(result);
                            $('#loginAlert').show();
                            
                        }
                    }
                })
            });
            
            $('.toggleFollow').click(function() {
                
                var id = $(this).attr('data-userId')
                
                $.ajax({
                    type: "POST",
                    url: "action.php?action=toggleFollow",
                    data: "userId=" + id,
                    success: function(result) {
                        
                        if(result == "1") {
                            
                            $("a[data-userId='" + id + "']").html("Follow <i class='icon ion-plus-round'></i>");
                            
                        } else if(result == "2") {
                            
                            $("a[data-userId='" + id + "']").html("Unfollow <i class='icon ion-minus-round'></i>");
                            
                        }
                        
                    }
                })
                
            });
            
            $('#postTweetButton').click(function() {
                
                $.ajax({
                    type: "POST",
                    url: "action.php?action=postTweet",
                    data: "tweetContent=" + $("#tweetContent").val(),
                    success: function(result) {
                        
                        if(result == "1") {
                            
                            $("#tweetFail").hide();
                            $('#tweetSuccess').show();
                            
                        } else if(result != "") {
                            
                            $('#tweetSuccess').hide();
                            $("#tweetFail").html(result).show();
                            
                        }
                        
                    }
                })
                
            });
            
            $('#tweetLinktab').click(function() {
                if($('.profile-links').hasClass('currentLink'))
                    $('.profile-links').removeClass('currentLink');
                $(this).addClass('currentLink');
                if($('.tweetsContainer').hasClass('hidden-xs-up'))
                    $('.tweetsContainer').removeClass('hidden-xs-up');
                if(!$('.followingContainer').hasClass('hidden-xs-up'))
                    $('.followingContainer').addClass('hidden-xs-up');
                if(!$('.followersContainer').hasClass('hidden-xs-up'))
                    $('.followersContainer').addClass('hidden-xs-up');
            });
            
            $('#followingLinktab').click(function() {
                if($('.profile-links').hasClass('currentLink'))
                    $('.profile-links').removeClass('currentLink');
                $(this).addClass('currentLink');
                if(!$('.tweetsContainer').hasClass('hidden-xs-up'))
                    $('.tweetsContainer').addClass('hidden-xs-up');
                if($('.followingContainer').hasClass('hidden-xs-up'))
                    $('.followingContainer').removeClass('hidden-xs-up');
                if(!$('.followersContainer').hasClass('hidden-xs-up'))
                    $('.followersContainer').addClass('hidden-xs-up');
            });
            
            $('#followersLinktab').click(function() {
                if($('.profile-links').hasClass('currentLink'))
                    $('.profile-links').removeClass('currentLink');
                $(this).addClass('currentLink');
                if(!$('.tweetsContainer').hasClass('hidden-xs-up'))
                    $('.tweetsContainer').addClass('hidden-xs-up');
                if(!$('.followingContainer').hasClass('hidden-xs-up'))
                    $('.followingContainer').addClass('hidden-xs-up');
                if($('.followersContainer').hasClass('hidden-xs-up'))
                    $('.followersContainer').removeClass('hidden-xs-up');
            });

        </script>

    </body>
</html>