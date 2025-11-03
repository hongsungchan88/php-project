<?
    include "../common.php";

    $id = $_REQUEST["id"];
    $name = $_REQUEST["name"];
    $id1 = $_REQUEST["id1"];

    $sql="update opts set name='$name' where id=$id1";
	$result=mysqli_query($db, $sql);
	if (!$result) exit("에러: $sql");
	
	echo("<script>location.href='opts.php?id=$id'</script>");
?>