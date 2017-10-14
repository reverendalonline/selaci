<?php
if(isset($_POST['add']))
{
    $ptype = htmlspecialchars(trim($_POST['ptype']));
    $pdesc = htmlspecialchars(trim($_POST['pdesc']));
    $pma = htmlspecialchars(trim($_POST['pma']));
    $plen = htmlspecialchars(trim($_POST['plen']));
    $pns = htmlspecialchars(trim($_POST['pns']));
    $pcost = htmlspecialchars(trim($_POST['pcost']));
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
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    $check = getimagesize($_FILES["img"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $ok = true;
    } else {
        echo '<br />File is not an image.';
        $ok = false;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo '<br />Sorry, file already exists.';
        $ok = false;
    }
    // Check file size
    if ($_FILES["img"]["size"] > 4194304) {
        echo '<br />Sorry, your file is too large.';
        $ok = false;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo '<br />Sorry, only JPG, JPEG and PNG img are allowed.';
        $ok = false;
    }
    // Check if $uploadOk is set to 0 by an error
    if (!$ok) {
        echo '<br />Sorry, Data was not uploaded your file has a problem ';
    // if everything is ok, try to upload file
    } else {
        $view = $db->query('SELECT MAX(partyid) AS mx FROM party');
        $v = $view->fetch();
        $max = ($v['mx'] > 0) ? ++$v['mx'] : 1;
        $imgnewname = 'party-img-(' . $max . ').' . $imageFileType;
        $target_file = $target_dir . $imgnewname;
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                $up = $db->prepare('INSERT INTO party(partytype, partyDesc, costperchild, partylength, nochildattend, prodnservices, reg_date, partyImg)
                VALUES (?,?,?,?,?,?,NOW(),?)');
                if($up->execute(array($ptype,$pdesc,$pcost,$plen,$pma,$pns, $imgnewname)))
                {
                    echo '<br />The file ' . $imgnewname. ' has been uploaded.';
                    echo '<br />The party has been added.';
                }
                else {
                    echo '<br />Sorry, there was an error uploading your file.';
                }

            } else {
                echo '<br />Sorry, there was an error uploading your file.';
            }
        }
}
