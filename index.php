<?php

// $ftp_server:FTPサーバ名(ホスト名、IPアドレスなど)
// $ftp_port:ポート番号(通常は21)
// $ftp_user_name:FTPログイン名
// $ftp_user_pass:FTPログインパスワード
// $ftp_send_file:送信対象ファイルパス(./test.txtなど)
// $ftp_remote_file:送信先のパス(/home/hoge/test.txtなど)

$ftp_server = '54.221.142.250';
$ftp_port = 21;
$ftp_user_name = 'ftpuser';
$ftp_user_pass = 'phpftpdemo';
$ftp_send_file = './test.txt';
$ftp_remote_file = '/home/hoge/test.txt';

// FTPサーバへ接続する
$conn_id = ftp_connect($ftp_server, $ftp_port);
if($conn_id == false){
    echo "FTPサーバへの接続失敗"."\n";
    exit();
}

// ユーザー名とパスワードでログインする
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
if($login_result == false){
    echo "FTPサーバへのログイン失敗"."\n";
    // 接続を閉じる
    ftp_close($conn_id);
    exit();
}

//パッシブモードに設定
ftp_pasv($conn_id, true);

// ファイルをアップロードする
if (ftp_put($conn_id, $ftp_remote_file, $ftp_send_file, FTP_ASCII)) {
    echo "UPLOAD 成功"."\n";
} else {
    echo "UPLOAD 失敗"."\n";
}


$ftp_download_file = '/home/hoge/sample.txt';
$ftp_local_file = 'sample.txt';

// ファイルをダウンロード
if (ftp_get($conn_id, $ftp_local_file, $ftp_download_file, FTP_ASCII)) {
    echo "DOWNLOAD 成功"."\n";
} else {
    echo "DOWNLOAD 失敗"."\n";
}

// カレントディレクトリの内容を得る
// $contents = ftp_nlist($conn_id, "/home/hoge");

// $contents を出力する
// print_r($contents);


// 接続を閉じる
ftp_close($conn_id);

?>


<!-- FTP の転送ではバイナリモードとアスキーモードの2種類があります。
バイナリーモードとアスキーモードの違いは単純でアスキーモードの場合はFTPクライアントに合わせた改行コードに変換されます。
バイナリモードの場合はファイルを変換無く転送します。(*)よってテキストファイルの改行を変更せずに転送したい場合は、テキストファイルでもバイナリモードで転送してください。 -->
