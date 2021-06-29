<?php
session_start();
if(isset($_SESSION['user_id'])){
header("Location:mypage.php");
}
?>


<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
            <title>マイページ登録</title>
                <link rel="stylesheet" type="text/css" href="login.css">
    </head>

<body>
    <header>
        <img src="4eachblog_logo.jpg">
            <div class="login"><a href="login.php">ログイン</a></div>
    </header>

<main>
    <form method="post" action="mypage.php">
    <div class="box1">
        <div class="form_contents">

            <div class="mail">
                <label>メールアドレス</label><br>
                    <input type="text" class="formbox" size="40" value="<?php if (isset($_COOKIE['login_keep'])) {
                                                                                echo $_COOKIE['mail'];
                                                                            }
                                                                                 ?>" name="mail">
            </div>

            <div class="password">
                <label>パスワード</label><br>
                    <input type="password" class="formbox" size="40" value="<?php if (isset($_COOKIE['login_keep'])) {
                                                                                echo $_COOKIE['password'];
                                                                                }
                                                                            ?>" name="password" id="password">
            </div>

            <div class="hozi">
                <input type="checkbox" class="formbox" size="40" name="login_keep" value="login_keep"
                    <?php
                        if(isset($_COOKIE['login_keep'])){
                        echo "checked='checked'";
                        }
                    ?><label>ログイン状態を保持する</label>
                   
            </div>

            <div class="toroku">
                <input type="submit" class="submit_button" size="35" value="ログイン"> 
            </div>

        </div>
    </div>

</form>
</main>

<footer>
© 2018 InterNous.inc.All rights reserved
</footer>

<script>
function ConfirmPassword(confirm){
    var input1 = password.value;
    var input2 = confirm.value;
    if(input1 != input2){
        confirm.setCustomValidity("パスワードが一致しません。");
    }else{
        confirm.setCustomValidity(");
    }
}
</script>

</body>
</html>
