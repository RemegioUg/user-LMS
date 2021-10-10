<?php

function check_login($link)
{
  if(isset($_SESSION['Reg_No']))
  {
     $id = $_SESSION['Reg_No'];
     $query = "select * from student where Reg_No = '$id' limit 1" ;
     $result = mysqli_query($link, $query); 

     if($result && mysqli_num_rows($result)>0) 
     {
        $user_data = mysqli_fetch_assoc($result);
        return $user_data; 
     }
    
  }
   //redirect to login
   header("location: indexu.php");
   die; 
}