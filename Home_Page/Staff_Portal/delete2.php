<?php
if(isset($_GET["id"]))
{
	$AID=$_GET["id"];
    $db=new mysqli("localhost","root","","project");
{
	echo('Connection error' .mysqli_connect_error());
}
$sql="DELETE FROM announcement WHERE AID=$AID";
$res=$db->query($sql);
if ($res)
{
	header('location:announcement.php');
}
else
  {
    echo"<p class='error'>Failed to Delete Documents</p>";
  }
}
?>