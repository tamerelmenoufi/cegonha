<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST))
$_POST = json_decode(file_get_contents('php://input'), true);

file_put_contents('x.txt',var_dump($_POST));