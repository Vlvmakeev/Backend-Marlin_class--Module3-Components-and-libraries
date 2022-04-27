<?php
    
    namespace App;
    use Aura\SqlQuery\QueryFactory;
    use PDO;

    class QueryBuilder
    {
        private $pdo;
        private $queryFactory;

        public function __construct(){
            // a PDO connection
            $this->pdo = new PDO('mysql:host=localhost;dbname=app3;charset=utf8', 'root', '');
            $this->queryFactory = new QueryFactory('mysql');
        }
        
        public function getAll($table){
            

            $select = $this->queryFactory->newSelect();

            $select->cols(['*'])
                ->from($table);

            

            

            // prepare the statement
            $sth = $this->pdo->prepare($select->getStatement());

            // bind the values and execute
            $sth->execute($select->getBindValues());

            // get the results back as an associative array
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }

        public function insert($data, $table){
            $insert = $this->queryFactory->newInsert();

            $insert
                ->into($table)                   // INTO this table
                ->cols($data);
            
            
            // prepare the statement
            $sth = $this->pdo->prepare($insert->getStatement());

            // execute with bound values
            $sth->execute($insert->getBindValues());

        }

        public function update($data, $id, $table){
            $update = $this->queryFactory->newUpdate();

            $update
                ->table($table)                  // update this table
                ->cols($data)
                ->where('id = :id', ['id' => $id])           // AND WHERE these conditions
                ->bindValue('id', $id);
            
            
            // prepare the statement
            $sth = $this->pdo->prepare($update->getStatement());

            // execute with bound values
            $sth->execute($update->getBindValues());
        }
    }
?>