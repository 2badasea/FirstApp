<?php
$conn = null; 
try{
    $conn = mysqli_connect('localhost', 'bada', '1234', 'opentutorials');
} catch(Exception $e){
    // 문자열 안에 php문법을 사용하기 위해선 더블쿼트로 문자열을 감싸주어야 한다! 
    header("Location: {$_SERVER['HTTP_REFERER']}");
}

// 일반적으로 회원가입 처리를 한 다음 => 메인페이지로 돌아가도록 하는 게 맞는 듯
// 사용자로부터 넘어온 값에 대하여 filtering처리
$filtered = null;
$sql = null;
if($_SERVER["REQUEST_METHOD"] === "POST" &&  isset($_POST['id'])){
    $filtered = array(
        'id'=> mysqli_real_escape_string($conn, $_POST['id']),
        'password'=> mysqli_real_escape_string($conn, $_POST['password']),
        'name'=> mysqli_real_escape_string($conn, $_POST['name'])
    );
    $sql = "INSERT INTO USER(id, password, name, joindate)
                    VALUES( '{$filtered['id']}'
                        , '{$filtered['password']}'
                        , '{$filtered['name']}'
                        , NOW()
                    )
    ";

    $result = mysqli_query($conn, $sql);
    if($result === false){
        echo "저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의<br><a href='../view/joinForm.php'>메인페이지로 돌아가기</a><br>";
    }else {
        echo "<br>데이터 저장 성공. <a href='../view/main.php'>메인페이지로 돌아가기</a><br>";
        echo $sql;
    }
}

// 아이디 중복 여부 처리
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['id'])){
    $filteredName = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "
        SELECT COUNT(id) from user where id = '{$filteredName}'
    ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result); // 결과 레코드를 저장=> count값이 0이어도 그 결과가 레코드 1개에 출력됨
    // 레코드가 없을 때 Null을 반환하는 것이 아니라 false를 반환한다. 
    

    $response = null;
    if($row['COUNT(id)'] === '0'){
        $response = true;
    }else{
        $response = false;
    }
    echo $response;
}





?>