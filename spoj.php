<?php

class DatabaseConnection
{
    private $conn;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "fitnessbase";

    public function connect()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function close()
    {
        mysqli_close($this->conn);
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function query($query)
    {
        return mysqli_query($this->conn, $query);
    }

    public function getArray($data)
    {
        return mysqli_fetch_array($data, MYSQLI_ASSOC);
    }

    public function getCount($data)
    {
        return mysqli_num_rows($data);
    }

    public function error()
    {
        return mysqli_error($this->conn);
    }
}
?>