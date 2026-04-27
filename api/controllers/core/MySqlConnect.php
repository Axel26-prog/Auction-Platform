<?php
class MySqlConnect {
    private $pdo;
    private $log;

    public function __construct() {
        $this->log = new Logger();
    }

    public function connect() {
        try {
            $host = Config::get('DB_HOST');
            $dbname = Config::get('DB_DBNAME');
            $user = Config::get('DB_USERNAME');
            $pass = Config::get('DB_PASSWORD');
            $port = Config::get('DB_PORT') ?: 3306;

            $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (Exception $e) {
            handleException($e);
        }
    }

    public function executeSQL($sql, $resultType = "obj") {
        $lista = null;
        try {
            $this->connect();
            $stmt = $this->pdo->query($sql);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach (array_reverse($rows) as $row) {
                if ($resultType === "obj") {
                    $lista[] = (object) $row;
                } else {
                    $lista[] = $row;
                }
            }
            $this->pdo = null;
            return $lista;
        } catch (Exception $e) {
            handleException($e);
        }
    }

    public function executeSQL_DML($sql) {
        try {
            $this->connect();
            $stmt = $this->pdo->exec($sql);
            $this->pdo = null;
            return $stmt;
        } catch (Exception $e) {
            handleException($e);
        }
    }

    public function executeSQL_DML_last($sql) {
        try {
            $this->connect();
            $this->pdo->exec($sql);
            $lastId = $this->pdo->lastInsertId();
            $this->pdo = null;
            return $lastId;
        } catch (Exception $e) {
            handleException($e);
        }
    }
}
