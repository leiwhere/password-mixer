

# Introduction #

The Antiy Password Mixer（APM）, which is developed by Antiy labs is a project for demonstrations of security algorithms, in order to resist security threats such as database leak. It is provided for small and medium scale BBSs, SNSs, message boards, common Web applications such as Web games and other Web applications that may need user registration, identification and password management. The APM is for planners, developers and maintainers of Web applications. The APM can meet the demand for most identity identification as well as encryption and preservation of key information of Web backstage.

The APM opens its source codes under the GNU GPL v2 protocol. We have developed Python and PHP version, and are developing Ruby version. We will supply follow-up updates and corresponding support services for APM.

The characteristics of APM:

  * Simple and low cost integrated solutions. APM can be integrated in existing enterprise environment easily.

  * Effective against statistical attacks, the common brute force attacks, GPU acceleration attacks and attacks based on cloud computing

  * Having two user modes, one is encryption that dates cannot be restored one-way, another is supporting decrypting plaintext

  * Right programming with strict code review

At present, 0day is very common, few websites and applications can absolutely guarantee their database system security. The APM is used to reduce the loss of database systems being stolen. Even if the database is leaked, the APM also can reduce the social pressure and the legal responsibility.

How APM do these things?It has no technical content and no domestic algorithms with their own independent intellectual property rights, even that the length of main program of Python is less than 300. From a security engineer’s perspective, we have used the existing popular open source packages, and finished the external encapsulation of RSA algorithm and HASH+SALT algorithm. They are reasonable examples of these algorithms and we provide them for website developers. Of course, the achievement of the algorithms in open source packages has been with security analysis with code level. By doing that, we hope the websites that save password with plaintext and websites that use related algorithm with unreasonable strategies (for example, use multi Hashes or only use SALT) can understand how to use these mathematical methods scientifically and reduce the thresholds of security applications. We also hope to perish the thought that some small and medium scale websites try to research an algorithm by themselves. It is not worth for these websites to give up these algorithms that have been tested by theories and practices. It is a waste of mental efforts and man-months.

Of course, you may despise our codes, and hope to realize more capable and wonderful codes by yourself. We only hope more developers can understand that security is not mysterious, and there are many resources to refer to and use, as long as we use them reasonably, we can get more security.
# **Background** #
From the leak of users’ information of SONY last year to the leak of passwords of CSDN and Tianya, all of them cause the users' password panic. Because a number of users use the same password anywhere, the leak of password not only threats the security of his specific website but also the security of his e-bank, online game, IM and so on. What have been mentioned above will result in extremely bad influence on these websites that are attacked by database leak. Some websites are even attacked by DDOS.

So far, the influences of leak events include:

|**The names of attacked manufacturers or websites**|**The number of users related to information leak**|
|:--------------------------------------------------|:--------------------------------------------------|
| SONY| about 101.6 million|
| SEGA | about 1.3 million |
| CITIGROUP| about 0.2 million|
| CSDN| about 6 million|
| DUOWAN| about 8 million|
| TIANYA| about 40 million|

# Analysis #
At present, it is extremely unbalanced between attack and preventing attack. Even traditional standard HASH algorithms are used to encrypt in websites, once date bases are stolen, it is equal to the leak of 90 percent of passwords. Why so?

Let us to see **what resources do attackers have**:
  * Billions of users’ plaintext passwords that have been leaked.
  * Rainbow tables, which are counted by trillion. MD5 values of all passwords which can be combined by less than 14 digits and letters.
  * GPU accelerations and distributed computing resources that sharply lower cost.
  * Legal super computing resources and cloud computing resources, which can be got in low price.
  * Botnets that can be counted in thousand.

Despite of these lessons mentioned above,**most of websites cannot resolve encryption problems of their account numbers and passwords. Why?**

  * It is hard for enterprises to employ a qualified programmer who knows security.
  * Solutions that spread in networks are most developed by netters, so they lack of professional design and evaluation.
  * It is a low success ratio in computer classes because the absence of professional security talents.
  * Technicians who are grown with practical competition often commit low-level errors and hardly can implement a security program correctly because they lack the basis of professional knowledge. Incorrect implement provides false security results which are much more harmful.
  * Most programmers can't have been tracking the latest security technologies.
# Which problems has APM solved #
**One person one password,one website one password:** For these websites that have used APM, even if two users use the same password, the results of encryptions are different. For different websites that have used APM, users use the same information and password to register; the results of encryptions are also different.

**High speed and low load encryption and identification:** Some websites do not encrypt because they are worried that encryption -related processing consumes server resources. If so, it will reduce the user experience. We need to solve the problem first.

**Resistance to brute force attack:** Because of the characteristics of APM that one person one password and one website one password, if attackers use brute force attack to get cipher texts, they need to start from scratch for each website. But if the related parameters are reasonably stored, in the case of only getting database, it is impossible to use the open source codes of Antiy Password Mixer to construct effective generators.

**Resistance to attacks of look-up table:** It is the same as what have been mentioned above; APM makes brute force attacks meaningless, so no look-up table could be used.

**Resistance to statistical analysis:** For these websites that use HASH algorithms developed by themselves or other HASH algorithms, attackers do not need to attack, what they need to do is sorting HASH values, and then comparing these values with high frequency password tables, as a result, most of users’ passwords will be unsafe. But passwords are uniform distributed and with no statistical value after being disposed by APM.

**Becoming fast sheep:** We believe that you have heard of a motto-- **The wolves bite the slowest sheep.** APM cannot solve the problem of database leaks, but can make database leaks nearly valueless. Anyhow, a small minority websites are using APM all over the word. So when your databases have no significance to attacks, attackers will go to look for slower sheep.

# Which problems has APM not solved and our suggestions #

| **Threatens** | **Illustrations** | **Suggestions** |
|:--------------|:------------------|:----------------|
| Clients leak cryptograms| Users loss their passwords because of Trojan or telling passwords to others or being peeped when entering passwords | Strengthen the popularization of users’ security knowledge|
| Phishing websites| Users login fake websites and loss passwords| Websites strengthen the search to find out phishing websites|
| One password anywhere| Try to use users’ names and passwords spread from other websites in websites using APM | Add a frequency control mechanism that using different IDs to login will be failure to make it more difficult to detect|
| Communication theft| Being monitored in communication processes, ICP being deceived and monitored by ARP and so on| Use HTTPS instead of HTTP to do login authentication, but that will add load to the servers|

# The problems we plan to solve #
## The problem that one password anywhere ##
When the whole databases and encryption parameters are gotten, there is still a problem that one password anywhere for the current projects; the problem will influence these users that use one password anywhere. We have designed another project to solve the problem, but the project is complex, so it is difficult to transplant the project for existing websites.
## The limited intensity of encryption in the clients ##
We hope to provide a JS that encrypted in client to enhance the security of transmitting passwords and identifications. Intensity of encryption is not guaranteed because of the limit of JS’s abilities.
# How to use APM #
## Useful links ##
Links below may be helpful to you:

[The installation method of APM](http://code.google.com/p/password-mixer/wiki/Installation)

[The interface illustrations of APM](http://code.google.com/p/password-mixer/wiki/API)

[FAQ in using APM](http://code.google.com/p/password-mixer/wiki/FAQ)

[Data migration guides for APM users](http://code.google.com/p/password-mixer/wiki/DataMigration)

[The source codes and documentations to download](http://code.google.com/p/password-mixer/downloads/list)

## Languages and platforms ##
If your applications are based on the developments of Python or PHP, you can immediately begin to use APM; if your applications are based on Ruby, you need to wait about 10 days; if your applications are based on C/C++, Perl or others, please contact us.
## Take a start from the head ##
If you are building your WEB applications, then everything will be simple. You need to read our document examples and do following operations.

First initialize programs through APM and generate encryption parameters belonging to you only. Then you can go on developing web applications after keeping the relevant parameters well.

In your applications, you encrypt the stored information that needs to encrypt through APM and then store them. Of course, the length of data after encryption is longer than the length of data before, you may need to fine-tune field design of your databases.

You only need to embed APM in the functions of register and login to finish the corresponding work.
## Existing transplantation ##
If you have had the applications that have been developed, in the following cases you can still finish the APM embedment according to the guidance of our manuals.
  * Passwords are stored in the form of plaintext.
  * Passwords are stored in the form of reducible encryption.
  * Passwords are stored in the form of a certain unidirectional HASH
  * Passwords are stored in the form of a certain unidirectional HASH as well as a simple SALT

In addition to the work we mentioned in ‘Take a start from the head’, you need to finish transporting available data according to the guidance of our documents
# **Rights introduction and suggestions** #
The source codes of APM are opened based on GNU GPL v2 protocol. We welcome any improvements and contributions based on the protocol. You may have no energy to audit a mass of codes, so we suggest you obtain APM developed on our original websites to avoid malicious tampering of APM.

Internet applications with the number of registered users smaller than 100000 all can use APM for free. But we hope these websites that use APM can place our product mark and link. The mark of APM is:

[![](http://www.antiy.net/opensource/apm/logo.png)](http://www.antiy.net/)

# Adequate and systematic service #
We will consider collecting fee of following services:
  * Develop and custom made other language versions: We will develop the versions of Python、PHP and Ruby for free. But we will collect fee of other versions.
  * Provide you with technical supports of APM: remote supports and on-site supports.
  * Provide you with suggestions of login security: consulting services of login security mechanism.
  * Cloud inquires of password security: An application based on command MD5 can be embedded in the process of your register to detect whether the users’ passwords have been leaked.

Everyone can try out our free clients that have been published, the download address is :
http://www.antiyfx.com/download/apc.zip
# **Contact us** #

Antiy website: http://www.antiy.com

Contact us: apm@antiy.com