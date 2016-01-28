# class.mysql.php


Classe PHP para conectar e fazer queries MySQL

## Uso

```bash
$mysql = new MysqlClass("localhost", "root", "root", "database");
$posts = $mysql->query('select * from table;');
$number_posts = mysql_num_rows($posts);
```
