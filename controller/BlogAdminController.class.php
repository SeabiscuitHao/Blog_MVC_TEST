<?php
class BlogAdminController{

	public function add(){
		include "./view/blog/add.html";
	}

	public function doAdd(){
        $name 	 = $_POST['title'];
        $content = $_POST['content'];
        $cate 	 = $_POST['cate'];
        if (empty($name) || empty($content) || empty($cate)) {
            die('no data');
        }
        $data = array(
        	'name'		 => $name,
        	'content'	 => $content,
        	'category'	 => $cate,
        	'createtime' => date('Y-m-d H:i:s'),
        );
        $status = D('blog')->addBlog($data);
        var_dump($status);
	}


    public function lists() {
        //每页的条数
        $limit = 3;

        //总条数
        $count = D('blog')->getCount();

        //总页数    条数除以每页数  向上取整
        $pageCount = ceil($count / $limit);

        //获取当前页码  默认是1
        $page = !empty($_GET['p']) ? $_GET['p'] : 1;

        //计算数据偏移量
        $offset = ($page-1) * $limit;

        $cateList = D('cate')->getLists();
        
        foreach ($cateList as $key => $value) {
            $cateTmp[$value['id']] = $value;
        }
        // $blogObj = D('blog');
        // $lists = $blogObj->getLists();
        
        //获取数据
        $lists = D('blog')->getLists(array(), $offset, $limit);
        include "./view/blog/lists.html";
    }
}