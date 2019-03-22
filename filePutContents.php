<?php
/**
 * URLリストのページを取得してファイルに保存
 * 保存時のファイル名はURLをMD5ハッシュ化した値
 */
$shortopts = "f:";
$options = getopt($shortopts);

if (!isset($options['f']) || is_null($options['f'])) {
    echo '$ php this.php -f url.list' . PHP_EOL;
    die();
}

// URLリストの取得
$lines = file($options['f']);

$context = stream_context_create([
        'http' => [
            'ignore_errors' => true
        ]
    ]);

foreach ($lines as $line_num => $line) {
    $body = file_get_contents(trim($line), false, $context);
    $url = urlReplace($line);
    $md5_hash = md5(trim($url));
    file_put_contents('./page/' . $md5_hash, $body);
    echo '.';
}

/**
 * 開発と本番でURLが違う場合は生成されるファイル名が異なるのでこの関数で置換を行う。
 */
function urlReplace($url)
{
    // $url = str_replace("dev", "pro", $url);
    return $url;
}
