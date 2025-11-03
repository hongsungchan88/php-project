<?php
    include "../common.php";

    $id = $_REQUEST["id"];
    $menu = $_REQUEST["menu"];
    $code = $_REQUEST["code"];
    $name = $_REQUEST["name"];
    $coname = $_REQUEST["coname"];
    $price = $_REQUEST["price"];
    $opt1 = $_REQUEST["opt1"];
    $opt2 = $_REQUEST["opt2"];
    $contents = $_REQUEST["contents"];
    $status = $_REQUEST["status"];
    $icon_new = isset($_REQUEST["icon_new"]) ? 1 : 0;
    $icon_hit = isset($_REQUEST["icon_hit"]) ? 1 : 0;
    $icon_sale = isset($_REQUEST["icon_sale"]) ? 1 : 0;
    $regday = $_REQUEST["regday"];
    if (empty($regday)) {
        $regday = date("Y-m-d"); // 현재 날짜를 YYYY-MM-DD 형식으로 설정
    }
    $image1 = $_FILES["image1"]["name"];
    $image2 = $_FILES["image2"]["name"];
    $image3 = $_FILES["image3"]["name"];
    $discount = ($icon_sale == 1) ? $_REQUEST["discount"] : 0;
    $fname1 = ($_FILES["image1"]["name"] == "") ? $_REQUEST["fimage1"] : $_FILES["image1"]["name"];
    $fname2 = ($_FILES["image2"]["name"] == "") ? $_REQUEST["fimage2"] : $_FILES["image2"]["name"];
    $fname3 = ($_FILES["image3"]["name"] == "") ? $_REQUEST["fimage3"] : $_FILES["image3"]["name"];
    $checkno1 = $_REQUEST["checkno1"];
    $checkno2 = $_REQUEST["checkno2"];
    $checkno3 = $_REQUEST["checkno3"];

    if ($checkno1 == "1") $fname1 = "";
    if ($checkno2 == "1") $fname2 = "";
    if ($checkno3 == "1") $fname3 = "";

    if ($_FILES["image1"]["error"] == 0 && $checkno1 != "1") {
        if (!move_uploaded_file($_FILES["image1"]["tmp_name"], "../product/" . $fname1)) {
            echo("<script>alert('이미지1 업로드 실패');</script>");
            exit;
        }
    }
    if ($_FILES["image2"]["error"] == 0 && $checkno2 != "1") {
        if (!move_uploaded_file($_FILES["image2"]["tmp_name"], "../product/" . $fname2)) {
            echo("<script>alert('이미지2 업로드 실패');</script>");
            exit;
        }
    }
    if ($_FILES["image3"]["error"] == 0 && $checkno3 != "1") {
        if (!move_uploaded_file($_FILES["image3"]["tmp_name"], "../product/" . $fname3)) {
            echo("<script>alert('이미지3 업로드 실패');</script>");
            exit;
        }
    }

    $sql = "update product set
        menu='$menu', code='$code', name='$name', coname='$coname',
        price='$price', opt1='$opt1', opt2='$opt2', contents='$contents',
        status='$status', regday='$regday', icon_new='$icon_new',
        icon_hit='$icon_hit', icon_sale='$icon_sale', discount='$discount',
        image1='$fname1', image2='$fname2', image3='$fname3'
        where id=$id";

    $result = mysqli_query($db, $sql);

    if (!$result) {
        echo "에러 발생: " . mysqli_error($db); // 상세한 오류 메시지 출력
        exit;
    }

    echo("<script>location.href='product.php'</script>");
?>