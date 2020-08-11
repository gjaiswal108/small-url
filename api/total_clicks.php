<?php  
$url = $_GET["url"];
$conn = new mysqli('localhost','root','','url') or die('Unable To connect');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT counter FROM short_urls WHERE short_code=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$url);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows == 1) {
	$row=$result->fetch_assoc();
	echo $row["counter"];
}else{
	echo "invalid";
}
?>