<?php
    class UserController {
        public function login(){
            include "./view/user/login.html";
        }

        public function reg(){
            include "./view/user/reg.html";
        }


        public function doLogin(){
            $phone    = $_POST['phone'];
            $password = $_POST['password'];
            $formate = $_POST['formate'];

            // $mysqli = new mysqli('localhost','root','root','zt_test');
            // $sql = "select * from zt_user where phone = '{$phone}'";
            // $query = $mysqli -> query($sql);
            include "./model/UserModel.class.php";
            $model = new User();
            $query = $model -> getUserInfoBy($phone);

            if (!empty($model)) {
                $res = $query -> fetch_array(MYSQLI_ASSOC);
                if ($res['password'] == $password) {
                    $_SESSION['me'] = $res;
                    header("location:index.php?c=message&a=lists");
                }
            }else{
                echo "<script>alert('该用户不存在！');</script>";
            }
        }
        public function logout(){
            $_SESSION['me'] = array();
            header("location:index.php?c=user&a=login");
        }

        public function doReg(){
            $name       = $_POST['uname'];
            $phone      = $_POST['phone'];
            $password   = $_POST['password'];


            $mysqli = new mysqli('localhost','root','root','zt_test');
            $sql = "select * from zt_user where phone = '{$phone}'";
            $query = $mysqli -> query($sql);


            if ($query -> num_rows>0) {
                echo "<script>alert('该电话已被注册！');</script>";
            }else{
                $sql = "insert into zt_user (name,phone,password) value('{$name}','{$phone}','{$password}')";
                $query = $mysqli -> query($sql);
                if ($query) {
                    // echo "<script>alert('注册成功！');windows.location.href='index.php?c=user&a=login';</script>";
                    header("location:index.php?c=user&a=login");        
                }else{
                    echo "<script>alert('注册失败！')</script>";
                }
            }
        }






















        // public function doLogin() {
        //     $phone 		= $_POST['phone'];
        //     $password 	= $_POST['password'];

        //     $mysqli = new mysqli('localhost', 'root', 'root', 'zt_test');
        //     $sql = "select * from zt_user where phone = '{$phone}' ";
        //     $query = $mysqli->query($sql);
        //     $info = $query->fetch_array(MYSQLI_ASSOC);
        //     if ($info['password'] == $password) {
        //         unset($info['password']);

        //         $_SESSION['me'] = $info;
        //     }
        //     header('location:index.php?c=message&a=lists');
        // }

        // public function reg() {
        //     include "./view/user/reg.html";
        // }

        // public function doReg() {
        //     $uname 		= $_POST['uname'];
        //     $phone 		= $_POST['phone'];
        //     $password 	= $_POST['password'];

        //     $mysqli = new mysqli('localhost', 'root', 'root', 'zt_test');
        //     $sql = "select * from zt_user where phone = '{$phone}'";
        //     $query = $mysqli->query($sql);

        //     if ($query->num_rows > 0) {
        //         header('location:index.php?c=user&a=login');
        //         die();
        //     }

        //     $sql = "insert into zt_user (name,phone,password) value ('{$uname}', '{$phone}', '{$password}')";
            
        //     $query = $mysqli->query($sql);
        //     header('location:index.php?c=user&a=login');
        // }

        // public function logout() {
        //     $_SESSION = array('a'=>'b','c'=>'d');
        //     header('location:index.php?c=user&a=login');
        // }
    }

