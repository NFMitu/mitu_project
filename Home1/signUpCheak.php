<?php
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $national_id = trim($_POST['national_id']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    if (empty($firstname)) {
        $errors[] = 'First name is required';
    }

    if (empty($lastname)) {
        $errors[] = 'Last name is required';
    }

    if (empty($username)) {
        $errors[] = 'Username is required';
    }

    if (empty($national_id)) {
        $errors[] = 'National ID is required';
    }

    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }

    if (empty($phone)) {
        $errors[] = 'Phone number is required';
    } elseif (!preg_match('/^[0-9]{10}+$/', $phone)) {
        $errors[] = 'Invalid phone number format. It should contain 10 digits.';
    }

    if (empty($password)) {
        $errors[] = 'Password is required';
    } elseif (strlen($password) < 8) {
        $errors[] = 'Password should be at least 8 characters long';
    }
}

?>


<?php 
        $connnection = mysqli_connect('localhost','root','','investor-seeker-db');
        if(isset($_REQUEST['submit'])){ 
        $fname=mysqli_real_escape_string($connnection,$_REQUEST['firstname']);
        $lname=mysqli_real_escape_string($connnection,$_REQUEST['lastname']);
        $usnm=mysqli_real_escape_string($connnection,$_REQUEST['username']);
        $nid=mysqli_real_escape_string($connnection,$_REQUEST['nid']);
        $eml=mysqli_real_escape_string($connnection,$_REQUEST['email']);
        $password=mysqli_real_escape_string($connnection,md5($_REQUEST['password']));

        $fullname=$fname.$lname;
       


        

   $picture=$_FILES['profile_picture'];
   $pname=$picture['name'];
   $tmp_name=$picture['tmp_name'];
   

     $name_changer=uniqid().".png";


     $queryy="SELECT username FROM `entrepreneur-reg-table` WHERE username='$usnm'";
     $res=mysqli_query($connnection,$queryy) or die("Query faild.");

     $cnt=mysqli_num_rows($res);

     if($cnt>0){
      echo "Username already exist";
     }else{

     
   
   if(!empty($name)){
   
       $locat='en_profile/';
   
       if(move_uploaded_file($tmp_name,$locat.$name_changer)){
   
   
       }else{
           echo 'upload failed';
       }
       
     }else{
       echo 'file not found';
        }


     

        // require "../Admin/includes/configure.php";

        $connnection = mysqli_connect('localhost','root','','investor-seeker-db');
            if(!$connnection){
        
         die("not connected".mysqli_error());
    }else{

    $sqlin= "INSERT INTO `entrepreneur-reg-table1` (`profile_photo`, `name`, `username`, `nid`, `email`, `password`) VALUES ('$name_changer', '$fullname', '$usnm', '$nid', '$eml', '$password')";
    
    $result=mysqli_query($connnection,$sqlin);

   
    if($result){
       header("location:signupForm.php?inserted");
    }else{
        echo "not inserted";

        header("location:signUpCheak.php?notinserted");
    }
    
   }

     }

    }

    ?>