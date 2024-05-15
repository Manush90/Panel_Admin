
<?php
class Database
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'panel_admin';
    private $conn;
    private $lastError;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
        }
    }

    public function executeQuery($query, $params = array())
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->lastError = $e->getMessage();
            return false;
        }
    }

    public function getLastError()
    {
        return $this->lastError;
    }
}
?>
