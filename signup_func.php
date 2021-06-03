<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Music Trans Sign Up</title>

    <style>
    @import url(https://fonts.googleapis.com/css?family=Exo:100,200,400);
@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

body{
  margin: 0;
  padding: 0;
  background: #fff;

  color: #fff;
  font-family: Arial;
  font-size: 12px;
}

.body{
  position: absolute;
  top: -20px;
  left: -20px;
  right: -40px;
  bottom: -40px;
  width: auto;
  height: auto;
  background-image: url(5ea5a6375B15D.jpg);
  background-size: cover;
  -webkit-filter: blur(5px);
  z-index: 0;
}

.grad{
  position: absolute;
  top: -20px;
  left: -20px;
  right: -40px;
  bottom: -40px;
  width: auto;
  height: auto;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
  z-index: 1;
  opacity: 0.7;
}

.header{
  position: absolute;
  top: calc(50% - 35px);
  left: calc(50% - 60px);
  z-index: 2;
}

.header div{
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 15px;
  font-weight: 200;
}

.header div span{
  color: #5379fa !important;
}

.login{
  position: absolute;
  top: calc(50% - 5px);
  left: calc(50% - 140px);
  height: 150px;
  width: 350px;
  padding: 10px;
  z-index: 2;
}

.login input[type=text]{
  width: 250px;
  height: 30px;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: 2px;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 4px;
}

.login input[type=password]{
  width: 250px;
  height: 30px;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: 2px;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 4px;
  margin-top: 10px;
}

.login input[type=submit]{
  width: 260px;
  height: 35px;
  background: #fff;
  border: 1px solid #fff;
  cursor: pointer;
  border-radius: 2px;
  color: #a18d6c;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 6px;
  margin-top: 10px;
}

.login input[type=submit]:hover{
  opacity: 0.8;
}

.login input[type=submit]:active{
  opacity: 0.6;
}

.login input[type=text]:focus{
  outline: none;
  border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
  outline: none;
  border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=submit]:focus{
  outline: none;
}

::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6);
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6);
}



    </style>
</head>

<body>
<?php
$dsn = 'mysql:dbname=****;host=localhost';
$user = '****';
$password = '****';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = "CREATE TABLE IF NOT EXISTS users"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
    . "address TEXT,"
    . "pass TEXT"
	.");";
    $stmt = $pdo->query($sql);
?>

<div class="body"></div>
    <div class="grad"></div>
    <div class="header">
      
    

<?php

// フォーム情報の取得
$name = $_POST['name'];
$address = $_POST['address'];
$pass = $_POST['pass'];

if(empty($name) || empty($address) || empty($pass)){
    echo"<div>Please fill in all the blanks.</div>";
}
else{
    // 会員情報をデータベースに登録
    // メールアドレスが被っていたらエラー
    $stmt = $pdo->prepare('SELECT * FROM users where address=:address');
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->execute();
            $rep_user = $stmt->fetch(PDO::FETCH_ASSOC);
            $rep_address = $rep_user['address'];
    if(!empty($rep_address)){
        echo "<div>This address has already been used.</div>"; 
    }
    else{
        require 'src/Exception.php';
        require 'src/PHPMailer.php';
        require 'src/SMTP.php';
        require 'setting.php';

        // PHPMailerのインスタンス生成
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            $mail->isSMTP(); // SMTPを使うようにメーラーを設定する
            $mail->SMTPAuth = true;
            $mail->Host = MAIL_HOST; // メインのSMTPサーバー（メールホスト名）を指定
            $mail->Username = MAIL_USERNAME; // SMTPユーザー名（メールユーザー名）
            $mail->Password = MAIL_PASSWORD; // SMTPパスワード（メールパスワード）
            $mail->SMTPSecure = MAIL_ENCRPT; // TLS暗号化を有効にし、「SSL」も受け入れます
            $mail->Port = SMTP_PORT; // 接続するTCPポート

        // メール内容設定
            $mail->CharSet = "UTF-8";
            $mail->Encoding = "base64";
            $mail->setFrom(MAIL_FROM,MAIL_FROM_NAME);
            $mail->addAddress("{$address}", "{$name}さん"); //受信者（送信先）を追加する
            //    $mail->addReplyTo('xxxxxxxxxx@xxxxxxxxxx','返信先');
            //    $mail->addCC('xxxxxxxxxx@xxxxxxxxxx'); // CCで追加
            //    $mail->addBcc('xxxxxxxxxx@xxxxxxxxxx'); // BCCで追加
            $mail->Subject = MAIL_SUBJECT; // メールタイトル
            $mail->isHTML(true);    // HTMLフォーマットの場合はコチラを設定します
            $body = '登録が完了しました！';

            $mail->Body  = $body; // メール本文
            // メール送信の実行
            if(!$mail->send()) {
                echo "<div>Mailer Error:   $mail->ErrorInfo</div>";
            } else {
                echo '<div>Registration Successful!!</div>';
                $sql = $pdo -> prepare("INSERT INTO users (name, address, pass) VALUES (:name, :address, :pass)");
                $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                $sql -> bindParam(':address', $address, PDO::PARAM_STR);
                $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
                $sql -> execute();
            }
    }
}
?>

<div class="login">
    <form action="top.php" method="post">
    <input type="submit" name="login" value="Back to the Top">
    </form>
</div>

</body>
</html>