<div class = "container-form-signin">
   <?php
      ini_set('session.cache_limiter','public');
      session_cache_limiter(false);
      session_start();
      $msg = '';
      if(isset($_GET['logout'])) 
      {
         unset($_SESSION);
         session_destroy();
         header('Location:  ' . $_SERVER['PHP_SELF']);
      }

      if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) 
      {
         if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin') 
         {
            $_SESSION['auth'] = 'OK' ;
            $_SESSION['valid'] = true;
            $_SESSION['username'] = 'admin';
         }
         else 
         {
              $msg = 'Wrong username or password';
         }
       }
   ?>
</div> 
<? include 'templates/header.html.php'; ?></pre>
<div class="content">
   <?php if($_SESSION['username'] == 'admin'):;?>
      
   <?php else: ?>
      <form class = "form-signin" role = "form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
         <input type = "text" class = "form-control" name = "username" placeholder = "username = admin" required autofocus><br>
         <input type = "password" class = "form-control" name = "password" placeholder = "password = admin" required><br>
         <button type = "submit" name = "login">Login</button>
      </form>
      <h4 class = "form-signin-msg"><?php echo $msg; ?></h4>
   <?php endif; ?>
</div>
<pre>
<? include 'templates/footer.html.php'; ?>