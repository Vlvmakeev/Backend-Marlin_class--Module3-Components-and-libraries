<?php
    namespace App;
    use Aura\SqlQuery\QueryFactory;
    use PDO;

    class QueryBuilder
    {
        private $pdo;
        private $queryFactory;

        public function __construct(){
            $this->pdo = new PDO('mysql:host=127.0.0.1;dbname=app3;charset=utf8', 'root', '');
            $this->queryFactory = new QueryFactory('mysql');
        }

        public function getAll($table){
            $select = $this->queryFactory->newSelect();
            
            $select->cols(['*']);
            $select
                ->from($table);

            $sth = $this->pdo->prepare($select->getStatement());

            $sth->execute($select->getBindValues());

            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        public function insert($table, $data){
            $insert = $this->queryFactory->newInsert();

            $insert
                ->into($table)                   
                ->cols($data);

            $sth = $this->pdo->prepare($insert->getStatement());

            $sth->execute($insert->getBindValues());
        }

        public function update($table, $data, $id){
            $update = $this->queryFactory->newUpdate();

            $update
                ->table($table)                  
                ->cols($data)
                ->where('id = :id', ['id' => $id])      
                ->bindValue('id', $id);

            $sth = $this->pdo->prepare($update->getStatement());

            $sth->execute($update->getBindValues());
        }

        public function delete($table, $id){
            $delete = $this->queryFactory->newDelete();

            $delete
                ->from($table)                   
                ->where('id = :id')           
                ->bindValue('id', $id);
        }

        public function getOne($table, $id){
            $select = $this->queryFactory->newSelect();

            $select->cols(['*']);
            $select
                ->from($table)
                ->where('id = :id', ['id' => $id]);
            
            $sth = $this->pdo->prepare($select->getStatement());

            $sth->execute($select->getBindValues());

            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>