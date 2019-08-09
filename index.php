<?php
require_once ('SQLDirector.php');
$director = new SQLDirector('kek');

$fields = array('qwerty' => '12', 'qweqwe' => '123123');

echo $query = $director->selectAll() .'<br/>';
echo $query = $director->insert($fields) .'<br/>';
echo $query = $director->updateById($fields, "12") .'<br/>';
echo $query = $director->deleteById("12") .'<br/>';
