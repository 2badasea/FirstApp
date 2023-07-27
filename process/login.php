<?php
// mysqli_connect() 함수는 예외를 발생하지 않고, 오류가 발생하면 false를 반환하거나 오류 메시지를 출력
$conn = null;

try{
    $conn = mysqli_connect('localhost', 'bada', '1234', 'opentutorials');
}catch(Exception $e){
    // mysqli_connect_errno()는 가장 최근의 MySQL 연결 시도에서 발생한 오류에 대한 숫자형 에러 코드를 반환
    $msg = mysqli_connect_error();
    echo $msg;
    echo header("Location: ../view/loginForm.php?error=dbconnect");
}
// from으로 넘어온 값 id, password 그리고  post 방식 
if($_SERVER["REQUEST_METHOD"] === "POST" &&  $_POST['id'] !== ''){
    $filtered = array(
        "id"=>mysqli_real_escape_string($conn, $_POST['id']),
        "password"=>mysqli_real_escape_string($conn, $_POST['password'])
    ); 
    $sql = "
        SELECT * FROM USER 
            WHERE 
                ID = '{$filtered['id']}'
            AND 
                PASSWORD = '{$filtered['password']}'
    ";
    echo $sql."<br>";
    // mysqli_query()는 mysqli_result '객체'가 반환되는데, 이 객체는 빈 결과셋을 가짐. 이 자체는 NULL이 아님
    $result = mysqli_query($conn, $sql);
    // 결과셋의 행 수를 통해 제어문 분기 처리를 진행
    $resultCount = mysqli_num_rows($result);

    if($resultCount > 0){
        // 세션 부여하고 메인 페이지 이동시키기
        session_start();
        // 세션에 사용자 정보 저장
        $_SESSION["userId"] =  $filtered['id'];
        echo "존재함";
        header("Location: ../view/main.php");
    }else{
        echo "존재하지 않음";
        header("Location: ../view/loginForm.php?error=invalid_credentials");
    }

}


?>