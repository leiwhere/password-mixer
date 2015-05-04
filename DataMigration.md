

# APM用户数据迁移指南 #

本文档介绍用户如何将网站的用户账户认证数据迁移至APM下。

_**注意**：本文只是举例说明将数据迁移至APM的步骤，不是真实环境的操作指南。用户需要根据自身实际情况制定迁移方案。_

某网站A的数据库中，用户表（user）包含六列，分别为：用户ID、用户名、密码、注册邮箱、注册日期、是否激活。该表的一部分数据如下：

| **uid** | name | password | email | date | active |
|:--------|:-----|:---------|:------|:-----|:-------|
| 2334 | zhangsan | xj6528w | zhangsan@163.com | 2010-02-26 | 是 |
| 4362 | amy | 654321 | amywang123@sina.com | 2010-09-03 | 是 |
| 21295 | woshichaoren | 4tg0!E^x0 | wjstc@qq.com | 2011-08-30 | 是 |
| 25107 | cici1990 | ilovenana | ximengniu@gmail.com | 2011-12-25 | 否 |
| …… | …… | …… | …… | …… | …… |

当用户登录时，网站A在该表中查询是否存在该用户名的记录，并判断输入的密码与保存的密码是否相等。如果存在用户名记录，密码也相等，则登陆成功，否则登陆失败。

为了提高账户数据安全、保障用户隐私，网站A使用了APM。他们按以下步骤将相关数据转移至APM系统。

## 第一步：查表，取出所有用户名、密码 ##
例如，使用SQL语句：
```sql

SELECT name, password FROM user
```

## 第二步：将数据导出为特定格式 ##
APM支持的格式为每行一条记录，每条记录由用户名、密码组成，两者之间用TAB分隔（"\t"）。

例如，上述示例数据应导出为如下格式：

```
zhangsan	xj6528w
amy	654321
woshichaoren	4tg0!E^x0
cici1990	ilovenana
```

将这种格式的数据保存为文件，名为user.dat

## 第三步：将数据导入APM ##
对Python用户，使用源码中的apm\_migration.py脚本，将上述数据导入APM。该脚本的使用方法是：
```bash

apm_migration.py user.dat mig.log
```

对PHP用户，使用源码中的apm\_migration.php脚本，将上述数据导入APM。该脚本的使用方法是：
```bash

php apm_migration.php user.dat mig.log
```

其中，第一个参数user.dat是输入上一部保存的用户数据，第二个参数mig.log是输出的数据导入日志记录。

## 第四步：在原数据库中，删除密码 ##
例如，使用SQL语句：
```sql

ALTER TABLE user DROP COLUMN password
```