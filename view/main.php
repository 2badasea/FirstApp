<?php
require_once('../common/bootstrapCdn.php');
?>
<?= $bootstarpCdn ?>
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .boardWrapper{
        margin-top: 5%;
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
    <span>글번호, 글제목, 작성자, 작성일만 출력</span>
    <div class="container boardWrapper">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">번호</th>
                    <th scope="col">제목</th>
                    <th scope="col">작성자</th>
                    <th scope="col">작성일</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>