<?php 
ob_start();
session_start();
if (isset($_SESSION["username"])){
    header("Location: ../index.php");     
}?>

<!DOCTYPE html>
<html>

    <head>

        <meta charset="UTF-8">

        <title>Electronic Bio Data - Log-in</title>
        <script src="../js/jquery2.1.3.min.js"></script>
        <script src='../jqueryUI/jquery-ui.js'></script>
        <link rel='stylesheet' href="../jqueryUI/jquery-ui.css" />
        <link rel='stylesheet' href="../bootstrap/css/bootstrap.css" />

        <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.css" media="screen" type="text/css" />

    </head>

    <body>

        <div class="login-card">
            <h1><b>Bio Data</b> <br/> Login</h1><br>
            <form>
                <input type="text" name="user" placeholder="Username">
                <input type="password" name="pass" placeholder="Password">
                <input type="submit" name="login" class="login login-submit btn-primary" value="login">
                <i style="margin: auto"></i>
                <input type="button" name="signup" class="login register-submit btn-warning" value="sign up">
                <span class="alert-danger in-pass shownot">Invalid Login details</span>
                <span class="alert-warning up-pass shownot">User id not allow, choose a new one</span>
                <span class="alert-success login-success shownot">Login Successfully</span>
            </form>

            <div class="login-help">
                <!--<a href="#">Register</a> • <a href="#">Forgot Password</a>-->
            </div>
        </div>

<!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->



    </body>

    <script>
        $(function () {
            $("form").submit(function (e) {
                e.preventDefault();
            });
            $("form").click(function (e) {
                e.preventDefault();
            });
            $("[name=login], [name=signup]").click(function (e) {
                var whr = "login";
                if ($(this).attr("name") === "login") {
                    whr = "login";
                } else {
                    whr = "signup";
                }
                $.post("../model/login.php?login="+whr,
                {
                    usr: $("[name=user]").val(),
                    pwd: $("[name=pass]").val()
                },
                function (data) {
                    if (data === "0") {
                        $(".in-pass").slideDown();
                    } else if (data === "1") {
                        $(".login-success").slideDown();
                        $(location).attr("href","../save.php");
                    } else if (data === "2") {
                        $("up-pass").slideDown();
                    }else{
                       // alert("your lock code is: "+data+" \nmake sure you secure it, this is your real access to your file");
                        $(".login-success").slideDown();
                        $(location).attr("href","../save.php");
                    }
                })
                e.preventDefault();
            });

            $(".up-pass, .login-success, .in-pass").mousemove(function () {
                $(this).fadeOut();
            })
        })
    </script>
</html>