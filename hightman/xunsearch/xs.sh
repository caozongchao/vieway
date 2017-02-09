/usr/local/xunsearch/bin/xs-ctl.sh restart
php /usr/local/nginx/html/vieway/vendor/hightman/xunsearch/util/Indexer.php --rebuild --source=mysql://root:caozongchao@127.0.0.1/vieway --sql="select * from view" --project=view
