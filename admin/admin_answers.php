<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if (!$_SESSION['login']){
  header('HTTP/1.0 403 Forbidden');
  die('Forbidden');
}
include_once('../conn.php');
include('admin_functions.php');

$survey_responders_id = filter_var($_REQUEST['survey_responders_id'], FILTER_SANITIZE_NUMBER_INT);
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
<div class="container-fluid">
  <a href="admin.php"><img src="https://keysurvey.inventivetalentreviews.com/img/its_logo_default.png" style="width:300px"></a>
<br/><br/>
  <a href="admin_details.php?survey_id=<?php echo $survey_id?>" class="btn btn-primary" >Back to Responders</a>
  <br/><br/>

<h2><?php echo getRespondersInfo($survey_responders_id)['name']?></h2>

<!-- SECTION -->
<hr>
<h3>Board Composition and Capabilities</h3>

<table id="responders" class="cell-border stripe" >
    <thead>
        <tr>
            <th>Response</th>
            <th>Question</th>
            <th>Topic</th>
        </tr>
    </thead>
    <tbody>

<?php

if($stmt=$conn->prepare("SELECT response, title, description, header, survey_section_id from survey_responses inner join survey_questions on survey_responses.survey_questions_id = survey_questions.survey_questions_id WHERE survey_responders_id= ? and survey_questions.survey_section_id='1' ORDER BY  sortorder")){
  $stmt->bind_param('i',$survey_responders_id);
  $stmt->execute();
  $stmt->bind_result($response, $title, $description, $header, $survey_section_id);

  while ($stmt->fetch()) {
  ?>
          <tr>
              <?php 
                echo '<td>' . getAnswerDetail($response,$survey_section_id) . '</td>'; 
                echo '<td>' . $description . '</td>'; 
                echo '<td>' . $title . '</td>'; 
                ?>
          </tr>
  <?php
  }
}
  ?>
    </tbody>
</table>

<!-- SECTION -->
<hr>
<h3>Rate Current Level of Focus</h3>

<table id="responders" class="cell-border stripe" >
    <thead>
        <tr>
            <th>Response</th>
            <th>Question</th>
            <th>Topic</th>
        </tr>
    </thead>
    <tbody>

<?php

if($stmt=$conn->prepare("SELECT response, title, description, header, survey_section_id from survey_responses inner join survey_questions on survey_responses.survey_questions_id = survey_questions.survey_questions_id WHERE survey_responders_id= ? and survey_questions.survey_section_id='2' ORDER BY  header")){
  $stmt->bind_param('i',$survey_responders_id);
  $stmt->execute();
  $stmt->bind_result($response, $title, $description, $header, $survey_section_id);

  while ($stmt->fetch()) {
  ?>
          <tr>
              <?php 
                echo '<td>' . getAnswerDetail($response,$survey_section_id) . '</td>'; 
                echo '<td>' . $title . '</td>'; 
                echo '<td>' . $header . '</td>'; 
                ?>
          </tr>
  <?php
  }
}
  ?>
    </tbody>
</table>


<!-- SECTION -->
<hr>
<h3>Board Dynamics</h3>

<table id="responders" class="cell-border stripe" >
    <thead>
        <tr>
            <th>Response</th>
            <th>Question</th>
        </tr>
    </thead>
    <tbody>

<?php

if($stmt=$conn->prepare("SELECT response, title, description, header, survey_section_id from survey_responses inner join survey_questions on survey_responses.survey_questions_id = survey_questions.survey_questions_id WHERE survey_responders_id= ? and survey_questions.survey_section_id='3' ORDER BY  header")){
  $stmt->bind_param('i',$survey_responders_id);
  $stmt->execute();
  $stmt->bind_result($response, $title, $description, $header, $survey_section_id);

  while ($stmt->fetch()) {
  ?>
          <tr>
              <?php 
                echo '<td>' . getAnswerDetail($response,$survey_section_id) . '</td>'; 
                echo '<td>' . $description . '</td>'; 
                ?>
          </tr>
  <?php
  }
}
  ?>
    </tbody>
</table>

<!-- SECTION -->
<hr>
<h3>Individual Director Capabilities: Skills, Abilities, and Experience</h3>

<table id="responders" class="cell-border stripe" >
    <thead>
        <tr>
            <th>Response</th>
            <th>Board Member</th>
            <th>Topic</th>
        </tr>
    </thead>
    <tbody>

<?php

if($stmt=$conn->prepare("SELECT response, title, description, header, survey_section_id, name from survey_responses inner join survey_questions on survey_responses.survey_questions_id = survey_questions.survey_questions_id inner join survey_responders on survey_responders.survey_responders_id = survey_responses.survey_boardmembers_id WHERE survey_responses.survey_responders_id= ? and survey_questions.survey_section_id='4' order by name")){
  $stmt->bind_param('i',$survey_responders_id);
  $stmt->execute();
  $stmt->bind_result($response, $title, $description, $header, $survey_section_id, $name);

  while ($stmt->fetch()) {
  ?>
          <tr>
              <?php 
                echo '<td>' . getAnswerDetail($response,$survey_section_id) . '</td>';
                echo '<td>' . $name . '</td>'; 
                echo '<td>' . $description . '</td>'; 
                ?>
          </tr>
  <?php
  }
}
  ?>
    </tbody>
</table>


<!-- SECTION -->
<hr>
<h3>Individual Director Capabilities: Personality Traits</h3>

<table id="responders" class="cell-border stripe" >
    <thead>
        <tr>
            <th>Response</th>
            <th>Board Member</th>
            <th>Topic</th>
        </tr>
    </thead>
    <tbody>

<?php

if($stmt=$conn->prepare("SELECT response, title, description, header, survey_section_id, name from survey_responses inner join survey_questions on survey_responses.survey_questions_id = survey_questions.survey_questions_id inner join survey_responders on survey_responders.survey_responders_id = survey_responses.survey_boardmembers_id WHERE survey_responses.survey_responders_id= ? and survey_questions.survey_section_id='5' order by name")){
  $stmt->bind_param('i',$survey_responders_id);
  $stmt->execute();
  $stmt->bind_result($response, $title, $description, $header, $survey_section_id, $name);

  while ($stmt->fetch()) {
  ?>
          <tr>
              <?php 
                echo '<td>' . getAnswerDetail($response,$survey_section_id) . '</td>';
                echo '<td>' . $name . '</td>'; 
                echo '<td>' . $description . '</td>'; 
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
    $('#responders').DataTable({
      aLengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
    iDisplayLength: -1
    });
} );
</script>
</body>
</html>
