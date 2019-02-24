<?php
    ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="description" content="A lightweight webbased noteeditor">
    <meta name="keywords" content="Notes, Editor, Markdown, MIT-License">
    <meta name="author" content="Philip Mayer, 2018-2019">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">

    <script type="text/javascript" src="lib/jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="lib/jquery-announce/jquery.announce.min.js"></script>
    <script type="text/javascript" src="lib/jquery.caret/jquery.caret.js"></script>
    <script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="lib/simpleMDE/simplemde.min.js"></script>

    <title>Lpad Login</title>  
  </head>
  <body>
    <div class="container form-signin border border-dark mt-5 pl-5 pr-5">
      <h2>Lpad Login</h2>
        <?php
            require('./php/config.php');
            require('./php/mysql.php');
            $msg = '';

            if(isset($_POST['login']) && !empty($_POST['username'])
               && !empty($_POST['password'])) {
                
                $db = new SqlCon($db_server, $db_user, $db_pw, $db_schema);

                if($db->hasConn()) {
                
                    if($db->isUserValid($_POST['username'], $_POST['password'])) {
                      $_SESSION['valid'] = true;
                      $_SESSION['timeout'] = time();
                      $_SESSION['username'] = $_POST['username'];
                      header('Location: index.php');
                      return;
                    }
                }                    
                $_SESSION['valid'] = false;
                $msg = 'Wrong username or password';
            }
        ?>
      <form class="form-signin" role="form" 
          action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <h4 class="form-signin-heading"><?php echo $msg; ?></h4>
        <input type="text" class="form-control" 
          name="username" required autofocus></br>
        <input type="password" class="form-control"
          name="password" required>
        <p></p>
        <button class="btn btn-lg btn-primary btn-block" type="submit" 
          name="login">Login</button>
        <p></p>
      </form>
    </div> 
  </body>
</html>
