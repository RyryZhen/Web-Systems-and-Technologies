<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            text-align : center;
            margin-top: 20px
        }

        table{
            margin: auto;
            border-collapse: collapse;
            width: 80%;
            max-width: 600px;
        }

        th, td{
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            width: 50px;
            height: 40px;
        }

        th{
            background-color: #f2f2f2;
        }

        .odd {
            background-color: yellow;
            font-weight: bold;
        }
        </style>
</head>
<body>

    <?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $rows = $_POST['rows'];
        $cols = $_POST['cols'];

        echo "<h1>Multiplication Table</h1>";
        echo "<h3>($rows x $cols)</h3>";

        echo "<table>";
        echo "<tr><th>X</th>";
        for($i = 1; $i<=$cols;$i++){
            echo "<th>$i</th>";
        }
        echo "</tr>";

        for($i = 1; $i<=$rows;$i++){
            echo "<tr>";
            echo "<th>$i</th>";
        

        for($j = 1;$j<=$cols;$j++){
            $value = $i * $j;

            if($value % 2 !=0){
                echo "<td class = 'odd'>$value</td>";
            }else{
                echo "<td>$value</td>";
            }
        }
        echo "</tr>";
}
        echo "</table>";
    }?>
        <form action="" method ="post">
            <br><br>
       <input type="number" name = "rows" placeholder="     Enter row size: "required><br><br><br>
       <input type="number" name = "cols" placeholder="     Enter column size: "required><br><br><br>
        <input type="submit" value="View Table">
    </form>
</body>
</html>