<?php
    require_once("load_env.php");

    class Dao {
        public function getConnection() {
            $db = parse_url(getenv("DATABASE_URL"));
            return new PDO("pgsql:" . sprintf(
                "host=%s;port=%s;user=%s;password=%s;dbname=%s",
                $db["host"],
                $db["port"],
                $db["user"],
                $db["pass"],
                ltrim($db["path"], "/")
            ));
        }

        public function getUsers() {
            $conn = $this->getConnection();
            $result = $conn->query("SELECT username, display_name from users");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public function verifyPassword($email, $password) {
            $conn = $this->getConnection();
            $result = $conn->query("SELECT passhash FROM users WHERE email = '$email'")->fetch();
            if ($result) {
                return password_verify($password, $result['passhash']);
            } else {
                return false;
            }
        }
    }