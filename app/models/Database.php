
<?php 
    class Database {
        public $HOSTNAME = "localhost";
        public $USERNAME = "root";
        public $PASSWORD = "";
        public $DATABASE = "mvc";
        public $conn;
        public $stmt;
        public $result;
    
        public function __construct() {
            try {
                $dsn = "mysql:host=" . $this->HOSTNAME . ";dbname=" . $this->DATABASE;
                $this->conn = new PDO($dsn, $this->USERNAME, $this->PASSWORD);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Database connection error : " . $e->getMessage();
            }
        }
        
        public function query($query, $params = []) {
            try {
                $this->stmt = $this->conn->prepare($query);
        
                if ((strpos(strtoupper($query), 'INSERT') === 0) || (strpos(strtoupper($query), 'UPDATE') === 0) || (strpos(strtoupper($query), 'DELETE') === 0)) {
                    return $this->stmt->execute($params);
                }
        
                if(strpos(strtoupper($query), 'SELECT') === 0) {
                    if ($this->stmt->execute($params)) {
                        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        echo "Query execution error: " . implode(", ", $this->stmt->errorInfo());
                        return false;
                    }
                }
        
                return $this->stmt->execute($params);
            } catch (PDOException $e) {
                echo "Query execution error: " . $e->getMessage();
                return false;
            }
        }
        
        
    }
?>
