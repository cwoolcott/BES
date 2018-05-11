<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!$_SESSION['login']){
	header('HTTP/1.0 403 Forbidden');
	die('Forbidden');
}
include_once('../conn.php');


$survey_id = filter_var($_REQUEST['survey_id'], FILTER_SANITIZE_NUMBER_INT);


 // while ($stmt-> fetch()) {
  //    echo $email . "<br>";
  //}

 // $stmt-> close();


//$conn-> close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>ITR Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.css"/>
  <style>
  #responders tbody td {
 border: 1px solid #ddd !important;
 border-spacing: 0;
 border-collapse: collapse;
 border-left-width: 0;
 border-bottom-width: 0;
 padding: 3px;
 }
 </style>
</head>
<body>
  <div style="float:right">
<iframe name="rightframe" style="border:none;">
  
</iframe>
  </div>
<div class="container-fluid">
	<a href="admin.php"><img src="https://keysurvey.inventivetalentreviews.com/img/its_logo_default.png" style="width:300px"></a>
<br/><br/>
  <a href="admin.php" class="btn btn-primary" >Back to Admin</a>
  <br/><br/>
    <a href="https://keysurvey.inventivetalentreviews.com/mailhandler.php?survey_id=<?php echo $survey_id ?>&emailtype=initial" class="btn btn-danger" target="rightframe">Send Initial Emails</a>  &nbsp; 
  <a href="https://keysurvey.inventivetalentreviews.com/mailhandler.php?survey_id=<?php echo $survey_id ?>&emailtype=reminder" class="btn btn-danger" target="rightframe">Send Reminder Emails</a> 
  
  <br/><br/>
<table id="responders" class="cell-border stripe" >
    <thead>
        <tr>
            <th>survey_responders_id</th>
            <th>survey_id</th>
            <th>responderkey</th>
            <th>name</th>
            <th>sortorder</th> 
            <th>email</th>
            <th>started</th>
            <th>complete</th>
            <th>Time Completed</th>
        </tr>
    </thead>
    <tbody>


<?php

if($stmt=$conn->prepare("SELECT survey_responders_id, survey_id, responderkey, name, sortorder, email,started,completed FROM survey_responders WHERE survey_id= ?")){
  $stmt-> bind_param('i',$survey_id);
  $stmt-> execute();
  $stmt-> bind_result($survey_responders_id, $survey_id, $responderkey, $name, $sortorder, $email, $started, $complete);

  //$stmt->store_result();
  //$resultcount = $stmt->num_rows;


  while ($stmt-> fetch()) {
  ?>
          <tr>
              <?php 
                if ($complete){
                echo '<td><a class="btn btn-primary" href="admin_answers.php?survey_responders_id=' . $survey_responders_id . '&survey_id=' . $survey_id . '">View</a></td>';
                }
                else
                {
                  echo '<td>Not Completed</td>';
                }
                echo '<td>' . $survey_id . '</td>'; 
                echo '<td>' . $responderkey . '</td>';   
                echo '<td>' . $name . '</td>'; 
                echo '<td>' . $sortorder . '</td>'; 
                echo '<td>' . $email . '</td>'; 
                echo '<td>' . $started . '</td>'; 
                echo '<td>' . $complete . '</td>'; 
                echo '<td>';
                if ($started && $complete){
                    $started = new DateTime($started);
                    $complete = new DateTime($complete);
                    $diff = date_diff( $started, $complete );
                    echo  $diff->d . ' days, ';
                    echo  $diff->h . ' hours, ';
                    echo  $diff->i . ' minutes';
                  }
                echo '</td>'; 


                
                   
                ?>
          </tr>
  <?php
  }
}
  ?>
    </tbody>
</table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.16/datatables.min.js"></script>
<script>
$(document).ready(function() {
    $('#responders').DataTable();
} );
</script>
</body>
</html>
