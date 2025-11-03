<?
    include "../common.php";

    $adminid = $_REQUEST["adminid"];
    $adminpw = $_REQUEST["adminpw"];

    if ($adminid == $admin_id && $adminpw == $admin_pw)
    {
        // $cookie_admin 쿠키변수에 "yes"로 쿠키 저장
        // echo($adminid);
        setcookie("cookie_admin", "yes", time() + 3600, "/");
        // member.php로 이동
        header("Location: member.php");
    }
    else
    {
        // $cookie_admin 쿠키변수 삭제
        setcookie("cookie_admin", "", time() - 3600, "/");
        header("Location: index.html");
    }
?>