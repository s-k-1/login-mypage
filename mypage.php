<?php
mb_internal_encoding("UTF-8");
session_start();

if(empty($_SESSION['user_id'])){

    try{
    //try catch文。DBに接続できなければエラーメッセージを表示
    $pdo = new PDO("mysql:dbname=lesson02;host=localhost;","root","");
}catch(PDOException $e){
    die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインをしてください。</p>
    <a href='http://localhost/login_mypage/login_mypage/login.php'>ログイン画面へ</a>"
    );
}



//prepared statement(プリペアードステートメント)でSQL文の型を作る(DBとpostデータを照合させる。select文とwhere句を使用。)
$stmt = $pdo->prepare("select * from login_mypage where mail = ? && password = ?");

//bindvalueメソッドでパラメータをセッと
$stmt->bindValue(1,$_POST['mail']);
$stmt->bindValue(2,$_POST['password']);


//executeでクエリを実行
$stmt->execute();

//データベースを切断
$pdo = NULL;

//fetch・while文でデータを取得し、sessionに代入
while($row = $stmt->fetch()){
    $_SESSION['user_id']=$row['user_id'];
    $_SESSION['name']=$row['name'];
    $_SESSION['mail']=$row['mail'];
    $_SESSION['password']=$row['password'];
    $_SESSION['path_filename']=$row['picture'];
    $_SESSION['comments']=$row['comments'];
}

if(empty($_SESSION['user_id'])){
    header("Location:login_error.php");
}


if(!empty($_POST['login_keep'])){
    $_SESSION['login_keep']=$_POST['login_keep'];
    }
}

//データが取得できずに(emptyを使用して判定)sessionがなければ、リダイレクト(エラー画面へ)

if(!empty($_SESSION['user_id']) && !empty($_SESSION['login_keep'])){
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);
    
    }else if(empty($_SESSION['login_keep'])){
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('login_keep','',time()-1);
    }
?>

<!DOCTYPE HTML>
<html lang = "ja">

<head>
    <meta charset="UTF-8">
    <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="mypage.css">
</head>

<body>
<!--このbodyの中に、マイページとして表示する部分を記述していく(HTMLと代入したsessionを記述)-->

<header>
    <img src="4eachblog_logo.jpg">
</header>

<main>
<div class="box1">
    <h2>会員情報</h2>
        <div class="confirm">
            <div class="form_contents">
                <?php echo "こんにちは！ ".$_SESSION['name']."さん";?>
            </div>

            <div class= "profile_pic">
                <img src="<?php echo $_SESSION['path_filename']; ?>">
            </div>

            <div class="basic_info">
                <p>氏名：<?php echo $_SESSION['name']; ?></p>
                <p>メール：<?php echo $_SESSION['mail']; ?></p>
                <p>パスワード：<?php echo $_SESSION['password']; ?></p>
            </div>

            <div class="comments">
                <?php echo $_SESSION['comments']; ?>
            </div>
            
            <form action="mypage_hensyu.php" method="post" class="form_center">
                <input type="hidden" value="<?php echo rand(1,10);?>" name="from_mypage">
        </div>

                <div class="submit">
                    <input type="submit" class="submit_button" value="編集する">
                 </div>
            </form>
</div>
</main>

<footer>
© 2018 InterNous.inc.All rights reserved
</footer>


</body>
</html>


