<?php
if (!isset($_SESSION['question'])) {
    $num1 = rand(1, 10 * $_SESSION['level']);
    $num2 = rand(1, 10 * $_SESSION['level']);
    
    $operations = ['+', '-', '*', '/', '**'];
    $operation = $operations[array_rand($operations)];

    switch ($operation) {
        case '+':
            $correctAnswer = $num1 + $num2;
            break;
        case '-':
            $correctAnswer = $num1 - $num2;
            break;
        case '*':
            $correctAnswer = $num1 * $num2;
            break;
        case '/':
            $num2 = ($num2 == 0) ? 1 : $num2;
            $correctAnswer = round($num1 / $num2, 2);
            break;
        case '**':
            $num2 = rand(1, 2); 
            $correctAnswer = pow($num1, $num2);
            break;
    }

    $_SESSION['correct_answer'] = $correctAnswer;
    $_SESSION['question'] = "$num1 $operation $num2";
}
?>
