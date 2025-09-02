<?php
if(isset($_GET['num'])){
    $result = (int)($_GET['num']);
}else{
    echo "Enter Number 1 to 7";
}
switch ($result){
        case 1:
        echo "Monday";
        break;
        case 2:
        echo "Tuesday";
        break;
        case 3:
        echo "Wednesday";
        break;
        case 4:
        echo "Thursday";
        break;
        case 5:
        echo "Friday";
        break;
        case 6:
        echo "Saturday";
        break;
        case 7:
        echo "Sunday";
        break;
        default:
        echo "Something is wrong with your input!";
}
?>