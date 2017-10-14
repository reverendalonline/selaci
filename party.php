<?php include 'session.php'; include 'connect.php';  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
      <aside>
          <ul class=" list-unstyled text-center">
              <li>
                  <h1>Welcome <br><small><?php echo $_SESSION['fn']; ?></small></h1>
              </li>
              <li class="active"><a href="party.php">Party</a></li>
              <li><a href="bookings.php">Bookings</a></li>
              <li><a href="logout.php">Logout</a></li>
          </ul>
      </aside>
      <p class="text-center">
          <?php $get = false;
          if (isset($_GET['opt'])) {
              if($_GET['opt'] === 'del')
              {
                  $del = $db->prepare('DELETE FROM party WHERE partyid = ?');
                  if($del->execute(array($_GET['id'])))
                  {
                      echo 'article deleted';
                  }
                  else {
                      echo 'delete error';
                  }
              }
              elseif ($_GET['opt'] === 'edit') {

                  $act = $db->prepare('SELECT * FROM party WHERE partyid = ?');
                  $act->execute(array($_GET['id']));
                  if($a = $act->fetch())
                  {
                     $get = true;
                  }
              }
          } ?>
      </p>
      <div class="container-fluid">
          <div class="col-xs-6 col-xs-push-3">
              <div class="box">
                  <?php include ($get) ? 'update.php' : 'addparty.php';
                  ?>
                  <h1 class="text-center">Add new Party</h1>
                  <form class="" action="party.php<?php echo ($get) ? '?opt=edit&id='.$a['partyid'] : '' ; ?>" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="<?php echo ($get) ? $a['partyid'] : '' ; ?>">

                      <div class="form-group">
                        <label for="">Party Type</label>
                        <input required type="text" class="form-control" id="" value="<?php echo ($get) ? $a['partytype'] : '' ; ?>" name="ptype">
                      </div>
                      <div class="form-group">
                        <label for="">Party Description</label>
                        <input required type="text" class="form-control" id="" value="<?php echo ($get) ? $a['partyDesc'] : '' ; ?>" name="pdesc">
                      </div>
                      <div class="form-group">
                        <label for="">Party Cost</label>
                        <input required type="number" class="form-control" id="" value="<?php echo ($get) ? $a['costperchild'] : '' ; ?>" name="pcost">
                      </div>
                      <div class="form-group">
                        <label for="">Party Length</label>
                        <input required type="number" class="form-control" id="" value="<?php echo ($get) ? $a['partylength'] : '' ; ?>" name="plen">
                      </div>
                      <div class="form-group">
                        <label for="">Party Max attendants</label>
                        <input required type="number" class="form-control" id="" value="<?php echo ($get) ? $a['nochildattend'] : '' ; ?>" name="pma">
                      </div>
                      <div class="form-group">
                        <label for="">Products and services</label>
                        <input required type="text" class="form-control" id="" value="<?php echo ($get) ? $a['prodnservices'] : '' ; ?>" name="pns">
                      </div>
                      <?php if(!$get)
                      { ?>
                          <div class="form-group">
                            <label for="">Party Image</label>
                            <input required type="file" class="form-control" id="" name="img">
                          </div>
                     <?php } ?>

                      <div class="form-group">
                        <button type="submit" class="btn btn-success form-control"  value="<?php echo ($get) ? 'Upload Party' : 'Add Party' ; ?>" id="" placeholder="" name="add">Add</button>
                      </div>
                  </form>
              </div>
          </div>
          <div class="row">
              <div class="col-xs-12">
                  <div class="box">
                      <h1 class="text-center">Party added</h1>
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>image</th>
                                  <th>type</th>
                                  <th>desc.</th>
                                  <th>cost</th>
                                  <th>length</th>
                                  <th>max att.</th>
                                  <th>prod. n serv.</th>
                                  <th>option</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              $partysel = $db->query('SELECT * FROM party ORDER BY partyid DESC');
                              while ($ps = $partysel->fetch()) {
                                  echo '<tr>
                                    <td class="text-center"><img src="images/'.$ps['partyImg'].'" alt="'.$ps['partytype'].'" class="img-32"/></td>
                                    <td class="text-center">'.$ps['partytype'].'</td>
                                    <td class="text-center">'.$ps['partyDesc'].'</td>
                                    <td class="text-center">£'.$ps['costperchild'].'</td>
                                    <td class="text-center">'.$ps['partylength'].'Min</td>
                                    <td class="text-center">'.$ps['nochildattend'].'</td>
                                    <td class="text-center">'.$ps['prodnservices'].'</td>
                                    <td class="text-center">
                                        <p>
                                            <a href="party.php?opt=edit&id='.$ps['partyid'].'">edit</a>
                                        </p>
                                        <p>
                                            <a href="party.php?opt=del&id='.$ps['partyid'].'">delete</a>
                                        </p>
                                    </td>
                                  </tr>';
                              }
                               ?>

                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>

  </body>
</html>
