<?php
    require_once "Database.php";
    class User extends Database{

        public function store($request)
        {
            $first_name = $request['first_name'];
            $last_name = $request['last_name'];
            $username = $request['username'];
            $password = $request['password'];

            //Hash the password before inserting into the database
            $password = password_hash($password, PASSWORD_DEFAULT);
            # $password -> password supplied by the user
            # PASSWORD_DEFAULT -> algorithm use to hash the password

            # Prepare the query
            $sql = "INSERT INTO users(`first_name`, `last_name`,`username`,`password`) VALUES('$first_name', '$last_name', '$username', '$password')";

            # Execute the query string
            if ($this->conn->query($sql)) {
                header("location: ../views"); //the login page... we will create later
                exit();
            }else{
                die("Error in creating new user " . $this->conn->error);
            }
        }

        public function login($request){
            $username = $request['username'];
            $password = $request['password'];

            # Query string
            $sql = "SELECT * FROM users WHERE username = '$username'";

            # Execute the query and store the result in $result
            $result = $this->conn->query($sql);

            # Check the username
            if ($result->num_rows == 1) {
                # Check if the password is correct
                $user = $result->fetch_assoc();
                #$user = ['id' => 1, 'username' => 'john', 'password' => $lajhd78624njs1zzxdj]

                # Verify the password if it match with the password in the database
                if (password_verify($password, $user['password'])) {
                    # If the password matched, the create the session variables
                    session_start();
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['fullname'] = $user['first_name'] . " " . $user['last_name'];

                    # redirect to dashboard if everything is okay
                    header("location: ../views/dashboard.php"); //we will create dashboard.php later on
                    exit();
                }else {
                    die("Password is incorrect.");
                }
            }else {
                die("Username not found.");
            }

        }

        public function logout(){
         session_start(); 
         session_unset();    //unsetting the session variables
         session_destroy(); // Removed or destroy the session variables
         
         header("location: ../views");
         exit;
        }

        public function getAllUsers(){
            $sql = "SELECT id, first_name, last_name, username, photo FROM users";
            
            if ($result = $this->conn->query($sql)) {
                return $result;
            }else {
                die("Error in retrieving all users. " . $this->conn->error);
            }
        }

        public function getUser(){
            $id = $_SESSION['id']; //logged-in user

            $sql = "SELECT first_name, last_name, username, photo FROM users WHERE id = $id";

            if ($result = $this->conn->query($sql)) {
                return $result->fetch_assoc();
            }else {
                die("Error in retrieving the user." . $this->conn->error);
            }
        }

        public function update($request, $files){
            session_start();
            $id = $_SESSION['id'];
            $first_name = $request['first_name'];
            $last_name = $request['last_name'];
            $username = $request['username'];

            //Image uploaded by the user
            $photo = $files['photo']['name'];
            $tmp_photo = $files['photo']['tmp_name'];

            # Query String
            $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username' WHERE id = '$id'";

            if ($this->conn->query($sql)) {
                $_SESSION['username'] = $username;
                $_SESSION['full_name'] = "$first_name $last_name";

                #If there an image uploaded, save it to the Db, and save the file into the images folder
                if ($photo) {
                    $sql = "UPDATE users SET photo = '$photo' WHERE id = '$id'";
                    $destination = "../assets/images/$photo";

                    # Save the image to the database
                    if ($this->conn->query($sql)) {
                        //Save the file to the images folder
                        if (move_uploaded_file($tmp_photo, $destination)) {
                            header("location: ../views/dashboard.php");
                            exit;
                        }else {
                            die("error in moving the photo");
                        }
                    }else {
                        die("Error in uploading the photo. " . $this->conn->error);
                    }
                }
                header("location: ../views/dashboard.php");
                exit;
            }else {
                die("Error in updating the user: " . $this->conn->error);
            }
        }

        public funcrion delete(){
            session_start();
            $id= $_SESSION['id'];

            $sql = "DELETE FROM users WHERE id = $id'";

            if($this->conn->query($sql)){
                $this->logout();
            }else{
                die("Error in deleting user." . $this->conn->error);
            }
        }
    }
?>





