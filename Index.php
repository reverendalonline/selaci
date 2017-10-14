<?php include 'session.php'; include 'connect.php';
if(isset($_SESSION['id']))
{
    if ($_SESSION['id'] > 1) {
        header('location: CustomerDash.php');
    }
    else {
        header('location: party.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogIn</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

      <form class="logForm" action="./" method="post">
          <div class="jumbotron">
              <h1 class="text-center">Login</h1>
          </div>
          <?php include 'loginVerif.php'; ?>
          <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                      <label for="">Username</label>
                      <input type="text" class="form-control" id="" placeholder="" required name="username">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="password" class="form-control" id="" placeholder="" required name="password">
                    </div>
                </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="form-control btn btn-primary" id="" placeholder=""  name="login">Login</button>
          </div>
          <p class="text-center"><a href="Register.php">Become a member</a></p>
      </form>
  </body>
</html>
