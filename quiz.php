<?php
	require_once("scripts/connect_db.php");

	$selecting_quiz = mysql_query("SELECT quiz_id, display_questions, time_allotted, quiz_name
									FROM quizes WHERE set_default=1");
	$selecting_quiz_row = mysql_fetch_array($selecting_quiz);



 //checking if all 3 values are there
	if(isset($_POST['rollno']) && $_POST['rollno'] != "")
	{
		
	 //getting values in variables
		$roll_no = $_POST['rollno'];
		$roll_no = htmlspecialchars($roll_no);
		$roll_no = mysql_real_escape_string($roll_no);

		$total_questions = preg_replace('/[^0-9]/', "", $selecting_quiz_row['display_questions']);

	 


	 //total time converted to seconds
		$total_time = (preg_replace('/[^0-9]/', "", $selecting_quiz_row['time_allotted']))*60;

		$final_quiz_ID = preg_replace('/[^0-9]/', "", $selecting_quiz_row['quiz_id']);

		$quzz_name = $selecting_quiz_row['quiz_name'];

	


	 //checking if user has already taken this quiz
		$userCheck = mysql_query(" SELECT id FROM quiz_takers 
										WHERE username = '$roll_no' 
										AND quiz_id='$final_quiz_ID' ")or die(mysql_error());
	
	


	 //if user already did, redirect to instruction.php with error
		if(!(mysql_num_rows($userCheck) < 1)){
			$user_msg = 'Sorry, but '.$roll_no.', has already attempted the  '.$quzz_name.'!';
			header('location: index.php?user_msg='.$user_msg.'');
			exit();
		
		}else{
	 
	 


	 //else inserting few columns into the table
		mysql_query("INSERT INTO quiz_takers (username, percentage, date_time, quiz_id, duration) 
					 VALUES ('$roll_no', '0', now(), '$final_quiz_ID', '0')")or die(mysql_error());
		}
	}else{
		$user_msg = 'This is the start Page, So enter your username here first';
		header('location: index.php?user_msg='.$user_msg.'');
			exit();
	}







 //getting body i.e. questions, options and submit button for the page

 //initialize the optput variable
	$m_output='';
 
 //Getting the questions from DB here
	$m_questions_from_DB = mysql_query("SELECT * FROM questions WHERE quiz_id='$final_quiz_ID'
								ORDER BY rand() LIMIT $total_questions");

		while (mysql_num_rows($m_questions_from_DB)<1) {
			$user_msg = 'Sorry but there are no questions in this exam!';
			header('location: instruction.php?user_msg='.$user_msg.'');
			exit();
		}

	 


	 //setting Question No. to 1 on quiz page(necessary due to rand() above)
		$m_display_ID = 1;

	 





	 //looping through the questions and adding them on the page
		while($m_row = mysql_fetch_array($m_questions_from_DB)){
		 //initializing the options
			$m_answers='';
				
		 
		 //getting row attributes in variables
			$m_id = $m_row['id'];
			$m_thisQuestion = $m_row['question'];
			$m_type = $m_row['type'];
			$m_question_id = $m_row['question_id'];
			$m_code = $m_row['code'];
			$m_code_type = $m_row['code_type'];

		
		 //html for question
			$m_q = '<tr>
						<td width="40px" rowspan="1" align="center">
							<strong>'.$m_display_ID.'.</strong>
						</td>
						<td>
							<pre class="question_style"><strong><div style="width: 730px; word-wrap: break-word;">'.$m_thisQuestion.'</div></strong></pre>
						</td>
					</tr>';
		
		
		 //gathering options of the question here
			$m_options_from_DB = mysql_query("SELECT * FROM answers 
									WHERE question_id='$m_question_id' ORDER BY rand()");

				$m_answers .=  '<tr>
									<td></td>
									<td>
								';
				 //adding html to individual options here
					while($m_row2 = mysql_fetch_array($m_options_from_DB)){
					 //getting row attributes in variables
						$m_answer = $m_row2['answer'];
						$m_answer_ID = $m_row2['id'];

						
						$m_answers .= ' <label style="cursor:pointer;">
									   		<input type="radio" name="rads'.$m_display_ID.'" value="'.$m_answer_ID.'">'.$m_answer.'</label>
										<br /><br />
									  ';
					}

					$m_answers .=  '</td>
								</tr>
								<tr height="20px">
								</tr>
								   ';



			 // the complete div that is sent back to quiz.php
				$m_output .= ''.$m_q.$m_answers;

				$m_display_ID++;

		}

		$m_display_ID--;

	 //adding html for submit button
		$m_output .= '  <tr>
							<td colspan="2" align="center">
								<span id="m_btnSpan">
									<a href="javascript:{}" onclick="quiz_submit()" class="myButton">Submit</a>
								</span>
							</td>
						</tr>';

	 //adding html for hidden values to be sent to result.php
		$m_output .= '<input type="hidden" name="rollno" value="'.$roll_no.'">
					  <input type="hidden" name="total_ques" value="'.$m_display_ID.'">
					  <input type="hidden" name="total_time" value="'.$total_time.'">
					  <input type="hidden" name="quizID" value="'.$final_quiz_ID.'">
					  ';
?>




























<!DOCTYPE html>
<html>

	<head>
		<title>Examination Page</title>

		<meta charset="utf-8">

		<link rel="stylesheet" type="text/css" href="css/master.css">
        <script type="text/javascript" src="scripts/overlay.js"></script>
        <script type="text/javascript">

	     //function that submits the quiz
			function quiz_submit(){
				window.onbeforeunload = null;
	            document.getElementById('quiz_form').submit(); 
	        }

	     //function that keeps the counter going
			function timer(secs){
				var ele = document.getElementById("countdown");
				ele.innerHTML = "Your Time Starts Now";			
				var mins_rem = parseInt(secs/60);
				var secs_rem = secs%60;
				
				if(mins_rem<10 && secs_rem>=10)
					ele.innerHTML = "Time Remaining: "+"0"+mins_rem+":"+secs_rem;
				else if(secs_rem<10 && mins_rem>=10)
					ele.innerHTML = "Time Remaining: "+mins_rem+":0"+secs_rem;
				else if(secs_rem<10 && mins_rem<10)
					ele.innerHTML = "Time Remaining: "+"0"+mins_rem+":0"+secs_rem;
				else
					ele.innerHTML = "Time Remaining: "+mins_rem+":"+secs_rem;

				if(mins_rem=="00" && secs_rem < 1){
					quiz_submit(); 
				}
				secs--;

			 //to animate the timer otherwise it'd just stay at the number entered
			 //calling timer() again after 1 sec
				var time_again = setTimeout('timer('+secs+')',1000);
			}

		 //warning confirmation that appears on closing/refreshing the quiz window/tab
			function closeEditorWarning(){
    				return "Do you really wanna quit?! You cannot take the examination again!";
			}
			window.onbeforeunload = closeEditorWarning;
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
				background-size: cover;
				background-attachment: fixed;
				background-image: url('img/report.jpg');
			}
			#countdown{
				font-size: 21px;
			}
			table{
				font-size: 22px;
			}
		</style>
	</head>

	<body style="font-family: Arial;">
		
		<div id="head" align="center">
			<div id="header">
            	<img src="img/header.png" alt="college" height="150px" width="1300px" />
        	</div>
        </div>
       
        <br><h3><strong><?php echo $quzz_name; ?></strong></h3>

        <div id="countdown">
        	<script type="text/javascript">
        		timer(<?php echo  $total_time; ?>);
        	</script>
        </div>


		<div id="main_body" align="center" style="margin-bottom: 100px;">
			<form id="quiz_form" name="quiz_form_name" action="result.php" method="POST">
			<br /><BR /><BR />
				<table width="780px" align="center">
					<?php echo $m_output ?>
				</table>
			</form>
		</div>



        <div id="fade_overlay">
            <a href="javascript:close_overlay();" style="cursor: default;">
                <div id="fade" class="black_overlay">
                </div>
            </a>
        </div>
	</body>
</html