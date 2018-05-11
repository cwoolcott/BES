<?php
session_start();

if (!$_SESSION['login']){
  header('HTTP/1.0 403 Forbidden');
  die('Forbidden');
}
include_once('../conn.php');


// Section 1
$sql = "SELECT * FROM survey WHERE survey_active = 'Y' order by workshopdate desc";
$result = $conn->query($sql);
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
  #companies tbody td {
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
  <img src="https://keysurvey.inventivetalentreviews.com/img/its_logo_default.png" style="width:300px"><br/><br/>

<table id="companies" class="cdemo cell-border dataTable" role="grid" style="max-width:1040px;">
    <thead>
        <tr>
            <th>Responders</th>
            <th>Summary</th>
            <th>Company</th>
            <th>Type</th>
            <th>Workshop Date</th>
        </tr>
    </thead>
    <tbody>
      <?php
while ($surveyrow = $result->fetch_assoc()) {
?>
        <tr>
            <td><a class="btn btn-primary" href="admin_details.php?survey_id=<?php echo $surveyrow['survey_id']?>">View Responders</a></td>
            <td><a class="btn btn-success" href="admin_teamreport.php?survey_id=<?php echo $surveyrow['survey_id']?>&survey_type_id=<?php echo $surveyrow['survey_type_id']?>">View Team Report</a></td>
            <td><b><?php echo $surveyrow['survey_name']?></b></td>
            <td><b><?php echo ($surveyrow['survey_type_id']==1 ? 'Board Effectiveness' : 'Team Effectiveness') ?></b></td>
            <td><b><?php echo $surveyrow['workshopdate']?></b></td>
        </tr>
<?php
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
    $('#companies').DataTable();
} );
</script>
</body>
</html>
