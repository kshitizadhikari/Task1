<?php
    class GenericMapper
    {
        protected $db;
        protected $tableName;

        public function __construct($db, $tableName) {
            $this->db = $db;
            $this->tableName = $tableName;
        }
        
        protected function getObjectData($obj) {
            return get_object_vars($obj);
        }

        public function save($obj) {
            $data =  $this->getObjectData($obj);
            $columns = implode(', ', array_keys($data));
            $values = implode(', ', array_fill(0, count($data), '?'));
            $sql = "INSERT INTO $this->tableName ($columns) VALUES ($values)";
            return $this->db->query($sql, array_values($data)); //returns boolean value
        }

        public function findById($id) {
            $sql = "SELECT * FROM $this->tableName WHERE id=?";
            $result = $this->db->query($sql, [$id]);
            return $result;
        }

        public function findAll() {
            $sql = "SELECT * FROM $this->tableName";
            $result = $this->db->query($sql);
            return $result;
        }

        public function update($obj) {
            $data = $this->getObjectData($obj);
            $setClause = '';
            $values = [];
            foreach ($data as $key => $value) {
                if ($key !== 'id') { // Skip ID field in SET clause
                    $setClause .= "$key=?,";
                    $values[] = $value;
                }
            }
            $setClause = rtrim($setClause, ','); // Remove trailing comma
            $sql = "UPDATE $this->tableName SET $setClause WHERE id=?";
            $values[] = $data['id']; // Add ID to values array
            return $this->db->query($sql, $values);
        }


        public function delete($id) {
            $sql = "DELETE FROM $this->tableName WHERE id=?";
            $result = $this->db->query($sql, [$id]);
            return $result;
        }
        
    }
?>