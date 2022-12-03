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
        <title></title>
        <style>
            button{
                align-items: center;
                align-content: center;
                font-size: 15px;
                padding: 5px;
                margin: 5px;
                border: none;
                display: inline-block;
            }
            #titleQuiz{
                font-size: 30px;
                font: sans-serif;
                font-weight: bold;
            }
            #questionNum{
                font-size: 28px;
                font: sans-serif;
            }
            #qu{
                font-size: 20px;
                font: sans-serif;
            }
        </style>
    </head>
    <body>
        <!--        create form-->
        <form action="displayQuestions.php" method="POST">
            <ul>
                <?php
                //get the session variables/data
                $theQuiz = $_SESSION["theQuiz"];
                $currentQuestionNumber = $_SESSION["currentQuestionNumber"];
                $userAnswers = $_SESSION["userAnswers"];

                $title = $theQuiz["title"];
                $output = "";

                
                if (isset($_POST["Q" . $_SESSION["currentQuestionNumber"]])) {
                    $_SESSION["userAnswers"][$_SESSION["currentQuestionNumber"]] = $_POST[("Q" . $_SESSION["currentQuestionNumber"])];
                }

                //increment current question number by 1 when next is selected
                if (isset($_POST["next"])) {
                    $_SESSION["currentQuestionNumber"]++;
                }
                //decrement current question number by 1 when previous is selected
                if (isset($_POST["previous"])) {
                    $_SESSION["currentQuestionNumber"]--;
                }
                //when done is pressed, go to results page
                if (isset($_POST["done"])) {
                    header("location: results.php");
                }

                //output title of quiz
                $output .= "<p id='titleQuiz'> " . $title . " Quiz </p>";

                //variable for questions array
                $quizQuestions = $theQuiz['questions'];

                //
                $questionNumber = $_SESSION["currentQuestionNumber"] + 1;
                
                //display current question number and the question 
                $output .= "<p id='questionNum'>Question " . $questionNumber . "</p>";
                $output .= "<p id='qu'>" . $quizQuestions[$_SESSION["currentQuestionNumber"]]["questionText"] . "</p>";

                //loop through question # the user is on and dislay choices
                for ($n = 0; $n < count($quizQuestions[$_SESSION["currentQuestionNumber"]]["choices"]); $n++) {
                    
                    //radio button value
                    $value = $quizQuestions[$_SESSION["currentQuestionNumber"]]["choices"][$n];

                    //display choices to each question as radio buttons from choices array
                    $output .= "<input type='radio' name='Q" . $_SESSION["currentQuestionNumber"] . "'value='$n' id='$value'" . 
                            (($_SESSION["userAnswers"][$_SESSION["currentQuestionNumber"]] == $n) ?
                            "checked" : "") . "><label for='$value'>" .
                            $quizQuestions[$_SESSION["currentQuestionNumber"]]["choices"][$n] . "</label><br>";
                }

                $output .= "</ul><br>";
                
                //previous button
                $output .= "<button type='submit' name = 'previous' id = 'previous' value = 'previous'" .
                        (($_SESSION["currentQuestionNumber"] == 0 ) ? "disabled" : "") . ">Previous</button>";
                //next button
                $output .= "<button type='submit' name='next' id='next' value='next'" .
                        (($_SESSION["currentQuestionNumber"] == $_SESSION["quizLength"]) ? "disabled" : "") .
                        ">Next</button>";
                //done button
                $output .= "<button type='submit' name='done' id='done' value='done'" .
                        (($_SESSION["currentQuestionNumber"] == $_SESSION["quizLength"]) ? "" : "disabled") .
                        ">Done</button>";
                //close form
                $output .= "</form>";
                //display output
                echo $output;
                ?>
            </ul>
        </form>
    </body>
</html>

