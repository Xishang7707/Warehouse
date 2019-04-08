<?php
/**
 * id生成规则: yyMMdd+毫秒时间戳后4位+操作员id后4位(总共14位)
 */

/*
0 否
1 是

200 成功
400 请求错误
-----10000-----用户错误
10001 用户工号已存在
10002 账号密码验证错误
10003 未登录

*/

$config['DB']['host']='xis7707.com';
$config['DB']['dbname']='DB_Warehouse';
$config['DB']['username']='Warehouse';
$config['DB']['password']='WarehouseAdmin...';

$config['PubKey']='-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCm0fuTsiRU9STm7RyjHJVxJiWr
Jtd1mI3rFDKMf4NwjljswwsE+XZQgQefhFsmIsk96vnUTb4nIwXeesuGHr4k62qL
fSc7HxhKDnWY7NkBv/7MIXhFAgVu1sPDADyJJY7y+R7X4g5fbxnzS42UEsTOuvAH
E0RQtUpT7kr14w+oFwIDAQAB
-----END PUBLIC KEY-----';
$config['PrvKey']='-----BEGIN PRIVATE KEY-----
MIICdQIBADANBgkqhkiG9w0BAQEFAASCAl8wggJbAgEAAoGBAKbR+5OyJFT1JObt
HKMclXEmJasm13WYjesUMox/g3COWOzDCwT5dlCBB5+EWyYiyT3q+dRNvicjBd56
y4YeviTraot9JzsfGEoOdZjs2QG//swheEUCBW7Ww8MAPIkljvL5HtfiDl9vGfNL
jZQSxM668AcTRFC1SlPuSvXjD6gXAgMBAAECgYAgOvW2RXbLi0mD7E/aG82rvMkO
VkTOjZjt0Esr5f8JIheANvbMET6Qsz07zqClr5beBaYbJKIWgafCokrsMMhfndON
eTgc+2wETsyUdoWMCrzIy9o4QFV5gxSnBy9CtMfc2PUtUvPT0tnhZYH9oqJceF0f
vIVmPm6f6Lkfi6ta8QJBANPEz6wv1Ixp0jAORsyIOPg14sWNLCtrT/Fliyo/aYxa
NKWW0nMfPMQsVqXjkkDoZgbnHqmIKfSti5YRsV6aCWUCQQDJqcqZqIvnngQqPlVr
cgLhkPUnSmcHvLyqcxSzSfQ1uNrwOFtREbFFhVKUsYFNOyslJHFWGb7BKTWyVaXz
uJHLAkByYzTqBUwCLIbkflGv2UUsja7YltDtAyJDel4Zi/cvYOpfJ4C1voHMVUbY
hHxTozS5Nc5SNMK076kefqAYQYwhAkAsAvlrhaRa/VqNWaNM2soULo3CcHOB9cf7
LziCVI6OtvRZXwNW8xSMRqeaOg8tKs+kwIpXrzC5eWP1ssmQImT3AkAD1TEoYCw9
i2D20w+I4rQtb0f9j7b8GkPUE/TuBVN7i/n73rR1EfQ3OY3R+UuMTED+E30E4udY
u2TQGWt6tGp6
-----END PRIVATE KEY-----';

$config['DEBUG']=true;

return $config;