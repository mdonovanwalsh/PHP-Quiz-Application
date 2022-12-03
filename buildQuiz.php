<?php
//start session
session_start();
include 'ChromePhp.php';
include 'FileUtils.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Choose your quiz</title>
        <style> 
            body {
                text-align: center;
            }
        </style>        
    </head>
    <body>

        <?php
        //post method to select quiz from form
        $quizOptions = ($_POST["pickQuiz"]);
        //convert array file into a string array
        $fileContents = readFileIntoString($quizOptions);
        //load the quiz file user chooses
        $theQuiz = json_decode($fileContents, true);

        //declare session variables
        $_SESSION["theQuiz"] = $theQuiz;
        $_SESSION["currentQuestionNumber"] = 0;
        $_SESSION["userAnswers"] = array();
        $_SESSION["quizLength"] = (count($theQuiz["questions"]) - 1);
        
        //loop through the quiz questions and push usersAnswers into an array
        for ($i = 0; $i < count($theQuiz["questions"]); $i++) {
            array_push($_SESSION["userAnswers"], -1);
        }
        
        //go to display questions page
        header("location: displayQuestions.php");
        exit();
        ?>

    </body>
</html>

