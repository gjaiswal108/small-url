<?php
$url = $_SERVER["REQUEST_URI"];
if($url[0] == "/")
	$url = substr($url, 1);
if($url[strlen($url)-1] == "/")
	$url = substr($url,0,strlen($url)-1);
$conn = new mysqli('localhost','root','','url') or die('Unable To connect');
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT long_url,counter FROM short_urls where short_code=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$url);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows == 1) {
	$row = $result->fetch_assoc();
	$new_counter = $row["counter"]+1;
	$sql = "UPDATE short_urls SET counter=" . $new_counter . " WHERE short_code=?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s",$url);
	$stmt->execute();
	$stmt->close();
	$conn->close();
	header("Location: " . $row["long_url"]);
}else{
	header("Location: http://" . $_SERVER["HTTP_HOST"] . "/404.html");
}
?>
