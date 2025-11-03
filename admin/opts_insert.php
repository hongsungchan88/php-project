<?php
    include "../common.php";

    if (isset($_POST['opt_id']) && isset($_POST['name'])) {
        $opt_id = $_POST['opt_id'];
        $name = $_POST['name'];

        $sql = "insert into opts (name, opt_id) values('$name', '$opt_id')";
        $result = mysqli_query($db, $sql);

        if ($result) {
            echo "<script>location.href='opts.php?id=$opt_id'</script>"; // 성공 시 목록 페이지로 이동
        } else {
            exit("에러: " . mysqli_error($db)); // 오류 발생 시 오류 메시지 출력
        }
    } else {
        exit("잘못된 접근입니다."); // POST 데이터가 없을 경우
    }
?>