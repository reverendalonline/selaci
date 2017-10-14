<?php include 'session.php'; include 'connect.php';
if($_SESSION['id'] <= 1)
{
    header('location: ./');
}

$us = $db->prepare('SELECT * FROM customer WHERE customerid = ?');
$us->execute(array($_SESSION['id']));
$u = $us->fetch();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="jquery.min.js"></script>
  </head>
  <body>
      <aside>
            <ul class="list-unstyled text-center">
                <li>
                    <h1>Welcome <br><small><?php echo $_SESSION['fn']; ?></small></h1>
                </li>
                  <li class="active"><a href="CustomerDash.php">Bookings</a></li>
                  <li><a href="partylist.php">Party</a></li>
                  <li><a href="logout.php">Logout</a></li>
            </ul>
      </aside>
      <div class="container-fluid">
          <div class="col-xs-4">
              <?php include 'book.php'; ?>
              <h1 class="text-center">Book a party</h1>
              <form class="" action="CustomerDash.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="un" value="<?php echo $u['customername']; ?>">
                  <div class="form-group">
                    <label for="">Party Type</label>
                    <select class="form-control" name="pt" required="">
                        <?php $ptype = $db->query('SELECT partytype FROM party ORDER by partytype');
                        while ($pt = $ptype->fetch()) {
                           echo '<option value="'.$pt['partytype'].'">'.$pt['partytype'].'</option>';
                        } ?>
                    </select>
                  </div>
                  <div class="form-group">
                      <label for="">Your Phone Number</label>
                      <input type="number" class="form-control" id="" name="nb" placeholder="" required="">
                  </div>
                  <div class="form-group">
                      <label for="">Amount per child</label>
                      <input type="number" class="form-control" id="" name="bc" placeholder="" required="">
                  </div>
                  <div class="form-group">
                      <label for="">Number of Children</label>
                      <input type="number" class="form-control" id="" name="nc" placeholder="" required="">
                  </div>
                  <div class="form-group">
                      <div class="row">
                          <div class="col-xs-4">
                              <div class="form-group">
                                <label for=""> Day</label>
                                <input type="number" class="form-control" id="" placeholder="" required="" name="D">
                              </div>
                          </div>
                          <div class="col-xs-4">
                              <div class="form-group">
                                <label for=""> Month</label>
                                <input type="number" class="form-control" id="" placeholder="" required="" name="M">
                              </div>
                          </div>
                          <div class="col-xs-4">
                              <div class="form-group">
                                <label for=""> Year</label>
                                <input type="number" class="form-control" id="" placeholder="" required="" name="Y">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-success form-control" placeholder="" name="add">
                  </div>
              </form>
          </div>
          <div class="col-xs-8">
              <h1 class="text-center">Booking Calendar</h1>
              <?php include_once('functions.php'); ?>
              <div id="calendar_div">
             	<?php echo getCalender(); ?>
             </div>
          </div>
      </div>
  </body>
</html>
