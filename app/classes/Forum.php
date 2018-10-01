<?php
class Forum {

    private $db;

    function __construct() {
//         Database connectie
        $this->db = Database::getInstance();
    }

    // redirect vanaf development folder

    public function redirect($path) {
        header("location:http://valmbeer.badge-webdevelopment.nl/public/".$path);
    }



    public function swearFilter($string) {
        $json = "http://valmbeer.badge-webdevelopment.nl/app/json/vlambeer-swear.json?key=20161216095827";
        $json = file_get_contents($json);
        $decoded = json_decode($json);

        foreach ($decoded as $item) {
            foreach ($item as $key => $val) {
                $string = str_replace($val,'vlambeer', $string);
            }
        }
        return $string;
    }

    // Returned de posts van een thread
    public function getPosts($fk_thread_id) {
        $sql = "SELECT * FROM tbl_post WHERE `fk_thread_id` = :fk_thread_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':fk_thread_id', $fk_thread_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

//    Returns all thread info
    public function getThreadInfo($forum_id){
        $sql = "SELECT *
                FROM tbl_thread
                WHERE fk_forum_id = :forum_id 
                AND thread_sticky = '0' 
                AND thread_active = '1'";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':forum_id', $forum_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function getThreadTitle($thread_id) {
        $sql = "SELECT thread_subject FROM tbl_thread WHERE thread_id = :thread_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':thread_id', $thread_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

//    Used for delete posts. (Needed to check the forum_id of a specific thread).
    public function getAllThreadInfo($thread_id){
        $sql = "SELECT * FROM `tbl_thread` WHERE `thread_id` = :thread_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':thread_id', $thread_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

//    Used for delete posts. (Gets the forums which a user can maintain)
    public function getPermittedForumId($user_id){
        $sql = "SELECT `fk_forum_id` FROM `tbl_forum_moderator` WHERE `fk_user_id` = :user_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

//    Update active to inactive post. Used for delete posts.
    public function setInactive($table, $id){
        $column = '';

        if($table == 'posts'){
            $table = 'tbl_post';
            $column = 'post_';
        }
        if($table == 'threads'){
            $table = 'tbl_thread';
            $column = 'thread_';
        }
        $active = $column . 'active';
        $column_id = $column . 'id';

        $sql = "UPDATE $table
                SET $active = 0
                WHERE $column_id = :column_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':column_id', $id);
        $stmt->execute();
    }

    public function getAllPostData($thread_id) {
        $sql = "SELECT * FROM `tbl_post` p
                INNER JOIN `tbl_thread` t
                ON p.fk_thread_id = t.thread_id
                INNER JOIN `tbl_user` u
                ON p.fk_user_id = u.user_id
                INNER JOIN `tbl_user_lvl` l
                ON u.fk_user_lvl_id = l.user_lvl_id
                WHERE t.thread_id = :thread_id 
                AND p.post_active = 1
                ORDER BY p.post_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':thread_id', $thread_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getTotalAmountUpvotes($user_id) {
        $sql = "SELECT SUM(post_upvotes) as TotalUpvotes FROM tbl_post WHERE fk_user_id = :fk_user_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':fk_user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        if ($result > 100) {
            return 'Master';
        } elseif ($result > 75) {
            return 'Elder';
        } elseif ($result > 50) {
            return 'Veteran';
        } elseif ($result > 25) {
            return 'Member';
        } elseif ($result > 10) {
            return 'Novice';
        } elseif ($result > 5) {
            return 'Beginner';
        } elseif ($result >= 0) {
            return 'Pleb';
        }
    }

//    Counts all posts of a specific categorie
    public function countAllPostsInCategorie($forum_id){
        $sql = "SELECT COUNT(*) 
                FROM `tbl_post` 
                WHERE `fk_thread_id` IN (
                    SELECT `thread_id` 
                    FROM `tbl_thread` 
                    WHERE `fk_forum_id` = :forum_id)
                AND `post_active` = 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':forum_id', $forum_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

//    Gets all posts of a specific categorie, sorted on date. This is used for the last posts.
    public function getAllPostsInCategorie($forum_id){
        $sql = "SELECT * 
                FROM `tbl_post`
                WHERE `fk_thread_id` IN (
                    SELECT `thread_id` 
                    FROM `tbl_thread` 
                    WHERE `fk_forum_id` = :forum_id AND thread_sticky = '0')
                ORDER BY `post_date_created` DESC
                ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':forum_id', $forum_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function upvotePost($post_id, $user_id) {
        $rating = 1;
        $this->insertRating($rating, $post_id, $user_id);
        $sql = "UPDATE `tbl_post` SET post_upvotes = post_upvotes + 1 WHERE post_id = :post_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        if ($stmt->execute()){
            $sql = "SELECT `post_upvotes` FROM tbl_post WHERE post_id = :post_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':post_id', $post_id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $result['post_upvotes'];
        } else {
            die;
        }
    }


    private function insertRating($rating, $fk_post_id, $session_user_id) {
        // Hier tel ik om te kijken of er al een upvote of downvote is.
        $sql = "SELECT COUNT(*) FROM tbl_post_rating
                WHERE fk_post_id = :fk_post_id AND fk_user_id = :session_user_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':fk_post_id', $fk_post_id);
        $stmt->bindParam(':session_user_id', $session_user_id);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        //Als er al een upvote of downvote bestaat dan update hij deze.
        if ($result >= 1) {
            $sql = "UPDATE tbl_post_rating
                    SET rating = :rating
                    WHERE fk_user_id = :session_user_id
                    AND fk_post_id = :fk_post_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':rating', $rating);
            $stmt->bindParam(':fk_post_id', $fk_post_id);
            $stmt->bindParam(':session_user_id', $session_user_id);
            $stmt->execute();

        } else {
            //Als er geen upvote of downvote bestaat dan insert hij deze.
            $sql = "INSERT INTO tbl_post_rating
                (`rating`, `fk_post_id`, `fk_user_id`)
                VALUES (:rating, :fk_post_id, :session_user_id)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':rating', $rating);
            $stmt->bindParam(':fk_post_id', $fk_post_id);
            $stmt->bindParam(':session_user_id', $session_user_id);
            $stmt->execute();
        }
    }

    public function downvotePost($post_id, $user_id) {
        $rating = -1;
        $this->insertRating($rating, $post_id, $user_id);
        //Er word in de querry gecontrolleerd of de post niet onder 0 komt. Als dit wel het geval is
        //dan kan je niet downvoten alleen upvoten.
        $sql = "UPDATE `tbl_post` SET post_upvotes = 
                CASE 
                  WHEN post_upvotes <= '0' THEN 0
                  WHEN post_upvotes >= '1' THEN post_upvotes -1
                  ELSE 0
                END
                WHERE post_id = :post_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':post_id', $post_id);
        if ($stmt->execute()){
            $sql = "SELECT `post_upvotes` FROM tbl_post WHERE post_id = :post_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':post_id', $post_id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $result['post_upvotes'];
        } else {
            die;
        }
    }

    public function canRatePost($post_id, $session_user_id)
    {
        if ($session_user_id == null) {
            return 'disabled';
        } else {
            $sql = "SELECT rating FROM tbl_post_rating WHERE fk_post_id = :post_id AND fk_user_id = :session_user_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':post_id', $post_id);
            $stmt->bindParam(':session_user_id', $session_user_id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_COLUMN);
            if ($result == 1 || $result == -1) {
                return 'disabled';
            } elseif ($result == false || $result == 0) {
                $sql = "SELECT fk_user_id FROM tbl_post WHERE post_id = :post_id;";
                $stmt = $this->db->pdo->prepare($sql);
                $stmt->bindParam(':post_id', $post_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_COLUMN);
                if ($result == $session_user_id) {
                    return 'disabled';
                } else {
                    return 'enabled';
                }
            }
        }

    }

    public function getAllStickyPostsInCategorie($forum_id){
        $sql = "SELECT * 
                FROM `tbl_post`
                WHERE `fk_thread_id` IN (
                    SELECT `thread_id` 
                    FROM `tbl_thread` 
                    WHERE `fk_forum_id` = :forum_id AND thread_sticky = '1')
                ORDER BY `post_date_created` DESC
                ";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':forum_id', $forum_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getStickyThreadInfo($forum_id){
        $sql = "SELECT *
                FROM tbl_thread
                WHERE fk_forum_id = :forum_id AND thread_sticky = '1'";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':forum_id', $forum_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function pin($thread_id){
        $sql = "UPDATE `tbl_thread`
                SET thread_sticky = '1'
                WHERE thread_id = :thread_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':thread_id', $thread_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function unpin($thread_id){
        $sql = "UPDATE `tbl_thread`
                SET thread_sticky = '0'
                WHERE thread_id = :thread_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':thread_id', $thread_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
}