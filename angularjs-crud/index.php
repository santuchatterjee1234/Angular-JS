<!DOCTYPE html>  
 <!-- index.php !-->  
 <html>  
      <head>  
           <title>AngularJS with PHP</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>  
      </head>  
      <body>  
           <br /><br />  
           <div class="container" style="width:500px;">  
                <h3 align="center">AngularJS with PHP</h3>  
                <div ng-app="myapp" ng-controller="usercontroller" ng-init="displayData()">  
                     <label>First Name</label>  
                     <input type="text" name="first_name" ng-model="firstname" class="form-control" />  
                     <br />  
                     <label>Last Name</label>  
                     <input type="text" name="last_name" ng-model="lastname" class="form-control" />  
                     <br />  
                     <label>Emai</label>  
                     <input type="email" name="email" ng-model="email" class="form-control" />  
                     <br /> 
                     <label>Password</label>  
                     <input type="password" name="password" ng-model="password" class="form-control" />  
                     <br /> 
                     <input type="hidden" ng-model="id" />  
                     <input type="submit" name="btnInsert" class="btn btn-info" ng-click="insertData()" value="{{btnName}}"/>  
                     <br /><br />  
                     <div class="form-group">
                        <div class="input-group">
                         <span class="input-group-addon">Search</span>
                         <input type="text" name="search_query" ng-model="search_query" ng-keyup="displayData()" placeholder="Search by Customer Details" class="form-control" />
                        </div>
                       </div>
                       <br />
                     <table class="table table-bordered">  
                          <tr>  
                               <th>First Name</th>  
                               <th>Last Name</th>  
                               <th>Email</th>
                               <th>Update</th>  
                               <th>Delete</th>  
                          </tr>  
                          <tr ng-repeat="x in names" ng-clock>  
                               <td>{{x.first_name}}</td>  
                               <td>{{x.last_name}}</td>  
                               <td>{{x.email}}</td>  
                               <td><button ng-click="updateData(x.id, x.first_name, x.last_name, x.email, x.password)" class="btn btn-info btn-xs">Update</button></td>  
                               <td><button ng-click="deleteData(x.id )"class="btn btn-danger btn-xs">Delete</button></td>  
                          </tr>  
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 const app = angular.module("myapp",[]);  
 app.controller("usercontroller", function($scope, $http){  
      $scope.btnName = "ADD";  
      //Insert Data
      $scope.insertData = function(){  
           if($scope.firstname == null)  
           {  
                alert("First Name is required");  
           }  
           else if($scope.lastname == null)  
           {  
                alert("Last Name is required");  
           }  
           else if($scope.email == null)  
           {  
                alert("Email Id is required");  
           } 
             else if($scope.password == null)  
           {  
                alert("Password is required");  
           } 
           else  
           {  
                $http.post(  
                     "insert.php",  
                     {'firstname':$scope.firstname, 'lastname':$scope.lastname, 'email':$scope.email, 'password':$scope.password, 'btnName':$scope.btnName, 'id':$scope.id}  
                ).success(function(data){  
                     alert(data);  
                     $scope.firstname = null;  
                     $scope.lastname = null; 
                     $scope.email = null;
                     $scope.password = null; 
                     $scope.btnName = "ADD";  
                     $scope.displayData();  
                });  
           }  
      }  
      //Select Data
      // $scope.displayData = function(){  
      //      $http.get("select.php")  
      //      .success(function(data){  
      //           $scope.names = data;  
      //      });  
      // }

       $scope.displayData = function(){
       $http({
        method:"POST",
        url:"select.php",
        data:{search_query:$scope.search_query}
       }).success(function(data){
        $scope.names = data;
       });
      };

      //Update Data
      $scope.updateData = function(id, first_name, last_name, email, password){  
           $scope.id = id;  
           $scope.firstname = first_name;  
           $scope.lastname = last_name;  
           $scope.email = email;
           $scope.password = password;
           $scope.btnName = "Update";  
      }  

      //Delete Data

       $scope.deleteData = function(id){  
      if(confirm("Are you sure you want to delete this data?"))  
      {  
           $http.post("delete.php", {'id':id})  
           .success(function(data){  
                alert(data);  
                $scope.displayData();  
           });  
      }  
      else  
      {  
           return false;  
      }  
 } 
 });  
 </script>  