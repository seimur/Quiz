<?php include "db.php"; ?>
<?php session_start(); ?>
<?php

$number = (int)$_GET['num'];

$query = "SELECT * FROM questions";
$results = $mysqli->query($query) or die ($mysqli->error._LINE_);
$total = $results->num_rows;

$query = "SELECT * FROM questions 
          WHERE question_number = $number";

$result = $mysqli->query($query) or die ($mysqli->error._LINE_);

$question = $result->fetch_assoc();

$query = "SELECT * FROM choices 
          WHERE question_number = $number";

$choices = $mysqli->query($query) or die ($mysqli->error._LINE_);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>PHP Quizzer</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header>
            <div class="container">
                <h1>PHP Quizzer</h1>
            </div>
        </header>
        <main>
            <div class="container">
                <div class="current">Question <?php echo $question['question_number']; ?> of <?php echo $total;?></div>
                    <p class="question">
                        <?php echo $question['text'] ?>
                    </p>
                    <form method="post" action="process.php">
                        <ul class="choices">
                           <?php while($row = $choices->fetch_assoc()): ?>
                           <li><input name="choice" type="radio" value="<?php echo $row['id'] ?>"><?php echo $row['text'];?></li>
                           <?php endwhile; ?>
                        </ul>
                        <input type="submit" value="Submit">
                        <input type="hidden" name="number" value="<?php echo $number; ?>">
                    </form>
                </div>
        </main>
        <footer>
            <div class="container">
                Copyright &copy; 2017, PHP Quizzer
            </div>
        </footer>
    </body>
</html>