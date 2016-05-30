---------------------
> 对样式的支持
- [x] 1.  aaaaaaaaaaaaaaaa
- [ ] 2. ~~bbbbbbbbbbb~~
- [x] 3. ==ccccccc==
- [x] 4. ++dddddddddd++

---

- 对代码的支持
```sql
update test set test_days  =
ceil((test_out_time - unix_timestamp(from_unixtime(test_into_time,'%Y-%m-%d')))/86400) 
where last_out_time > 0
```

>对副标题的支持

>列表的支持 
-  列表
-  列表

```php
header("Content-type:text/html;charset=utf-8");
require_once('md4php.php');
$mt = new MdTpl();
$mt->display('test.md',true,'file');
```

