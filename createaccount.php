<?php
 require_once("scripts/connect_db.php");
?>
<form method="POST">
<input type="text" name="user">
<input type="text" name="pass">
<input type="hidden" name="type" value="Exam">

<input type="submit" value="save" name="add"/>
</form>

<?php
if(isset($_POST['add'])){
		$username=mysql_real_escape_string($_POST['user']);
		$password=mysql_real_escape_string($_POST['pass']);
		$password=md5($password);
		$type = $_POST['type'];

	$insert="insert into enrolment_login (id,username,password,type)Values('null','$username','$password','$type')";
	  $result = mysql_query($insert);
			echo "<script type='text/javascript'>alert('Success!');</script>";	
	}	
?>	