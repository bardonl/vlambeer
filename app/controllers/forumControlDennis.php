<?php require_once realpath(__DIR__ . '/../init.php');?>
<?php
/**
 * Created by PhpStorm.
 * User: Duck
 * Date: 19/01/2017
 * Time: 09:21
 */



if ( $_SERVER['REQUEST_METHOD'] == 'POST'); {

    if($_POST['type'] == 'create_thread'){
        $title = $_POST['title'];
        $message = $_POST['message'];

        if(empty($title) || empty($message)){
            $user->redirect('forum/forum-new-thread.php');
        }
        $forum_id = $_POST['forum_id'];
        $id = $user->userId;

        $lastId = $forumDennis->createThreadTitle($title,$id, $forum_id);
        $forumDennis->createThreadPost($message,$id, $lastId);
        $user->redirect('forum/forum-thread.php?id=' . $forum_id);
    }

    if($_POST['type'] == 'create_post');{
        $message = $_POST['post_message'];
        $thread_id = $_POST['thread_id'];
        $user_id = $_POST['user_id'];
        if (empty($message)) {
            $user->redirect('forum/forum-post.php?id=' . $thread_id);
        } else {
            $forumDennis->createPost($message, $thread_id, $user_id);
            $user->redirect('forum/forum-post.php?id=' . $thread_id);
        }
    }
}