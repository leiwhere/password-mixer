

# Python接口 #

## apm\_register\_user (user, password, ext\_info) ##
注册用户名、密码、以及其它信息到数据库中

**参数**:

user(string) – 用户名称，不可以使用空字符串

password(string) – 密码，不可以使用空字符串

ext\_info(string) – 其它信息，可以使用空字符串

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 用户名或密码输入为空

> 返回-3: 该用户名己经注册

> 返回-4: 保存原始密码失败，请确认/opt/AntiyPasswordMixer/keys/pubkey.pem是否存在，以及该文件是否有权限访问

> 返回-5: 保存其它信息失败，请确认/opt/AntiyPasswordMixer/keys/pubkey.pem是否存在，以及该文件是否有权限访问

> 返回-6: 保存用户信息失败，请确认磁盘空间是否不足，或数据库文件是否被破坏

> 返回-7: 密码为高频密码，用户不可使用该密码

## apm\_change\_pwd(user, oldpwd, newpassword) ##
修改密码

**参数**:

user (string) – 用户名称，不可以使用空字符串

oldpwd (string) – 原始密码，不可以使用空字符串

newpassword(string) – 修改后的密码，不可以使用空字符串

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 用户名或密码输入为空

> 返回-3: 该用户名不存在或输入的原始密码错误

> 返回-4: 该用户己被置为无效用户

> 返回-5: 保存用户信息失败，请确认磁盘空间是否不足，或数据库文件是否被破坏

> 返回-6: 保存原始密码失败，请确认/opt/AntiyPasswordMixer/keys/pubkey.pem是否存在，以及该文件是否有权限访问

> 返回-7: 密码为高频密码，用户不可使用该密码

## apm\_delete\_user(user) ##
删除用户及用户相关信息

**参数**:

user (string) – 用户名称，不可以使用空字符串

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 用户名输入为空

> 返回-3: 该用户名不存在

## apm\_authenticate\_user(user, password) ##
验证用户名及密码是否正确

**参数**:

user (string) – 用户名称，不可以使用空字符串

password(string) – 密码，不可以使用空字符串

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 用户名或密码输入为空

> 返回-3: 该用户名不存在

> 返回-4: 该用户己被置为无效用户

> 返回-5: 输入的密码错误

## apm\_set\_user\_validity(user, validity) ##
设置用户是否有效

**参数**:

user (string) – 用户名称，不可以使用空字符串

validity (int) – 有效性，输入0 该用户名失效，输入1 用户名有效

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 该用户名不存在

> 返回-3: 保存用户信息失败，请确认磁盘空间是否不足，或数据库文件是否被破坏

# PHP接口 #

## apm\_register\_user ($user, $password, $ext\_info) ##

注册用户名、密码、以及其它信息到数据库中

**参数**:

$user (string) – 用户名称，不可以使用空字符串

$password(string) – 密码，不可以使用空字符串

$ext\_info(string) – 其它信息，可以使用空字符串

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 用户名或密码输入为空

> 返回-3: 该用户名己经注册

> 返回-4: 保存原始密码失败，请确认/opt/AntiyPasswordMixer/keys/pubkey.pem是否存在，以及该文件是否有权限访问

> 返回-5: 保存其它信息失败，请确认/opt/AntiyPasswordMixer/keys/pubkey.pem是否存在，以及该文件是否有权限访问

> 返回-6: 保存用户信息失败，请确认磁盘空间是否不足，或数据库文件是否被破坏

> 返回-7: 密码为高频密码，用户不可使用该密码

## apm\_change\_pwd($user, $oldpwd, $newpassword) ##

修改密码

**参数**:

$user (string) – 用户名称，不可以使用空字符串

$oldpwd (string) – 原始密码，不可以使用空字符串

$newpassword(string) – 修改后的密码，不可以使用空字符串

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 用户名或密码输入为空

> 返回-3: 该用户名不存在或输入的原始密码错误

> 返回-4: 该用户己被置为无效用户

> 返回-5: 保存用户信息失败，请确认磁盘空间是否不足，或数据库文件是否被破坏

> 返回-6: 保存原始密码失败，请确认/opt/AntiyPasswordMixer/keys/pubkey.pem是否存在，以及该文件是否有权限访问

> 返回-7: 密码为高频密码，用户不可使用该密码

## apm\_delete\_user($user) ##

删除用户及用户相关信息

**参数**:

$user (string) – 用户名称，不可以使用空字符串

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 用户名输入为空

> 返回-3: 该用户名不存在

## apm\_authenticate\_user($user, $password) ##

验证用户名及密码是否正确

**参数**:

$user (string) – 用户名称，不可以使用空字符串

$password(string) – 密码，不可以使用空字符串

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 用户名或密码输入为空

> 返回-3: 该用户名不存在

> 返回-4: 该用户己被置为无效用户

> 返回-5: 输入的密码错误

## apm\_set\_user\_validity($user, $validity) ##

设置用户是否有效

**参数**:

$user (string) – 用户名称，不可以使用空字符串

$validity (int) – 有效性，输入0 该用户名失效，输入1 用户名有效

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 该用户名不存在

> 返回-3: 保存用户信息失败，请确认磁盘空间是否不足，或数据库文件是否被破坏

# Ruby接口 #
## apm\_register\_user (user, password, ext\_info) ##
注册用户名、密码、以及其它信息到数据库中

**参数**:

user (string) – 用户名称，不可以使用空字符串

password(string) – 密码，不可以使用空字符串

ext\_info(string) – 其它信息，可以使用空字符串

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 用户名或密码输入为空

> 返回-3: 该用户名己经注册

> 返回-4: 保存原始密码失败，请确认/opt/AntiyPasswordMixer/keys/pubkey.pem是否存在，以及该文件是否有权限访问

> 返回-5: 保存其它信息失败，请确认/opt/AntiyPasswordMixer/keys/pubkey.pem是否存在，以及该文件是否有权限访问

> 返回-6: 保存用户信息失败，请确认磁盘空间是否不足，或数据库文件是否被破坏

> 返回-7: 密码为高频密码，用户不可使用该密码

## apm\_change\_pwd(user, oldpwd, newpassword) ##
修改密码

**参数**:

user (string) – 用户名称，不可以使用空字符串

oldpwd (string) – 原始密码，不可以使用空字符串

newpassword(string) – 修改后的密码，不可以使用空字符串

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 用户名或密码输入为空

> 返回-3: 该用户名不存在或输入的原始密码错误

> 返回-4: 该用户己被置为无效用户

> 返回-5: 保存用户信息失败，请确认磁盘空间是否不足，或数据库文件是否被破坏

> 返回-6: 保存原始密码失败，请确认/opt/AntiyPasswordMixer/keys/pubkey.pem是否存在，以及该文件是否有权限访问

> 返回-7: 密码为高频密码，用户不可使用该密码

## apm\_delete\_user(user) ##
删除用户及用户相关信息

**参数**:

user (string) – 用户名称，不可以使用空字符串

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 用户名输入为空

> 返回-3: 该用户名不存在

## apm\_authenticate\_user(user, password) ##

验证用户名及密码是否正确

**参数**:

user (string) – 用户名称，不可以使用空字符串

password(string) – 密码，不可以使用空字符串

**返回结果**:
> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 用户名或密码输入为空

> 返回-3: 该用户名不存在

> 返回-4: 该用户己被置为无效用户

> 返回-5: 输入的密码错误

## apm\_set\_user\_validity(user, validity) ##
设置用户是否有效

**参数**:

user (string) – 用户名称，不可以使用空字符串

validity (int) – 有效性，输入0 该用户名失效，输入1 用户名有效

**返回结果**:

> 返回0: 函数执行成功

> 返回-1: 无法打开数据库，请确认是否有访问/opt/AntiyPasswordMixer/database/目录的权限

> 返回-2: 该用户名不存在

> 返回-3: 保存用户信息失败，请确认磁盘空间是否不足，或数据库文件是否被破坏