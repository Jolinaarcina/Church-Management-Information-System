<?php

$connection = mysqli_connect("localhost",DB_USERNAME,DB_PASSWORD);
$db = mysqli_select_db($connection,DB_NAME);

if(isset($_POST['insertrequest']))
    {
        $id = $_POST['id'];
        $code = $_POST['code'];
        $type = $_POST['type'];
        $fullname = $_POST['fullname'];
        $contact = $_POST['contact'];
        $baptizee = $_POST['baptizee'];
        $dob = $_POST['dob'];
        $message = $_POST['message'];

        $query = "INSERT INTO `message_list`(`id`, `code`, `type`, `fullname`, `contact`, `baptizee`, `dob`, `message`) VALUES (null,'$code','$type','$fullname','$contact','$baptizee','$dob','$message') ";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
            ?>
            <!-- <br><br><br> -->
            <!-- <h2><center> Please take a screen shoot or make a copy of the Ticket code below </center></h2><br> -->
            
           <!-- <h1><center> -->
            <?php echo $code; ?>
             <!-- <br> <br><a href ="./index.php">Click Here</a></center></h1> -->

            <?php
            echo "<script type='text/javascript'>alert('Request Successfully Sent.  Please take a screenshot or make a copy of the Ticket code. {$code}');
            window.location.href='./index.php';
           </script>";
            
        }
        else
        {
            echo '<script> alert ("Request Not Sent");</script>';
        }
       
    }

?>