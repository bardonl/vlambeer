<?php

/**
 * Created by PhpStorm.
 * User: kobus
 * Date: 12/6/2016
 * Time: 9:07 AM
 */
class User
{

    private $db;
    public $userId;
    public $userData;
    public $role;
    public $loggedIn = false;
    public $isBanned = false;
    public $isMod = false;

    function __construct() {
//         Database connectie
        $this->db = Database::getInstance();
    }

    // redirect vanaf development folder

    public function redirect($path) {
        header("location:" . BASE_URL . 'public/'.$path);
        exit;
    }

    // AuthFunctions

    public function getUserDataByName($username) {
        $sql = "SELECT * FROM tbl_user 
                INNER JOIN tbl_user_lvl
                    ON fk_user_lvl_id = user_lvl_id
                WHERE username = :username";
        $stmt = Database::getInstance()->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getUserDataById($id) {
        $sql = "SELECT * FROM tbl_user WHERE user_id = :id";
        $stmt = Database::getInstance()->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }

    // zet alle database user columns in userData array

    public function setUserData($id) {
        $result = $this->getUserDataById($id);
        foreach ($result as $key => $value){
                $this->userData[$key] = $value;
        }
    }

    // zoekt het role id van specifieke user

    public function getRoleId($id) {
        $sql = (
            "SELECT `user_lvl_desc` FROM tbl_user_lvl
                INNER JOIN tbl_user
                    on tbl_user.`fk_user_lvl_id` = tbl_user_lvl.`user_lvl_id`
                WHERE tbl_user.`user_id` = :id");
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    // register functions GEBRUIK ASSORTIEF ARRAY

    public function forumRegister($data) {
        var_dump($data);
        $sql = "INSERT INTO tbl_user
                (`username`, `email`, `dob`, `country`, `user_gender`, `password`, `join_date`, `fk_user_lvl_id`)
                VALUES
                (:username, :email, :dob, :country, :user_gender, :password, :joinDate, :userlvl)
        ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':dob', $data['dob']);
        $stmt->bindParam(':country', $data['country']);
        $stmt->bindParam(':user_gender', $data['user_gender']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':joinDate', $data['joinDate']);
        $stmt->bindParam(':userlvl', $data['userlvl']);
        $stmt->execute();

        

    }

    public function webshopRegister($data) {
        $sql = "INSERT INTO tbl_user
                (`username`, `email`, `password`, `firstname`,
                `lastname`, `phonenumber`, `streetname`,
                `housenumber`, `zipcode`, `city`, `country`,
                `state_or_province`, `user_gender`, `join_date`, `fk_user_lvl_id`)
                VALUES
                (:username, :email, :password, :firstname, :lastname, :phonenumber,
                :streetname, :housenumber, :zipcode, :city, :country,
                :stateOrProvince, :gender, :joinDate, :userlvl)";

        $stmt = $this->db->pdo->prepare($sql);
        foreach ($data as $key => &$value) {
            $stmt->bindParam(':'.$key ,$value, PDO::PARAM_STR);
        }
        $stmt->execute();
    }

    // select 5 users

    public function selectFewUsers() {
        $sql = "SELECT * FROM tbl_user limit 5";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // login

    public function userLogin($id) {
        $_SESSION['user_id'] = $id;
    }

//    Edit user profile

    public function editProfile($userData, $uploadedFile){
        if(empty($userData['password']) && empty($uploadedFile['name'])){
            $sql = "UPDATE `tbl_user`
                    SET user_description = :user_description,
                        dob = :dob,
                        country = :country,
                        email = :email,
                        mobilenumber = :mobilenumber,
                        phonenumber = :phonenumber,
                        streetname = :streetname,
                        housenumber = :housenumber,
                        zipcode = :zipcode,
                        city = :city,
                        state_or_province = :state_or_province,
                        firstname = :firstname,
                        lastname = :lastname
                    WHERE user_id = :user_id
                    ";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':user_description', $userData['user_description']);
            $stmt->bindParam(':dob', $userData['dob']);
            $stmt->bindParam(':country', $userData['country']);
            $stmt->bindParam(':email', $userData['email']);
            $stmt->bindParam(':mobilenumber', $userData['mobilenumber']);
            $stmt->bindParam(':phonenumber', $userData['phonenumber']);
            $stmt->bindParam(':streetname', $userData['streetname']);
            $stmt->bindParam(':housenumber', $userData['housenumber']);
            $stmt->bindParam(':zipcode', $userData['zipcode']);
            $stmt->bindParam(':city', $userData['city']);
            $stmt->bindParam(':state_or_province', $userData['state_or_province']);
            $stmt->bindParam(':user_id', $userData['user_id']);
            $stmt->bindParam(':firstname', $userData['first-name']);
            $stmt->bindParam(':lastname', $userData['last-name']);
            $stmt->bindParam(':lastname', $userData['newsletter']);
            $stmt->execute();
        }
        else if(empty($userData['password'])){
            $targetImg = '../../public/img/profile_img/';
            $basenameImg = uniqid() . '-' . basename($uploadedFile['name']);
            $uploadTargetImg = $targetImg . $basenameImg;
            $uploadTargetImgDb = BASE_URL . 'public/img/profile_img/';
            $uploadTargetImgDb = $uploadTargetImgDb . $basenameImg;

            $sql = "UPDATE `tbl_user`
                    SET user_description = :user_description,
                        dob = :dob,
                        country = :country,
                        email = :email,
                        mobilenumber = :mobilenumber,
                        phonenumber = :phonenumber,
                        streetname = :streetname,
                        housenumber = :housenumber,
                        zipcode = :zipcode,
                        city = :city,
                        state_or_province = :state_or_province,
                        profile_picture_path = :profile_picture_path,
                        firstname = :firstname,
                        lastname = :lastname
                    WHERE user_id = :user_id
                    ";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':user_description', $userData['user_description']);
            $stmt->bindParam(':dob', $userData['dob']);
            $stmt->bindParam(':country', $userData['country']);
            $stmt->bindParam(':email', $userData['email']);
            $stmt->bindParam(':mobilenumber', $userData['mobilenumber']);
            $stmt->bindParam(':phonenumber', $userData['phonenumber']);
            $stmt->bindParam(':streetname', $userData['streetname']);
            $stmt->bindParam(':housenumber', $userData['housenumber']);
            $stmt->bindParam(':zipcode', $userData['zipcode']);
            $stmt->bindParam(':city', $userData['city']);
            $stmt->bindParam(':state_or_province', $userData['state_or_province']);
            $stmt->bindParam(':profile_picture_path', $uploadTargetImgDb);
            $stmt->bindParam(':user_id', $userData['user_id']);
            $stmt->bindParam(':firstname', $userData['first-name']);
            $stmt->bindParam(':lastname', $userData['last-name']);
            $stmt->execute();

            //Upload de image daadwerkelijk naar de juist folder, in de SQL word het pad naar de img geplaatst.
            move_uploaded_file($uploadedFile['tmp_name'], $uploadTargetImg);
        }
        else if(empty($uploadedFile['name'])){
            $sql = "UPDATE `tbl_user`
                    SET user_description = :user_description,
                        password = :password,
                        dob = :dob,
                        country = :country,
                        email = :email,
                        mobilenumber = :mobilenumber,
                        phonenumber = :phonenumber,
                        streetname = :streetname,
                        housenumber = :housenumber,
                        zipcode = :zipcode,
                        city = :city,
                        state_or_province = :state_or_province,
                        firstname = :firstname,
                        lastname = :lastname
                    WHERE user_id = :user_id
                    ";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':user_description', $userData['user_description']);
            $stmt->bindParam(':dob', $userData['dob']);
            $stmt->bindParam(':password', $userData['password']);
            $stmt->bindParam(':country', $userData['country']);
            $stmt->bindParam(':email', $userData['email']);
            $stmt->bindParam(':mobilenumber', $userData['mobilenumber']);
            $stmt->bindParam(':phonenumber', $userData['phonenumber']);
            $stmt->bindParam(':streetname', $userData['streetname']);
            $stmt->bindParam(':housenumber', $userData['housenumber']);
            $stmt->bindParam(':zipcode', $userData['zipcode']);
            $stmt->bindParam(':city', $userData['city']);
            $stmt->bindParam(':state_or_province', $userData['state_or_province']);
            $stmt->bindParam(':user_id', $userData['user_id']);
            $stmt->bindParam(':firstname', $userData['first-name']);
            $stmt->bindParam(':lastname', $userData['last-name']);
            $stmt->execute();
        }
//        Als alles is ingevuld:
        else {
            $targetImg = '../../public/img/profile_img/';
            $basenameImg = uniqid() . '-' . basename($uploadedFile['name']);
            $uploadTargetImg = $targetImg . $basenameImg;
            $uploadTargetImgDb = BASE_URL . 'public/img/profile_img/';
            $uploadTargetImgDb = $uploadTargetImgDb . $basenameImg;

            $sql = "UPDATE `tbl_user`
                    SET user_description = :user_description,
                        password = :password,
                        dob = :dob,
                        country = :country,
                        email = :email,
                        mobilenumber = :mobilenumber,
                        phonenumber = :phonenumber,
                        streetname = :streetname,
                        housenumber = :housenumber,
                        zipcode = :zipcode,
                        city = :city,
                        state_or_province = :state_or_province,
                        profile_picture_path = :profile_picture_path,
                        firstname = :firstname,
                        lastname = :lastname
                    WHERE user_id = :user_id
                    ";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':user_description', $userData['user_description']);
            $stmt->bindParam(':password', $userData['password']);
            $stmt->bindParam(':dob', $userData['dob']);
            $stmt->bindParam(':country', $userData['country']);
            $stmt->bindParam(':email', $userData['email']);
            $stmt->bindParam(':mobilenumber', $userData['mobilenumber']);
            $stmt->bindParam(':phonenumber', $userData['phonenumber']);
            $stmt->bindParam(':streetname', $userData['streetname']);
            $stmt->bindParam(':housenumber', $userData['housenumber']);
            $stmt->bindParam(':zipcode', $userData['zipcode']);
            $stmt->bindParam(':city', $userData['city']);
            $stmt->bindParam(':state_or_province', $userData['state_or_province']);
            $stmt->bindParam(':profile_picture_path', $uploadTargetImgDb);
            $stmt->bindParam(':user_id', $userData['user_id']);
            $stmt->bindParam(':firstname', $userData['first-name']);
            $stmt->bindParam(':lastname', $userData['last-name']);
            $stmt->execute();

            //Upload de image daadwerkelijk naar de juist folder, in de SQL word het pad naar de img geplaatst.
            move_uploaded_file($uploadedFile['tmp_name'], $uploadTargetImg);
        }
    }

    // logout

    public function userLogout() {
        if(isset($_SESSION['user_id'])) {
            session_destroy();
            return 1;
        }
        return 0;
    }

    // kijkt of username al bestaat

    public function usernameExists($username) {
        $sql = "SELECT username from tbl_user where username = :username";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->rowCount();
        if($result == 0) {
            return 0;
        } else {
            return 1;
        }

    }

    // kijkt of email al bestaat

    public function emailExists($email) {
        $sql = "SELECT email FROM tbl_user
                WHERE email = :email
        ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->rowCount();

        if($result == 0) {
            return 0;
        }
        return 1;
    }
    
    // Kijk naar lengte
    
    public function lengthVal($val, $min, $max) {
        if(strlen($val) < $min  || strlen($val) > $max ) {
            return 0;
        } else {
            return 1;
        }
    }

    // Is in string

    function contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false;
    }
    
    // Check logged in

    public function checkLogin() {
        if(!$this->loggedIn) {
            return 0;
        }

        return 1;

    }

    // check roles

    public function checkAdmin() {
        if($this->role != 'Admin') {
            return 0;
        }
        return 1;

    }

    public function checkModerator() {
        if($this->role != 'Moderator') {
            return 0;
        }
        return 1;
    }

    public function checkUser() {
        if($this->role != 'User') {
            return 0;
        }
        return 1;
    }

    // Sets

    public function setUserId($val) {
        $this->userId = $val;
    }

    public function setRole($val) {
        $this->role = $val;
    }

    public function setLoggedIn($val) {
        $this->loggedIn = $val;
    }

}