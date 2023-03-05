<?php
include_once "./base5.php";
$vote=$Que->find(["id"=>$_POST['id']]);
$vote['count']=$vote['count']+1;
$id=$vote['parent'];
$Que->save($vote);
to("../index.php?do=que_result&id=$id");