<?php
session_start();
$_SESSION;
include("config.php");
include("functions.php");
$user_data = check_login($link);

$Reg_No = $_SESSION['Reg_No'];
$ISBN = $_GET['book'];

if(isset($_GET["book"]) && !empty($_GET["book"])){

    $ssql = "SELECT * FROM issued_book_details WHERE Student_ID = '$Reg_No' AND Returned_Stutus = 'Borrowed'";
    $sresult= mysqli_query($link, $ssql);
    if (mysqli_num_rows($sresult)>0) {
        echo '<script>
                   alert("You can not borrow twice, first return to borrow again. ");
                   window.location.href = "borrow_book.php";
            </script>';
                
    }else {
        $sql="SELECT * FROM student WHERE Reg_No = '$Reg_No' ";
        $sqlr="SELECT * FROM book WHERE ISBN = $ISBN ";

        $result = mysqli_query($link, $sql);
        $rresult = mysqli_query($link, $sqlr);

        if ($user = mysqli_fetch_assoc($result) && $bk = mysqli_fetch_assoc($rresult)) {
            
            //Total number of borrowed book copies.
            $csql = "SELECT * FROM issued_book_details WHERE Book_ID = $ISBN AND Returned_Stutus = 'Borrowed'";
            $cresult= mysqli_query($link, $csql);
            $bb = mysqli_num_rows($cresult) + 1;
            $Availablebooks=$bk['Qty']-$bb;
            $sqlu = "UPDATE book SET Available =$Availablebooks WHERE ISBN = $ISBN";
            $resultu = mysqli_query($link, $sqlu);
        
            $sqli = "INSERT INTO issued_book_details (Returned_Stutus, Student_ID, Book_ID)
                        VALUES ('Borrowed', '$Reg_No', $ISBN)";
            $resulti = mysqli_query($link, $sqli);

            if ($resulti) {
                echo '<script>
                        alert("Borrowed successful. ");
                        window.location.href = "borrow_book.php";
                    </script>';
                
            }else {
                echo "Couldn't insert into table!!"  ;
            } 
        }else {
            echo "ISBN invalid OR Registration No!!"  ;
            mysqli_close($link);
        }
    }

                
}



?>