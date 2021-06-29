<?php
mb_internal_encoding("utf8");

//セッションスタート
session_start();

//mypage.phpからの導線以外は、『login_error.php』へリダイレクト
if(empty($_POST['from_mypage'])){
    header("Location:login_error.php");
}

?>

<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>マイページ登録</title>
<link rel="stylesheet" type="text/css" href="mypage_hensyu.css">
</head>

<body>
<!--このbodyの中に、マイページとして表示する部分を記述していく
(HTMLとsessionを記述。編集できるように、sessionはvalueに入れる。)-->

<header>
<img src="4eachblog_logo.jpg">
</header>

<div class="box1">
    <h2>会員情報</h2>
        <div class="confirm">
            <div class="form_contents">
                <?php echo "こんにちは！ ".$_SESSION['name']."さん";?>
            </div>

                <form action="mypage_update.php" method="post">
                    <div class= "profile_pic">
                        <img src="<?php echo $_SESSION['path_filename']; ?>">
                    </div>

                    <div class="basic_info">
                        <p>氏名：<input type="text" size="30" value="<?php echo $_SESSION['name']; ?>" name="name"></p>
                        <p>メール：<input type="text" size="30" value="<?php echo $_SESSION['mail']; ?>" name="mail"></p>
                        <p>パスワード:<input type="text" size="30" value="<?php echo $_SESSION['password']; ?>" name="password"></p>
                    </div>

                    <div class="comments">
                        <textarea name="comments" rows="4" cols="75" ><?php echo $_SESSION['comments']; ?></textarea>
                    </div>

        </div>

                    <div class="submit">
                        <form action="mypage_update.php" method="post">
                            <input type="submit" class="submit_button" value="この内容に変更する"/>
                    </div>
                </form>

</div>


<footer>
© 2018 InterNous.inc.All rights reserved
</footer>

</body>
</html>