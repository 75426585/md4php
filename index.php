<?php

header("Content-type:text/html;charset=utf-8");
require_once('md4php.php');
$mt = new MdTpl();
$mt->display('test.md',true,'file');
