# 差分チェック用

2つの環境のサイトで出力されているコードに差が発生しているか確認するために作成。

## WordPressやMODXからURLリストを生成するプログラム

- wordpress_makeurl.php
- modx_makeurl.php

## URLリストからコンテンツデータを取得してファイルに保存するプログラム

- filePutCntents.php

生成されたディレクトリにdiffコマンドを再帰的に実行して差が発生しているか確認する。