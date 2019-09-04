<?php
    class database{
        private $dsn = 'mysql:dbname=test_db;host=db;charset=utf8mb4';
        private $user = 'docker';
        private $pass = 'docker';
        private $pdo;

        /*
            データベースの接続
            データベースのテーブル追加
        */
        public function init(){
            try{
                $this->pdo = new PDO($this->dsn,$this->user,$this->pass);  
                /*
                    テーブルの内容
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
                
                echo $this->pdo->query($table_sql);
            }
            catch(PDOException $e){
                echo '接続失敗';
                die;
            }
        }
        /*
            TODOに要素を追加する．
        */
        public function TODO_insert($Todo,$Need_period,$Priority_number){//データベースにinsert
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
    }
?>