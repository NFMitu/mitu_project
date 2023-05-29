


<!DOCTYPE html>
<html>
<head>
    <title>Animated Signup Form</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <img class="wave" src="img/wave.png">
    <div class="container">
        <div class="img">
            <img src="img/register.svg">
        </div>
        <div class="login-content">


            <form action="" method="post" enctype="multipart/form-data">
                
                <h2 class="title">Signup</h2>
                <div class="input-div one">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        <h5>Firstname</h5>
                        <input type="text" class="input" name="firstname" value="<?php echo htmlspecialchars($firstname ?? ''); ?>">
                   </div>
                </div>



                <?php if (!empty($errors) && in_array('First name is required', $errors)): ?>
                    <span class="error">First name is required</span>
                <?php endif; ?>

                <div class="input-div two">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        <h5>Lastname</h5>
                        <input type="text" class="input" name="lastname" value="<?php echo htmlspecialchars($lastname ?? ''); ?>">
                   </div>
                </div>



                





                <div class="input-div three">
                <div class="i">
                  <i class="fas fa-user"></i>
                  </div>
                <div class="div">
                <h5>Username</h5>
                <input type="text" class="input" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>">
            </div>
                 </div>




               

             <div class="input-div four">
              <div class="i">
                <i class="fas fa-id-card"></i>
              </div>


            <div class="div">
                <h5>NID</h5>
                <input type="text" class="input" name="nid" value="<?php echo htmlspecialchars($nid ?? ''); ?>">
            </div>
      </div>


          







        <div class="input-div">
               <div class="i">
                    <i class="fas fa-envelope"></i>
               </div>
               <div class="div">
                    <h5>Email</h5>
                    <input type="email" class="input" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>">
               </div>
            </div>
            

            <div class="input-div">
               <div class="i">
                    <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                    <h5>Password</h5>
                    <input type="password" class="input" name="password">
               </div>
            </div>
            

            <div class="input-div">
               <div class="i">
                    <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                    <h5>Confirm Password</h5>
                    <input type="password" class="input" name="confirm_password">
               </div>
            </div>
           

            <div class="input-div">
               <div class="i">
               <i class="fas fa-image"></i>
               </div>
               <div class="div">
                    <h5>Profile Picture</h5>
                     <input class="profil" type="file" name="profile_picture">
               </div>
            </div>
            

            <input type="submit" class="btn" value="Signup">
        </form>
    </div>
</div>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>



<?php 
    require "../Admin/includes/configure.php";
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


     

        require "../Admin/includes/configure.php";
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