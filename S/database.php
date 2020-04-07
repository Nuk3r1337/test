<?php


class Database
{

    /**
     * @var PDO $connection
     */
    private $connection;

    /**
     * @var PDOStatement $stmt
     */
    private $stmt;

    /**
     * Database constructor. Starts database connection
     */
    public function __construct()
    {

            //credentials for database
            //Her kan man se alle de ting man normalt ikke ville have der bliver set.
            $hostname = "localhost";
            $username = "root";
            $password = "";
            $database = "portfolio";
            $charset = "utf8mb4";

        try {
            $this->connection = new PDO("mysql:dbname={$database};charset={[$charset]};host={[$hostname]}", [$username], [$password]);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        } catch (PDOException $e) {

            exit($e);
        }

        //Dette gør man så man ikke sender konkrete variabler som fx $database men der imod en flexible variable som $config.

        $config = require "config/database.php";

        try {
            $this->connection = new PDO("mysql:dbname={$config["DATABASE"]};charset={$config["CHARSET"]};host={$config["HOSTNAME"]}", $config["USERNAME"], $config["PASSWORD"]);

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        } catch(PDOException $e) {

            exit($e);
        }
    }
 }
