<?php  
 //insert.php  
 $connect = mysqli_connect("localhost", "root", "", "php");  
 $data = json_decode(file_get_contents("php://input"));  
 if($data)  
 {  
      $first_name = mysqli_real_escape_string($connect, $data->firstname);       
      $last_name = mysqli_real_escape_string($connect, $data->lastname);  
      $email = mysqli_real_escape_string($connect, $data->email);
      $password = mysqli_real_escape_string($connect, $data->password);
      $btn_name = $data->btnName;  
      if($btn_name == "ADD")  
      {  
           $query = "INSERT INTO tbl_user(first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";  
           if(mysqli_query($connect, $query))  
           {  
                echo "Data Inserted...";  
           }  
           else  
           {  
                echo 'Error';  
           }  
      }  
      if($btn_name == 'Update')  
      {  
           $id = $data->id;  
           $query = "UPDATE tbl_user SET first_name = '$first_name', last_name = '$last_name', email = '$email', password = '$password'  WHERE id = '$id'";  
           if(mysqli_query($connect, $query))  
           {  
                echo 'Data Updated...';  
           }  
           else  
           {  
                echo 'Error';  
           }  
      }  
 }  
 ?>  