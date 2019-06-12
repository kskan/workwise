1、什么数据库
	有一堆数据相关文件组成的一个集合.这个集合通常被保存为一个或多个彼此相关的文件。
	创建一个数据库 会生成多个彼此相关的文件
	(db.opt、表.frm)


2.什么是关系型数据库？
	表与表之间存在关系。形成这种关系的数据库就是关系型数据库


3、关系型数据库又有哪些
	mysql sql server IBM SQLITE 

4、数据库的实现步骤
	数据库(项目)
		数据表(实体->表、关系、表类型)
			字段(属性->字段、字段类型)
				数据
					sql语句(增删查改)


1、实体
	1.1、真实存在
	1.2、有多个属性
	1.3、有多个记录
	例如：
		(产品表)
		手机(名称、品牌、价格、内存大小、出厂日期，颜色)
		冰箱，电视，洗衣机，路由器，油烟机，桌子，床，沙发
		(产品分类)
			电子产品，厨房用品，食品，家具用品，化妆品
		(产品品牌)
			苹果，华为，小米.....
		(产品类型)
			电子产品类型
				CPU,内存,显卡,硬盘大小

			家具产品类型
				质量,尺寸,材料

			书
				出版商，作者，出版日期
2、关系
	1:1 身份证:人 电影票：座位
	1:n 教室:多个人
	n:m 学生:课程

	关系在表中的体现
	1:1 不需要关联字段 主键：主键
	1:n 分类:多产品  1个产品：一个分类 把1里面的主键放多的里面做外键(把分类表的主键，放到产品表里面做外键)
	n:m 学生:课程 把两个表的主键拿出来，放到第三张表里面做外键

索引：可以帮助我们在一张表的多个数据中快速确定数据的位置

	普通索引
		主要对数据进行快速搜索查询

	唯一索引
		重点：保证唯一性.

	全文索引
		对文章内容的关键词做索引

	主索引
		主键即主索引。是一种特殊的唯一索引 主键自增在表中只能有一个



数据库名称问题：
	1、数据库和数据表大部分情况不区分，少数(linux)
	2、命名一定要有意义(库，表，字段)
	3、尽量不要超过64个字符(库，表，字段);
	4、表前缀 库名称_   字段前缀(可以加也可以不加)

shop 
	shop_user
		user_id
		user_name
		user_pwd

	shop_admin

cms
	cms_user

事务
	购物下单 付款
		统计总金额 > 优惠券 > 积分 > 支付
	必须将所有环节执行成功后才叫做事务完成，如果有一个环节失败将会回滚到没执行过一样

表类型：
	myisam(不支持事务) 小 如果没有特殊情况的话  会选用myisam
		静态类型：表里面的字段如果是固定长度的话，就会直接选用这种长度，不会改变，这种的存储效率会比较高(长度固定)(效率高，性能低)

		动态:当字段的类型是不固定长度的，那么往往会根据存储的内容长度来决定存多少。(性能高，效率低)

	innodb(支持事务) 大 innodb 是myisam的一个升级版
		事务

		崩溃恢复
			在计算机系统没有被完全毁坏不能开机的情况下，mysql会恢复到上一次最稳定的版本

		行及锁定
			假如说A用户正在操作10条数据，B用户只能查询，但不能再做操作修改。

		外键约束
			A表的数据肯定是对应B表里面的数据，不存在A表的数据在B表中找不到对应的记录

	Memory(内存表)
		给对数据不重要的可以使用类似一些访问记录之类的
		因为内存表 当Mysql关闭之后就会销毁了


字段类型:(常用的)
	字符串类型：
		char 固定长度 255个字符
		varchar 可变长度 255个字符
		TINYTEXT 文本	255个字符
		TEXT  短文本   65 535个字符
		MEDIUMTEXT 中等文本 16 777 215个字符
		LONGTEXT  长文本	4 294 967 295个字符

	数值类型：
		TINYINT(m)  数值 8位整数 1个字节 
		SMALLINT(m)  短数值 16位整数 2个字节
		MEDIUMINT(m) 中等数值 24位整数 3个字节    
		INT(m)  中等数值 32位整数 4个字节   
		BIGINT(m)  大的数值 64位整数 8个字节
	
	浮点数
		FLOAT(M,D) 4 字节 单精度  
		DOUBLE(M,D) 8 字节  双精度
		DECIMAL(M,D)   M长度 D小数  固定长度存储的字符串数据 相当于 char  
			M包括D在内  123213.123123123 M整个长度 D小数长度
	
	日期：
		DATE	3个字节 “2010-01-01”
		TIME    3个字节 “23：59：59”
		DATETIME  ”2010-01-01 23:59:59”
		YEAR	1个字节 100 ~ 2155
	
	Enum单选
		(boy,girl,aaa,ddd,ccc) 从里面选一个

	set多选
		(boy,girl,aaa,ddd,ccc) 从里面选多个
	
字段属性：
	AUTO_INCREMENT  自增 在插入数据的时候自增 insert 
		这个属性必须与NOT NULL 、PRIMARY KEY 或者 UNIQUE 属性同时使用;
	NOT NULL 不为空
	PRIMARY KEY 主键
	UNIQUE  唯一
	DEFAULT  默认值
	UNSIGNED	无符号 非负数


挑出来实体
挑属性
找关系
用phpmyadmin 把你分析的实体属性变成具体的数据库表结构

选择数据库的编码：utf8-general-ci

如果表少的话 用phpmyadmin 就可以了
如果表多了的话，用phpmyadmin创建的时候就比较麻烦了




部门、职位、员工
部门：员工 1:n 
职位：员工 1:n
部门：职位 1:n 
	





数据库构建注意：
	1、实体不可再分
	2、如果是主外建关系的话 主键为主索引 外建为普通索引
	给主外建添加外建约束条件(主键和外建是绝对相似)其他属性都要一样。
	3、给主表和外建表建立关系 
			删除主表的一条记录会顺带删除外建表的记录 级联
			删除主表的一条记录会顺带清空外建表字段的记录 



SQL 语句
DML 操作数据的 增删查改
DDL 操作数据库和字段 增删查改
DCL 权限管理  数据库用户权限的


添加 INSERT INTO 
INSERT INTO 表名(字段1名,字段2名,字段3名)VALUES('值1',123,343);


添加多条
INSERT INTO 表名(字段1名,字段2名,字段3名)VALUES('值1',123,343),('值1',123,343),('值1',123,343),('值1',123,343);

INSERT INTO pre_department(name)VALUES('技术部'),('行政部'),('财务部'),('销售部门'),('渠道部门')



INSERT INTO pre_person(name,sex,phone,email,address,avatar,job_id,department_id)VALUES('小红',0,'123123123','123123@qq.com','地址','',4,3)


//更新
UPDATE pre_person SET name='小明',sex=1 WHERE id = 2;


//删除
DELETE FROM pre_person WHERE id = 2;


SELECT 
* 所有
SELECT * FROM pre_person
SELECT id,name FROM pre_person

统计总数
SELECT COUNT(id) FROM pre_person


//带条件查询

//比较运算符
SELECT * FROM pre_person WHERE id = 1;
SELECT * FROM pre_person WHERE id >= 1;
SELECT * FROM pre_person WHERE id <= 1;
SELECT * FROM pre_person WHERE id != 1;
SELECT * FROM pre_person WHERE id < 1;
SELECT * FROM pre_person WHERE id > 1;

//逻辑与或非

两个必须同时为true
SELECT * FROM pre_person WHERE id = 1 AND name = '小明'

只要有一个为真就行了
SELECT * FROM pre_person WHERE id = 99 OR name = '小红'

//!NOT
//列表查询  IN 只要是括号里面的都能查询
SELECT * FROM pre_person WHERE id IN(1,6,7,11,18,21);

//除了括号里面的
SELECT * FROM pre_person WHERE id NOT IN(1,6,7,11,18,21);

//范围 BETWEEN AND 
SELECT * FROM pre_person WHERE id BETWEEN 10 AND 20;


//模糊匹配
% 匹配任意长度的任意字符
_ 匹配单个任意字符

结尾
SELECT * FROM pre_person WHERE name LIKE '%小红'
SELECT * FROM pre_person WHERE name LIKE '小红%'
SELECT * FROM pre_person WHERE name LIKE '%小红%'
SELECT * FROM pre_person WHERE name LIKE '_小红'
SELECT * FROM pre_person WHERE name LIKE '小红_'
SELECT * FROM pre_person WHERE name LIKE '小红'


链表查询
左链表  右链表 内链表
LEFT JOIN 
RIGHT JOIN 
INNER JOIN 

Atable
id name  BID
1  学生1  1
2  学生2  2
3  学生3  3
4  学生4  4

Btable
id name 
1   教室1
2   教室2
3   教室3
5   教室5
6   教室6


//左链表  A主表 左链表  B副表   B表的数据可有可无
SELECT a.id AS aid,a.name AS aname,B.* FROM Atable AS a LEFT JOIN Btable AS b ON a.BID = b.id WHERE id = 4;


//右链表 A表的数据可有可无 A副表 右链表  B主表   
SELECT a.id AS aid,a.name AS aname,B.* FROM Atable AS a RIGHT JOIN Btable AS b ON a.BID = b.id WHERE id = 4;


//内  A主表 内链表  B主表   必须是A、B条件同时满足才会有数据
SELECT a.id AS aid,a.name AS aname,B.* FROM Atable AS a INNER JOIN Btable AS b ON a.BID = b.id WHERE id = 4;


//可以连无数张
员工的职位和部门数据
SELECT person.*,det.name AS detName,job.name AS jobName FROM pre_person AS person left join pre_department AS det ON person.department_id = det.id left join pre_job AS job ON person.job_id = job.id WHERE person.id IN(3,6,8,10)


限制查询条数
SELECT * FROM pre_person LIMIT 5; 

//从0条开始，查5条
SELECT * FROM pre_person LIMIT 0,5; 

排序ORDER BY
SELECT * FROM pre_person ORDER BY id asc;  //升序
SELECT * FROM pre_person ORDER BY id desc;  //降序

语句中 个环节的顺序
SELECT * FROM 表名 WHERE 条件 ORDER BY 字段 方式 LIMIT 偏移量,个数

min 最小值
SELECT min(id) AS mid FROM pre_person

max 最大值
select max(id) as mid from pre_person

avg 平均值
select avg(id) as aid from pre_person

sum 总和
select sum(id) as sid from pre_person

//分组 GROUP BY  把相同的分到一组里面 重复的直接省略 不同的挑选出来
SELECT * FROM pre_person GROUP BY name;