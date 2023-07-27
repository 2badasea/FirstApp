<?php
require_once('../common/bootstrapCdn.php');
?>
<?=$bootstarpCdn?>
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
    <div class="container-fluid" align="center" style="border-bottom: 0.5px solid lightsteelblue;">
        <a href="main.php"><img src="https://th.bing.com/th/id/OIP.7kK3U1NINjAj5xzmNaKr8AAAAA?pid=ImgDet&rs=1" class="img-fluid" style="max-width: 150px;"></a>
    </div>
    <div class="container container2">
        <form action="../process/join.php" method="post" class="frm">
            <h4 style="text-align: center; font-weight: 600;">회원가입</h4>
            <div class="form-group">
                <label for="inputId">ID</label>
                <div style="display: flex;">
                    <input type="text" name="id" class="form-control col" id="inputId" placeholder="아이디를 입력하세요." required>
                    <button type="button" class="btn btn-primary btn-md idCheckBtn" data-check="">중복확인</button>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPwd">Password</label>
                <input type="password" class="form-control" id="inputPwd" placeholder="비밀번호를 입력하세요." required>
            </div>
            <div class="form-group">
                <label for="inputPwdCheck">Password 확인</label>
                <input type="password" name="password" class="form-control" placeholder="비밀번호를 확인하세요." id="inputPwdCheck" required>
            </div>
            <div class="form-group">
                <label for="inputName">이름</label>
                <input type="text" class="form-control" name="name" id="inputName" placeholder="이름을 입력하세요." required>
            </div>
            <button type="submit" class="btn btn-primary btn-lg btn-block joinBtn">Sign Up</button>
        </form>
    </div>
</body>
<script>
    // 입력값에 대한 유효성 체크
</script>
<script>
    $(function() {
        // 아이디 중복 체크 이벤트
        $(".idCheckBtn").on("click", function() {
            const checkId = $("#inputId").val();
            if (!/^[a-zA-Z][a-zA-Z0-9]{6,29}$/.test(checkId)) {
                alert('올바른 id 형식이 아닙니다.');
                return false;
            }
            console.log('ajax이전');
            $.ajax({
                url: "../process/join.php",
                method: "GET",
                data: {
                    id: checkId
                },
                success: function(msg) {
                    console.log(msg);
                    if (msg == true) { // 1이 넘어옴 => 1 == true,   
                        alert("회원가입 가능");
                        $(".idCheckBtn").data('check', 'yes');
                        // $(this).attr('data-check', 'yes'); 표현도 가능
                        $('#inputId').attr("disabled", true); // 입력창 비활성화
                    } else {
                        alert("중복된 아이디");
                        $(".idCheckBtn").data('check', 'no');
                    }
                },
                error: function(xhr) {
                    alert(xhr);
                }
            })
        })


        // 가입 버튼 => 입력값 유효성 체크 함수 formCheck() 호출
        $(".joinBtn").on("click", function(e) {
            e.preventDefault();
            if (formCheck()) {
                $(".frm").submit();
            }
        })

        // 회원가입 폼 유효성 체크
        function formCheck() {
            const id = $('#inputId').val();
            const pwd = $('#inputPwd').val();
            const pwdCheck = $("#inputPwdCheck").val();
            const name = $("#name").val();

            const idReg = /^[a-zA-Z][a-zA-Z0-9]{6,29}$/;
            const pwdReg = /^[a-zA-Z0-9!@#$%^&*]{8,15}$/; // 최소 8~최대 15자리
            const nameReg = /^[a-zA-Z가-힣]{2,10}$/; // 최소2~최대 10자리

            if (!idReg.test(id)) {
                alert("아이디를 확인해주세요.");
                return false;
            }
            if ($(".idCheckBtn").data('check') != "yes") {
                alert("아이디 중복 체크를 해주세요");
                return false;
            }
            if (!pwdReg.test(pwd)) {
                alert('비밀번호를 확인해주세요.');
                return false;
            }
            if (pwd !== pwdCheck) {
                alert("비밀번호가 일치하지 않습니다.");
                return false;
            }
            if (!nameReg.test(name)) {
                alert('이름을 확인해주세요.');
                return false;
            }

            const joinCheck = confirm("가입하시겠어요?");
            if (!joinCheck) {
                alert('가입이 취소되었습니다.');
                $(".frm input").val("");
                return false;
            }
            return true;
        } // formCheck();
    })
</script>

</html>