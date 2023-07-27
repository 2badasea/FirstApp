<?php
require_once('../common/bootstrapCdn.php');
?>
<?=$bootstarpCdn?>
<?php
    if(isset($_GET['error'])){
        if($_GET['error'] === "invalid_credentials"){
            echo "<script>alert('아이디 또는 다시 입력해주세요.')</script>";
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
    .container2 {
        position: absolute;
        top: 55%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 40%;
    }
    form {
        padding: 50px;
        border: 1px solid lightgray;
    }
</style>

<body>
    <div class="container-fluid">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="main.php">홈</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="loginForm.php">로그인</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="joinForm.php">회원가입</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">마이페이지</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">관리자</a>
            </li>
        </ul>
    </div>
    <div class="container-fluid" align="center" style="border-bottom: 0.5px solid lightsteelblue;">
        <a href="main.php"><img src="https://th.bing.com/th/id/OIP.7kK3U1NINjAj5xzmNaKr8AAAAA?pid=ImgDet&rs=1" class="img-fluid" style="max-width: 150px;"></a>
    </div>
    <div class="container container2">
        <form method="POST" action="../process/login.php" onsubmit="if(!formCheck()){return false;}">
            <h2 style="text-align: center; font-weight: 700;">Login</h2>
            <div class="form-group">
                <label for="inputId">ID</label>
                <input type="text" name="id" class="form-control" id="inputId" aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
                <label for="inputPwd">Password</label>
                <input type="password" name="password" class="form-control" id="inputPwd" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="autoLoginCheck">
                <label class="form-check-label" for="autoLoginCheck">Auto Login</label>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block loginBtn">Sign In</button>
        </form>
    </div>

</body>
<script>
    function formCheck(){
        const inputId = $("#inputId").val().trim();
        const inputPwd = $("#inputPwd").val().trim();
        if(inputId.length == 0 || inputPwd.length == 0){
            alert("빈 공백은 입력할 수 없습니다.");
            return false;
        }else{
            return true;
        }
    }
</script>
<script>
    $(function() {
        
    })
</script>

</html>