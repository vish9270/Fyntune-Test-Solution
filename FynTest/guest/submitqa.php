<?php

include("guest_dbconnection.php");

 if(isset($_POST['submit_test_btn'])){
    $guest_id = mysqli_real_escape_string($gcon, $_POST['guest_id']);
    $counter = mysqli_real_escape_string($gcon, $_POST['counter']);
    $no_of_que = mysqli_real_escape_string($gcon, $_POST['counter']);
    $g_score=0;
    $g_sucess=0;
    $g_wrong=0;
    
    while($counter!=0){
        $question_name=$_POST['question'.$counter.''];
        $correct_answer_name=$_POST['correct_answer'.$counter.''];
        $category_name=$_POST['category'.$counter.''];
        $difficulty_name=$_POST['difficulty'.$counter.''];
        $other_counter_name = $_POST['other_counter'.$counter.''];
        $given_answer_name=$_POST['answer'.$counter.''];
        
        $given_answer= mysqli_real_escape_string($gcon, $given_answer_name);
        $correct_answer= mysqli_real_escape_string($gcon, $correct_answer_name);
        $difficulty = mysqli_real_escape_string($gcon, $difficulty_name);
        $question = mysqli_real_escape_string($gcon, $question_name);
        $category = mysqli_real_escape_string($gcon, $category_name);
        //echo $given_answer."<br>";
        //echo $correct_answer."<br><br>";
        if($given_answer!=$correct_answer){
            $g_wrong++;
        }
        else{
            $g_sucess++;
        }

        $insert_question="Insert into questions (`gid`,`question`,`difficulty`,`category`) values ('$guest_id','$question','$difficulty','$category')";
        if(mysqli_query($gcon,$insert_question)){
           $qid= mysqli_insert_id($gcon);
         //  echo'question_insertion_sucesfull';
        }
        else{
            echo 'question_insertion_issue';
        }

        $insert_correct_answer="Insert into answers (`qid`,`answer`,is_correct) values ('$qid','$correct_answer',1)";
        if(mysqli_query($gcon,$insert_correct_answer)){
           // echo 'correct_answer_insertion_sucesfull';
        }
        else{
            echo 'correct_answer_insertion_issue';
        }


        $other_counter = mysqli_real_escape_string($gcon, $other_counter_name);
        while($other_counter!=-1){
        
            $other_answer=mysqli_real_escape_string($gcon, $_POST['other_answer'.$other_counter.$counter]);
            //echo 'other_answer'.$other_counter.$counter.':'.$other_answer.'<br>';
            $insert_answer="Insert into answers (`qid`,`answer`,is_correct) values ('$qid','$other_answer',0)";
            if(mysqli_query($gcon,$insert_answer)){
             //   echo'answer_insertion_sucesfull';
            }
            else{
                echo'answer_insertion_issue';
            }
             $other_counter--;
        }
        
     
        $counter--;
        
    }
    $timestamp=date("Y-m-d");
    $g_score=(($g_sucess/$no_of_que)*100);
    $update_guest_table="Update guest SET g_status=1, g_submitted='$timestamp', `g_score`='$g_score',g_sucess='$g_sucess',`g_wrong`='$g_wrong' WHERE `gid`='$guest_id'";
    if(mysqli_query($gcon,$update_guest_table)){?>
       
<!DOCTYPE html>
<html>
<title>Applicant's Score Card</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    .centered {
  position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}
</style>
<body>

<div class="w3-container">
 
  <div class="w3-card-4 centered" style="width:70%">
    <header class="w3-container w3-light-grey">
      <h3>Your Score Card</h3>
    </header>
    <div class="w3-container">
      <p>Congratulations..!!!!</p>
      <hr>
      
      <p>You Scored <?php echo $g_score;?>%  marks in this test.</p><br>
    </div>
    <button class="w3-button w3-block w3-dark-grey" >Thanks..!!!</button>
  </div>
 
</div>

</body>
</html>

<?php    }
    else{
        echo'guest_updation_failed';
    }
 }
 
 
 ?>