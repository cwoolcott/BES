<?php

function getRespondersInfo($survey_responders_id){

//include_once('../conn.php');
global $conn;
if ($statement = $conn->prepare('SELECT name, email FROM survey_responders WHERE survey_responders_id = ?')) {
     $statement->bind_param('i', $survey_responders_id);
     $statement->execute();
     $statement->store_result();

     if ($statement->num_rows > 0) {
            $statement->bind_result( $response['name'], $response['email']);
            $statement->fetch();

     }
     return $response;
}
}

function getAnswerDetail($response,$survey_section_id){

$responsetext= $survey_section_id . ':' . $response;

if ($survey_section_id==1 || $survey_section_id==3 ){

  if ($response=='1')
    $responsetext='Insufficient';
  if ($response=='2')
    $responsetext='Could Have More';
  if ($response=='3')
    $responsetext='On Target';
  if ($response=='4')
    $responsetext='More Than Enough';
  if ($response=='5')
    $responsetext='Too Much';
}

if ($survey_section_id==2){

  if ($response=='1')
    $responsetext='Insufficient';
  if ($response=='2')
    $responsetext='On Target';
  if ($response=='3')
    $responsetext='More Than Enough';
}

if ($survey_section_id==4 || $survey_section_id==5){
  //For Each Board Member
  if ($response=='1')
    $responsetext='Insufficient';
  if ($response=='2')
    $responsetext='Room for Development';
  if ($response=='3')
    $responsetext='Proficient';
  if ($response=='4')
    $responsetext='Exemplary';
  if ($response=='5')
    $responsetext='Overuse';
  if ($response=='6')
    $responsetext='Can\'t Rate Clearly';
}

return $responsetext;
}
?>