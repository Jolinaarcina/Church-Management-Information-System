<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,'bims_db');

if(isset($_POST['update']))
{

    $contact = $_POST['contact'];
    $sid = 'AC2a6d1f15b7667e4ae4df09b8a6a5e743';
    $token = '590d38b425e7d71f80272ba54afd1222';
    $client = new Client($sid, $token);
    $code = $_POST['code'];
    $fullname = $_POST['fullname'];
    $decide = $_POST['decide'];
    $remarks = $_POST['remarks'];
   
    $query = "UPDATE message_list SET status1 = '$decide', remarks='$remarks' WHERE code = '$code'";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
        $client->messages->create(
            // the number you'd like to send the message to
            $contact,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+15597850406',
                // the body of the text message you'd like to send
                'body' => 'Hello there! Your request has already been verified, please check it our website using your Token code '
            ]
        );
        echo "<script type='text/javascript'>alert('Successfully Updated');</script>";
        echo "<script>window.location.href=_base_url_+'./admin/?page=inquiries';</script>";
        exit;
    }
        
    else
    {
        echo "<script type='text/javascript'>alert('Not Updated');
           
        </script>";
    }
   
}


?>