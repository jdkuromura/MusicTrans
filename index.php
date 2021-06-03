<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>MusicTrans Top</title>

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
  top: calc(50% - 90px);
  left: calc(50% - 70px);
  z-index: 2;
}

.title{
  float: left;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 35px;
  font-weight: 200;
}

.header div span{
  color: #5379fa !important;
}

.intro{
  position: absolute;
  top: 50px;
  left: -100px;
  right: -40px;
  bottom: -40px;
  font-family: 'Exo', sans-serif;
  font-size: 15px;
  width: auto;
  height: auto;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
  z-index: 1;
  opacity: 0.7;
  white-space: nowrap;
}

.signup{
  position: absolute;
  top: calc(50% - -10px);
  left: calc(50% - 120px);
  height: 150px;
  width: 350px;
  padding: 10px;
  z-index: 1;
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


    </style>

</head>

<body>
<div class="body"></div>
    <div class="grad"></div>
    <div class="header">
    <div class=title>Music<span>Trans</span></div>
    <div class="intro"> 
    MusicTransはお好きな音楽を，ホールやトンネルといった<br>
    様々な場所で聴いたように再現・再生できるWebアプリです
    </div>
</div>

<div class="signup">
    <form action="music_up.php" method="post">
    <input type="submit" name="regist" value="File Select Page">
    </form>
</div>

<!-- admax -->
<script src="https://adm.shinobi.jp/s/0777e662be1058e6d5a0d3bc40c4750d"></script>
<!-- admax -->


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