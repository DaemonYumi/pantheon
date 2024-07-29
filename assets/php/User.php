<?php
    
    // $root= dirname(__FILE__);

//    require_once "$root/config.php";

    namespace Controller;

    use Connection\Database;
    // use Traits\ResponseTrait;
    use UserLoginResponseTrait\UserLoginResponse;

   class UserController extends Database{
        // use ResponseTrait;
        use UserLoginResponse;

       // Register new user
       public function registerUser($fname, $lname, $email, $username, $password){
            // Insert into users' table
           $sql = "INSERT INTO users(email, username, password) VALUES (?, ?, ?)";
           $stmt = $this->conn->prepare($sql);
           $stmt->execute([$email, $username, $password]);

            // insert into user profile
            $sql_1 = "INSERT INTO users_profile(firstname, lastname) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql_1);
            $stmt->execute([$fname, $lname]);

           return true;
       }

        // Check if user already exists by email address
        public function userExist($email){
            $sql = "SELECT email FROM panth_users WHERE email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$email]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $result;
        }

        // Login - check  if user is not deleted or is the credetials entered is existing in the record
        public function login($username, $password){

            $user_login_res = new UserLoginResponse();

            $sql = "SELECT id, username, email, password FROM panth_users WHERE (username = ? OR email = ?)  AND deleted_at = 0";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$username, $username]);
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            // if have results
            if(!empty($row)){

                // Check password
                if(password_verify($password, $row['password'])){

                    // if correct
                    // Set session to user
                    session_start();
                    $_SESSION['id'] = $row['id'];
                    return $this->sendResponse($row, 'Login Success', 200);
                }else{
                    // if incorrect
                    return $this->sendResponse(['message' =>'Incorrect Password', 'error' => false], 500);
                }

            }else{
                // if no results
                return $this->sendResponse(['message' =>'Account does not exist', 'error' => false], 404);
            }

        }

        // Details of the current logged in user
        public function currentUser($username){
            $sql = "SELECT * FROM user_profile WHERE user_id = ? AND deleted_at = null";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$username]);
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

            return $row;
        }

   }
?>