<?php
    session_start();
    $_SESSION;
    include("config.php");
    include("functions.php");
    $user_data = check_login($link);
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
        .container-table{
            align-content: center;
            width: 80%;
            align-items: center ;
        }
        div table {
        border-collapse: collapse;
        text-align: justify;
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

</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('.form-inline input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("backsearch.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".form-inline").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
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
    <div class="container-table container-fluid" style="margin-top:2rem;">
        <table class="table  table-light table-striped">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Edition</th>
                    <th>Subject</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Available</th>
                </tr>
            </thead>
            
        <?php
        
        $sql = "SELECT * FROM book JOIN subject ON book.sub_ID= subject.Subject_ID";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        echo "
        <tr>
                <td>" . $row["ISBN"]. "</td>
                <td>" . $row["Title"] . "</td>
                <td>" . $row["Author"] ."</td>
                <td>" . $row["Publisher"] . "</td>
                <td>" . $row["Edition"] . "</td>
                <td>" . $row["Subject_Name"]. "</td>
                <td>" . $row["Description"]. "</td>
                <td>" . $row["Qty"]. "</td>
                <td>" . $row["Available"]. "</td>
                
            </tr>";
            
        }
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