<?php

class Singleton {

}

$s1 = new Singleton();
$s2 = new Singleton();

if ($s1 == $s2) {
    echo '1';
} else {
    echo '0';
}
