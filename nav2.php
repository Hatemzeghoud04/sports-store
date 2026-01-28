<?php 
  session_start();
  require_once "action/db_connect.php";
  $name = $_SESSION["username"];
  $type = $_SESSION["type"];
  $email = $_SESSION["email"];
  $pan = 0;

  if($name!=NULL){
      $getdata = mysqli_query($conn,"SELECT * FROM users WHERE username='$name'");
      $userdata = mysqli_fetch_array($getdata);
        
?>
<?php if($userdata['type'] == 1) : ?>

<div class="nav">
            <img src="img/dark-logo.png" class="brand-logo" alt="">
            <div class="nav-items">
            
                <a>
                <?php
    if ($type == 1){
        $thetype = "src='img/icons/admin.png'";
     }elseif ($type == 2){
        $thetype = "src='img/icons/moderator.png'";
     }elseif ($type == 3){
        $thetype = "src='img/icons/user.png'";
     }elseif ($type == 4){
         $thetype = "src='img/icons/new.png'";
     };

?>
                     <img <?php echo $thetype ?> id="user-img" alt="">
                     <div class="login-logout-popup hide">
                         <p class="account-info"><?php echo $name ?></p>
                         <?php if($type == 1) : ?>
                        <button onclick="window.location='index.php'"class="btn" id="user-btn">Home</button>

                            <?php endif; ?>

                         <button onclick="window.location='action/logout.php'"class="btn" id="user-btn">Log out</button>
                     </div>
                </a>
            </div>
        </div>
        <ul class="links-container">
            <li class="link-item"><a href="stats.php" class="link">stats</a></li>
            <li class="link-item"><a href="users-panel.php" class="link">users</a></li>
            <li class="link-item"><a href="demandes.php" class="link">demandes</a></li>
            <li class="link-item"><a href="messages-panel.php" class="link">messages</a></li>
            <li class="link-item"><a href="sales-panel.php" class="link">sales</a></li>
            <li class="link-item"><a href="product-panel.php" class="link">products</a></li>
        </ul>
    
<script>
const userImageButton = document.querySelector('#user-img');
const userPop = document.querySelector('.login-logout-popup');
const popuptext = document.querySelector('.account-info');
const actionBtn = document.querySelector('#user-btn');

userImageButton.addEventListener('click', () => {
    userPop.classList.toggle('hide');
})


</script>
<?php elseif($userdata['type'] == 3) : ?>
    <script>
            window.location.href = "home.php";
        </script>
<?php endif; ?>
<?php
}
else {
    header('location:error.php');
}
?>

