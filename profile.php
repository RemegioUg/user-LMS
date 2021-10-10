<?php

session_start();
$_SESSION;
include("config.php");
include("functions.php");
$user_data = check_login($link);


   
    $Reg_No = $_SESSION['Reg_No'];
    $sql = "SELECT * FROM student WHERE Reg_No = '$Reg_No'";
    $stmt = mysqli_query($link, $sql);
    if (mysqli_num_rows($stmt)==1) {
        $result = mysqli_fetch_assoc($stmt);

            // Retrieve individual field value
        $Reg_No = $result["Reg_No"];
        $firstname = $result["First_Name"];
        $lastname = $result["Last_Name"];
        $tel_No = $result["Tel_No"];
        $course = $result["Course"];
        $year = $result["Year"];
        $semester = $result["Semester"];
        $faculty = $result["Faculty"];
        
        if (isset($_POST['submit'])) {
            
            $pd = $_POST['password1'];
            $cpd = $_POST['password2'];

            if ($pd===$cpd) {
                $rsql = "UPDATE student SET Password = '$pd' WHERE Reg_No = '$Reg_No'";
                $pass = mysqli_query($link, $rsql);
                if ($pass) {
                    echo "Password was reset";
                }
            }else {
                echo "Password missmatch!!";
            }

        }
    }   mysqli_close($link);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="./Resources/code-base2.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="./bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <script src="./fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
           
            background-size: cover;
            background-color: #f1f5f9;
            font-family: 'poppins', sana-serif;
        }
        
        nav {
            background-color: black;
            color: white;
            font-weight: 500;
        }
        
        nav div ul li a {
            color: white;
            font-size: 1.2rem;
        }
        
        nav div ul li:hover a {
            color: white;
        }
        
        nav div ul li a :hover {
            color: white;
        }
        
        nav div ul li a i:hover {
            color: red;
        }
        div h1 {
            font-weight: 500;
            font-size: 3rem;
            text-align: center;
            padding-top: 10rem;
            color: black;
        }
    
      .container-fluid  {
          background-color: white;
            width: 60%;
            padding: 2rem;
            margin-top: 2rem;
            align-content: center;
      }
      div .form-group input {
          
          float: left;
      }
      
    </style>
</head>
    
<body>
    <nav class=" navbar navbar-expand-lg   shadow">

        <div class="container">

            <a href="/" class="navbar-brand">
                <img src="./Resources/code-base2.png " width="100px" height="50px" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbar-responsive" aria-expanded="false" aria-abel="Toggle navigation">
                <span class="fa fa-bars " style=" color: white;" aria-hidden="true"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">

                <ul class="navbar-nav ml-auto ">
                   
                    <li class="nav-item">
                        <a href="view.php" class="nav-link active">
                            <span class="p-2">View Books</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="borrow_book.php" class="nav-link">
                            <span class="p-2">Borrow Book</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="returnedbook.php" class="nav-link">

                            <span class="p-2">Return Book</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="profile.php" class="nav-link">

                            <span class="p-2">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">

                            <span class="p-2"><i style="color: red; margin-right: .5rem;" class="fa fa-power-off"></i>Logout</span>
                        </a>
                    </li>


                </ul>

            </div>
        </div>

    </nav>
    <div style="background-image: url(./Resources/back2.jpg);"></div>
    
    <div class="container-fluid">
        <div>
            <h4>My Profile</h4>
            <img src="./Resources/user.png" width="50px" height="50px" >
        </div>
        <div class="row">
            <div class="col-md-12">

                <form action='' method="post" >
                    <div class="form-group">
                        <label>Registration No</label>
                        <input type="text" name="Reg_No" disabled class="form-control" value="<?php echo $Reg_No; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="firstname" disabled class="form-control" value="<?php echo $firstname; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lastname" disabled class="form-control" value="<?php echo $lastname; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>Tel Number</label>
                        <input type="text" name="tel_No" disabled class="form-control" value="<?php echo $tel_No; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>Course</label>
                        <input type="text" name="course" disabled class="form-control" value="<?php echo $course; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>Year</label>
                        <input type="text" name="year" disabled class="form-control" value="<?php echo $year; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <input type="text" name="semester" disabled class="form-control" value="<?php echo $semester; ?>">
                        
                    </div>
                    <div class="form-group">
                        <label>Faculty</label>
                        <input type="text" name="faculty" disabled class="form-control" value="<?php echo $faculty; ?>">
                        
                    </div><br><br>
                    <div>
                        <h4>To Change your password</h4>
                        <label>Enter new password</label>
                        <input type="password" name="password1" required >
                        <label>Confirm password</label>
                        <input type="password" name="password2" required>
                        <input type="submit" name="submit" class = 'btn btn-primary' >
                    </div>
                    
                </form>
            </div>
        </div>        
    </div>
    
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/venobox/venobox.min.js"></script>
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
</body>
</html>