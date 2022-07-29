<?php

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,'bims_db');

if(isset($_POST['insertrequest']))
    {
        $id = $_POST['id'];
        $code = $_POST['code'];
        $type = $_POST['type'];
        $fullname = $_POST['fullname'];
        $wife = $_POST['wife'];
        $wdob = $_POST['wdob'];
        $contact = $_POST['contact'];
        $baptizee = $_POST['baptizee'];
        $dob = $_POST['dob'];
        $message = $_POST['message'];

        $query = "INSERT INTO `message_list`(`id`, `code`, `type`, `fullname`, `contact`, `baptizee`, `dob`, `wife`, `wdob`, `message`) VALUES (null,'$code','$type','$fullname','$contact','$baptizee','$dob','$wife','$wdob','$message') ";
        $query_run = mysqli_query($connection,$query);

        if($query_run)
        {
            ?><br><br><br>
            <h2><center> Please take a screen shoot or make a copy of the Ticket code below </center></h2><br>
            
           <h1><center><?php echo $code; ?> <br> <br><a href ="./index.php">Click Here</a></center></h1>

            <?php
            //echo "<script type='text/javascript'>alert('Request Successfully Sent.  Please take a screenshot or make a copy of the Ticket code. {$code}');
           
           // </script>";
            
        }
        else
        {
            echo '<script> alert ("Request Not Sent");</script>';
        }
       
    }

?>