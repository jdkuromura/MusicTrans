<?php

// メール情報
// メールホスト名・gmailでは smtp.gmail.com
define('MAIL_HOST','smtp.gmail.com');

// メールユーザー名・アカウント名・メールアドレスを@込でフル記述
define('MAIL_USERNAME','****@gmail.com');

// メールパスワード・上で記述したメールアドレスに即したパスワード
define('MAIL_PASSWORD','thJTxgyPcm');

// SMTPプロトコル(sslまたはtls)
define('MAIL_ENCRPT','tls');

// 送信ポート(ssl:465, tls:587)
define('SMTP_PORT', 587);

// メールアドレス・ここではメールユーザー名と同じでOK
define('MAIL_FROM','****@gmail.com');

// 表示名
define('MAIL_FROM_NAME','****');

// メールタイトル
define('MAIL_SUBJECT','登録完了のお知らせ');

