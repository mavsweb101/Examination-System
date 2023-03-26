<?php

    if(isset($_POST["total_ques"]) && isset($_POST["rollno"]) && isset($_POST["quizID"]))
    {
        if($_POST["total_ques"] != "" && $_POST["rollno"] != "" && $_POST["quizID"] != "")
        {
            require_once("scripts/connect_db.php");

         //initializing the variables
            $marks = 0;
            $total_questions = $_POST["total_ques"];
            $roll_no = $_POST["rollno"];
            $quiz_ID = $_POST["quizID"];

            if($total_questions>0){

	         //calculating percentage
	            for($i=1 ; $i <= $total_questions ; $i++){
	                @$fetch_ID = "rads".$i;
	                @$php_id = $_POST[$fetch_ID];

	                $check_sql = mysql_query("SELECT correct FROM answers 
	                                            WHERE id='$php_id'") or die(mysql_error());
	                $q_answer = mysql_fetch_array($check_sql);
	                $marks += $q_answer[0];
	            }
	            $percent = ($marks/$total_questions)*100;

	         //getting total time taken by the user to complete the quiz
	            $get_time_query = mysql_query("SELECT now() - date_time FROM quiz_takers 
	                                            WHERE username = '$roll_no' ") or die(mysql_error());
	            $get_time = mysql_fetch_array($get_time_query);
	            $time_taken = $get_time[0];

	            $check_time_query = mysql_query("SELECT duration FROM quiz_takers 
	                                            WHERE username = '$roll_no' 
	                                            AND quiz_id = '$quiz_ID' ") or die(mysql_error());
	            $check_time = mysql_fetch_array($check_time_query);
	            $duration = $check_time[0];

	            if($duration==0){
		        
                 //updating the percentage and time taken by the user in the DB
	            	mysql_query("UPDATE quiz_takers 
	                	         SET marks='$marks', percentage= '$percent', duration= '$time_taken', quiz_id= '$quiz_ID'
	                    	     WHERE username = '$roll_no' ")or die(mysql_error());
	            }else{
                    
	            	$user_msg = 'Sorry, but re-submission of the examination answers is not allowed!';
                    
                    header('location: index.php?user_msg='.$user_msg.'');
	            }
	        }else{
	        	$user_msg = 'It seems the exam had no questions!';
        		header('location: index.php?user_msg='.$user_msg.'');
            	exit();
	        }
        }else{
            $user_msg = 'Something went wrong! Please tell the Admin, Thank You';
        header('location: index.php?user_msg='.$user_msg.'');
            exit();
        }
    }else{
        $user_msg = 'This is the start Page!, So enter your full name here first';
        header('location: index.php?user_msg='.$user_msg.'');
            exit();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Result</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="css/master.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="scripts/overlay.js"></script>

        
        <script language="javascript">
            document.addEventListener("contextmenu", function(e){
                e.preventDefault();
            }, false);
        </script>
   
    <style>
       #header{
             background-color: #23bd19;
             width: 100%;
             height: 160px;
             margin:auto;
        }
        body{
            background-image: url('img/report1.jpg');
            background-attachment: fixed;
            background-size: cover;
            background-repeat: no-repeat;s 
        }
         #result{
            font-family: Arial;
            font-size: 60px; 
        }
        #fontr{
            color: red;
        }
        
    </style>
    </head>

    <body  style="font-family: Arial;">
      <div id="header">
        <div id="head" align="center">
            <img src="img/header.png" alt="college" width="1350px" height="160px"  />
        </div>
      </div>
        
        <div id='result'>
            <br>
            <center>
                <span id="fontr"><?php echo ($roll_no) ; ?></span>,
                <br />
                You got a Total Score of 

                <span id="fontr"><?php echo $marks; ?>/<?php echo $total_questions; ?></span>
            </center>
       </div>
       <br><br>
        <div>
            <a href="index.php">
            <input class="btn btn-primary btn-lg" type="submit" value="Back to main Page">
            </a>
        </div>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>