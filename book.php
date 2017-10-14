<?php
if(isset($_POST['add']))
{
    $un = htmlspecialchars(trim($_POST['un']));
    $pt = htmlspecialchars(trim($_POST['pt']));
    $nb = htmlspecialchars(trim($_POST['nb']));
    $bc = htmlspecialchars(trim($_POST['bc']));
    $nc = htmlspecialchars(trim($_POST['nc']));
    $d = htmlspecialchars(trim($_POST['D']));
    $m = htmlspecialchars(trim($_POST['M']));
    $y = htmlspecialchars(trim($_POST['Y']));
    $ok = true;

    if(empty($nb))
    {
        $ok = false;
        echo '<br />enter a number please';
    }
    if($bc < 0)
    {
        $ok = false;
        echo '<br />budget must be higher than 0';
    }
    if($nc < 0)
    {
        $ok = false;
        echo '<br />number of child must be higher than 0';
    }
    if($d > 0 && $d <= 31)
    {
        if($m > 0 && $m <= 12)
        {
            if($y >= 2017)
            {
                $dob = $y . '-' . $m . '-' . $d;
            }
            else {
                $ok = false;
                echo '<br />wrong booking year';
            }
        }
        else {
            $ok = false;
            echo '<br />wrong booking month';
        }
    }
    else {
        $ok = false;
        echo '<br />wrong booking day';
    }
    // Check if $uploadOk is set to 0 by an error
    if (!$ok) {
        echo '<br />Sorry, booking not done resolve the error first ';
    // if everything is ok, try to upload file
    }
    else
    {
        $dob = $y . '-' . $m . '-' . $d;
        $verif = $db->prepare('SELECT * FROM booking WHERE PartyBooked = ? AND BookingDate = ?');
        $verif->execute(array($pt, $dob));
        $r = $verif->fetch();
        if(empty($r))
        {
            $fc = $nc * $bc;
            $ins = $db->prepare('INSERT INTO booking (customername, Number, BookingDate, PartyBooked, fullcost, amount_perchild, reg_date, bookstatus) VALUES (?,?,?,?,?,?,NOW(),"0")');
            $ins->execute(array($un, $nb, $dob, $pt, $fc, $nc));
            echo '<br />success: booking made we will contact you soon';
        }
        else
        {
            echo '<br />This party has been taken on this particular date select another date';
        }
    }
}
