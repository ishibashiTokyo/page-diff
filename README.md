# Web page difference
差分チェック用

2つの環境のサイトで出力されているHTMLコードに差が発生しているか確認するために作成。

## WordPressやMODXからURLリストを生成するプログラム

以下のファイルをCMSを設置しているドキュメントルートに設置してアクセスするとURL一覧が表示されるのでファイルに保存。

- wordpress_makeurl.php
- modx_makeurl.php

## URLリストからコンテンツデータを取得してファイルに保存するプログラム

保存したURL一覧ファイルを以下のプログラムで取得

- filePutCntents.php

生成されたディレクトリにdiffコマンドを再帰的に実行して差が発生しているか確認する。

```shell
$ diff -r page1/ page2/
```
