<?php

function radioBuild($survey_questions_id){
    global $str_radioBuild;
    ?>
    <div class="buttongroup">
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="1" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Insufficient</span>
        </label>
        <label for="option[<?php echo $survey_questions_id?>]"></label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="2" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Could Have More</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="3" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">On Target</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="4" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word"> More Than Enough</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="5" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Too Much</span>
        </label>
    </div>
    <?php
    $str_radioBuild .= "$(\"input[name='question[" . $survey_questions_id . "]'][value=\" + localStorage.getItem('question[" . $survey_questions_id . "]') + \"]\").attr('checked', 'checked');\n";
}

function radioBuild_type2($survey_questions_id){
    global $str_radioBuild_type2;
    ?>
    <div class="buttongroup">
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="1" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Strongly Disagree</span>
        </label>
        <label for="option[<?php echo $survey_questions_id?>]"></label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="2" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Disagree</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="3" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Neutral</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="4" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Agree</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="5" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Strongly Agree</span>
        </label>
    </div>
    <?php
    $str_radioBuild_type2 .= "$(\"input[name='question[" . $survey_questions_id . "]'][value=\" + localStorage.getItem('question[" . $survey_questions_id . "]') + \"]\").attr('checked', 'checked');\n";
}

function radioBuild_type2Capabilities($survey_questions_id){
    global $str_radioBuild_type2Capabilities;
    ?>
    <div class="buttongroup">
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="1" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Insufficient;</span>
        </label>
        <label for="option[<?php echo $survey_questions_id?>]"></label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="2" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Could Have More</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="3" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">On Target</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="4" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">More Than Enough</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="5" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Too Much</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="6" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Can't Rate Clearly</span>
        </label>
    </div>
    <?php
    $str_radioBuild_type2Capabilities .= "$(\"input[name='question[" . $survey_questions_id . "]'][value=\" + localStorage.getItem('question[" . $survey_questions_id . "]') + \"]\").attr('checked', 'checked');\n";
}


function radioBuild2($survey_questions_id){
    global $str_radioBuild2;
    ?>
    <div class="buttongroupthree">
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="1" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Insufficient</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="2" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">On Target</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="3" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">More Than Enough</span>
        </label>
    </div>
    <?php
    $str_radioBuild2 .= "$(\"input[name='question[" . $survey_questions_id . "]'][value=\" + localStorage.getItem('question[" . $survey_questions_id . "]') + \"]\").attr('checked', 'checked');\n";
}

function radioBuild5($survey_questions_id){
    global $str_radioBuild5;

    ?>
    <div class="buttongroup">
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="1" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Insufficient</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="2" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Could Have More</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="3" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">On Target</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="4" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word"> More Than Enough</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="question[<?php echo $survey_questions_id?>]" class="option" value="5" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Too Much</span>
        </label>
    </div>
    <?php
    $str_radioBuild5 .= "$(\"input[name='question[" . $survey_questions_id . "]'][value=\" + localStorage.getItem('question[" . $survey_questions_id . "]') + \"]\").attr('checked', 'checked');\n";

}

//pass though
function radioBuild7($survey_questions_id, $survey_responders_id){
    global $str_radioBuild7;

    ?>
    <div class="buttongroupseven">
        <label class="btn btn-default buying-selling">
            <input type="radio" name="questionboard[<?php echo $survey_questions_id?>][<?php echo $survey_responders_id?>]" class="textoption" value="1" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Insufficient</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="questionboard[<?php echo $survey_questions_id?>][<?php echo $survey_responders_id?>]" class="textoption" value="2" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Room for Development</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="questionboard[<?php echo $survey_questions_id?>][<?php echo $survey_responders_id?>]" class="textoption" value="3" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Proficient</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="questionboard[<?php echo $survey_questions_id?>][<?php echo $survey_responders_id?>]" class="textoption" value="4" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Exemplary</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="questionboard[<?php echo $survey_questions_id?>][<?php echo $survey_responders_id?>]" class="textoption" value="5" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Overuse</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="questionboard[<?php echo $survey_questions_id?>][<?php echo $survey_responders_id?>]" class="textoption" value="6" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Can't Rate Clearly</span>
        </label>
    </div>
    <?php
    $str_radioBuild7 .= "$(\"input[name='questionboard[" . $survey_questions_id . "][" . $survey_responders_id . "]'][value=\" + localStorage.getItem('questionboard[" . $survey_questions_id . "][" . $survey_responders_id . "]') + \"]\").attr('checked', 'checked');\n";
}

//pass though
function radioBuild7_type2($survey_questions_id, $survey_responders_id){
    global $str_radioBuild7_type2;

    ?>
    <div class="buttongroupseven">
        <label class="btn btn-default buying-selling">
            <input type="radio" name="questionboard[<?php echo $survey_questions_id?>][<?php echo $survey_responders_id?>]" class="textoption" value="1" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Insufficient</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="questionboard[<?php echo $survey_questions_id?>][<?php echo $survey_responders_id?>]" class="textoption" value="2" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Could Have More</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="questionboard[<?php echo $survey_questions_id?>][<?php echo $survey_responders_id?>]" class="textoption" value="3" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">On Target</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="questionboard[<?php echo $survey_questions_id?>][<?php echo $survey_responders_id?>]" class="textoption" value="4" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">More Than Enough</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="questionboard[<?php echo $survey_questions_id?>][<?php echo $survey_responders_id?>]" class="textoption" value="5" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Too Much</span>
        </label>
        <label class="btn btn-default buying-selling">
            <input type="radio" name="questionboard[<?php echo $survey_questions_id?>][<?php echo $survey_responders_id?>]" class="textoption" value="6" required autocomplete="off">
            <span class="radio-dot"></span>
            <span class="buying-selling-word">Can't Rate Clearly</span>
        </label>
    </div>
    <?php
    $str_radioBuild7_type2 .= "$(\"input[name='questionboard[" . $survey_questions_id . "][" . $survey_responders_id . "]'][value=\" + localStorage.getItem('questionboard[" . $survey_questions_id . "][" . $survey_responders_id . "]') + \"]\").attr('checked', 'checked');\n";
}


function viewStandard($survey, $showheader = false, $showfooter = false, $topheader=''){

if ($showfooter) {?>
    </div>
    </div>
<?php } ?>
<?php if ($showheader) {?>
<div class="step row">
    <div class="col-md-10">
        <h3 class="title" style="font-weight:bold"><?php echo $topheader;?></h3>
        <h3 class="steptitle" style="font-weight:bold"><?php echo $survey['header'];?></h3>
        <?php } ?>
        <div class="threechoice">
            <h4><?php echo $survey['title']?><?php echo $survey['description'];?></h4>
            <?php
            radioBuild2($survey['survey_questions_id']);
            ?>
        </div>
        <?php
        }

        function viewStandardEnd(){?>
    </div>
</div>
<?php } ?>
