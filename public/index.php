<?php
session_start();

if (!isset($_SESSION['level'])) {
    $_SESSION['level'] = 1;
    $_SESSION['question'] = null; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['answer'])) {
    $userAnswer = $_POST['answer'];
    $correctAnswer = $_SESSION['correct_answer'] ?? null;

    if ($userAnswer == $correctAnswer) {
        $_SESSION['level']++; 
        $_SESSION['question'] = null;
        $errorMessage = null;
    }else{
        $errorMessage = '<h3 style="color:red">Javob noto\'g\'ri</h3>';
    }
}

if ($_SESSION['level'] <= 5) {
    include 'questions.php';
} else {
    $successMessage = "<h2 style='color: green'>Tabriklaymiz! Siz barcha bosqichlarni bajardingiz 🎉</h2>";
    $successMessage .= '<a href="reset.php" style="display: inline-block; padding: 10px; background: #28a745; color: white; text-decoration: none; border-radius: 5px; margin-top: 10px;">Qaytadan boshlash</a>';
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matematika Testi</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <?php 
    if (!empty($successMessage)) {
        echo $successMessage;
    } else { ?>
        <h2><?= $_SESSION['level'] ?>-bosqich</h2>
        
        <form method="POST">
            <p><strong><?= $_SESSION['question'] ?> = ?</strong></p>
            <input type="text" name="answer" required>
            <button type="submit">Tekshirish</button>
        </form>
        <?php
        if(!empty($errorMessage)){
            echo $errorMessage;
        }
         ?>
        <?php } ?>
</div>
</body>
</html>

