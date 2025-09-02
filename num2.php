<?php
if(isset($_GET['score'])){
    $result = ($_GET['score']);
}else{
    echo "Enter a score ";
}

switch ($result){
    case ($result>=90 && $result<=100):
        echo "Grade: A";
        break;
    case ($result>=80 && $result<=90):
        echo "Grade: B";
        break;
    case ($result>=70 && $result<=80):
        echo "Grade: C";
        break;
    case ($result>=60 && $result<=70):
        echo "Grade: D";
        break;
    case ($result<60 && $result>=0):
        echo "Grade: F";
        break;
    default:
        echo "Invalid Grade!";
}
?>