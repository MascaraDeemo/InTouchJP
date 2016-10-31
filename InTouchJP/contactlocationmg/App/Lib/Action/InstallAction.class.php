<?php

class InstallAction extends Action {
    public function index(){
        $this->display();
    }
    public function checkDb(){
        $user = C("DB_USER");
        $passwd = C("DB_PWD");
        $host = C("DB_HOST").":".C("DB_PORT");
        $link=mysql_connect("$host","$user","$passwd");
        $flag = false;
        if(!$link){
            $flag = true;
            return $flag;
        }
        $dbname = C("DB_NAME");
        $select = mysql_select_db("$dbname", $link);
        if(!$select){
            $flag = true;
            return $flag;
        }
        return $flag;
    }
    public function update(){
        $port = $_POST['port'];
        if(empty($port)){
            $port="3306";
        }
        $config['DB_USER'] = $_POST['user'];
        $config['DB_PWD'] = $_POST['pwd'];
        $config['DB_HOST'] = $_POST['ip'];
        $config['DB_PORT'] = $port;
        $config['DB_NAME'] = $_POST['dbname'];
        $this->update_config($config);
        echo "配置已保存!";
    }
    public function install(){
        $log = "";
        $file_name=DATA_PATH."data.sql"; //要导入的SQL文件名
        $ip = $_POST['ip'];
        $port = $_POST['port'];
        if(empty($port)){
            $port="3306";
        }
        $dbhost=$ip.":".$port; //数据库主机名
        $dbuser=$_POST['user']; //数据库用户名
        $dbpass=$_POST['pwd']; //数据库密码
        $dbname=$_POST['dbname']; //数据库名
        set_time_limit(0); //设置超时时间为0，表示一直执行。当php在safe mode模式下无效，此时可能会导致导入超时，此时需要分段导入
        $fp = @fopen($file_name, "r");//打开文件
        if(!$fp){
            $log.="不能打开SQL文件";
            echo $log;
            return;
        }
        $conn=mysql_connect($dbhost, $dbuser, $dbpass);//连接数据库
        if(!$conn){
            $log.="无法连接数据库";
            echo $log;
            return;
        }
        mysql_query("set names utf8",$conn);
        $sql="DROP DATABASE $dbname"; // 如果数据库存在,会删除.
        mysql_query($sql);
        $sql="CREATE DATABASE $dbname"; // 如果资料表存在,也会删除... 所以安全问题要考虑一下.
        mysql_query($sql);

        if(mysql_select_db($dbname)){
            $log.="正在执行导入操作<BR>";
            while ( $SQL = ($this->getNextSQL ($fp)) ) {
                if (mysql_query ( $SQL )) {
                    $log.="执行SQL：" . mysql_error () . "";
                    $log.="SQL语句为：" . $SQL . "<BR>";
                }
            }
            $log.="导入完成";
        }
        $config['DB_USER'] = $dbuser;
        $config['DB_PWD'] = $dbpass;
        $config['DB_HOST'] = $ip;
        $config['DB_PORT'] = $port;
        $config['DB_NAME'] = $dbname;
        $this->update_config($config);
        echo $log;
        fclose ( $fp ) or die ( "Can't close file $file_name" ); // 关闭文件
        mysql_close ();
    }

    public function getNextSQL($fp) {
        $sql="";
        while (($line = @fgets($fp, 40960))) {
            $line = trim($line);
            //以下三句在高版本php中不需要
            $line = str_replace("\\\\","\\",$line);
            $line = str_replace("\'","'",$line);
            $line = str_replace("\\r\\n",chr(13).chr(10),$line);
            // $line = stripcslashes($line);
            if (strlen($line)>1) {
                if ($line[0]=="-" && $line[1]=="-") {
                    continue;
                }
            }
            $sql.=$line.chr(13).chr(10);
            if (strlen($line)>0){
                if ($line[strlen($line)-1]==";"){
                    break;
                }}
        }
        return $sql;
    }

    public function update_config($new_config, $config_file = '') {
        !is_file($config_file) && $config_file = CONF_PATH . '/config.php';
        if (is_writable($config_file)) {
            $config = require $config_file;
            $config = array_merge($config, $new_config);
            file_put_contents($config_file, "<?php \nreturn " . stripslashes(var_export($config, true)) . ";", LOCK_EX);
            @unlink(RUNTIME_FILE);
            return true;
        } else {
            return false;
        }
    }
}