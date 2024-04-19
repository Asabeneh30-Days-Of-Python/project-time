<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Main site scheduling</title>
	<h1 style="text-emphasis: beige;text-shadow: peru;">welcome to main page</h1>
</head>
<body>
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color:navy;
            color: tan;
        }
        form {
            background-color: royalblue;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        input[type=text], input[type=date], input[type=time], textarea {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #45a049;
        }
    </style>
	<form id="data-form" method="POST" action="">
		<div>
		<h3>Add activity</h3>
		<label>Activity</label>
		<input type="text" name="Activity">
		<br>
		<label>date</label>
		<input type="date" name="date">
		<br>
		<label>time</label>
		<input type="time" name="time">
		<br>
		<input type="submit" name="submit" value="submit data">
	</div>
	</form>
	<form id="report-form" method="POST" action="">
    <div>
    	<h3>Obtain reports</h3>
    	<label for="start">start</label>
    	<input type="date"id="start-date" name="start-date">
    	<br>
    	<label for="stop">stop</label>
    	<input type="date"id="stop-date" name="stop-date">
    	<br>
    	<input type="submit" name="generate reports">
    </div>
   </form>
	
	<hr>
    <div>
    	<h3>next activity</h3>
    </div>
	
	<script type="text/javascript">
	document.getELementByid('data-form').addEventListener('submit',function(event){
			event.preventDefault();
			var activity=
			document.getELementByid('activity').value;
			var date = 
			document.getELementByid('date').value;
			var time = document.getELementByid('time').value;
			document.getELementByid('data-form').innerHtml +='<p>' + activity+ ''+ date +':'+ time +'</p>';
		});
</script>	

<script type="text/javascript">
	  // Let's assume you have your activities data in the following format:
        var activities = [
            { activity: 'running', date: '2024-03-02', time: '06:30:00' },
            { activity: 'reading', date: '2024-07-04', time: '10:30:00' },
            { activity: 'appointment', date: '2024-07-05', time: '11:30:00' },
            { activity: 'travel', date: '2024-08-06', time: '02:30:00' },
            { activity: 'conference', date: '2024-10-06', time: '09:50:00' }
            //add more activities here
        ];

        // This function returns the next upcoming activity
        function getNextActivity() {
            var now = new Date();
            var nextActivity = activities.reduce(function(closest, current) {
                var currentActivityDateTime = new Date(current.date + 'T' + current.time);
                return (currentActivityDateTime > now && (!closest || currentActivityDateTime < new Date(closest.date + 'T' + closest.time))) ? current : closest;
            }, null);
            return nextActivity;
        }

        // Call the function and display the next activity
        var nextActivity = getNextActivity();
        if (nextActivity) {
            document.write('The next activity is "' + nextActivity.activity + '" on ' + nextActivity.date + ' at ' + nextActivity.time);
        } else {
            document.write('There are no upcoming activities.');
        }
</script>	

<?php
	if ($_POST){
$activity =isset( $_POST["activity"]) ?$_POST[" activity"] :"";
$date =isset( $_POST["date"]) ? $_POST["date"] :"";
$time =isset($_POST["time"]) ? $_POST["time"] :"";
     //create connection
	$conn = new mysqli('localhost','root','','time_manager');
	//check connection
	if ($conn->connect_error) {
		die("connection failed:" . $conn->connect_error);
	}else{ 
	//sql to create table
	$stmt = $conn ->prepare("INSERT INTO tasks (activity,date,time) VALUES (?, ?, ?)");
	$stmt->bind_param("sss",$activity,$date,$time);
	//set parameters and execute
	$activity="running";
	$date="02/03/2024";
	$time="06:30:00";
	$stmt->execute();

	$activity="reading";
	$date="04/07/2024";
	$time="10:30:00";
	$stmt->execute();

	$activity="appointment";
	$date="05/07/2024";
	$time= "11:30:00";
	$stmt->execute();

	$activity="travel";
	$date= "06/08/2024";
	$time="02:30:00";
	$stmt->execute();

	$activity="conference";
	$date="06/10/2024";
	$time="09:50:00";
	$stmt->execute();
	//add more activities here

	
	header("location: logout.php");
	$stmt->close();
	$conn->close();
	exit();
	}
}
	?>
</body>
</html>