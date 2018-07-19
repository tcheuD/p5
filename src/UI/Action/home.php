<?php
require __DIR__.'./../../../config/templateLoader.php';

function home(){
    $title = 'hello world !';
    require loadTemplate('index.php');
}