<?php
namespace Fun;

use Fun\CompareTheScores;
use Symfony\Component\VarDumper\VarDumper;

class CompareTheScores
{
    public $stud1FinalScore = 0;
    public $stud2FinalScore = 0;


    public function __construct()
    {

     $this->scoreCalculator();

    }
    //This function will take an array of Strings and convert each element to an Integer, insert each into a new array
    function FunArrayStrToInt(array $var){
      $newArray = array();
      for($count = 0;$count <= count($var) -1;$count++){

        $int_va = (int)$var[$count];
        $newArray[$count] = $int_va;

      }
      return $newArray;
    }

    // This function will take two Int arguments and test for equality
    //Returns < 0 if Int1 is less than Int2; > 0 if Int1 is greater than Int2, and 0 if they are equal.
    function  intcmp($a = 0, $b = 0){
        if($a == $b){
          $comp = 0;
        }elseif($a < $b){
          $comp = -1;
        }else{
          $comp = +1;
        }
        return $comp;
      }

    /*This method takase 2 sets of scores and compares them based on the following
    *Student A had 96 for the first assignment, and Student B had 94. 96 > 94, so Student A is assigned a point of "1"
    *Student A had 48 for the second assignment, and student B had 51. 48 < 51, so Student B is assigned a point of "1" (Student A gets "0")
    *Student A has 54 for the third assignment, and student B also has 54. 54 == 54, so neither student gets a mark, both gets "0"
    *Student A has 84 for the fourth assignment, and student B has 81. 84 > 81, so Student A gets "1" and student B gets "0"
    */
    public function scoreCalculator(){


      //Prompt User to enter scores for Student One
      echo "\n Please enter Student One's scores, with a space separating each score.\n For example 52 80 75 60 \n";
      $student1Scores = fgets(STDIN);

      //Prompt User to enter scores for Student Two
      echo "\n Please enter Student Two's scores, with a space separating each score.\n For example 52 80 75 60 \n";
      $student2Scores = fgets(STDIN);

      //Convert input strings(Scores for both Students) to Arrays of Strings using the empty string " " as a delimeter
      $std1ArrScores = explode(" ", $student1Scores);
      $std2ArrScores = explode(" ", $student2Scores);

      //conver Strings Arrays to Int Arrays
      $intStd1ArrScores = $this->FunArrayStrToInt($std1ArrScores);
      $intStd2ArrScores =  $this->FunArrayStrToInt($std2ArrScores);



      //check if the number of  scores entered for both Students are equal otherwise calculation will not proceed
      if(count($std1ArrScores) == count($std2ArrScores)){
        echo "\n Calculating Score....\n";

        //Calculate the score by looping through $std1ArrScores and comparing that with each score in $std2ArrScores
        for($i = 0;$i <= count($std1ArrScores) -1; $i++){

           $score = $this->intcmp($intStd1ArrScores[$i], $intStd2ArrScores[$i]);
           if($score > 0){
             $this->stud1FinalScore = $this->stud1FinalScore + 1;
           }elseif($score == -1){
             $this->stud2FinalScore = $this->stud2FinalScore + 1;
           }else{

            //Do nothing
           }

        }
        //Output Result of calculation stdout
        if($this->stud1FinalScore > $this->stud2FinalScore){
          echo "\n Student One Wins with a score of $this->stud1FinalScore vs Student Two with a score of $this->stud2FinalScore\n";
        }elseif($this->stud2FinalScore > $this->stud1FinalScore){
          echo "\nStudent Two Wins with a score of $this->stud2FinalScore vs  Student One with a score of $this->stud1FinalScore\n";
        }else{
          echo "\n Its a Draw!!!\n";
        }

      }else{
        echo "Please re-run the Score Calculator with the same number of scores for both Students!";
      }
    }
}
