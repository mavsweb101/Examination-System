<?php 
 require_once('scripts/connect_db.php');
?>

<?php 

	$sql = "SELECT * FROM quiz_takers  
			ORDER BY marks DESC, duration ASC LIMIT 20";

	$result = mysql_query($sql);

	if (isset($_POST["back"])) {
		echo "<script>window.location.href='admin.php'</script>";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Examination Report || Top 20</title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<style>
	#rTable{
		font-style: Times New Roman;
		font-size: 30px;
		padding: 0px 30px 20px 0px;
		margin-top: 20px;
	}
	#rpTable{
		font-style: Times New Roman;
		font-size: 30px;
		padding: 0px 30px 20px 0px;
		margin-top: 20px;
	}
	.table{
		width: 1024px;

	}

	  .btn {
            
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
        }
        .tHead{
        	text-align: center;
        	font-weight: bold;
        	font-size: 19px;
        }
        .form-control{
        	width: 400px;
        	font-style: Arial;
        	font-size: 12px;
        }
        #form{
        	margin-left: 160px;
        }
        #tForm{
        	width: 1000px;
        }
</style>

</head>


<body>
<center>
	<table id="rpTable">
		<tr align="center">
			<td><img src="img/logo isu.png" height="100" width="100"></td>
		</tr>
		<tr>
			<td align="center">
				Republic of the Philippines <br>
				Isabela State University <br>
				Jones Campus
			</td>
		</tr>
	</table>
</center>

<br><br>
<div id="form">
<form method="POST">
	<table id="tForm">
		<tr>
				<td>
				<input type="button" class="btn btn-primary" value="Print" id="print"/>
				
				<input type="submit" class="btn btn-warning" value="Back" id="print1" name="back"/>
				</td>
	</table>
	<br>
	<table align="center" style="margin-right: 500px;">
		<tr>
			<td>
				<input type="text" class="form-control search" placeholder="Search Name Here"   autofocus />
			</td>
		</tr>
	</table>
</form>
</div>			

	


<br><br>

<center>
	<table id="rData" class="table table-hover ">
		<thead>	
			<tr>
					<th class="tHead">Rank</th>
					<th class="tHead">Full Name</th>
					<th class="tHead">Score</th>
					<th class="tHead">Percentage</th>
					<th class="tHead">Time Taken per Second</th>
					<th class="tHead">TimeStamp</th>
			</tr>
		</thead>

		<?php
		$display_id = 1;  
			while ($row = mysql_fetch_array($result)) {		
			
			$db_id = $row["id"];
			$db_username = $row["username"];
			$db_marks = $row["marks"];
			$db_percentage = $row["percentage"];
			$db_duration = $row["duration"];
			$db_timestamp = $row["date_time"];	

			echo "
			<tbody>
				<tr style='text-align:center; font-size: 20px;'>
					<td>$display_id</td>
					<td>$db_username</td>
					<td>$db_marks</td>
					<td>$db_percentage</td>
					<td>$db_duration</td>
					<td>$db_timestamp</td>
				</tr>
			</tbody>
				";
		 $display_id++;
		 }
		  
		 ?>
	</table>
</center>


<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>




<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {
		$('#print').click(function(){
			$('#print,#print1,.search').hide()
				window.print()
			$('#print,#print1,.search').show()
				});
			});

</script>


<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
    $('.search').on('keyup',function(){
        var searchTerm = $(this).val().toLowerCase();
        $('#rData tbody tr').each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
                $(this).hide();
            }else{
                $(this).show();
            }
        });
    });
});
</script>
</body>
</html>