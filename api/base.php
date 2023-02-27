<?php
date_default_timezone_set("Asia/Taipei");
session_start();

// dd
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
// to
function to($text)
{
    // 這邊有錯
    header("location:".$text);
}

class DB
{
    // 宣告變數。
    private $nad = "mysql:host=localhost;charset=utf8;dbname=dbxx";
    // 連結資料庫名稱。
    private $table;
    private $pdo;

    // 宣告預設開啟設定。
    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->nad,'root','');
    }
    // 拆解字串。
    private function ArrayToSql($array)
    {
        foreach ($array as $key => $val) {
            $tmp[] = " `$key` = '$val' ";
        }
        return $tmp;
    }
    // 取出所有物件。
    public function all(...$arg)
    {
        $sql = " select * from $this->table ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->ArrayToSql($arg[0]);
                //這邊沒背熟
                $sql = $sql . " where " . join(" && ", $tmp);
            } else {
                $sql = $sql . $arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql = $sql . $arg[1];
        }
        return $this->pdo->query($sql)->fetchall(PDO::FETCH_ASSOC);
    }
    // 取出單個物件。
    public function find($id)
    {
        $sql = " select * from $this->table ";
        if (is_array($id)) {
            $tmp = $this->ArrayToSql($id);
            //這邊沒背熟
            $sql = $sql . " where " . join(" && ", $tmp);
        } else {
            $sql = $sql . "where `id` = '$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    // 輸入
    public function save($array)
    {
        // 更新區
        if (isset($array['id'])) {
            $sql = " update `$this->table` set ";
            $id = $array['id'];
            unset($array['id']);
            $tmp = $this->ArrayToSql($array);
            $sql = $sql . join(" , ", $tmp) . " where `id`='$id'";
        } else {
            // 全新資料區
            $sql = " insert into `$this->table` (`";
            $key = array_keys($array);
            $sql = $sql . join("`,`", $key) . "`) values ( '" . join("','", $array) . "')";
        }

        return $this->pdo->exec($sql);
    }
    //刪除
    public function del($id)
    {
        $sql = "delete from $this->table ";
        if (is_array($id)) {
            $tmp = $this->ArrayToSql($id);
            //這邊沒背熟
            $sql = $sql . " where " . join(" && ", $tmp);
        } else {
            $sql = $sql . "where `id` = '$id'";
        }
        return $this->pdo->exec($sql);
    }
    //  數學模型
    private function math($math, ...$arg)
    {
        switch ($math) {
            case "count":
                $sql = "select count(*) from $this->table ";
                if (isset($arg[0])) {
                    if (is_array($arg[0])) {
                        $tmp = $this->ArrayToSql($arg[0]);
                        $sql = $sql . " where " . join(" && ", $tmp);
                    } else {
                        $sql = $sql . $arg[0];
                    }
                }
                break;
            default:
                $sql = "select $math($arg[0]) from $this->table ";
                if (isset($arg[1])) {
                    if (is_array($arg[1])) {
                        $tmp = $this->ArrayToSql($arg[1]);
                        $sql = $sql . " where " . join(" && ", $tmp);
                    } else {
                        $sql = $sql . $arg[1];
                    }
                }
        }
        // dd($sql);
                                        // 這邊要背
        return $this->pdo->query($sql)->fetchColumn();
    }
    public function count(...$arg){
        return $this->math("count",...$arg);
    }
    public function avg($col,...$arg){
        return $this->math("avg",$col,...$arg);
    }
    public function sum($col,...$arg){
        return $this->math("sum",$col,...$arg);
    }
    public function max($col,...$arg){
        return $this->math("max",$col,...$arg);
    }
    public function min($col,...$arg){
        return $this->math("min",$col,...$arg);
    }
}
$News=new DB('news');
$Log=new DB('log');
$Que=new DB('que');
$Total=new DB('totle');
$User=new DB('user');

dd($User->all());
dd($User->sum("id"));
