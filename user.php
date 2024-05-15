<?php
class User
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function authenticate($username, $password)
    {
        $query = "SELECT * FROM users WHERE users = :username";
        $params = array(':username' => $username);
        $result = $this->db->executeQuery($query, $params);
        if ($result && count($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $result = $this->db->executeQuery($query);
        return $result;
    }
}
