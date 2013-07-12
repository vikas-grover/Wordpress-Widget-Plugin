<?php
	$id=abs($_GET['id']);
	$dbc = mysqli_connect('localhost', 'sandboxlogin', 'smith234', 'sandboxlogin')
    or die('Error connecting to MySQL server.');
	$query = "Select StudentPic from tutorsloggedin where StudentID =$id Order By StudentName";
	$result = mysqli_query($dbc, $query) or die ('No File Found.'); //on error display message 
while($row=mysqli_fetch_array($result))
{
	header("Content-Type: image/jpeg");
		echo $row['StudentPic'];
		echo '<br/ >';
		}
  	mysqli_close($dbc); 
?>