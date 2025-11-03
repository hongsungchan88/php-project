<?
	if (isset($_COOKIE["cookie_value"])) {
		$cookie_value = $_COOKIE["cookie_value"];
	} else {
		// 쿠키가 존재하지 않을 경우 처리
		$cookie_value = ""; // 기본값 설정 또는 오류 처리
	}
?>
<html>
<head>
	<title>Cookie</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>

저장된 cookie값은 <font color="blue"><?=$cookie_value; ?></font>입니다.
&nbsp;&nbsp
<a href="cookie.html">돌아가기</a>

</body>
</html>

