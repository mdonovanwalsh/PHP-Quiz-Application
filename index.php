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
        <title>Choose a quiz</title>
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
            #title{
                font-size: 35px;
                font: sans-serif;
                font-weight: bold;
            }
            #pickQuiz{
                font: sans-serif;
            }
        </style>
    </head>
    <body>
        <p id="title">Quiz App</p>
<!--        form for user to choose which quiz they want to complete-->
        <form action="buildQuiz.php" method="POST">
            <label for ="pickQuiz">Select a quiz and press START to begin</label><br><br>
<!--            drop down to choose quiz-->
            <select name ="pickQuiz">
                <option value="NumberSystems.json">Number Systems</option>
                <option value="WorldGeography.json">World Geography</option>
            </select>
            <button type="submit" value="start" name="start">START</button>
        </form>
    </body>
</html>
