<?php

$array = array("uno", "dos", "tres");

foreach ($array as $key => $value) {
    print $key . ' - ' . $value . '<br>';
}

print '<br>';

foreach (array(1, 2, 3, 4) as $value) {
    print $value . '<br>';
}
