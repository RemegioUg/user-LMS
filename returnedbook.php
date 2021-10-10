<?php
    session_start();
    $_SESSION;
    include("config.php");
    include("functions.php");
    $user_data = check_login($link);

    $Reg_No = $_SESSION['Reg_No'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="./Resources/code-base2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>

    <link rel="stylesheet" href="./bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <script src="./fontawesome/js/all.min.js"></script>
    <style>
        body {
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
        table {
        border-collapse: collapse;
    }
    
    thead tr {
        border-top: 1px solid #f0f0f0;
        border-bottom: 2px solid #f0f0f0;
    }
    
    thead td {
        font-weight: 700;
    }
    
    td {
        padding: .5rem 1rem;
        font-size: .9rem;
        color: #222;
    }
    
    tr td:last-child {
        display: flex;
        align-items: center;
    }
    
    .table-responsive {
        width: 100%;
        overflow-x: auto;
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

    <div class="container-fluid" style="width:80%; margin-top:2rem;">
 
    <table class="table table-bordered table-light table-striped">
        <tr>
        <th>ISBN</th>
        <th>Title</th>
        <th>Issued Date</th>
        <th>Returned Date</th>
        <th> Stutus</th>
        </tr>
    <?php
    
    $sql = "SELECT * FROM book JOIN issued_book_details ON book.ISBN= issued_book_details.Book_ID WHERE Student_ID = '$Reg_No'";
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["ISBN"]. "</td>
            <td>" . $row["Title"] . "</td>
            <td>" . $row["Issued_Date"] . "</td>
            <td>" . $row["Returned_Date"] . "</td>
            <td>" . $row["Returned_Stutus"] ."</td>
        </tr>";
    }
    echo "</table>";
    } else { echo "0 results"; }
    $link->close();
    ?>
    </table>
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