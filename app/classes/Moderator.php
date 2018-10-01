<?php

class Moderator {

    private $db;

    function __construct() {
        $this->db = Database::getInstance();
    }

    public function searchUser($search) {
        $sql = "SELECT * FROM tbl_user
                    WHERE username like :search
                    LIMIT 10
                ";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':search', '%' . $search . '%');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function selectAllRoles() {
        $sql = "SELECT * FROM tbl_user_lvl";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function changeRank($userId, $rankId) {
        $sql = "UPDATE tbl_user
                SET fk_user_lvl_id = :rankId
                WHERE user_id = :userId
                ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':rankId', $rankId);
        $stmt->execute();
    }

    public function addForumMod($userId, $forumId) {
        $sql = "INSERT INTO tbl_forum_moderator
                (`fk_user_id`, `fk_forum_id`)
                VALUES
                (:userId, :forumId)
        ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':forumId', $forumId);
        $stmt->execute();
    }

    public function removeForumMod($userId, $forumId) {
        $sql = "DELETE FROM tbl_forum_moderator
                WHERE fk_user_id = :userId AND fk_forum_id = :forumId
        ";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':forumId', $forumId);
        $stmt->execute();
    }

    public function getSelectedCategories($userId) {
        $sql = "SELECT fk_forum_id FROM tbl_forum_moderator
                WHERE fk_user_id = :userId";

        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $result = false;
        }

        return $result;
    }
    
    public function banUser($userId) {
        $user = new User();
        if($user->getUserDataById($userId)['is_banned'] == 0) {
            $ban = 1;
        } else if($user->getUserDataById($userId)['is_banned'] == 1) {
            $ban = 0;
        }
        
        
        $sql = "UPDATE tbl_user
                SET is_banned = :ban
                WHERE user_id = :userId
        ";
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':ban', $ban);
        $stmt->execute();

        return $ban;
    }

    public function checkNewsletter($userId, $checked) {
        if($checked == 1) {
            $checker = 1;
            $sql = "UPDATE tbl_user SET has_newsletter = :checker WHERE user_id = :userId";
        } else {
            $checker = 0;
            $sql = "UPDATE tbl_user SET has_newsletter = :checker WHERE user_id = :userId";
        }
        
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':checker', $checker);
        $stmt->execute();
    }

}