<?php

include_once 'gd.php';

if (filter_input(INPUT_GET, 'type') == 'proporcional') {
    proportional_image(filter_input(INPUT_GET, 'img-name'));
} else
if (filter_input(INPUT_GET, 'type') == 'cortar') {
    cut_image(filter_input(INPUT_GET, 'img-name'));
} else
if (filter_input(INPUT_GET, 'type') == 'estrechar') {
    narrow_image(filter_input(INPUT_GET, 'img-name'));
} else
if (filter_input(INPUT_GET, 'type') == 'text-img') {
    text_image(filter_input(INPUT_GET, 'img-name'));
}
