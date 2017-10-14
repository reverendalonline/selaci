<?php
if(isset($_POST['add']))
{
    $ptype = htmlspecialchars(trim($_POST['ptype']));
    $pdesc = htmlspecialchars(trim($_POST['pdesc']));
    $pma = htmlspecialchars(trim($_POST['pma']));
    $plen = htmlspecialchars(trim($_POST['plen']));
    $pns = htmlspecialchars(trim($_POST['pns']));
    $pcost = htmlspecialchars(trim($_POST['pcost']));
    $id = htmlspecialchars(trim($_POST['id']));
    $ok = true;

    if($plen < 0)
    {
        $ok = false;
        echo '<br />party length must be higher than 0';
    }
    if($pcost < 0)
    {
        $ok = false;
        echo '<br />party cost must be higher than 0';
    }
    if($pma < 0)
    {
        $ok = false;
        echo '<br />party max attendants must be higher than 0';
    }

    // Check if $uploadOk is set to 0 by an error
    if (!$ok) {
        echo '<br />Sorry, Data was not updated ';
    // if everything is ok, try to upload file
    } else {

        $up = $db->prepare('UPDATE party SET partytype = ?, partyDesc = ?, costperchild = ?, partylength = ?, nochildattend = ?, prodnservices = ? WHERE partyid = ?');
        if($up->execute(array($ptype,$pdesc,$pcost,$plen,$pma,$pns, $id)))
        {
            echo '<br />The party has been updated.';
        }
        else {
            echo '<br />Sorry, there was an error uploading your file.';
        }

    }
}
