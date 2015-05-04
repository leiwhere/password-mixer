

# FAQ #

## Q: 如何使用APM 注册用户信息? ##

A: Python用户使用方式如下:
```python

from apm import *

ret = apm_register_user(“testuser”, “istest”, “testuser@test.com”)
if ret == 0:
print “register user successful !”```

PHP用户使用方式如下：
```php

include_once("./apm.php");
$ret = apm_register_user(“testuser”, “istest”, “testuser@test.com”)
if (ret == 0)
{
print “register user successful !\n”;
}```

Ruby用户使用方式如下：
```ruby

require 'apm'
ret = apm_register_user(“testuser”, “istest”, “testuser@test.com”)
if ret == 0
puts “register user successful !\n”
end
```

## Q: 如何使用APM验证用户信息? ##

A: Python用户使用方式如下:
```python

from apm import *

if apm_authenticate_user(“testuser”, “istest”) == 0:
print “authenticate user successful !”
else
print “authenticate user failed !”```

PHP用户使用方式如下：
```php

include_once("./apm.php");
if (apm_authenticate_user(“testuser”, “istest”) == 0)
{
print “authenticate user successful !\n”;
}
else
{
print “authenticate user failed !\n”;
}```

Ruby用户使用方式如下：
```ruby

require 'apm'
if apm_authenticate_user(“testuser”, “istest”) == 0
puts “authenticate user successful !\n”
else
puts “authenticate user failed !\n”
end
```

## Q: 如何使用APM 删除用户注册信息? ##

A: Python用户使用方式如下:
```python

from apm import *

apm_delete_user(“testuser”)```

PHP用户使用方式如下：
```php

include_once("./apm.php");
apm_delete_user(“testuser”);```

Ruby用户使用方式如下：
```ruby

require 'apm'
apm_delete_user(“testuser”)
```

## Q: 使用APM希望保存用户的原始密码，怎么办? ##

A: APM 默认不保存用户的原始密码，如果需要保存：

Python用户请修改pm\_config.py中的`g_apm_register_type`变量；

PHP用户请修改pm\_config.php中的`$g_apm_register_type`变量，将该值设置为1；

Ruby用户请修改apm\_config.rb中的`$g_apm_register_type`变量，将该值设置为1，

则保存用户的原始密码。

## Q: 如何设置数据库的存储位置? ##

A: Python用户请修改apm\_config.py中的`g_apm_db_path`变量，例如`g_apm_db_path = "/usr/apm/base"`；

PHP用户请修改apm\_config.php 中的`$g_apm_db_path`变量，例如 `$g_apm_db_path = “/usr/apm/base”;`；

Ruby用户请修改apm\_config.rb中的`$g_apm_db_path`变量，例如`$g_apm_db_path = “/usr/apm/base”`。

## Q: 如何设置公钥存放的位置? ##

A: Python用户请修改apm\_config.py 中的`g_apm_pub_key_path`变量，例如`g_apm_pub_key_path = "/usr/apm/key"`。

PHP用户请修改apm\_config.php 中的`$g_apm_pub_key_path`变量，例如`$g_apm_pub_key_path = “/usr/apm/key”;`；

Ruby用户请修改apm\_config.rb中的`$g_apm_pub_key_path`变量，例如`$g_apm_pub_key_path = “/usr/apm/key”`。

## Q: 如何确保在调用用户注册函数效率最高? ##

A: 可选择不保存用户原始密码及其它信息，APM 默认不保存用户的原始密码。

Python用户在调用`apm_register_user`函数时`ext_info`设置为空字符串，例如: `apm_register_user("testuser", "istest", "")`；

PHP用户在调用`apm_register_user`函数时`ext_info`设置为空字符串，例如: `apm_register_user(“testuser”, “istest”, “”);`;

Ruby用户在调用`apm_register_user`函数时`ext_info`设置为空字符串，例如:`apm_register_user(“testuser”, “istest”, “”)`。

## Q: 使用APM希望过滤高频密码，怎么办? ##
A: APM默认不过滤高频密码，如果需要过滤

Python用户请修改apm\_config.py中的`g_apm_check_frequently_used_pwd`变量，将该值设置为`1`，则过滤高频密码

PHP用户请修改apm\_config.php 中的`$g_apm_check_frequently_used_pwd`变量，将该值设置为`1`，则过滤高频密码

Ruby用户请修改apm\_config.rb中的`$g_apm_check_frequently_used_pwd`变量，将该值设置为`1`，则过滤高频密码

## Q: 什么是高频密码?为什么要过滤高频密码？ ##
A: 安天针对当前脱库等安全威胁中泄露的密码进行统计，对用户使用最多密码进行排序的TOP 100的列表。

该列表中的密码使用数量占用户总数的20%~30%之间，是最容易被猜测命中及暴力破解的密码。APM中加入了高频密码的过滤功能，但出于效率的考虑该开关默认是关闭的。在APM的下一个版本中将会推出高频密码过滤在客户端可应用的JavaScript脚本。