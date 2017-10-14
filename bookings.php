<?php include 'session.php'; include 'connect.php';  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookings</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
      <aside>
          <ul class=" list-unstyled text-center">
              <li>
                  <h1>Welcome <br><small><?php echo $_SESSION['fn']; ?></small></h1>
              </li>
              <li><a href="party.php">Party</a></li>
              <li class="active"><a href="bookings.php">Bookings</a></li>
              <li><a href="logout.php">Logout</a></li>
          </ul>
      </aside>
      <p class="text-center">
          <?php $get = false;
          if (isset($_GET['opt'])) {
              if($_GET['opt'] === 'del')
              {
                  $del = $db->prepare('DELETE FROM booking WHERE bookingid = ?');
                  if($del->execute(array($_GET['id'])))
                  {
                      echo 'article deleted';
                  }
                  else {
                      echo 'delete error';
                  }
              }
              elseif ($_GET['opt'] === 'val') {

                  $act = $db->prepare('UPDATE booking SET bookstatus = "1" WHERE bookingid = ?');
                  $act->execute(array($_GET['id']));
              }elseif ($_GET['opt'] === 'decl') {

                  $act = $db->prepare('UPDATE booking SET bookstatus = "0" WHERE bookingid = ?');
                  $act->execute(array($_GET['id']));
              }
          } ?>
      </p>
      <div class="container-fluid">

          <div class="col-xs-10 col-xs-push-1">
              <h1 class="text-center">Customer Bookings Made</h1>
              <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>Number</th>
                          <th>Date</th>
                          <th>Type</th>
                          <th>full cost</th>
                          <th>Child</th>
                          <th>Status</th>
                          <th>Options</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      $partysel = $db->query('SELECT * FROM booking ORDER BY bookingid DESC');
                      while ($ps = $partysel->fetch()) {
                          $status = ($ps['bookstatus'] == '0') ? 'pending' : 'validated';
                          $opt = ($ps['bookstatus'] == '0') ? 'val' : 'decl';
                          $txt = ($ps['bookstatus'] == '0') ? 'accept' : 'decline';
                          echo '<tr>
                            <td>'.$ps['customername'].'</td>
                            <td>'.$ps['Number'].'</td>
                            <td>'.$ps['BookingDate'].'</td>
                            <td>'.$ps['PartyBooked'].'</td>
                            <td>£'.$ps['fullcost'].'</td>
                            <td>'.$ps['amount_perchild'].'</td>
                            <td>'.$status.'</td>
                            <td>
                                <p>
                                    <a href="bookings.php?opt='.$opt.'&id='.$ps['bookingid'].'">'.$txt.'</a>
                                </p>
                                <p>
                                    <a href="bookings.php?opt=del&id='.$ps['bookingid'].'">delete</a>
                                </p>
                            </td>
                          </tr>';
                      }
                       ?>

                  </tbody>
              </table>
          </div>
      </div>
  </body>
</html>
