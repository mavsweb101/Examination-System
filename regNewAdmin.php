<?php 
	require_once('scripts/connect_db.php'); 
?>

<?php 

if (isset($_POST['btnReg'])) {
	
	   $first_name=mysql_real_escape_string($_POST['fname']);
        $middle_name=mysql_real_escape_string($_POST['mname']);
        $last_name=mysql_real_escape_string($_POST['lname']);
        $user=mysql_real_escape_string($_POST['user']);
        $pass=mysql_real_escape_string($_POST['pass']);
       
        $password=md5($pass);
        $type = $_POST['type'];
        $pos = $_POST['pos'];


        $fetch=mysql_query("SELECT id FROM enrolment_login 
                            WHERE username='$user' && Name = '$first_name' && 
                            middlename = '$middle_name' && lastname = '$last_name' ")
                or die(mysql_error());

          $count=mysql_num_rows($fetch);
        if($count!="")
        {
        	$user_msg = 'Sorry, but \ '.$user.' \ is already taken!';
            	echo("<script>alert('User Data is already taken')</script>");
        }
        else
        {
            mysql_query("INSERT INTO enrolment_login (Name, middlename, lastname, username, password, position, type) 
            	VALUES ('$first_name', '$middle_name', '$last_name', '$user','$password', '$pos', '$type' )")or die(mysql_error());

        	$user_msg = 'Admin account, \ '.$user.' \ has been created!';
            echo("<script>alert('Your admin account has been save')</script>");
        }
 
    }



?>
 






<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>

<form action="" method="POST">
  <div class="form-group">
    <label for="firstname">First Name</label>
    <input type="text" name="fname" class="form-control" required placeholder="First Name" />


    <br>

    <label for="middlename">Middle Name</label>
    <input type="text" name="mname" class="form-control" required id=mname" placeholder="Middle Name" />
    
    <br>

    <label for="lname">Last Name</label>
    <input type="text" name="lname" class="form-control" required id="lname" placeholder="Last Name" />

    <br>
    
    <label for="username">Choose Username</label>
    <input type="text" name="user" class="form-control" required id="username" placeholder="Username" />

     <br>

    <label for="pass">Password</label>
    <input type="text" name="pass" class="form-control" required id="pass" placeholder="Password" />
 
    <input type="hidden" name="type" value="CEE" />
    <input type="hidden" name="pos"  value="Exam Proctor" />

  </div>

  <center>
  		<input type="submit" class="btn btn-success" name="btnReg" value="Register" />
  		<input type="button" class="btn btn-default" data-dismiss="modal" value="Close" />
  </center>
</form>


    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>