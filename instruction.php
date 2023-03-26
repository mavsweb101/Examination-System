<?php 
session_start();
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
$name= ucfirst($fname)." ".ucfirst($lname);
   
    require_once("scripts/connect_db.php");


    $index_selecting_quiz = mysql_query("SELECT quiz_id, display_questions, time_allotted, quiz_name
                                    FROM quizes WHERE set_default=1");
    $index_selecting_quiz_row = mysql_fetch_array($index_selecting_quiz);
    $index_selecting_quiz_num = mysql_num_rows($index_selecting_quiz);



    $user_taken = "";
    if(isset($_POST['user_msg']) && $_POST['user_msg']!=""){
        $user_taken = $_POST['user_msg'];
    }
    if(isset($_GET['user_msg']) && $_GET['user_msg']!=""){
        $user_taken = $_GET['user_msg'];
    }




    $total_questions = preg_replace('/[^0-9]/', "", $index_selecting_quiz_row['display_questions']);
   



    $total_time = preg_replace('/[^0-9]/', "", $index_selecting_quiz_row['time_allotted']);
    $quizName = $index_selecting_quiz_row['quiz_name'];

   


//For viewing the exam information
 
    if($index_selecting_quiz_num>0)
    	$first_item = 'You\'ve got exactly '.$total_time.' minutes for attempting '.$total_questions.' questions.';
    else
    	$first_item = '<strong>Sorry, but it seems there are no Exam Questions Available right now!</strong>';
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <title>Examination Instructions</title>
                <meta name="msapplication-TileColor" content="#FFFFFF">
                <meta name="msapplication-TileImage" content="img/faviconit/favicon-144.png">

        <link rel="icon" href="img/logo isu.png">
        <link rel="stylesheet" type="text/css" href="css/master.css">
        <script type="text/javascript" src="scripts/overlay.js"></script>

        <script type="text/javascript">
            function submit(){
                var x=document.forms["onlyForm"]["rollno"].value;
                if (x==null || x==""){
                    document.getElementById("enter_rollno").innerHTML = "Enter Your Full Name";
                    exit();
                }
                document.getElementById('myForm').submit(); 
                return false;
            }
        </script>

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
            background-repeat: no-repeat;
            background-image: url('img/report.jpg');
            background-size: cover;
            background-attachment: fixed;
        }
        h2,h3{
            font-size: 30px;
        }
        ul,li{
            font-size: 22px;
        }
        #btext{
            font-size: 30px;
            border-radius: 6px;
        }
    </style>    
    </head>

    <body style="font-family: Arial;">
    <div id="header">  
        <div id="head" align="center">
            <img src="img/header.png" alt="college" height="150px" width="1300px" />
        </div>
    </div>
        <div id="main_body" align="center">
            <h2>So, you want to take the Entrance Exam</h2>
            <h2><strong><?php echo $quizName; ?> </strong></h2>
            <h3 align="left">Here are the rules then:</h3>
            <div align="left">
                <ul>
                    <li><?php echo "<strong> $first_item </strong>"; ?></li>
                    <li>If time runs out, your examination answer will be automatically submitted </li>
                    <li>You'll only be getting confirmation pop-up once if you try to leave during the <strong>EXAM</strong></li>
                    <li>It consist of <strong>5 subjects</strong> with <strong>20</strong> items each and arrange respectively 
                       <strong>
                        <ol>
                            <li>Filipino</li>
                            <li>English</li>
                            <li>Math</li>
                            <li>Science</li>
                            <li>History</li>
                        </ol>
                        </strong>
                    </li>

                    <li>You can only attempt the examination <strong>ONCE</strong></li>
                </ul>
            </div>

            <h3>GOOD LUCK AND GOD BLESS!</h3>

            <form id="myForm" name="onlyForm" action="quiz.php" method="POST">
                <table align="center">
                    <tr>
                        <td align="center">
                            <input id="btext" type="text" value="<?php echo $name ?>" name="rollno" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <h3>Click below when you are ready to start the exam</h3>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <a href="javascript:submit();" class="myButton">Click Here to Begin</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id = "enter_rollno" align="center"><?php echo $user_taken ?></div>
                        </td>
                    </tr>
                </table>
            </form>
            
        </div>
        <br><br><br><br><br><br>
        
        <div id="fade_overlay">
            <a href="javascript:close_overlay();" style="cursor: default;">
                <div id="fade" class="black_overlay">
                </div>
            </a>
        </div>
    </body>
</html>

