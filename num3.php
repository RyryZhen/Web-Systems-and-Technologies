<?php
if(isset($_GET['num'])){
    $result = (int)($_GET['num']);
}else{
    echo "Enter a number";
}


if($result % 2 != 0){
    echo "$result is Odd";
}elseif($result % 2 == 0){
     echo "$result is Even";
}else{
    echo "Something is wrong with your input!";
}
?>