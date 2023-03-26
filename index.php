<?php

   require_once("scripts/connect_db.php");

        if(isset($_POST['first_name']) && isset($_POST['middle_name']) && isset($_POST['last_name'])){
            
            $fname = $_POST['first_name'];
            $mname = $_POST['middle_name'];
            $lname = $_POST['last_name'];

            $query = mysql_query("SELECT * FROM exam_user WHERE first_name='$fname' && middle_name='$mname' && last_name='$lname'");
            if(mysql_num_rows($query) > 0 ) { //check if there is already an entry for that username
                echo ("<script>alert('Your full name already exists!')</script>");
            }else{
                mysql_query("INSERT INTO exam_user (first_name, middle_name, last_name) VALUES ('$fname', '$mname', '$lname')");
               

                session_start();
                  $_SESSION['first_name']=$fname;
                      $_SESSION['last_name']=$lname;
                       header("location:instruction.php");
            }

    }
    mysql_close();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>HOME || Examination System</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<style>
        #header{
             background-color: #23bd19;
             width: 100%;
             height: 160px;
             margin-bottom: 40px;
    }
    body{
        background-image: url("img/index.jpg");
        margin: auto;
        background-size: cover;
        background-attachment: fixed;
        }
    #form_wrap{
        border-radius: 30px;
        border: none;
        background-color: white;
        width: 500px;
        height: 400px;
        margin-right: 300px;
        margin-left: 400px;
        margin-top: 50px;
        margin:auto;
    }
    .form-control{
        width: 80%;
        font-size: 18px;
        border-radius: 8px;
    }
    label{  
        font-style: Times New Roman;
        font-size: 18px;
    }
    #contents{
        margin:auto;
    }

</style>
</head>
<body>

<div id="contents">
    <div id="header">
        <center> <img src="img/header.png" width="1350px" height="160px" /></center>
    </div>

    <div id="form_wrap">

<br>
<br>
<br>
        <form method="POST">
        <fieldset>
       <center>
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name" required placeholder="Enter first name">
            
            <br>
            
            <label for="middle_name">Middle Name</label>
            <input type="text" class="form-control" name="middle_name" required  placeholder="Enter middle name">
            
            <br>

            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" required placeholder="Enter last name">

            <br>

            <input class="btn btn-primary btn-lg" type="submit" required value="Register" name="reg">
        </center>
        </fieldset>
        </form>
    </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>