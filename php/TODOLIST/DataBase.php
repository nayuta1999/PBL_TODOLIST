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
        public function TODO_insert($Todo,$Need_period,$Priority_number){//データベースにinsert
            
        }
    }
?>