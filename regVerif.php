<?php
if(isset($_POST['reg']))
{
    $un = htmlspecialchars(trim($_POST['un']));
    $fn = htmlspecialchars(trim($_POST['fn']));
    $em = htmlspecialchars(trim($_POST['em']));
    $ad = htmlspecialchars(trim($_POST['ad']));
    $gen = htmlspecialchars(trim($_POST['gen']));
    $d = htmlspecialchars(trim($_POST['D']));
    $m = htmlspecialchars(trim($_POST['M']));
    $y = htmlspecialchars(trim($_POST['Y']));
    $psw = htmlspecialchars(trim($_POST['psw']));
    $ok = true;

    if($d > 0 && $d <= 31)
    {
        if($m > 0 && $m <= 12)
        {
            if($y > 1917 && $y <= 2017)
            {
                $dob = $y . '-' . $m . '-' . $d;
            }
            else {
                $ok = false;
                echo '<br />wrong birth year';
            }
        }
        else {
            $ok = false;
            echo '<br />wrong birth month';
        }
    }
    else {
        $ok = false;
        echo '<br />wrong birth day';
    }

    $existU = $db->prepare('SELECT COUNT(*) as U FROM customer WHERE username = ?');
    $existU->execute(array($un));
    $x = $existU->fetch();
    if($x['U'] > 0)
    {
        echo '<br />username already exist';
        $ok = false;
    }
    if(empty($gen))
    {
        echo '<br />wrong gender';
        $ok = false;
    }

    if($ok)
    {
        $check = $db->query('SELECT COUNT(*) AS c FROM customer');
        $c = $check->fetch();
        $today = getdate();
        $Year = $today['year'];
        $age = $Year - $y;
        $dob = $y . '-' . $m . '-' . $d;
        if($c['c'] > 0)
        {
            $accessLvl = 'user';
            $c = $db->prepare('INSERT INTO customer (customername, address, childDateOfBirth, childage, childgender, email, reg_date, username, password, Accesslevel) VALUES (?,?,?,?,?,?,NOW(),?,?,?)');
            $c->execute(array($fn, $ad, $dob, $age, $gen, $em,$un, $psw, $accessLvl));
            echo '<br />registed: to go to the login page <a href="./">click here</a>';
        }
        else
        {
            $accessLvl = 'Admin';
            $c = $db->prepare('INSERT INTO customer (customername, address, childDateOfBirth, childage, childgender, email, reg_date, username, password, Accesslevel) VALUES (?,?,?,?,?,?,NOW(),?,?,?)');
            $c->execute(array($fn, $ad, $dob, $age, $gen, $em,$un, $psw, $accessLvl));
            echo '<br />registed: to go to the login page <a href="./">click here</a>';
        }
    }

}
