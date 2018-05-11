<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 11/15/17
 * Time: 11:20 PM
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('conn.php');

function sendinvites($survey_id,$emailtype){


    global $conn;
    $survey_id = filter_var($survey_id, FILTER_SANITIZE_NUMBER_INT);

    if ($emailtype=='reminder'){
        // Just send reminder to people that HAVEN'T RECIEVED
        $sql = "SELECT * FROM survey_responders WHERE survey_id = " . $survey_id . " and completed is NULL";
    }
    else{
        $sql = "SELECT * FROM survey_responders WHERE survey_id = " . $survey_id ;
    }

    $result = $conn->query($sql);
    

    while ($row = $result->fetch_assoc()) {

        $name=$row['name'];
        $email = $row['email'];

        $responderkey=$row['responderkey'];
        $day30=date('m/d/Y', strtotime("+14 days"));

        $sql = "SELECT survey_type_id,completebydate,workshopdate FROM survey WHERE survey_id = " . $survey_id;
        $resultx = $conn->query($sql);


        while ($rowx = $resultx->fetch_assoc()) {
            $completebydate = date_format(date_create($rowx['completebydate']),"F jS");
            $workshopdate = date_format(date_create($rowx['workshopdate']),"F jS");
            $survey_type_id = $rowx['survey_type_id'];
    
            if ($survey_type_id==1){

            $subject = "Survey of Board Effectiveness Personal Invitation";
            $emailstr = "<div class=\"email\" style=\"font-family:verdana; color:#333333\">
            Dear $name,<br /><br /> You are invited to complete the Inventive Talent Survey&trade; of Board Effectiveness. Please follow the instructions and complete the assessment by $completebydate. The link below is unique to you. Please do not forward or share the link. Survey data are confidential and secure. Data will be aggregated for review. Your individual responses will not be shared or seen by others.<br/><br /><br />
            <center>Your personal survey link: <a href=\"https://keysurvey.inventivetalentreviews.com/?key=$responderkey\">$responderkey</a></center> <br/><br/>
            Thank you for your participation.<br/><img src=\"https://keysurvey.inventivetalentreviews.com/img/itr_logo_email.png\" style=\"margin-top:8px\"><br/><br/>
            If you have questions or require support, please contact Inventive Talent: techsupport@inventivetalent.com
            </div>";
            }
            elseif ($emailtype=='initial' && $survey_type_id==2){
            $subject = "Personal Invitation for $name to complete Survey of Team Effectiveness";
            $emailstr = "<div class=\"email\" style=\"font-family:verdana; color:#333333\">
            Dear $name,<br /><br />On $workshopdate your team will participate in a Team Development Workshop.  During the workshop, we will review the results of the Inventive Talent Survey<sup>&trade;</sup> of Team Effectiveness which can be completed by clicking on the link below.  It is important that you and all team members complete the survey by $completebydate.  It should take less than 30 minutes of your time.  The link below is unique to you.  Please do not forward or share the link. Survey data are confidential and secure.  Data will be aggregated for review. Your individual responses will not be shared or seen by others.  Please answer all questions candidly and complete the survey by $completebydate.<br/><br /><br />
            <center>
            Your personal survey link: <a href=\"https://keysurvey.inventivetalentreviews.com/?key=$responderkey\">$responderkey</a></center> <br/><br/>
            Thank you for contributing to a great workshop.
            <br/><br/>
            Sincerely,<br/>
            Kim E. Ruyle<br/><img src=\"https://keysurvey.inventivetalentreviews.com/img/itr_logo_email.png\" style=\"margin-top:8px\"><br/><br/>
            If you have questions or require support, please contact Inventive Talent: techsupport@inventivetalent.com
            </div>";
            }
            elseif ($emailtype=='reminder' && $survey_type_id==2){
            $subject = "REMINDER – Please complete Survey of Team Effectiveness";
            $emailstr = "<div class=\"email\" style=\"font-family:verdana; color:#333333\">
            Dear $name,<br /><br />On $workshopdate your team will participate in a Team Development Workshop.  During the workshop, we will review the results of the Inventive Talent Survey<sup>&trade;</sup> of Team Effectiveness which can be completed by clicking on the link below.  It is important that you and all team members complete the survey by $completebydate.  It should take less than 30 minutes of your time.  The link below is unique to you.  Please do not forward or share the link. Survey data are confidential and secure.  Data will be aggregated for review. Your individual responses will not be shared or seen by others.  Please answer all questions candidly and complete the survey by $completebydate.<br/><br /><br />
            <center>
            Your personal survey link: <a href=\"https://keysurvey.inventivetalentreviews.com/?key=$responderkey\">$responderkey</a></center> <br/><br/>
            Thank you for contributing to a great workshop.
            <br/><br/>
            Sincerely,<br/>
            Kim E. Ruyle<br/><img src=\"https://keysurvey.inventivetalentreviews.com/img/itr_logo_email.png\" style=\"margin-top:8px\"><br/><br/>
            If you have questions or require support, please contact Inventive Talent: techsupport@inventivetalent.com
            </div>"; 
            }


            $headers = "From: info@inventivetalent.com" . "\r\n";
            $headers .= "Reply-To: info@inventivetalent.com" . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";


            if(mail($email,$subject,$emailstr,$headers)){
                echo "<br/>Message sent to: " . $email;
            }
            else
            {
                echo "Error: Message not accepted: " . $email;
            }

        }
    }
}
?>
<h3>Send Survey</h3>
<?php
if (!isset($_REQUEST['survey_id'])){
?>
<form action="mailhandler.php" method="post">
    <input type="number" name="survey_id" value=""><br/><br/>
    <select name="emailtype">
        <option value="initial">Initial</option>
        <option value="reminder">Reminder For Unfinished</option>
    </select><br/><br/>
    <input type="submit" value="Send Emails">
</form>
<?php
}
else
{
    $survey_id = filter_var($_REQUEST['survey_id'], FILTER_SANITIZE_NUMBER_INT);
    $emailtype = (isset($_REQUEST['emailtype'])) ? $_REQUEST['emailtype'] : 'reminder';
    sendinvites($survey_id,$emailtype);
}

