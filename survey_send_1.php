<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_POST['key'])){
    header('HTTP/1.0 403 Forbidden');
    echo 'You have do not have access to this page.';
    die();
}


include_once('functions.php');
include_once('surveydata.php');

$survey_responders_id = filter_var($_POST['survey_responders_id'], FILTER_SANITIZE_NUMBER_INT);

surveyLog('completed', $survey_responders_id);

?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<html lang="en">
<!--<![endif]-->
<head>

<!-- Basic Page Needs -->
<meta charset="utf-8">
<title>Survey Responsive Template</title>
<meta name="description" content="">
<meta name="author" content="Ansonika">

<!-- Favicons-->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<!-- Google web font -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- HTML5 and CSS3-in older browsers-->
<script src="js/modernizr.custom.17475.js"></script>

<!-- Support media queries for IE8 -->
<script src="js/respond.min.js"></script>

<!--[if IE 7]>
  <link rel="stylesheet" href="font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<script type="text/javascript">
function delayedRedirect(){
   // window.location = "index.html"
}
</script>

</head>
<body onLoad="setTimeout('delayedRedirect()', 5000)">

<?php
if (!isset($_SESSION['completed']) || !$_SESSION['completed']){


    foreach ($_POST['question'] as $survey_questions_id => $response) {
        $sql = "insert into survey_responses (survey_responders_id, survey_questions_id, response) 
              values ($survey_responders_id,$survey_questions_id,$response)";
        $conn->query($sql);
    }


    foreach ($_POST['questionboard'] as $survey_questions_id => $value) {
        foreach ($value as $survey_boardmembers_id => $response){
            $sql = "insert into survey_responses (survey_responders_id, survey_questions_id, response, survey_boardmembers_id) 
              values ($survey_responders_id,$survey_questions_id,$response, $survey_boardmembers_id)";
            $conn->query($sql);
        }
    }

/*
	$mail = $_POST['email'];
	mail($user,$usersubject,$usermessage,$userheaders);
*/

    $_SESSION['completed'] = true;
}

?>

<!-- END SEND MAIL SCRIPT -->   
<div class="container">
<div class="row">
        <div class=" col-md-12" style="text-align:center; padding-top:80px;">
         	<h1 style="color:#333">Thank you!</h1>
          <h3 style="color: #6C3">Survey Successfully Submitted.</h3>
        </div>
</div>
</div>
<script>
    localStorage.clear();
</script>
</body>
</html>