
 <?php
        //   define('DB_HOST','localhost');
        //   define('DB_USER','root');
        //   define('DB_PASS',"");
        //   define('DB_NAME','chary_project');

        //   $conn=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        //   if(mysqli_connect_error()){
        //     echo "Error";
        //     die();
        //   }
          ?>
<html>    
    <title>Registration</title>

<head>    

<style type="text/css">
    body  
{  
    margin: 0;  
    padding: 0;  
    background-color:#ffffff;
    font-family: 'Arial'; 

    
}  

button{
    float: right;  
    background-color: grey;
font-size: 50px;

}
.login{  
        width: 382px;  
        overflow: hidden;  
        margin: auto;  
        margin: 20 0 0 450px;  
        padding: 80px;  
        background: #003459;  
        border-radius: 15px ;  
          
}  

h1{
    text-align: center;  
    color: #277582;  
    padding: 20px;  
}

h2{  
    text-align: center;  
    color: #277582;  
    padding: 20px;  
}  
label{  
    color: #08ffd1;  
    font-size: 17px;  
}  
#Uname{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 3px;  
    padding-left: 8px;  
}  
#Pass{  
    width: 300px;  
    height: 30px;  
    border: none;  
    border-radius: 3px;  
    padding-left: 8px;  
      
}  
#log{  
    width: 30px;  
    height: 30px;  
    border: none;  
    border-radius: 17px;  
    padding-left: 7px;  
    color: blue;  
  
  
}  
span{  
    color: white;  
    font-size: 17px;  
}  
a{  
    float: right;  
    background-color: grey;  
   
}  

</style>

<h1>  WELCOME TO NURSERY AND PRIMARY SCHOOLS MAPPING SYSTEM</h1> 
        <title>   
        </title>    
       
</head>    
<body >    
    <h2>Make Registration</h2>  
    <div class="login">    
<form id="login" method="post" action="register1.php"> 

<label> <b>First Name</b></label><br>
<input type="text"  style="width: 50%; height:20px; border: 2px solid lightgreen;" id="n1" name="firstname"><br><br>

<label> <b>Last Name</b></label><br>
<input type="text"  style="width: 50%; height:20px; border: 2px solid lightgreen;"  name="lastname" id="n2"><br><br>
<label> <b> Birth Date</b></label><br>
<select   type="text"  style="width: 50%; height:20px; border: 2px solid lightgreen;" name="birth_date" id="n3"><option>1980</option>
<option>1981</option>
<option>1982</option>
<option>1983</option>
<option>1984</option>
<option>1985</option>
<option>1986</option>
<option>1987</option>
<option>1988</option>
<option>1989</option>
<option>1990</option>
<option>1991</option>
<option>1992</option>
<option>1993</option>
<option>1994</option>
<option>1995</option>
<option>1996</option>
<option>1997</option>
<option>1998</option>
<option>1999</option>
<option>2000</option>
<option>2001</option>
<option>2002</option></select><br><br>


<label> <b>Address (District/Sector)</b></label><br>
<input type="text"  style="width: 50%; height:20px; border: 2px solid lightgreen;" id="n1" name="address"><br><br>

    <label><b>Gender</b></label><br>
        <select   id="my_choice"   name="sex" style="width: 50%; height:20px; border: 2px solid lightgreen;" >
         <option value="Male" >Male</option>
         <option value="Female">Female</option>
          </select><br><br>


    <label><b>Telephone number</b></label><br>

     <input type="text" name="telephone"  id="tnumber"  style="width: 50%; height:20px; border: 2px solid lightgreen;" ><br><br>

    <label><b>Email</b></label><br>

     <input type="text" name="email"  id="email" style="width: 50%; height:20px; border: 2px solid lightgreen;" ><br><br>


 

    <label><b>Date of Registration:</b></label><br>

    <input type="date"  id="my_choice"  name="reg_date" style="width: 50%; height:20px; border: 2px solid lightgreen;"  ></p></i>

    <input type="submit" value="submit"  name="submit"> <br> <br>
    </form>  

         
          <?php
           if(isset($_POST['submit'])){
            $firstname=$_POST['firstname'];
            $lastname=$_POST['lastname'];
            $birth_date=$_POST['birth_date'];
            $address=$_POST['address'];
            $sex=$_POST['sex'];
            $telephone=$_POST['telephone'];
            $email=$_POST['email'];
            $reg_date=$_POST['reg_date'];           
         
         $querry="INSERT INTO `clients`(`firstname`,`lastname`,`birth_date`,`address`,`sex`,`telephone`,`email`,`reg_date`)
               VALUES('$firstname','$lastname','$birth_date','$address','$sex','$telephone','$email','$reg_date')";

               $result=$conn->query($querry);
               //if(isset($_POST['submit'])){
               if(!$result){
               echo mysqli_error($conn);
                exit;
               }else{
                  echo "Good"; 
                  
                }
                mysqli_close($conn);
               }
            
          ?>
</div>    
</body>    
</html>     