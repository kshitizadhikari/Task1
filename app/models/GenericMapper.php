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

        public function findByUserName($username) {
            $sql = "SELECT * FROM $this->tableName WHERE username=?";
            $result = $this->db->query($sql, [$username]);
            if (!empty($result)) {
                $row = $result[0];
                $user = new User;
                $user->id = $row['id'];
                $user->username = $row['username'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->role = $row['role'];
                $user->acc_created_by = $row['acc_created_by'];
                $user->loginCount = $row['loginCount'];
                return $user;
            } else {
                return null;
            }
        }

        public function findByUserEmail($email) {
            $sql = "SELECT * FROM $this->tableName WHERE email=?";
            $result = $this->db->query($sql, [$email]);
        
            if ($result && !empty($result)) { // Check if $result is not empty
                $row = $result[0];
                $user = new User;
                $user->id = $row['id'];
                $user->username = $row['username'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->role = $row['role'];
                $user->acc_created_by = $row['acc_created_by'];
                $user->loginCount = $row['loginCount'];
                return $user;
            } else {
                return null;
            }
        }
        

        public function findById($id) {
            $sql = "SELECT * FROM $this->tableName WHERE id=?";
            $result = $this->db->query($sql, [$id]);
            if (!empty($result)) {
                $row = $result[0];
                $user = new User;
                $user->id = $row['id'];
                $user->username = $row['username'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->role = $row['role'];
                $user->acc_created_by = $row['acc_created_by'];
                $user->loginCount = $row['loginCount'];
                return $user;
            } else {
                return null;
            }
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
                if ($key !== 'id') { 
                    $setClause .= "$key=?, ";
                    $values[] = $value;
                }
            }
            
            $setClause = rtrim($setClause, ', ');
            $sql = "UPDATE $this->tableName SET $setClause WHERE id=?";
            $values[] = $data['id'];
            
            return $this->db->query($sql, $values);
        }
        


        public function delete($id) {
            $sql = "DELETE FROM $this->tableName WHERE id=?";
            $result = $this->db->query($sql, [$id]);
            return $result;
        }
        
    }
?>