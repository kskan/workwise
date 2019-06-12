<?php
// error_reporting(0);  //显示所有错误

// 一个文件就是一个类
//数据库类

//访问修饰符
/*
    private 私有
    protected 受保护的
    public  公共的
*/

class DB
{
    //创建的私有变量
    private $host;
    private $user;
    private $pwd;
    private $dbname;
    private $conn;
    private $pre_ = "pre_";
    private $charset='UTF8';
    private $sql; //给一个sql语句的变量


    //构造函数
    function __construct($host,$user,$pwd,$dbname,$charset='UTF8',$pre_="pre_")
    {
        //赋值
        $this->host = $host;
        $this->user = $user;
        $this->pwd = $pwd;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->charset = $charset;
        $this->pre_ = $pre_;
        $this->connection(); //调用方法

        if($this->conn)  //当连接成功之后
        {
            $this->charset();  //设置编码
            $this->selectDB(); //选择数据库
        }else{
            die('连接失败');
        }
    }

    //数据库连接方法
    private function connection()
    {
        $this->conn = mysqli_connect($this->host,$this->user,$this->pwd);
    }

    //设置编码
    private function charset()
    {
        $res = mysqli_query($this->conn,"SET NAMES ".$this->charset);

        if(!$res)
        {
            $this->error();
        }

        return true;
    }

    //数据库的选择
    private function selectDB()
    {
        $res = mysqli_select_db($this->conn,$this->dbname);

        if(!$res)
        {
            $this->error();
        }

        return true;
    }


    //错误日志方法
    private function error()
    {
        $path = str_replace("\\","/",dirname(__FILE__));
        $error = mysqli_error($this->conn);
        $txt = "[".date("Y-m-d H:i")."]          ".$error."\r\n";
        $length = file_put_contents("$path/mysql_log.txt",$txt,FILE_APPEND);
        echo "sql语句执行失败，请查看日志文件";
        exit;
    }


    //查询字段
    public function select($field = "*")
    {
        $this->sql = "SELECT $field ";
        return $this;
    }

    //查询表名
    public function from($table)
    {
        $this->sql .= "FROM ".$this->pre_.$table." ";
        return $this;
    }

    //查询where条件
    public function where($where = 1)
    {
        $this->sql .= "WHERE $where ";
        return $this;
    }

    //排序
    public function orderBy($field,$by='asc')
    {
        if(is_array($field))
        {
            $str = "";
            foreach($field as $key=>$item)
            {
                $str .= " $key $item ,";
            }
            $this->sql .= "ORDER BY ".trim($str,",");
        }else{
            $this->sql .= "ORDER BY $field $by ";
        }
        
        return $this;
    }

    //限制条数
    public function limit($limit = 1)
    {
        $this->sql .= "LIMIT $limit ";
        return $this;
    }

    //查询单条  一维数组
    public function find()
    {
        $res = mysqli_query($this->conn,$this->sql);

        if(!$res)
        {
            $this->error();
        }

        return mysqli_fetch_assoc($res);
    }

    //查询多条 二维数组
    public function all()
    {
        $res = mysqli_query($this->conn,$this->sql);

        if(!$res)
        {
            $this->error();
        }

        $data = array();

        while($row = mysqli_fetch_assoc($res))
        {
            $data[] = $row;
        }
        return $data;
    }

    //插入
    function insert($table,$fields)
    {
        $keys = array_keys($fields);  //提取出数组的索引到一个新的数组里面
        $indexs = "`".implode("`,`",$keys)."`";  //把数组变成字符串
        $values = "'".implode("','",$fields)."'";
    
        $this->sql = "INSERT INTO {$this->pre_}$table($indexs)VALUES($values)";
        $res = mysqli_query($this->conn,$this->sql);
        if(!$res)
        {
            $this->error();
        }
    
        return mysqli_insert_id($this->conn); //返回插入id
    }

    /**
     * update 更新函数
     */
    function update($table,$data,$where)
    {
        $str = "";
        foreach($data as $key=>$item)
        {
            $str .= "`$key`='$item',";
        }

        $str = trim($str,",");
        $this->sql = "UPDATE {$this->pre_}{$table} SET $str WHERE $where";
        $res = mysqli_query($this->conn,$this->sql);

        if(!$res)
        {
            $this->error();
        }

        return mysqli_affected_rows($this->conn); //返回影响行数
    }

    /**
     * delete 删除函数
     */
    function delete($table,$where)
    {

        $this->sql = "DELETE FROM {$this->pre_}{$table} WHERE $where";
        $res = mysqli_query($this->conn,$this->sql);
        if(!$res)
        {
            $this->error();
        }

        return mysqli_affected_rows($this->conn);  //返回影响行数
    }



    //插入和更新合并成一个方法
    function save()
    {
        //插入 数组中没 主键id
        //更新 数组中有 主键id
    }



	
}



?>