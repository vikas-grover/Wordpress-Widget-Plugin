<?php
/*
Plugin Name: tutorlogin
Plugin URI:http://cis.bentley.edu/sandbox/wp-content/plugins
Description: Plugin to show logged in tutors
Author: Vikas Grover
Version: 1.0
Author URI: mail:vikas.grover@yahoo.com
*/
add_action("widgets_init", array('VikasFirstWidget', 'register'));
//add_action("widgets_init", array('VikasFirstWidget', 'accessDB'));
class VikasFirstWidget {
  function control(){
    echo 'I am a control panel';
  }
  function widget($args){
    echo $args['before_widget'];
    echo $args['before_title'] . 'Tutors currently available in sandbox' . $args['after_title'];
	require_once('appvars.php');
	require_once('connectvars.php');
	//require_once('querystring.php');
		$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Error connecting to MySQL server.');

		  $query1 = "SELECT sandboxswipe.work_visit.tutorID as ID,sandboxswipe.tutor.imgPath as image, sandboxswipe.student.FirstName as FirstName,sandboxswipe.student.LastName as LastName FROM sandboxswipe.work_visit,sandboxswipe.tutor,sandboxswipe.student where 
   sandboxswipe.work_visit.tutorID =sandboxswipe.tutor.tutorID AND   sandboxswipe.tutor.studentHash = sandboxswipe.student.studentHash AND
   sandboxswipe.work_visit.startTime >0 AND sandboxswipe.work_visit.endTime =0"; //*///
   //sandboxswipe.tutor_ability.CourseID as TCourseID,
   //sandboxswipe.tutor_ability,
	//sandboxswipe.tutor_ability.tutorID= sandboxswipe.work_visit.tutorID AND
	//  require_once('querystring.php');
  // echo $query;
	$url = plugin_dir_path( __FILE__ );  //returns the current URL
	$replace = "\\";
	$replaceWith = "/";
	$dirnew = str_replace( $replace, $replaceWith ,$url).GW_UPLOADPATH;
	$url = $_SERVER['REQUEST_URI']; //returns the current URL
	//echo $dirnew;
  $result1 = mysqli_query($dbc, $query1);
  if (!$result1) {
    printf("Error: %s\n", mysqli_error($dbc));
    exit();
}
  while ($row = mysqli_fetch_array($result1)) {
	
	echo '<table border="1" width="100%" style="table-layout: fixed;">';
	echo '<col width="150">';
	echo '<col width="125">';
	echo '<tr>';
	echo '<td>';
	echo '<font face="Arial";>';
	echo '<strong style="font-size:15px;">';
	echo $row['FirstName'].' '.$row['LastName'].',<br/>';
	echo '</td>';
	echo '</font>';
	echo '</strong>';
	echo '<td>';
	echo '<img src="wp-content/plugins/tutorlogin/assets/'.$row['image'].'" alt="'.$row['image'].'" width="100px" height="60px" >';	
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '<table border="1" width="100%" style="table-layout: fixed; ">';
	echo '<col width="10">';
	echo '<tr>';
	echo '<td>';
	echo '<font face="Arial";>';
	echo '<strong style="font-size:11px;">';
	$TutorID = $row['ID'];
	$query2 = "SELECT sandboxswipe.tutor_ability.CourseID as TCourseID FROM sandboxswipe.tutor_ability where 
   sandboxswipe.tutor_ability.tutorID = '$TutorID' Order by sandboxswipe.tutor_ability.CourseID";
    $result2 = mysqli_query($dbc, $query2);
	$row = mysqli_fetch_array($result2);
	$CourseList = "Tutor for: ".$row['TCourseID'];
	while ($row = mysqli_fetch_array($result2)) {
	$CourseList = $CourseList.', '.$row['TCourseID'];
	}
	echo $CourseList;
	echo '</td>';
	echo '</font>';
	echo '</strong>';
	echo '</tr>';
	echo '</table>';
  }
  mysqli_close($dbc);
	//echo 'Tutors logged in';
  //}
    echo $args['after_widget'];
  }
  function register(){
    register_sidebar_widget('VikasFirstWidget', array('VikasFirstWidget', 'widget'));
    register_widget_control('VikasFirstWidget', array('VikasFirstWidget', 'control'));
  }
}
?>