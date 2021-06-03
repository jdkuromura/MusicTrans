<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Music Trans Top</title>

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
  left: calc(50% - 255px);
  z-index: 2;
}

.header div{
  float: left;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 35px;
  font-weight: 200;
}

.header div span{
  color: #5379fa !important;
}


.signup{
  position: absolute;
  top: calc(50% - 75px);
  left: calc(50% - 50px);
  height: 150px;
  width: 350px;
  padding: 10px;
  z-index: 1;
}

.login{
  position: absolute;
  top: calc(50% - 5px);
  left: calc(50% - 50px);
  height: 150px;
  width: 350px;
  padding: 10px;
  z-index: 2;
}


.signup input[type=submit]{
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

.signup input[type=submit]:hover{
  opacity: 0.8;
}

.signup input[type=submit]:active{
  opacity: 0.6;
}

.signup input[type=submit]:focus{
  outline: none;
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

.login input[type=submit]:focus{
  outline: none;
}

    </style>

</head>

<body>
<div class="body"></div>
    <div class="grad"></div>
    <div class="header">
    <div>Music<span>Trans</span></div>
</div>

<div class="signup">
    <form action="signup.php" method="post">
    <input type="submit" name="regist" value="Sign Up">
    </form>
</div>

<div class="login">
    <form action="login.php" method="post">
    <input type="submit" name="login" value="Log In">
    </form>
</div>


<?php
// filesの中身削除
function rmdirAll($dir) {
	// 指定されたディレクトリ内の一覧を取得
	$res = glob($dir.'/*');
 
	// 一覧をループ
	foreach ($res as $f) {
		// is_file() を使ってファイルかどうかを判定
		if (is_file($f)) {
			// ファイルならそのまま出力
			unlink($f);
		} else {
			// ディレクトリの場合（ファイルでない場合）は再度rmdirAll()を実行
			rmdirAll($f);
		}
	}
}
 
// 最初にディレクトリを指定する
rmdirAll('./files');
?>



</body>
</html>