

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothing : Create Account</title>

    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <img src="img/loader.gif" class="loader" alt="">
    <div class="alert-box">
        <img src="img/error.png" class="alert-img" alt="">
        <p class="alert-msg">Error message </p>

    </div>
    <div class="container">
        <img src="img/dark-logo.png" class="logo" alt="signup.php">
        <div>
            <form method="post" action="action/createaccount.php">
                <div class='linear'>
            <input name="username" type="text" autocomplete="off" id="name" placeholder="username" required>
</div>
<div class='linear'>

            <input name="email" type="email" autocomplete="off" id="email" placeholder="email" required>
            </div>
<div class='linear'>
            <input name="password" type="password" autocomplete="off" id="password" placeholder="password" required>
            </div>
<div class='linear'>
            <input name="cpassword" type="password" autocomplete="off" id="cpassword" placeholder="confirm password" required>
            </div>
            <input type="checkbox" checked class="checkbox" id="terms-and-cond">
            <label for="terms-and-cond">agree to our <a href="">terms and conditions</a></label>
            <br>
            <input type="checkbox" class="checkbox" id="notification">
            <label for="notification">receive upcoming offers and events mails</label>
            <button typê="submit" class="submit-btn">create account</button>
        </form>
        </div>
        <a href="login.php" class="link">already have an account? Log in here</a>
    </div>
    <script src="js/token.js"></script>
    <script>

if (window.location.href.indexOf("error=1") > -1) {
shake();
}else if(window.location.href.indexOf("error=2") > -1) {
    shake();
}else if(window.location.href.indexOf("error=3") > -1) {
    shake();
}else if(window.location.href.indexOf("error=4") > -1) {
    shake();
};

function shake(){
    document.body.style.animation="screenshake .5s, screenred .5s ease-in";
    document.getElementById("error").style.display="block";
};


    </script>
    
</body>
</html>