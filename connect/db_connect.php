<?php

//connecting with database in php from sql we can use mysqli(improve) or pdo(php data object)
//using mysqli
$connect = mysqli_connect('localhost','Israel','nosaisrael21','ninja pizzas');

//chek for connection
if (!$connect){
    echo "connection error: mysql_connect_error()";
}


?>