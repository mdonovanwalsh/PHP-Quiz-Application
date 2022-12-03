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
        <title>Results</title>
        <style>
            #results{
                font-size: 30px;
                font: sans-serif;
                font-weight: bold;
            }
            #questionNum{
                font-size: 20px;
                font: sans-serif;
                font-weight: bold;
            }
            #qu{
                font-size: 15px;
                font: sans-serif;
            }
            #score{
                margin-top: 10px;
                border: solid black;
                padding: 10px;
                font-size: 20px;
            }
        </style>
    </head>
    <body>
        <?php
        //get session stored variables
        $theQuiz = $_SESSION["theQuiz"];
        $currentQuestionNumber = $_SESSION["currentQuestionNumber"];
        $userAnswers = $_SESSION["userAnswers"];
        
        //set counter variable to 0
        $counter = 0;
        
        $output = "";
        $output .= "<p id='results'>Results</p>";
        $output .= "<p>(Correct answers shown in green)</p>";
        
        //variable to hold questions array
        $quizQuestions = $theQuiz['questions'];

        //loop through the quiz questions
        for ($i = 0; $i < count($quizQuestions); $i++) {
            //add 1 to question number each time you loop through
            $questionNumber = $i + 1;
            //display question number
            $output .= "<p id='questionNum'>Question " . $questionNumber . "</p>";
            //display question text
            $output .= "<p id='qu'>" . $quizQuestions[$i]["questionText"] . "</p>";
            //get answer index for question i
            $answerIndex = $quizQuestions[$i]["answer"];
            //get answer for index i
            $answerBank = $quizQuestions[$i]["choices"][$answerIndex];
            $answerCount = $_SESSION["userAnswers"][$i];

            //check if user answered all questions
            if ($_SESSION["userAnswers"][$i] == -1) {
                //go to error page if all questions aren't answered
                header('location:errorPage.php');
            }
            if ($_SESSION["userAnswers"][$i] == $answerIndex) {
                $counter++;
            }

            //loop through the choices for a quiz question
            for ($n = 0; $n < count($quizQuestions[$i]["choices"]); $n++) {
                //if your answer == correct answer 
                $value = $quizQuestions[$i]["choices"][$n];
                //if radio button value == user selected radio button
                if ($value == $quizQuestions[$i]["choices"][$answerCount]) {
                    //if answer selected is correct, change font to green
                    if ($answerBank == $quizQuestions[$i]["choices"][$answerCount]) {
                        $output .= "<input checked type='radio' name='$questionNumber' value='$value' " . "id = '$value'> 
                    <label for '$value'><font color='green'>" . $quizQuestions[$i]["choices"][$n] . "</font></label><br>";
                        //if answer selected is not correct, change font to red
                    } else if ($answerBank != $quizQuestions[$i]["choices"][$answerCount]) {
                        $output .= "<input checked type='radio' name='$questionNumber' value='$value' " . "id = '$value'> 
                    <label for '$value'><font color='red'>" . $quizQuestions[$i]["choices"][$n] . "</font></label><br>";
                        //else leave the font black
                    } else {
                        $output .= "<input checked type='radio' name='$questionNumber' value='$value' " . "id = '$value'> 
                    <label for '$value'>" . $quizQuestions[$i]["choices"][$n] . "</label><br>";
                    }
                    //if the radio button is equal to the answer, change font green
                } else if ($value == $answerBank) {
                    $output .= "<input type='radio' name='$questionNumber' value='$value' " . "id = '$value'> 
                    <label for '$value'><font color='green'>" . $quizQuestions[$i]["choices"][$n] . "</font></label><br>";
                    //else leave the font black
                } else {
                    $output .= "<input type='radio' name='$questionNumber' value='$value' " . "id = '$value'> 
                    <label for '$value'>" . $quizQuestions[$i]["choices"][$n] . "</label><br>";
                }
            }
        }
        echo $output;
        echo "<div id='score'>Score: " . $counter . "/" . count($quizQuestions) . "</div>";
        ?>
    </body>
</html>
