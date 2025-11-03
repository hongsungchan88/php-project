<?php
    include "../common.php";

    $id_param = $_REQUEST["id"] ?? null;
    $state_param = $_REQUEST["state"] ?? null;

    $page = $_REQUEST["page"] ?? '1';
    $day1 = $_REQUEST["day1"] ?? null;
    $day2 = $_REQUEST["day2"] ?? null;
    $sel1 = $_REQUEST["sel1"] ?? null;
    $sel2 = $_REQUEST["sel2"] ?? null;
    $text1 = $_REQUEST["text1"] ?? null;

    $redirect_params_array = [];
    if ($day1 !== null) $redirect_params_array['day1'] = $day1;
    if ($day2 !== null) $redirect_params_array['day2'] = $day2;
    if ($sel1 !== null) $redirect_params_array['sel1'] = $sel1;
    if ($sel2 !== null) $redirect_params_array['sel2'] = $sel2;
    if ($text1 !== null) $redirect_params_array['text1'] = $text1;
    if ($page !== null) $redirect_params_array['page'] = $page;
    
    $redirect_url = "jumun.php";
    if (!empty($redirect_params_array)) {
        $redirect_url .= "?" . http_build_query($redirect_params_array);
    }

    // 필수 파라미터 (ID, 상태 값) 누락 시 오류 처리
    if ($id_param === null || $state_param === null) {
        echo("<script>alert('오류: ID 또는 상태 값이 전달되지 않았습니다.'); location.href='$redirect_url';</script>");
        exit;
    }

    // 상태 값은 정수형으로 유효성 검사
    $state = filter_var($state_param, FILTER_VALIDATE_INT);
    if ($state === false) { // 정수 변환 실패 시
        echo("<script>alert('오류: 상태 값은 반드시 숫자여야 합니다.'); location.href='$redirect_url';</script>");
        exit;
    }
    $id = $id_param; // ID 값은 전달된 그대로 사용 (필요시 추가 유효성 검사 가능)

    $sql = "UPDATE jumun SET state = ? WHERE id = ?";
    $stmt = mysqli_prepare($db, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "is", $state, $id);
        $execute_result = mysqli_stmt_execute($stmt);
        if ($execute_result) {
            $affected_rows = mysqli_stmt_affected_rows($stmt);
            if ($affected_rows > 0) {
                echo("<script>location.href='$redirect_url';</script>");
            } else {
                echo("<script>alert('수정할 주문을 찾지 못했거나 이미 해당 상태입니다.'); location.href='$redirect_url';</script>");
            }
        } else {
            echo("<script>alert('데이터 수정 중 오류가 발생했습니다. (실행 오류)'); location.href='$redirect_url';</script>");
        }
        mysqli_stmt_close($stmt);
    } else {
        echo("<script>alert('데이터 수정 중 오류가 발생했습니다. (SQL 준비 오류)'); location.href='$redirect_url';</script>");
        // 개발 중 오류 확인용: exit("SQL 준비 에러: " . mysqli_error($db));
    }
    // if (function_exists('mysqli_close') && $db) { mysqli_close($db); }
?>