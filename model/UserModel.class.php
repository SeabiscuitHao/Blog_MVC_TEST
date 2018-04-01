<?php
class UserModel {
    public $mysqli;
    public function __construct() {
        $this->mysqli = new mysqli('localhost', 'root', 'root', 'zt_test');
    }
    public function getUserInfoByPhone($phone) {
        $sql = "select * from zt_user where phone = '{$phone}' ";
        $query = $this->mysqli->query($sql);
        $info = $query->fetch_array(MYSQLI_ASSOC);
        return $info;
    }
    public function addUser($uname, $phone, $password) {
        $sql = "insert into zt_user (name,phone,password) value ('{$uname}', '{$phone}', '{$password}')";
        
        $query = $this->mysqli->query($sql);
        return $query;
    }

    public function formatUser($value) {
        $item = array(
            'userid' => $value['id'],
            'username' => $value['name'],
            'userimg' => $value['image'],
        );
        return $item;
    }
}