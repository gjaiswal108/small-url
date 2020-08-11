<?php  
session_start();
$data = json_decode(file_get_contents("php://input"));
if($_SERVER['REQUEST_METHOD'] == "POST"){
	if($data->captcha != $_SESSION["captcha_code"]){
		echo "invalid captcha";
	}
	else if($data->url != "" && $data->captcha != "") {
		$url = $data->url;
		if(strpos($url,"http://")!==0 and strpos($url,"https://")!==0){
			$url = 'http://' . $url;
		}
		$conn = new mysqli('localhost','root','','url') or die('Unable To connect');
		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		$short_code = "";
		if(isset($data->custom_page) && $data->custom_page != ""){
			$short_code = $data->custom_page;
			$flag = 0;$flag = 1;
			for ($i=0; $i < strlen($short_code); $i++) { 
				$curr = $short_code[$i];
				if(($curr >= 'a' && $curr <= 'z') || ($curr >= 'A' && $curr <= 'Z')){
					$flag1 = 0;
				}
				if(!(($curr >= 'a' && $curr <= 'z') || ($curr >= 'A' && $curr <= 'Z') || ($curr >= 0 && $curr <= 9) || ($curr == '-'))){
					$flag = 1; break;
				}
			}
			if($flag == 1 || $flag1 == 1){
				$error = array("error"=>"Invalid custom page name");
				echo json_encode($error);
				exit();
			}
			$sql = "SELECT short_code from short_urls WHERE short_code=?";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("s",strval($short_code));
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$error = array("error"=>"Already exists");
				echo json_encode($error);
				exit();
			}
		}else{
			$sql = "SELECT total from total_urls";
			$row = ($conn->query($sql))->fetch_assoc();
			$count = $row["total"] + 1;
			$sql = "UPDATE total_urls SET total=" . $count;
			$conn->query($sql);
			$short_code = $count;
		}
		
		$shortUrl = "https://" . $_SERVER["HTTP_HOST"] . "/" . $short_code;
		$sql = "INSERT INTO short_urls (long_url,short_code) VALUES(?,?)";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("ss",$url,strval($short_code));
		$stmt->execute();
		$stmt->close();
		$conn->close();
		$data_output = array("url"=>$url,"shortUrl"=>$shortUrl);
		echo json_encode($data_output);
	}else{
		echo "empty";
	}
	$_SESSION["captcha_code"] = "jqdyd367&dhdbhkejhhn$dnyd228ys99##";
}
?>