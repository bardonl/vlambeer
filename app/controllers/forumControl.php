<?php require_once realpath(__DIR__ . '/../init.php');
/**
 * Created by PhpStorm.
 * User: Duck
 * Date: 09/01/2017
 * Time: 10:47
 */

$forum = new Forum();


if($_SERVER['REQUEST_METHOD'] == 'GET'){
//    Delete selected post
    if(isset($_GET['post_id'])){
        $target = 'posts';
        $postId = $_GET['post_id'];

        $forum->setInactive($target, $postId);
        $user->redirect('forum/forum-post.php');
    }

    if(isset($_GET['thread_id'])){
        $target = 'threads';
        $threadId = $_GET['thread_id'];
        $forumId = $_GET['forum_id'];
        $forum->setInactive($target, $threadId);
        $user->redirect('forum/forum-thread.php?id=' . $forumId);
    }
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['userid'] == null) {
        header('HTTP/1.1 404');
        echo 'notloggedin';

    } else {
        //Is het zijn eigen post?
        if ($_POST['userid'] == $_POST['sessionuserid']) {
            header('HTTP/1.1 404');
            echo 'ownpost';

        } else {

            if (isset($_POST['upvoteid'])) {
                $rating = $forum->canRatePost($_POST['upvoteid'], $_POST['sessionuserid']);
                if ($rating == 'disabled') {
                    echo 'alreadyvoted';
                    header('HTTP/1.1 404');
                } else {
                    $forum->upvotePost($_POST['upvoteid'], $_POST['sessionuserid']);
                }
            }

            if (isset($_POST['downvoteid'])) {
                $rating = $forum->canRatePost($_POST['downvoteid'], $_POST['sessionuserid']);
                if ($rating == 'disabled') {
                    header('HTTP/1.1 404');
                    echo 'alreadyvoted';
                } else {
                    $forum->downvotePost($_POST['downvoteid'], $_POST['sessionuserid']);
                }
            }
        }

    if (isset ($_POST['unpinnedThreadId'])) {
        $forum->pin($_POST['unpinnedThreadId']);
    }

    if (isset ($_POST['pinnedThreadId'])) {
        $forum->unpin($_POST['pinnedThreadId']);
    }

    
//        if($_POST['type'] == 'create_thread'){
//                $title = $_POST['title'];
//                $message = $_POST['message'];
//
//                if(empty($title) || empty($message)){
//                        $user->redirect('forum/forum-new-thread.php');
//                }
//                $id = $user->userId;
//                var_dump($_POST);
//
//
//                $forumDennis->createThreadPost($message,$id);
//                $forumDennis->createThreadTitle($title,$id);
//
//        }
    }
}
