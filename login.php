<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Clothing : Log In </title>

    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <img src="img/loader.gif" class="loader" alt="">
    <div class="alert-box">
        <img src="img/error.png" class="alert-img" alt="">
        <p class="alert-msg">Error message </p>

    </div>
    <div class="container">
        <img src="img/dark-logo.png" class="logo" alt="">
        <div>
            <form method="post" action="action/logincheck.php">
<div class='linear'>
            <input name="email" type="email" autocomplete="off" id="email" placeholder="email">
            </div>
<div class='linear'>
            <input name="password" type="password" autocomplete="off" id="password" placeholder="password">
            </div>
            <button type="submit" class="submit-btn">log in</button>
        </form>
        </div>
        <a href="signup.php" class="link">dont have an account? Create one</a>
    </div>

    <script>
        if (window.location.href.indexOf("error=1") > -1) {
shake();
};

function shake(){
    document.body.style.animation="screenshake .5s, screenred .5s ease-in";
    document.getElementById("error").style.display="block";
};
    </script>
    
    
</body>
</html>