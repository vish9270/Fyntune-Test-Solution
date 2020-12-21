<?php 
 if($_GET['testQualifier']==1){
   
$guest_id=$_GET['id'];

function generateMCQ(){
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://opentdb.com/api.php?amount=10');
curl_setopt( $ch,CURLOPT_POST, 1 );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, 1 );
$result = curl_exec($ch);
curl_close( $ch );
return $result;
}

$result=generateMCQ();

//echo 'Encoded Json: '.$result."<br>";
//echo "<br>";
$decode=json_decode($result,true);
$responseMessage=$decode['response_code'];
//print_r($decode);
if($responseMessage!=0)
{
    header("Location: index.php?id=3");
}
else
    { ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php';?>
<body style="background-color: #fff; padding-bottom: 40px;">
<div class="jumbotron jumbotron-fluid jum">
  <div class="container">
    <h1 class="display-4">Test Your Knowledge...!!!</h1>
<p class="lead">
  <ul> 
    <li>This a modified testing scenarios, answer all the question below to test your skills.</li>
    <li>Each question are of 10 marks.</li>
    <li>You have to attempt all questions to see your score card.</li>
    <li>Your score card will be shown at the end of the test.</li>
  </ul></p>
  </div>
</div>

    <div class="container">
    <div class="row">
                <div class="col-lg-12">
                <form action="submitqa.php" method="post" name="test_form">
                    <?php
                     $i=1;
                    foreach ($decode['results'] as $value) {
                      ?>
                    <div class="panel panel-default">
                       <div class="panel-heading">
                         <?php echo 'Q'.$i;?>. <?php echo $value['question'];?>
                          <span class="badge bg-success"><?php echo $value['difficulty'];?></span>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                     <div class="form-group">

                                     <?php 
                                     $j=0;
                                     foreach ($value['incorrect_answers'] as $answer) {
                                      echo '<input type="hidden" name="other_answer'.$j.$i.'" value="'.$answer.'">'; //other answer value
                                     
                                      echo '<div class="radio">
                                        <label>
                                             <input type="radio" name="answer'.$i.'" value="'.$answer.'" id="optionsRadios'.$i.'" required>'.$answer.'
                                        </label>
                                      </div>';
                                      echo '<input type="hidden" name="other_counter'.$i.'" value="'.$j.'">';//internal counters
                                  
                                      $j++;
                                     
                                     }
                                     echo '<div class="radio">
                                     <label>
                                          <input type="radio" name="answer'.$i.'" id="optionsRadios1" value="'.$value['correct_answer'].'" required>'.$value['correct_answer'].'
                                    </label>
                                 </div>';
                                     ?>
                                     </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            
                            </div>
                            <!-- /.row (nested) -->
                            <div class="alert alert-success alert-dismissable">
                                <strong>Category:</strong> <?php echo $value['category'];?>
                                </div>
                        </div>
                        <!-- /.panel-body -->
                     </div>
                    <!-- /.panel -->
                    <?php 
                    echo '
                          <input type="hidden" name="difficulty'.$i.'" value="'.$value['difficulty'].'">
                          <input type="hidden" name="correct_answer'.$i.'" value="'.$value['correct_answer'].'">
                          <input type="hidden" name="question'.$i.'" value="'.$value['question'].'">
                          <input type="hidden" name="category'.$i.'" value="'.$value['category'].'">
                          <input type="hidden" name="counter" value="'.$i.'">

                    ';
                    
                    
                    $i++;
                  }?>
                                
                    <input type="hidden" name="guest_id" value="<?php echo $guest_id; ?>">
                    <button type="submit" class="btn btn-success" name="submit_test_btn">Submit Test</button>

                   
                    </form>
                        <!-- /form -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
    </div>
</body>
</html>
    <?php }
  }
  else{
    header("Location: index.php?id=2");
  }?>