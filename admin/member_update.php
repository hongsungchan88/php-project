<?
	include "../common.php";
	
	$uid = $_REQUEST["uid"];
	$pwd = $_REQUEST["pwd"];
	$name = $_REQUEST["name"];
	$tel1 = $_REQUEST["tel1"];
	$tel2 = $_REQUEST["tel2"];
	$tel3 = $_REQUEST["tel3"];
	$tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);
	$zip = $_REQUEST["zip"];
	$juso = $_REQUEST["juso"];
	$email = $_REQUEST["email"];
	$birthday1 = $_REQUEST["birthday1"];
	$birthday2 = $_REQUEST["birthday2"];
	$birthday3 = $_REQUEST["birthday3"];
	$birthday = sprintf("%04d-%02d-%02d", $birthday1, $birthday2, $birthday3);
    $gubun = $_REQUEST["gubun"];

     // uid 값 검증
    $check_sql = "SELECT uid FROM member WHERE uid = ?";
    $check_stmt = mysqli_prepare($db, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "s", $uid);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) == 0) {
        exit("오류: 존재하지 않는 uid입니다.");
    }
    mysqli_stmt_close($check_stmt);
	
	$sql="update member set name='$name', pwd=$pwd, tel='$tel', zip=$zip, birthday='$birthday', juso='$juso', email='$email', gubun=$gubun  where uid='$uid'";
	$result=mysqli_query($db, $sql);
	if (!$result) exit("에러: $sql");
	
	echo("<script>location.href='member.php'</script>");
?>