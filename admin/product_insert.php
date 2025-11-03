<?
    include "../common.php";

    $menu		=	$_REQUEST["menu"];
    $code		=	$_REQUEST["code"];
    if($_REQUEST["name"])
        $name	=	addslashes($_REQUEST["name"]);
    else
        $name   =   $_REQUEST["name"];
    $coname		=	$_REQUEST["coname"];
    $price		=	$_REQUEST["price"];
    $opt1		=	$_REQUEST["opt1"];
    $opt2		=	$_REQUEST["opt2"];
    if($_REQUEST["contents"])
        $contents	=	addslashes($_REQUEST["contents"]);
    else
        $contents   =   $_REQUEST["contents"];
    $status		=	$_REQUEST["status"];
    if (empty($regday)) {
        $regday = date("Y-m-d"); // 현재 날짜를 YYYY-MM-DD 형식으로 설정
    }
    $icon_new	=	($_REQUEST["icon_new"]==1) ? 1 : 0;
    $icon_hit	=	($_REQUEST["icon_hit"]==1) ? 1 : 0;
    $icon_sale	=	($_REQUEST["icon_sale"]==1) ? 1 : 0;
    $discount	=	($icon_sale==1) ? $_REQUEST["discount"] : 0;
    $image1		=	$_REQUEST["image1"];
    $image2		=	$_REQUEST["image2"];
    $image3		=	$_REQUEST["image3"];

    // 이미지 1 업로드 처리
    if ($_FILES["image1"]["error"] == 0) {
        $fname1 = $_FILES["image1"]["name"];
        if (!move_uploaded_file($_FILES["image1"]["tmp_name"], "../product/" . $fname1)) {
            exit("이미지1 업로드 실패");
        }
    }

    // 이미지 2 업로드 처리
    if ($_FILES["image2"]["error"] == 0) {
        $fname2 = $_FILES["image2"]["name"];
        if (!move_uploaded_file($_FILES["image2"]["tmp_name"], "../product/" . $fname2)) {
            exit("이미지2 업로드 실패");
        }
    }

    // 이미지 3 업로드 처리
    if ($_FILES["image3"]["error"] == 0) {
        $fname3 = $_FILES["image3"]["name"];
        if (!move_uploaded_file($_FILES["image3"]["tmp_name"], "../product/" . $fname3)) {
            exit("이미지3 업로드 실패");
        }
    }

    $sql="insert into product (
        menu, code, name, coname, price, opt1, opt2, contents, status, regday, icon_new, icon_hit, icon_sale, discount, image1, image2, image3
        ) values (
        $menu, '$code', '$name', '$coname', $price, $opt1, $opt2, '$contents', $status, '$regday', $icon_new, $icon_hit, $icon_sale, $discount, '$fname1', '$fname2', '$fname3'
        ) ";

    $result=mysqli_query($db,$sql);
    if (!$result) exit("에러:$sql");
    echo("<script>location.href='product.php'</script>");
?>