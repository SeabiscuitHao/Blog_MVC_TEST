  <?php
    function connectRds() {
        $redis = new Redis();
        $redis->connect('47.93.220.17', 6379);
        return $redis;
    }

    function getId($type='message'){
        $key = "GET_ID_".$type;
        $redis = connectRds();
        $id = $redis->incr($key);
        return $id;
    }

    function addMessage($key, $value) {
        $redis = connectRds();
        return $redis->hMSet($key, $value);
    }

    function addMessageLists($key, $score, $value) {
        $redis = connectRds();
        return $redis->zadd($key,$score, $value);
    }

    function getMessageList($key,$offset=0,$limit=20) {
        $redis = connectRds();
        return $redis->zRange($key, $offset, $limit);
    }

    function getMessageInfo($key){
        $redis = connectRds();
        return $redis->hGetAll($key);
    }

    function delMessage($key){
        $redis = connectRds();
        return $redis->del($key);
    }

    function delMessageListItem($key,$value) {
       $redis = connectRds();
       return $redis->zRem($key, $value);
    }

    function D($name) {
        static $res = array();
        if (empty($res[$name])) {
            $name = ucfirst($name);
            $className = $name.'Model';
            include_once "./model/{$className}.class.php";
            $model = new $className();
            $res[$name] = $model;
        }
        return $res[$name];
    }