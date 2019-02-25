<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="description" content="A lightweight webbased noteeditor">
    <meta name="keywords" content="Notes, Editor, Markdown, MIT-License">
    <meta name="author" content="Philip Mayer, 2018-2019">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/jquery-announce/jquery.announce.css">

    <script type="text/javascript" src="lib/jquery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="lib/jquery-announce/jquery.announce.min.js"></script>

    <script type="text/javascript" src="js/register.js"></script>


    <title>Sign up to Lpad</title>  
  </head>
  <body>
    <div class="container form-signin border mt-5 pl-5 pr-5">
      <h3 class="mb-3">Registration on Lpad</h3>
      <form>
        <div class="form-group">
          <label id="lblUsername" for="username">Username:</label> 
          <input id="username" type="text" class="form-control" name="username" required autofocus/>
        </div>
        <div class="form-group">
          <label id="lblUsername" for="username">E-Mail Address:</label> 
          <input id="email" type="email" class="form-control" name="username" required autofocus/>
        </div>
        <div class="form-group">
          <label id="lblPassword" for="password">Password:</label>
          <input id="password" type="password" class="form-control" name="password" required/>
        </div>
        <div class="form-group">
          <label id="lblPassword2" for="password2">Reapeat Password:</label>
          <input id="password2" type="password" class="form-control" name="password" required/>
        </div>
        <button id="btnRegister" class="btn btn-lg btn-success btn-block mb-4" type="submit" name="create">
          Create Account
        </button>
      </form>
    </div> 
  </body>
</html>
