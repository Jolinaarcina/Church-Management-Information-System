<style>
    .img-avatar{
        width:45px;
        height:45px;
        object-fit:cover;
        object-position:center center;
        border-radius:100%;
    }
</style>
<html>


	<body>
	<div class="container">
	<h1>PHP Send SMS</h1>
		<form method="post" action='phpsendsms.php'>
                 <?php 
                 $resultSet = $conn->query("SELECT brgy FROM brgy_list");
                     ?>
                     <select name="brgy">
                         <?php
        
                            while($rows = $resultSet->fetch_assoc()){
                                $brgyName = $rows['brgy'];
                                echo "<option value = ''$brgyName>$brgyName</option>";
                            }
                         ?>

                     </Select>
		<div class="form-group">
            
        <?php 
                 $resultSet = $conn->query("SELECT telephone FROM members_list where brgy =  ");
                     ?>
			<label for="phoneno">Mobile Number</label>
			<input type="text" name="phoneno" class="form-control" placeholder="Enter Phone Number" >
		</div>
		<div class="form-group">
			<label for="exampleFormControlTextarea3">Enter Text Message</label>
			<textarea class="form-control" name="smstext" rows="7"></textarea>
		</div>
		<div class="form-group">
			<input type="submit" name="submit" class="btn btn-primary" value="Send Message">
		</div>	
		</form>
	</div>	
	</body>
</html>