<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>トップぺージ</title>

    <style type="text/css">
    .submit_button{
        display       : inline-block;
        border-radius : 5%;          /* 角丸       */
        font-size     : 9pt;        /* 文字サイズ */
        text-align    : center;      /* 文字位置   */
        cursor        : pointer;     /* カーソル   */
        padding       : 6px 13px;   /* 余白       */
        background    : rgba(0, 0, 127, 0.75);     /* 背景色     */
        color         : #ffffff;     /* 文字色     */
        line-height   : 1em;         /* 1行の高さ  */
        transition    : .3s;         /* なめらか変化 */
        border        : 2px solid rgba(0, 0, 127, 0.75);    /* 枠の指定 */
}
.submit_button:hover {
    color         : rgba(0, 0, 127, 0.75);     /* 背景色     */
    background    : #ffffff;     /* 文字色     */
}

</style>

</head>


<body>

<!--databaseの作成-->
<?php
$dsn = 'mysql:dbname=tb221025db;host=localhost';
$user = 'tb-221025';
$password = 'thJTxgyPcm';
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

<?php

// フォーム情報の取得
$name = $_POST['name'];
$address = $_POST['address'];
$pass = $_POST['pass'];

if(empty($name) || empty($address) || empty($pass)){
    echo"全ての欄に入力してください！";
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
        echo "このE-mailは既に使用されています。"; 
    }
    else{
        $sql = $pdo -> prepare("INSERT INTO users (name, address, pass) VALUES (:name, :address, :pass)");
                $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                $sql -> bindParam(':address', $address, PDO::PARAM_STR);
                $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
                $sql -> execute();

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
                echo 'メッセージは送られませんでした！<br>';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo '送信完了！';
            }
    }
}
?>


<form action="top.php" method="POST">
<button class="submit_button" type="submit" name="login">トップへ戻る</button>
</form>

</body>
</html>