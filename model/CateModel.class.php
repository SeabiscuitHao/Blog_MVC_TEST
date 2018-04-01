<?php
 class CateModel {
    public $mysqli;
    public function __construct() {
        $this->mysqli = new mysqli('localhost', 'root', 'root', 'zt_test');
    }
    public function addCate($data) {
        $sql = "insert into zt_cate (category) value ('{$data['name']}') ";
        $query = $this->mysqli->query($sql);
        return $query;
    }
    public function getLists () {
        $sql = "select * from zt_cate";
        $query = $this->mysqli->query($sql);
        $lists = $query->fetch_all(MYSQLI_ASSOC);
        return $lists;
    }
}