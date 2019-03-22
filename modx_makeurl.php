<?php
/**
 * MODX用のURL生成外部プログラム
 */
define('URL_METHOD', 'http://');
define("MODX_API_MODE", true);
$db_name = 'modx';

include("/var/www/html/index.php");
$modx->db->connect();
$modx_setting = $modx->getSettings();

$url_host = parse_url($modx_setting['site_url'], PHP_URL_HOST);

// コンテンツテーブルのAI値取得
$sql = "SELECT auto_increment
        FROM information_schema.tables
        WHERE table_schema = '{$db_name}' 
        AND table_name = 'modx_site_content';";
$row = $modx->db->getObjectSql($sql);
$auto_increment = $row->auto_increment;

// URL生成
for ($i=0; $i < $auto_increment; $i++) {
    $sql = "SELECT * FROM modx_site_content WHERE id={$i}";
    $row = $modx->db->getObjectSql($sql);
    // データが存在しない場合は処理を飛ばす
    if ($row === false) {
        continue;
    }

    /* 必要ない除外条件はコメントアウトする */
    // コンテンツが空を除外
    if (is_null($row->content)) {
        continue;
    }
    // 非公開を除外
    if ($row->published === "0") {
        continue;
    }
    // 削除状態を除外
    if ($row->deleted === "1") {
        continue;
    }
    // コンテンツタイプがドキュメント以外を除外
    if ($row->type !== 'document') {
        continue;
    }

    // URL出力
    $args = [
        'id' => $i,
        'alias' => '',
        'args' => '',
        'scheme' => '',
        'ignoreReference' => true
    ];
    echo URL_METHOD . $url_host . $modx->makeUrl($args) . PHP_EOL;
}
