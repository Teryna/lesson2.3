<?php
error_reporting(0); 
if (!file_exists(__DIR__ . '/tests/' . $_GET["name"] . '.json')) {
    header('HTTP/1.1 404 Not Found');
    exit;
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
    <link rel="stylesheet" href="css/style.css">  
</head>
<body>
<form method="post" action="">
    <input type="hidden" name="test" value="<?php echo $test; ?>">
<?php    
if (!empty($_GET["name"])) {
    $tests = json_decode(file_get_contents('./tests/' . $_GET["name"] . '.json'));
    foreach($tests->questions as $question) {
        echo '<h3>' . $question->question . '</h3>';
        foreach($question->answers as $key => $answer) {
            echo '<label><input type="radio" value="' . $key . '"name="' . $question->id . '">'. $answer . '</label>';
        }
    }
}
?>
    <p><input type="submit" value="Проверить ответы"></p>
</form>
<?php  
if ($_POST) {
    $count = 0;
    
    foreach($_POST as $number => $testAnswer) {
        foreach($tests->questions as $question) {
            if ($testAnswer === $question->correct && $number === $question->id) {
                $count++;             
            }
        }     
    }
    
    echo '<h3>Правильных ответов: ' . $count . '</h3>';
        
} 
    
 if ($count !== 0 ) {
    echo 'Вы прошли тест на ';
    if ($count === 2 ) {
        echo '100%';
    ?>
        <form method="post" action="certificate.php">
        <p>Введите Ваше ФИО</p>
        <input type="text" name="username" placeholder="Ваше имя" required>
        <input type="hidden" name="count" value="<?php echo $count; ?>">
        <p><input type="submit" value="Получить сертификат"></p>
        </form>    
    
    <?php
    }
    if ($count === 1 ){
        echo '50%';
    }
    } else {
        echo 'Вы не прошли тест!';
    }  
    ?>
<ul>
    <li><a href="admin.php">Загрузить новый тест</a></li>
    <li><a href="list.php">Перейти к списку тестов</a></li>
</ul>

</body>
</html>