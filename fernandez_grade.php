<?php

$name = isset($_GET['name']) ? $_GET['name'] : "Unknown Student";
$score = isset($_GET['score']) ? (int)$_GET['score'] : 0;

if ($score > 100 || $score < 0) {
    $grade = "Invalid";
    $remark = "Score must be between 0 and 100.";
} elseif ($score >= 95 && $score <= 100) {
    $grade = "Excellent (A)";
    $remark = "Outstanding Performance!";
} elseif ($score >= 90 && $score < 95) {
    $grade = "Very Good (B)";
    $remark = "Great Job!";
} elseif ($score >= 85 && $score < 90) {
    $grade = "Good (C)";
    $remark = "Good effort, keep it up!";
} elseif ($score >= 75 && $score < 85) {
    $grade = "Needs Improvement (D)";
    $remark = "Work harder next time.";
} else {
    $grade = "Failed (F)";
    $remark = "You need to improve.";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grade Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            width: 400px;
            text-align: center;
        }
        h1 {
            color: #2575fc;
            margin-bottom: 10px;
        }
        .result {
            margin-top: 15px;
            font-size: 18px;
            line-height: 1.6;
        }
        .highlight {
            font-weight: bold;
            color: #6a11cb;
        }
        .remark {
            margin-top: 20px;
            font-size: 20px;
            font-style: italic;
            color: #2575fc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Student Grade Result</h1>
        <div class="result">
            <p><span class="highlight">Name:</span> <?php echo htmlspecialchars($name); ?></p>
            <p><span class="highlight">Score:</span> <?php echo $score; ?></p>
            <p><span class="highlight">Grade:</span> <?php echo $grade; ?></p>
        </div>
        <p class="remark"><?php echo $remark; ?></p>
    </div>
</body>
</html>
