<?
	include "../common.php";
	
	$uid=$_REQUEST["uid"];
	
	$sql="delete from member where uid='$uid'";
	$result=mysqli_query($db, $sql);
	if (!$result) exit("에러: $sql");
	
	echo("<script>location.href='member.php'</script>");
?>