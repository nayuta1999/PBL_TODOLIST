<?php
    class database{
        private $dsn;
        private $user;
        private $pass;
        private $pdo;

        /*
            コンストラクタ
            db接続
        */
        function __construct($Dsn='mysql:dbname=test_db;host=db;charset=utf8mb4;',$User='docker',$Pass='docker'){
            //var_dump($Dsn);die;
            $this->dsn=$Dsn;
            $this->user=$User;
            $this->pass=$Pass;
            try{
                $this->pdo=new PDO($this->dsn,$this->user,$this->pass);
            }catch(PDOException $e){
                echo '接続失敗';
            }
        }
        /*
            TODOテーブル作成
        */
        public function TODO_create_table(){
            try{
                /*
                    TODOテーブル内容
                */
                $table_sql = 'CREATE TABLE todo (
                    user_table INT(11),
                    user INT(11),
                    todo VARCHAR(30),
                    finish_datetime DATETIME,
                    finish_check INT(11),
                    need_period INT(11),
                    priority_number INT(11),
                    registry_datetime DATETIME
                )engine=innodb default charset=utf8';
                
                $this->pdo->query($table_sql);
            }
            catch(PDOException $e){
                echo '接続失敗';
                die;
            }
        }

        /*  
            ユーザーテーブル作成
        */
        public function User_create_table(){
            try{
                $table_sql = 'CREATE TABLE user (
                    user_id INT(11) NOT NULL AUTO_INCREMENT primary key,
                    user_table INT(11)NOT NULL,
                    user_name VARCHAR(255)NOT NULL,
                    hash VARCHAR(255) NOT NULL
                )engine=innodb default charset=utf8';
                $this->pdo->query($table_sql);
            }
            catch(PDOException $e){
                echo 'ユーザーテーブル作成失敗';
            }
        }
        /*
            TODOに要素を追加する．
        */
        public function TODO_insert($Todo,$Need_period,$Priority_number){
            $date=date('Y-m-d H:i:s');
            $sql = "INSERT INTO todo (
                user_table,user,todo,finish_check,need_period,priority_number,registry_datetime
            ) VALUES (
                :user_table,:user,:todo,:finish_check,:need_period,:priority_number,:registry_datetime
            )";
            //var_dump($sql);die;
            $stmt = $this->pdo->prepare($sql);
            $params=[
                ':user_table' => 1,
                ':user' => 1,
                ':todo' => $Todo,
                ':finish_check' => 0,
                ':need_period' => $Need_period,
                ':priority_number' => $Priority_number,
                ':registry_datetime' => $date,
            ];
            $stmt->execute($params);
        }
        /*
            ユーザーの作成
        */
        public function User_insert($user_name,$user_table,$hash){
            $hash = password_hash($hash,PASSWORD_DEFAULT);
            $sql="INSERT INTO user (
                user_table,user_name,hash
            ) VALUES (
                :user_table,:user_name,:hash
            )";
            $stmt=$this->pdo->prepare($sql);
            $params=[
                ':user_table' => $user_table,
                ':user_name' => $user_name,
                ':hash' => $hash,
            ];
            $stmt->execute($params);
            echo 'ユーザーが作成されました．';
        }

        /* 
            ログイン時に認証
        */
        public function CheckUser($user,$pass){
            $stmt = $this->User_serch('user_name',$user);     
            if(password_verify($pass,$stmt[0]['hash'])){
                return $stmt;
            }
            else{
                return False;
            }
        }
        /*
            データベースからUserを検索
        */
        public function User_serch($serch_word,$data){
            //$sql = "SELECT * FROM user WHERE $serch_word = $data";
            $sql = "SELECT * FROM user WHERE $serch_word LIKE '$data'";
            //var_dump($sql);die;
            $stmt = $this->pdo->query($sql);
            //var_dump($stmt);die;
            /*
            if($stmt==FALSE){
                return false;
            }
            */
            return $stmt->fetchAll();
        }

        /*
            データベースからTODOを検索する．
        */
        public function TODO_serch($serch_word,$data){
            $sql = "SELECT * FROM todo WHERE $serch_word = $data";
            //var_dump($sql);die;
            $stmt = $this->pdo->query($sql);
            if($stmt==FALSE){
                return false;
            }
            return $stmt->fetchAll();
        }
    }
?>