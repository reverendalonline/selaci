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
    <title>Register</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
      <form class="logForm" action="./register.php" method="post">
          <div class="jumbotron">
              <h1 class="text-center">Register</h1>
          </div>
          <?php include 'regVerif.php'; ?>
          <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                      <label for="">Username</label>
                      <input type="text" class="form-control" id="" placeholder="" required name="un">
                    </div>
                </div>
                <div class="col-xs-6">

                    <div class="form-group">
                      <label for="">Full name</label>
                      <input type="text" class="form-control" id="" placeholder="" required name="fn">
                    </div>
                </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                      <label for="">address</label>
                      <input type="text" class="form-control" id="" placeholder="" required name="ad">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                      <label for="">email</label>
                      <input type="email" class="form-control" id="" placeholder="" required name="em">
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
              <div class="col-xs-4">
                  <div class="form-group">
                    <label for="">Day</label>
                    <input type="number" class="form-control" id="" placeholder="" required name="D">
                  </div>
              </div>
              <div class="col-xs-4">
                  <div class="form-group">
                    <label for="">Month</label>
                    <input type="number" class="form-control" id="" placeholder="" required name="M">
                  </div>
              </div>
              <div class="col-xs-4">
                  <div class="form-group">
                    <label for="">Year</label>
                    <input type="number" class="form-control" id="" placeholder="" required name="Y">
                  </div>
              </div>
          </div>

          <div class="form-group">

            <label for="">Gender</label>
            <select name="gen" class="form-control">
                <option>Choose Gender</option>
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">password</label>
            <input type="password" class="form-control" id="" placeholder="" required name="psw">
          </div>
          <div class="form-group">
            <button type="submit" class="form-control btn btn-primary" id="" placeholder=""  name="reg" value="Register">Signup</button>
          </div>
          <p class="text-center"><a href="./" >Signin</a></p>
      </form>
  </body>
</html>
