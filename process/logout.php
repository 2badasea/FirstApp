<?php
// 세션 시작
session_start();

// 세션 파기
session_destroy();

// 로그아웃 처리 후 로그인 페이지로 리다이렉션
header("Location: ../view/loginForm.php");
exit;
?>