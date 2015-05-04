

# Python用户安装指南 #
## 运行环境 ##
系统环境:  Linux

运行环境:  Python2.6 或以上版本

内存环境:  256M 以上

处理器  :  PIII 以上处理器

## 安装第三方库 ##
在使用Antiy Password Mixer以前需要安装的的第三方程序或python模块列表如下:

### openssl ###
在Ubuntu下可以使用`sudo apt-get install openssl`进行安装

### kyotocabinet-1.2.72 ###
下载地址：http://fallabs.com/kyotocabinet/pkg/

请选择下载 kyotocabinet-1.2.72.tar.gz

下载后进行如下操作：
```bash

$ tar –zxvf kyotocabinet-1.2.72.tar.gz
$ cd kyotocabinet-1.2.72
$ ./configure --prefix=/usr
$ make
$ sudo make install
```

### kyotocabinet-python-legacy-1.16 ###
下载地址：http://fallabs.com/kyotocabinet/pythonlegacypkg/

请选择下载 kyotocabinet-python-legacy-1.16.tar.gz

下载后进行如下操作：
```bash

$ tar –zxvf kyotocabinet-python-legacy-1.16.tar.gz
$ cd kyotocabinet-python-legacy-1.16.tar.gz
$ make
$ sudo python setup.py
```

### python-m2crypto ###
在Ubuntu下可以使用`sudo apt-get install python-m2crypto`进行安装。

## 安装过程 ##
假设当前用户为antiytest，操作步聚如下:

  1. 创建目录：`sudo mkdir /opt/AntiyPasswordMixer`
  1. 更改目录拥有者：`sudo chown –R antiytest /opt/AntiyPasswordMixer`
  1. [下载AntiyPasswordMixer.tar.gz](http://password-mixer.googlecode.com/files/AntiyPasswordMixer.tar.gz)
  1. `tar -zxvf AntiyPasswordMixer.tar.gz`
  1. `cd ./AntiyPasswordMixer/python-apm`
  1. `sh ./initapm.sh`

执行python-apm目录下的initapm.sh后，会在/opt/AntiyPasswordMixer目录下创建两个目录。具体描述如下表所示

| **目录名称** | **存放文件名** | **描述** |
|:-----------------|:--------------------|:-----------|
| **/opt/AntiyPasswordMixer/keys** | privkey.pem pubkey.pem | 该目录下生成的文件分别是用于信息加密的私钥和公钥，在执行initapm.sh会生成到该目录下，请将privkey.pem妥善保存，并删除本机上的privkey.pem文件，防止泄密 |
| **/opt/AntiyPasswordMixer/database** | userinfo.kch | 该目录下生成的文件是保存用户信息的数据库，在首次调用用户注册接口后会生成该文件 |
| **/opt/AntiyPasswordMixer/database** | pwd.lst | 该目录下生成的文件是高频密码表，用于过滤高频密码，可以手工修改维护 |

# PHP用户安装指南 #

## 运行环境 ##
系统环境：Linux

运行环境：PHP5

内存环境：256M 以上

处理器：PIII 以上处理器

## 安装第三方库 ##
在使用Antiy Password Mixer以前需要安装的的第三方程序或PHP模块列表如下：

### Openssl ###
在Ubuntu下可以使用`sudo apt-get install openssl`进行安装

### php-db ###
在Ubuntu下可以使用`sudo apt-get install php-db`进行安装

## 安装过程 ##
假设当前用户为 antiytest，操作步聚如下:

  1. 创建目录：`sudo mkdir /opt/AntiyPasswordMixer`
  1. 更改目录拥有者：`sudo chown –R antiytest /opt/AntiyPasswordMixer`
  1. 下载AntiyPasswordMixer.tar.gz
  1. `tar –zxvf AntiyPasswordMixer.tar.gz`
  1. `cd ./AntiyPasswordMixer/php-apm`
  1. `sh ./initapm.sh`

执行php-apm目录下的initapm.sh后，会在/opt/AntiyPasswordMixer目录下创建两个目录。具体描述如下表所示：
| **目录名称** | **存放文件名** | **描述** |
|:-----------------|:--------------------|:-----------|
| **/opt/AntiyPasswordMixer/keys** | privkey.pem pubkey.pem | 该目录下生成的文件分别是用于信息加密的私钥和公钥，在执行initapm.sh会生成到该目录下，请将privkey.pem妥善保存，并删除本机上的privkey.pem文件，防止泄密 |
| **/opt/AntiyPasswordMixer/database** | userinfo.kch | 该目录下生成的文件是保存用户信息的数据库，在首次调用用户注册接口后会生成该文件 |

# Ruby用户安装指南 #
## 运行环境 ##
系统环境：Linux

运行环境：Ruby 1.8.7

内存环境：256M 以上

处理器：PIII 以上处理器

## 安装第三方库 ##
在使用Antiy Password Mixer以前需要安装的的第三方程序或ruby模块列表如下：

### openssl ###
在Ubuntu下可以使用`sudo apt-get install openssl`进行安装

### ruby ###
在Ubuntu下可以使用`sudo apt-get install ruby`进行安装

### rubygems ###
在Ubuntu下可以使用`sudo apt-get install rubygems`进行安装

### ruby-dev ###
在Ubuntu下可以使用`sudo apt-get install ruby-dev`进行安装

### kyotocabinet-ruby ###
下载：
```bash

$ wget http://rubygems.org/downloads/kyotocabinet-ruby-1.27.1.gem

$ sudo gem install kyotocabinet-ruby-1.27.1.gem
```

安装：

使用`gem env`查看GEMS PATHS，根据环境决定进入该路径，例如路径为`/var/lib/gems/1.8`
```bash

$ cd /var/lib/gems/1.8/gems/kyotocabinet-ruby-1.27.1
$ sudo ruby extconf.rb
$ make
$ sudo make install
```

### libopenssl-ruby ###
在Ubuntu下可以使用`sudo apt-get install libopenssl-ruby`进行安装

## 安装过程 ##
假设当前用户为 antiytest，操作步聚如下:

  1. 创建目录：`sudo mkdir /opt/AntiyPasswordMixer`
  1. 更改目录拥有者：`sudo chown –R antiytest /opt/AntiyPasswordMixer`
  1. 下载AntiyPasswordMixer.tar.gz
  1. `tar –zxvf AntiyPasswordMixer.tar.gz`
  1. `cd ./AntiyPasswordMixer/ruby-apm`
  1. `sh ./initapm.sh`

执行ruby-apm目录下的initapm.sh后，会在/opt/AntiyPasswordMixer目录下创建两个目录。具体描述如下表所示：
| **目录名称** | **存放文件名** | **描述** |
|:-----------------|:--------------------|:-----------|
| **/opt/AntiyPasswordMixer/keys** | privkey.pem pubkey.pem | 该目录下生成的文件分别是用于信息加密的私钥和公钥，在执行initapm.sh会生成到该目录下，请将privkey.pem妥善保存，并删除本机上的privkey.pem文件，防止泄密 |
| **/opt/AntiyPasswordMixer/database** | userinfo.kch | 该目录下生成的文件是保存用户信息的数据库，在首次调用用户注册接口后会生成该文件 |