<?php
    require_once("load_env.php");

    enum QueryResult {
        case SUCCESS;
        case FAILED_UNKNOWN;
        case FAILED_EMAIL_NOT_UNIQUE;
        case FAILED_USER_NOT_UNIQUE;
    }

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

        public function verifyPassword($username, $password) {
            $conn = $this->getConnection();
            $result = $conn->query("SELECT passhash FROM users WHERE username = '$username'")->fetch();
            if ($result) {
                return password_verify($password, $result['passhash']);
            } else {
                return false;
            }
        }

        /**
         * Returns 
         *  QueryResult::SUCCESS on success
         *  QueryResult::FAILED_UNKNOWN
         *  QueryResult::FAILED_EMAIL_NOT_UNIQUE on bad email
         *  QueryResult::FAILED_USER_NOT_UNIQUE on bad user
         */
        public function createUser($username, $password, $email) {
            $conn = $this->getConnection();
            $name_check = $conn->query("SELECT * FROM users WHERE username = '$username'")->fetch();

            if ($name_check) {
                return QueryResult::FAILED_USER_NOT_UNIQUE;
            }

            $insertQuery =
                "INSERT INTO users
                (username, passhash, email)
                VALUES
                (:username, :passhash, :email)";
            $q = $conn->prepare($insertQuery);
            $q->bindParam(":username", $username);
            $q->bindParam(":email", $email);
            $passhash = password_hash($password, PASSWORD_DEFAULT);
            $q->bindParam(":passhash", $passhash);

            try{
                if($q->execute()) {
                    return QueryResult::SUCCESS;
                } else {
                    return QueryResult::FAILED_UNKNOWN;
                }
            } catch (PDOException) {
                if ($q->errorCode() == '23505') {
                    return QueryResult::FAILED_EMAIL_NOT_UNIQUE;
                }
            }
        }
    }