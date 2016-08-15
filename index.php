<?php

header("Content-type:text/html;charset=utf-8");
require_once('md4php.php');
$mt = new MdTpl();
$mt->code_skin = 'emacs';
$mt->static_dir = '/static/';
$res = $mt->display('test.md','','file');
echo $res;
