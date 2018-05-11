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

$survey_id = filter_var($_REQUEST['survey_id'], FILTER_SANITIZE_NUMBER_INT);
$survey_type_id = filter_var($_REQUEST['survey_type_id'], FILTER_SANITIZE_NUMBER_INT);

$part1 = 10;
$part2 = 35;

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

<h2><?php //echo getRespondersInfo($survey_responders_id)['name']?></h2>

<!-- SECTION -->

<H3>Part 1</H3>
<table id="responders" class="cell-border stripe" style="width:800px" >
    <thead>
       
    </thead>
    <tbody>
<?php


$sql="SELECT title, description, COUNT(*) as totalCount, 
  COUNT(CASE WHEN response = '1' THEN 1 END) InsufficientCount, 
  COUNT(CASE WHEN response = '2' THEN 1 END) CouldHaveMoreCount,
  COUNT(CASE WHEN response = '3' THEN 1 END) OnTargetCount,
  COUNT(CASE WHEN response = '4' THEN 1 END) MoreThanEnoughCount, 
  COUNT(CASE WHEN response = '5' THEN 1 END) TooMuchCount 
from survey_responses 
  inner join survey_responders on survey_responders.survey_responders_id = survey_responses.survey_responders_id 
  inner join survey_questions on survey_questions.survey_questions_id = survey_responses.survey_questions_id 
WHERE survey_responders.survey_id= ? and survey_questions.survey_section_id = 1 GROUP BY survey_responses.survey_questions_id";

if($stmt=$conn->prepare($sql)){
  $stmt->bind_param('i',$survey_id);
  $stmt->execute();
  $stmt->bind_result($title, $description, $totalCount, $InsufficientCount, $CouldHaveMoreCount, $OnTargetCount, $MoreThanEnoughCount, $TooMuchCount);

  while ($stmt->fetch()) {
    $averageScore =  round(($InsufficientCount  + ($CouldHaveMoreCount * 2) + ($OnTargetCount * 3) + ($MoreThanEnoughCount * 4) + ($TooMuchCount * 5))/$totalCount,3);

    $styleCount = ($averageScore<3) ? '<span style="color:red">' . $averageScore . '</span>' :  $averageScore;

    $styleCount = ($averageScore>4) ? '<span style="color:green">' . $averageScore . '</span>' : $styleCount;
  ?>
          <?php if ($title){?>
          <tr>
            <td colspan="6" style="font-size: 18px;"><i><?php echo $title ?></i></td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="6"><b><?php echo $description ?><b></td>
          </tr>
          <tr>
            <td><?php echo ($survey_type_id==1 ? 'Insufficient' : 'Strongly Disagree');?></td>
            <td><?php echo ($survey_type_id==1 ? 'Could Have More' : 'Disagree');?></td>
            <td><?php echo ($survey_type_id==1 ? 'On Target' : 'Neutral');?></td>
            <td><?php echo ($survey_type_id==1 ? 'More Than Enough' : 'Agree');?></td>
            <td><?php echo ($survey_type_id==1 ? 'Too Much' : 'Strongly Agree');?></td>
            <td>Average Score</td>
          </tr>
          <tr>
              <?php 
                echo '<td>' . $InsufficientCount . '</td>'; 
                echo '<td>' . $CouldHaveMoreCount . '</td>'; 
                echo '<td>' . $OnTargetCount . '</td>'; 
                echo '<td>' . $MoreThanEnoughCount . '</td>'; 
                echo '<td>' . $TooMuchCount . '</td>'; 
                echo '<td>' . $styleCount . '</td>';
                ?>
          </tr>
  <?php
  }
}

?>
    </tbody>
</table>

<!-- SECTION -->
<?php

$title=false;

  $sql="SELECT title, description, 
    COUNT(CASE WHEN response = '1' THEN 1 END) InsufficientCount, 
    COUNT(CASE WHEN response = '2' THEN 1 END) OnTargetCount,
    COUNT(CASE WHEN response = '3' THEN 1 END) MoreThanEnoughCount
  from survey_responses 
    inner join survey_responders on survey_responders.survey_responders_id = survey_responses.survey_responders_id 
    inner join survey_questions on survey_questions.survey_questions_id = survey_responses.survey_questions_id 
  WHERE survey_responders.survey_id= ? and survey_questions.survey_section_id = 2 GROUP BY survey_responses.survey_questions_id";

if ($stmt=$conn->prepare($sql)){
$stmt->bind_param('i',$survey_id);
$stmt->execute();
$stmt->bind_result($title, $description, $InsufficientCount, $OnTargetCount, $MoreThanEnoughCount);
}
  if ($title){
  ?>
<hr>
<h3>Part 2: Board Focus and Priorities</h3>

<table id="responders" class="cell-border stripe" style="width:800px" >
    <thead>
       
    </thead>
    <tbody>

<?php
  while ($stmt->fetch()) {
  ?>
         <tr>
            <td colspan="3"><b><?php echo $title ?></b></td>
          </tr>
           <tr>
            <td>Insufficient Count</td>
            <td>On Target Count</td>
            <td>More Than Enough Count</td>
        </tr>
          <tr>
              <?php 
                echo '<td>' . $InsufficientCount . '</td>'; 
                echo '<td>' . $OnTargetCount . '</td>'; 
                echo '<td>' . $MoreThanEnoughCount . '</td>'; 
                ?>
          </tr>
  <?php
  }
?>
    </tbody>
</table>
<?php 
}
$title=false;

$sql="SELECT title, description, 
  COUNT(CASE WHEN response = '1' THEN 1 END) InsufficientCount, 
  COUNT(CASE WHEN response = '2' THEN 1 END) CouldHaveMoreCount,
  COUNT(CASE WHEN response = '3' THEN 1 END) OnTargetCount,
  COUNT(CASE WHEN response = '4' THEN 1 END) MoreThanEnoughCount, 
  COUNT(CASE WHEN response = '5' THEN 1 END) TooMuchCount 
from survey_responses 
  inner join survey_responders on survey_responders.survey_responders_id = survey_responses.survey_responders_id 
  inner join survey_questions on survey_questions.survey_questions_id = survey_responses.survey_questions_id 
WHERE survey_responders.survey_id= ? and survey_questions.survey_section_id = 3 GROUP BY survey_responses.survey_questions_id";

if ($stmt=$conn->prepare($sql)){
  $stmt->bind_param('i',$survey_id);
  $stmt->execute();
  $stmt->bind_result($title, $description, $InsufficientCount, $CouldHaveMoreCount, $OnTargetCount, $MoreThanEnoughCount, $TooMuchCount);
}
if ($title){
  ?>
<H3>Part 3: Board Composition and Capabilities</H3>
<table id="responders" class="cell-border stripe" style="width:800px" >
    <thead>
       
    </thead>
    <tbody>
<?php


  while ($stmt->fetch()) {
  ?>
          <tr>
            <td colspan="5"><b><?php echo $description ?></b></td>
          </tr>
          <tr>
            <td>Insufficient Count</td>
            <td>Could Have More Count</td>
            <td>On Target Count</td>
            <td>More Than Enough Count</td>
            <td>Too Much Count</td>
          </tr>
          <tr>
              <?php 
                echo '<td>' . $InsufficientCount . '</td>'; 
                echo '<td>' . $CouldHaveMoreCount . '</td>'; 
                echo '<td>' . $OnTargetCount . '</td>'; 
                echo '<td>' . $MoreThanEnoughCount . '</td>'; 
                echo '<td>' . $TooMuchCount . '</td>'; 
                ?>
          </tr>
  <?php
  }
?>
    </tbody>
</table>
  <?php
  }

if ($survey_type_id!=2){

?>

<H3>Part 4: Individual Director Capabilities.</H3>
<table id="responders" class="cell-border stripe" style="width:800px" >
    <thead>
       
    </thead>
    <tbody>
<?php

$sql="SELECT title, description, 
  COUNT(CASE WHEN response = '1' THEN 1 END) InsufficientCount, 
  COUNT(CASE WHEN response = '2' THEN 1 END) CouldHaveMoreCount,
  COUNT(CASE WHEN response = '3' THEN 1 END) OnTargetCount,
  COUNT(CASE WHEN response = '4' THEN 1 END) MoreThanEnoughCount, 
  COUNT(CASE WHEN response = '5' THEN 1 END) TooMuchCount 
from survey_responses 
  inner join survey_responders on survey_responders.survey_responders_id = survey_responses.survey_responders_id 
  inner join survey_questions on survey_questions.survey_questions_id = survey_responses.survey_questions_id 
WHERE survey_responders.survey_id= ? and survey_questions.survey_section_id = 4 GROUP BY survey_responses.survey_questions_id";


if($stmt=$conn->prepare($sql)){
  $stmt->bind_param('i',$survey_id);
  $stmt->execute();
  $stmt->bind_result($title, $description, $InsufficientCount, $CouldHaveMoreCount, $OnTargetCount, $MoreThanEnoughCount, $TooMuchCount);

  while ($stmt->fetch()) {
  ?>
          <tr>
            <td colspan="5"><b><?php echo $description ?></b></td>
          </tr>
          <tr>
            <td>Insufficient Count</td>
            <td>Could Have More Count</td>
            <td>On Target Count</td>
            <td>More Than Enough Count</td>
            <td>Too Much Count</td>
          </tr>
          <tr>
              <?php 
                echo '<td>' . $InsufficientCount . '</td>'; 
                echo '<td>' . $CouldHaveMoreCount . '</td>'; 
                echo '<td>' . $OnTargetCount . '</td>'; 
                echo '<td>' . $MoreThanEnoughCount . '</td>'; 
                echo '<td>' . $TooMuchCount . '</td>'; 
                ?>
          </tr>
  <?php
  }
}

?>
    </tbody>
</table>
<? 
}
else
{
  ?>

<!-- SECTION -->
<hr>
<h3>Individual</h3>
<?php

//Loop Through Each Member

if($stmt=$conn->prepare("SELECT name,survey_responders_id from survey_responders where survey_id=?")){
$stmt->bind_param('i',$survey_id);
$stmt->execute();
$stmt->bind_result($name,$survey_responders_id);
$a = 0;
while ($stmt->fetch()) {
      ?>
      <br/>
      <h4><?php echo $name?></h4>
      <h6>1: Insufficient * 2: Room for Development * 3: Proficient * 4: Exemplary * 5: Overuse * 6: Can't Rate Clearly</h6> 

<table style="padding:10px">
<?php
$sql = "SELECT distinct title from survey_questions where survey_section_id=4 and survey_type_id=2 order by title";
$result0 = $conn1->query($sql);

while($row0 = $result0->fetch_assoc()) {

$a++;
if (($a % 2) === 1){
echo "<tr><td style='padding:10px'>";
}
else
{
echo "<td style='padding:10px'>";
}
?>
<?php echo $row0['title']?>
    <table id="responders" class="cell-border stripe" style="font-size:12px; padding:5px; width:450px">
        <thead>
              
                <?php
                $i=0;
                $lasttitle='';
                //Get delivery

                $sql = "SELECT survey_questions_id, title, header from survey_questions where survey_section_id=4 and survey_type_id=2 and title='" . $row0['title'] . "'";
             
                $result = $conn1->query($sql);
                $array_questions_id = [];


                while($row = $result->fetch_assoc()) {
                  if ($row['title']!=$lasttitle) {
                    $bgcolor=mt_rand(150, 255);
                    $titlecolor="rgb(" . $bgcolor . "," . $bgcolor . "," . $bgcolor . ")";
                  }
                  if ($i==0) echo "<tr><th style='width:150px'>Individual</th>";
                  ?>
                  <th style='background-color:<?php echo $titlecolor?>; width:100px'><?php echo $row['header']?></th>
                  <?php
                  $array_questions_id[]=$row['survey_questions_id'];
                  $i++;
                  $lasttitle = $row['title'];
                }
                ?>
            </tr>
        </thead>
        <tbody>
          <?php
          //Get all Responders again
    $sql = "SELECT name,survey_responders_id from survey_responders where survey_id=" . $survey_id;
    $result2 = $conn1->query($sql);

  $columnArray=[];
   for ($x = 0; $x <= 2; $x++) {
          $columnArray[$x][1]=0;
          $columnArray[$x][2]=0;
          $columnArray[$x][3]=0;
          $columnArray[$x][4]=0;
          $columnArray[$x][5]=0;
          $columnArray[$x][6]=0;
        } 

    while($row2 = $result2->fetch_assoc()) {

       if ($row2['survey_responders_id']==$survey_responders_id){
            $selfbg="yellow";
        }
        else{
          $selfbg="";
        }
      ?>
          <tr>
            <td style="background-color: <?php echo $selfbg?>"><?php echo $row2['name'];?></td>
    <?php
     $columnNumber=0;
   


    foreach ($array_questions_id as $survey_questions_id) {
  
      //echo "SET TO 0<br>";


      // Get responses from This Responder on this survee
      $sql = "SELECT  response from survey_responses where survey_questions_id = " . $survey_questions_id . " and survey_responders_id=" . $row2['survey_responders_id'] . " and survey_boardmembers_id = " . $survey_responders_id;

      $result = $conn1->query($sql);

      // output data of each row
      while($row3 = $result->fetch_assoc()) {

        if ($row3['response']==1)
          $columnArray[$columnNumber][1]++;
        if ($row3['response']==2)
          $columnArray[$columnNumber][2]++;
        if ($row3['response']==3)
          $columnArray[$columnNumber][3]++;
        if ($row3['response']==4)
          $columnArray[$columnNumber][4]++;
        if ($row3['response']==5)
          $columnArray[$columnNumber][5]++;
        if ($row3['response']==6)
          $columnArray[$columnNumber][6]++;

       if ($row2['survey_responders_id']==$survey_responders_id){
          $selfresponse[$columnNumber]=$row3['response'];
       }
        ?>
        <td bgcolor="<?php echo $selfbg?>">
          <?php //echo "column:" . $columnNumber;?> 
          <?php 
              if ($row3['response']==1)
                echo "Insufficient";
              if ($row3['response']==2)
                echo "Could Have More";
              if ($row3['response']==3)
                echo "On Target";
              if ($row3['response']==4)
                echo "More Than Enough";
              if ($row3['response']==5)
                echo "Too Much";
              if ($row3['response']==6)
                echo "Can't Rate Clearly";
          ?>
        </td>
        <?php
        //die();
        }
        $columnNumber++;
    }
      ?>
          </tr>
          <?
          
        }


        // Use Collected Arrays
        echo "<tr style='background-color:#eee'>";
        echo "<td>Insufficient</td>";
        for ($x = 0; $x <= 2; $x++) {
          echo "<td style='background-color:" . ($selfresponse[$x]==1 ? 'yellow' : '') . "'>" . $columnArray[$x][1] . "</td>";
        }
        echo "</tr>";
        echo "<tr style='background-color:#eee'>";
        echo "<td>Could Have More</td>";
        for ($x = 0; $x <= 2; $x++) {
          echo "<td style='background-color:" . ($selfresponse[$x]==2 ? 'yellow' : '') . "'>" . $columnArray[$x][2] . "</td>";
        }
        echo "</tr>";
        echo "<tr style='background-color:#eee'>";
        echo "<td>On Target</td>";
        for ($x = 0; $x <= 2; $x++) {
          echo "<td style='background-color:" . ($selfresponse[$x]==3 ? 'yellow' : '') . "'>" . $columnArray[$x][3] . "</td>";
        }
        echo "</tr>";
        echo "<tr style='background-color:#eee'>";
        echo "<td>More Than Enough</td>";
        for ($x = 0; $x <= 2; $x++) {
          echo "<td style='background-color:" . ($selfresponse[$x]==4 ? 'yellow' : '') . "'>" . $columnArray[$x][4] . "</td>";
        }
        echo "</tr>";
        echo "<tr style='background-color:#eee'>";
        echo "<td>Too Much</td>";
        for ($x = 0; $x <= 2; $x++) {
          echo "<td style='background-color:" . ($selfresponse[$x]==5 ? 'yellow' : '') . "'>" . $columnArray[$x][5] . "</td>";
        }
        echo "</tr>";
        echo "<tr style='background-color:#eee'>";
        echo "<td>Can't Rate Clearly</td>";
        for ($x = 0; $x <= 2; $x++) {
          echo "<td style='background-color:" . ($selfresponse[$x]==6 ? 'yellow' : '') . "'>" . $columnArray[$x][6] . "</td>";
        }
        echo "</tr>";


        for ($x = 0; $x <= 2; $x++) {
          $columnArray[$x][1]=0;
          $columnArray[$x][2]=0;
          $columnArray[$x][3]=0;
          $columnArray[$x][4]=0;
          $columnArray[$x][5]=0;
          $columnArray[$x][6]=0;
        } 
        ?>
        </tbody>
      </table>

<?php
if (($a % 2) === 1){
echo "</td>";
}
else
{
echo "</td></tr>";
}
?>


      <?php

    }
    if (($a % 2) === 1) echo "</tr>";
  echo "</table>";
}
die();
}
}
die();
?>

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
<div class="container-fluid">
  <a href="admin.php"><img src="https://keysurvey.inventivetalentreviews.com/img/its_logo2.png" style="width:300px"></a>
<br/><br/>
  <a href="admin.php" class="btn btn-primary" >Back to Admin</a>
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
                echo '<td><a class="btn btn-primary" href="admin_answers.php?survey_responders_id=' . $survey_responders_id . '&survey_id=' . $survey_id . '">View</a></td>';
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
}
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
