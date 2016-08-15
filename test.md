### markdown for php : 一个markdown的php解析器
---------------------
> 对样式的支持
[x] 1. 普通的文字
[ ] 2. ~~删除的文字~~
[x] 3. ==着重显示==
[x] 4. ++下划线显示++

>对副标题的支持

>列表的支持 
-  一级分类1
  - 二级分类1
  - 二级分类2
-  一级分类2

```php
header("Content-type:text/html;charset=utf-8");
require_once('md4php.php');
$mt = new MdTpl();
$mt->display('test.md',true,'file');
```

