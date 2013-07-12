<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" type="text/css" href="style.css" />
<title>Tutors logged in</title>
</head>
<body>
<h1>Tutors currently available in Sandbox - Smith 234</h1>
  <?php
  require_once('querystring.php');
  header( "refresh:5;" );
  $result1 = mysqli_query($dbc, $query);
  while ($row = mysqli_fetch_array($result)) {
		
	echo '<table>';
	echo '<col width="175">';
	echo '<col width="175">';
	echo '<tr>';
	echo '<td>';
	echo $row['FirstName'].' '.$row['LastName'].',<br/>';
	echo '</td>';
	echo '<td>';
	echo '<'.'img src="'.GW_UPLOADPATH.$row['image'].'">';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<table>';
	echo '<col width="350">';
	echo '<tr>';
	echo '<td>';
	
	echo $row['TCourseID'];
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<br />';

  }
  mysqli_close($dbc);
?>
</body>
</html>
