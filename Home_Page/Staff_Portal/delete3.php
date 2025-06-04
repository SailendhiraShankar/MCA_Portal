<?php
if(isset($_GET["id"]))
{
	$PID=$_GET["id"];
    $db=new mysqli("localhost","root","","project");
{
	echo('Connection error' .mysqli_connect_error());
}
$sql="DELETE FROM pannouncement WHERE PID =$PID";
$res=$db->query($sql);
if ($res)
{
	header('location:payment_announcement.php');
}
else
  {
    echo"<p class='error'>Failed to Delete Documents</p>";
  }
}
?>