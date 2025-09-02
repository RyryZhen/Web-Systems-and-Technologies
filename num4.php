<?php
if(isset($_GET['year'])){
    $result = (int)($_GET['year']);
}else{
    echo "Enter Year";
}
if($result % 400 == 0 || $result % 4 == 0 && $result % 100 != 0){
    echo "$result is a Leap Year";
}else{
   echo "$result is not a Leap Year";
}
?>