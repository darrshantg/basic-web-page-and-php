<?php
	$Name = $_POST['Name'];
	$Email = $_POST['Email'];
	$Message= $_POST['Message'];

	if(!empty($Name) || !empty($Email) || !empty($Message) )
	{
		$host="localhost";
		$dbusername="root";
		$dbpassword="";
		$dbname="sweet factory";

		$conn=new mysqli($host, $dbusername, $dbpassword, $dbname);
		
		
			$SELECT = "SELECT Email from contact Where Email=? Limit 1";
			$INSERT = "INSERT into contact (Name,Email,Message) values (?,?,?)";
			
			$stmt = $conn->prepare($SELECT);
			$stmt->bind_param("s",$Email);
			$stmt->execute();
			$stmt->bind_result($email);
			$stmt->store_result();
			$rnum = $stmt->num_rows;

			if($rnum==0)
			{
				$stmt->close();
				$stmt = $conn->prepare($INSERT);
				$stmt->bind_param("sss", $Name,$Email,$Message);
				$stmt->execute();
				echo "Updated successfully!";
			}
			else
			{
				"Already filled using this email.";

			}
			$stmt->close();
			$conn->close();
	}
	else
	{
		echo "All field are required";
		die();
	}		
?>