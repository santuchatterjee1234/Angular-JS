<?php  
 //delete.php  
 $connect = mysqli_connect("localhost", "root", "", "php");  
 $data = json_decode(file_get_contents("php://input"));  
 if($data)  
 {  
      $id = $data->id;  
      $query = "DELETE FROM tbl_user WHERE id='$id'";  
      if(mysqli_query($connect, $query))  
      {  
           echo 'Data Deleted';  
      }  
      else  
      {  
           echo 'Error';  
      }  
 }  
 ?>  