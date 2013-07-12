<?php
  require_once('connectvars.php');
  // Define database query
   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Error connecting to MySQL server.');
   $query = "SELECT work_visit.tutorID as ID,tutor.imgPath as image,tutor_ability.CourseID as TCourseID, student.FirstName as FirstName,student.LastName as LastName FROM work_visit,tutor_ability,tutor,student where 
   work_visit.tutorID =tutor.tutorID AND
   tutor_ability.tutorID= work_visit.tutorID AND
   tutor.studentHash = student.studentHash AND
   work_visit.startTime >0 AND work_visit.endTime =0";
?>
