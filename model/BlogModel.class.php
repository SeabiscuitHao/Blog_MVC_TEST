<?php
 class BlogModel {
    public $mysqli;
    public function __construct() {
        $this->mysqli = new mysqli('localhost', 'root', 'root', 'zt_test');
    }

    public function addBlog($data) {
         $sql = "insert into zt_blog (title, content, category,createtime) value ('{$data['name']}', '{$data['content']}', {$data['category']}, '{$data['createtime']}') ";
       	 $query = $this->mysqli->query($sql);
       	 return $query;
    }

    //getLists $where = array();预留的位置 暂时不用 用来拼接sql语句

    public function getBlog(){
        $sql = "select * from zt_blog";
        $query = $this->mysqli->query($sql);
        $lists = $query->fetch_all(MYSQLI_ASSOC);
        return $lists;
    }

    public function getCount() {
        $sql = "select count(*) as num from zt_blog";
        $query = $this -> mysqli ->query($sql);
        $res = $query -> fetch_array(MYSQLI_ASSOC);
        return $res['num'];
    }

    public function formatBlog($value,$cateTmp) {
        $item = array(
            "id" => $value['id'],
            "title" => $value['title'],
            "category_id" => $value['category_id'],
            "category_name" => $value['category_name'],
            "read_num" => $value['read_num'],
            "createtime" => $value['createtime'],
        );
        if (!empty($value['user_id'])) {
            $author = D('user') -> getInfoById($value['user_id']);

            $item['userid'] = $author['id'];
            $item['username'] = $author['name'];
            $item['userimg'] = $author['image'];
        } else {
            $item['userid'] = 0;
            $item['username'] = '账号异常';
            $item['userimg'] = '';
        }
        return $item;
    }


    //getInfo 查询所有详情页的信息
    public function getInfo($id) {
        $blogInfo = $this -> getInfoById($id);
        if (empty($blogInfo)) {
            return false;
        }
        $cateTmp = D('cate') -> getTmpLists();
        $info = $this -> formatBlog($blogInfo,$catrTmp);
        $info['content'] = $blogInfo['content'];
        return $info;
    }


    //getInfoById 查询所有Blog的相关信息
    public function getInfoById($id) {
        if (empty($id)) {
            return array();
        }
        $sql = "select * from zt_blog where id = {$id}";
        $query = $this -> mysqli -> query($sql);
        $res = $query -> fetch_array(MYSQ
        );
        return $res;
    }
}