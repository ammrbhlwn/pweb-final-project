<?php
/* Confirmation Code */
function createRandomPassword()
{
    $chars = "0123456789";
    srand((float)microtime() * 1000000);
    $i = 0;
    $pass = '';
    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}
$r_id = createRandomPassword();
