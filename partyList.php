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
            <ul class="list-unstyled text-center">
                    <li>
                        <h1>Welcome <br><small><?php echo $_SESSION['fn']; ?></small></h1>
                    </li>
                  <li><a href="CustomerDash.php">Bookings</a></li>
                  <li class="active"><a href="partylist.php">Party</a></li>
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
              <h1 class="text-center">Party List</h1>
              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th>image</th>
                          <th>type</th>
                          <th>desc.</th>
                          <th>cost</th>
                          <th>length</th>
                          <th>max att.</th>
                          <th>prod. n serv.</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      $partysel = $db->query('SELECT * FROM party ORDER BY partyid DESC');
                      while ($ps = $partysel->fetch()) {
                          echo '<tr>
                            <td><img src="images/'.$ps['partyImg'].'" alt="'.$ps['partytype'].'" class="img-128"/></td>
                            <td>'.$ps['partytype'].'</td>
                            <td>'.$ps['partyDesc'].'</td>
                            <td>£'.$ps['costperchild'].'</td>
                            <td>'.$ps['partylength'].'Min</td>
                            <td>'.$ps['nochildattend'].'</td>
                            <td>'.$ps['prodnservices'].'</td>
                          </tr>';
                      }
                       ?>

                  </tbody>
              </table>
          </div>
      </div>
  </body>
</html>
