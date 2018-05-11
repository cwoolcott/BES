<?php
include_once('conn.php');



// User
function getlogin($key){
    $userinfo = false;
    global $conn;
    // Board Members

    /* create a prepared statement */
    if ($stmt = $conn->prepare("SELECT survey_responders.survey_responders_id,survey_responders.survey_id,email,completed,survey_name,survey_type_id FROM survey_responders inner join survey on survey.survey_id=survey_responders.survey_id WHERE responderkey = ?")) {

        /* bind parameters for markers */
        $stmt->bind_param("s", $key);

        /* execute query */
        $stmt->execute();

        /* bind result variables */
        $stmt->bind_result($survey_responders_id,$survey_id,$email,$completed,$survey_name,$survey_type_id);

        /* fetch values */
        $stmt->fetch();

        /* close statement */
        $stmt->close();

        $userinfo[]= [
            'survey_responders_id' => $survey_responders_id,
            'survey_id' => $survey_id,
            'email' => $email,
            'completed' => $completed,
            'survey_name' => $survey_name,
            'survey_type_id' => $survey_type_id
        ];
    }
    else{
        echo "no results";
    }

    if (!$survey_responders_id){$userinfo = 0;}
    return $userinfo[0];

}

function surveyLog($status, $survey_responders_id){

    global $conn;
    $sql = "SELECT * FROM survey_responders  WHERE survey_responders_id = " . $survey_responders_id;
    $result = $conn->query($sql);

    $row = mysqli_fetch_assoc($result);
    
    if (strtotime($row[$status])<0 || $row[$status] == null || $row[$status] == '') {
        //Update only if date hasn't been set
        $sql = 'update survey_responders set ' . $status . ' = "' . date("Y-m-d H:i:s") . '" where survey_responders_id=' . $survey_responders_id;
        $conn->query($sql);
    }
}

function sectionInfo($survey_section_id, $survey_type_id){

    global $conn;
    // Survey Type Info
    $sql = "SELECT survey_section_title, survey_section_opening,survey_section_header FROM survey_section 
            WHERE survey_section_id = '" . $survey_section_id . "' and survey_type_id = '" . $survey_type_id . "'";

    $result = $conn->query($sql);

    $surveysectionarray = false;

    if ($result) {
        while ($surveysection = $result->fetch_assoc()) {

            $surveysectionarray = [
                'survey_section_title' => $surveysection['survey_section_title'],
                'survey_section_opening' => $surveysection['survey_section_opening'],
                'survey_section_header' => $surveysection['survey_section_header'],
            ];

        }
        return $surveysectionarray;
    }
    else{

        return false;
    }
    
}

// Survey Type Info
$sql = "SELECT survey_type.survey_type_id, survey_type_name, survey_type_logo,survey_type_opening FROM survey_type 
        inner join survey on survey_type.survey_type_id = survey.survey_type_id
        WHERE survey_id = " . getlogin(isset($_REQUEST['key']) ? $_REQUEST['key'] : '0')['survey_id'];

$result = $conn->query($sql);


if ($result) {
    while ($surveytype = $result->fetch_assoc()) {

        $surveytypearray = [
            'survey_type_id' => $surveytype['survey_type_id'],
            'survey_type_name' => $surveytype['survey_type_name'],
            'survey_type_logo' => $surveytype['survey_type_logo'],
            'survey_type_opening' => $surveytype['survey_type_opening']
        ];

    }
}

// Board Members
$sql = "SELECT survey_responders_id,name FROM survey_responders 
        WHERE survey_id = " . getlogin(isset($_REQUEST['key']) ? $_REQUEST['key'] : '0')['survey_id'] . "
        order by sortorder";


$result = $conn->query($sql);


if ($result) {
    while ($boardmembers = $result->fetch_assoc()) {

        $boardmembersarray[] = [
            'survey_responders_id' => $boardmembers['survey_responders_id'],
            'name' => $boardmembers['name']
        ];

    }
}

// Section 1
$sql = "SELECT * FROM survey_questions WHERE survey_section_id = 1 and survey_type_id=" . $surveytypearray['survey_type_id'] . " order by sortorder";
$result = $conn->query($sql);


while ($question = $result->fetch_assoc()) {

    $surveyarray[] = [
        'survey_questions_id' => $question['survey_questions_id'],
        'title' => $question['title'],
        'description' => $question['description']

    ];
}

// Section 2
$sql = "SELECT * FROM survey_questions 
        WHERE survey_section_id = 2 
        and survey_type_id=" . $surveytypearray['survey_type_id'] . "
        order by sortorder";
$result = $conn->query($sql);

while ($question = $result->fetch_assoc()) {

    $surveyarray2[] = [
        'survey_questions_id' => $question['survey_questions_id'],
        'header' => $question['header'],
        'title' => $question['title'],
        'description' => $question['description']
    ];
}

// Section 3
$sql = "SELECT * FROM survey_questions 
        WHERE survey_section_id = 3 
        and survey_type_id=" . $surveytypearray['survey_type_id'] . "
        order by sortorder";
$result = $conn->query($sql);

while ($question = $result->fetch_assoc()) {

    $surveyarray3[] = [
        'survey_questions_id' => $question['survey_questions_id'],
        'description' => $question['description']
    ];
}

// Section 4
$sql = "SELECT * FROM survey_questions 
        WHERE survey_section_id = 4  
        and survey_type_id=" . $surveytypearray['survey_type_id'] . "
        order by sortorder";
$result = $conn->query($sql);

while ($question = $result->fetch_assoc()) {

    $surveyarray4[] = [
        'survey_questions_id' => $question['survey_questions_id'],
        'header' => $question['header'],
        'title' => $question['title'],
        'description' => $question['description']
    ];
}

// Section 5
$sql = "SELECT * FROM survey_questions 
        WHERE survey_section_id = 5 
        and survey_type_id=" . $surveytypearray['survey_type_id'] . "
        order by sortorder, survey_questions_id";
$result = $conn->query($sql);

while ($question = $result->fetch_assoc()) {

    $surveyarray5[] = [
        'survey_questions_id' => $question['survey_questions_id'],
        'header' => $question['header'],
        'title' => $question['title'],
        'description' => $question['description']
    ];
}

// Section 6
$sql = "SELECT * FROM survey_questions 
        WHERE survey_section_id = 6 
        and survey_type_id=" . $surveytypearray['survey_type_id'] . "
        order by sortorder";
$result = $conn->query($sql);

while ($question = $result->fetch_assoc()) {
    $tempquestionsarray = array();

    $sql = "SELECT question FROM survey_questions_ext WHERE survey_questions_id =" . $question['survey_questions_id'];
    $result_questions = $conn->query($sql);

    while ($question_ext = $result_questions->fetch_assoc()) {
        $tempquestionsarray[] = $question_ext['question'];
    }

    $surveyarray6[] = [
        'survey_questions_id' => $question['survey_questions_id'],
        'title' => $question['title'],
        'description' => $question['description'],
        'questions' => $tempquestionsarray
    ];

}

