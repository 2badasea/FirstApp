<?php
require_once('../common/bootstrapCdn.php');
?>
<?=$bootstarpCdn?>
<?php
session_start();
$emptyLogin = "<a class='nav-link' href='loginForm.php'>로그인</a>";
$adminPage = "";
$joinPage = "<a class='nav-link' href='joinForm.php'>회원가입</a>";
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    if ($userId === "admin") {
        $adminPage = "<a class='nav-link' href='admin.php'>관리자</a>";
    }
    $emptyLogin = "<a class='nav-link' href='../process/logout.php'>" . $userId . " 님 로그아웃</a>";
    $joinPage = "";
}
?>
<?php
$conn = null;
$boardList = "";
try{
    $conn = mysqli_connect('localhost', 'bada', '1234', 'opentutorials');
}catch(Exception $e){
    echo "DB Connection Error";
}
if($conn !== false){
    $sql = "select * from board order by wdate desc limit 10";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($result)){
        // 글번호(no), 제목(title), 작성자(writer), 작성일(wdate)
        $no = $row['no'];
        $title = $row['title'];
        $writer = $row['writer'];
        $wdate = $row['wdate'];
        $boardList .="<tr>";
        $boardList .="<th scope='row'>$no</th>";
        $boardList .="<td>$title</td>";
        $boardList .="<td>$writer</td>";
        $boardList .="<td>$wdate</td>";
        $boardList .="</tr>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .boardWrapper{
        margin-top: 2%;
        margin-bottom: 5%;
    }
    table{
        border-left: 0.1px dotted gainsboro;       
        border-right: 0.1px dotted gainsboro;       
    }
</style>

<body>
    <div class="container-fluid">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="main.php">홈</a>
            </li>
            <li class="nav-item">
                <?= $emptyLogin ?>
            </li>
            <li class="nav-item">
                <?= $joinPage ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">마이페이지</a>
            </li>
            <li class="nav-item">
                <?= $adminPage ?>
            </li>
        </ul>
    </div>
    <div class="container-fluid" align="center" style="border-bottom: 0.5px solid lightsteelblue;">
        <a href="main.php"><img src="https://th.bing.com/th/id/OIP.7kK3U1NINjAj5xzmNaKr8AAAAA?pid=ImgDet&rs=1" class="img-fluid" style="max-width: 150px;"></a>
    </div>
    <!-- 게시판 출력 -->
    <div class="container boardWrapper table-responsive">
        <table class="table table-hover table-bordered table-md">
            <caption>자유게시판 리스트</caption>
            <thead class="thead-dark">
                <tr>
                    <th scope="col">번호</th>
                    <th scope="col">제목</th>
                    <th scope="col">작성자</th>
                    <th scope="col">작성일</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr> -->
                    <?=$boardList?>
                <!-- </tr> -->
            </tbody>
        </table>
    </div>
</body>

</html>