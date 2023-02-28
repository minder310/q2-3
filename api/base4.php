<?php
date_default_timezone_set("Asia/Taipei");
session_start();

function dd($array)
{
    echo "<per>";
    print_r($array);
    echo "</per>";
}
function to($url)
{
    header("location:" . $url);
}
class DB
{
    private $dns = "mysql:host=localhost;charset=utf8;dbname=dbxx";
    private $table;
    private $pdo;

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dns, 'root', '');
    }
    // 拆解字體
    private function ArrayToSql($array)
    {
        foreach ($array as $key => $val) {
            $tmp[] = " `$key` = '$val' ";
        }
        return $tmp;
    }
    public function all(...$arg)
    {
        $sql = "select * from $this->table ";
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp = $this->ArrayToSql($arg[0]);
                $sql = $sql . " where " . join(" && ", $tmp);
            } else {
                $sql = $sql . $arg[0];
            }
        }
        if (isset($arg[1])) {
            $sql = $sql . $arg[1];
        }
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find($id)
    {
        $sql = "select * from $this->table ";
        if (is_array($id)) {
            $tmp = $this->ArrayToSql($id);
            $sql = $sql . " where " . join(" && ", $tmp);
        } else {
            $sql = $sql . " where `id` = '$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }
    public function del($id)
    {
        $sql = "DELETE FROM `$this->table` WHERE ";
        if (is_array($id)) {
            $tmp = $this->ArrayToSql($id);
            $sql = $sql . " where " . join(" && ", $tmp);
        } else {
            $sql = $sql . " where `id` = '$id'";
        }
        return $this->pdo->exec($sql);
    }
    public function save($text)
    {
        if (isset($text['id'])) {
            // 更改
            $id = $text['id'];
            unset($text['id']);
            $tmp = $this->ArrayToSql($text);
            $sql = "UPDATE `$this->table` SET" . join(",", $text) . " WHERE `id` = '$id'";
        } else {
            // 新增
            $key = array_keys($text);
            $sql = "INSERT INTO `$this->table`(`" . join("`,`", $key) . "`) VALUES ('" . join("','", $text) . "')";
        }
        return $this->pdo->exec($sql);
    }
    private function math($math, ...$arg)
    {
        switch ($math) {
            case "count":
                $sql = "select $math(*) from $this->table ";
                if (isset($arg[0])) {
                    if (is_array($arg[0])) {
                        $tmp = $this->ArrayToSql($arg[0]);
                        $sql = $sql . " where " . join(" && ", $tmp);
                    } else {
                        $sql = $sql . $arg[0];
                    }
                }
                if (isset($arg[1])) {
                    $sql = $sql . $arg[1];
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
        };
        return $this->pdo->query($sql)->fetchColumn();
    }
    public function count(...$arg){
        return $this->math("count",...$arg);
    }
    public function sum($col,...$arg){
        return $this->math("sum",$col,...$arg);
    }
    public function avg($col,...$arg){
        return $this->math("avg",$col,...$arg);
    }
    public function min($col,...$arg){
        return $this->math("min",$col,...$arg);
    }
    public function max($col,...$arg){
        return $this->math("max",$col,...$arg);
    }
}
