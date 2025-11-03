<?php
    include "../common.php";

    $id = $_REQUEST["id"] ?? null;

    $sql1="delete from jumun where id='$id'";
    $result1=mysqli_query($db, $sql1);
	if (!$result1) exit("에러: $sql1");

    $sql2="delete from jumuns where jumun_id='$id'";
    $result2=mysqli_query($db, $sql2);
	if (!$result2) exit("에러: $sql2");
	
	echo("<script>location.href='jumun.php'</script>");
?>