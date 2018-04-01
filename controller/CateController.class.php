<?php
class CateController{
 public function add() {
        include "./view/cate/add.html";
    }
    public function doAdd() {
        $name = $_POST['name'];
        if (empty($name)) {
            die('no name');
        }
        $status = D('cate')->addCate(array('name'=>$name));
        var_dump($status);
    }
    public function lists() {
    	
        $lists = D('cate')->getLists();
        
        include "./view/cate/lists.html";
    }
}