<!-- copy en paste dit wanneer je een nieuwe pagina maakt! -->

<?php require '../partials/head.php'; ?>
<?php $thread_id = $_GET['id']; ?>
<?php include '../partials/header.php';?>

<?php
$threadTitle = $forum->getThreadTitle($thread_id);

//Checks if user is permitted to delete a post.
$forumInfo = $forum->getAllThreadInfo($thread_id);
$currentForumId = $forumInfo['fk_forum_id'];

$userId = $user->userData['user_id'];
$permittedForumInfos = $forum->getPermittedForumId($userId);

$permitted = false;

if($user->checkAdmin()){
    $permitted = true;
}

foreach($permittedForumInfos as $info){
    if($info == $currentForumId){
        $permitted = true;
    }
}
//End the check


?>

<div class="forum-post-main">
    <div class="container">
        <div class="forum-post-main-content m0auto mx-auto">
            <h1 class="page-header"><i class="fa fa-pencil"></i> <?php echo $threadTitle['thread_subject']; ?> <a class="btn btn-default" href="forum-categories.php"><i class="fa fa-backward"></i> Back to topics</a></h1>
            <ul class="media-list forum">
                <!-- Forum Post -->

                <?php
                $getPosts = $forum->getAllPostData($thread_id);
                $userData = $user->userData;
                foreach ($getPosts as $post) {
                    $user_id = $post['user_id'];
                    $post_id = $post['post_id'];
                    $fk_user_id = $post['fk_user_id'];
                    $getTotalUpvotes = $forum->getTotalAmountUpvotes($user_id);
                    $hasVoted = $forum->canRatePost($post_id, $user->userId);
                    echo '<br> session userid: ' . $user->userId . '</br>';
                    echo '<br> userid van de post: ' . $user_id . '</br>';
                    echo '<br> postid: ' . $post_id . '</br>';
                    echo '<br> Resultaat van functie hasvoted: ' . $hasVoted . '</br>';
                    ?>
                    <li class="media well">
                        <div class="pull-left user-info" href="#">
                            <div class="forum-user">
                                <img class="avatar img-circle img-thumbnail"
                                     src="<?php echo $post['profile_picture_path'] ?>"
                                     width="64" height="64" alt="Generic placeholder image">
                                <a href="http://valmbeer.badge-webdevelopment.nl/public/profile/profile.php?username=<?php echo $post['username']?>"><?php echo $post['username'] ?></a>
                            </div>
                            <div class="forum-rank">
                                <p> <?php echo $getTotalUpvotes; ?></p>
                            </div>
                            <small class="btn-group btn-group-xs vote">
                                <button <?php echo $hasVoted ?> data-session-user-id="<?php echo $user->userId ?>" data-user-id="<?php echo $post['user_id'] ?>" data-post-id="<?php echo $post['post_id']?>" class="upvote btn btn-default"><i class="fa fa-thumbs-o-up"></i></button>
                                <button <?php echo $hasVoted ?> data-session-user-id="<?php echo $user->userId ?>" data-user-id="<?php echo $post['user_id'] ?>" data-post-id="<?php echo $post['post_id']?>" class="downvote btn btn-default"><i class="fa fa-thumbs-o-down"></i></button>
                                <strong data-post-rating="<?php echo $post['post_upvotes'] ?>" id="count" class="btn btn-success count"> <?php echo $post['post_upvotes'] ?> </strong>
                            </small>
                        </div>
                        <div class="media-body">
                            <!-- Post Info Buttons -->
                            <div class="forum-post-panel btn-group btn-group-xs">
                                <a href="#" class="btn btn-default"><i class="fa fa-clock-o"></i> <?php echo $post['post_date_created'] ?></a>
                                <?php if($permitted): ?>
                                <a href="http://valmbeer.badge-webdevelopment.n/app/controllers/forumControl.php?post_id= <?= $post['post_id']; ?>"
                                   class="btn btn-warning post-delete">Delete post</a>
                                <?php endif; ?>
                            </div>
                            <!-- Post Info Buttons END -->
                            <!-- Post Text -->
                            <?php
                                echo '<p>' . $post['post_message'] . '</p>';
                            ?>
                            <!-- Post Text EMD -->
                        </div>
                    </li>
                    <?php
                }
                ?>
                <!-- Forum Post END -->
                <?php if($user->loggedIn == true): ?>
                <div class='forum-post-input'>
                    <li>
                        <form action="../../app/controllers/forumControlDennis.php" method="POST">
                            <input type="hidden" id="thread_id" name="thread_id" value="<?=$_GET['id']; ?>">
                            <input type="hidden" id="user_id" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                            <textarea name="post_message" id="post_message" class="forum-post-input col-md-12"></textarea>
                            <button class=" btn btn-primary pull-right" id="create_post"><span class="glyphicon glyphicon-share-alt"></span> Reply</button>
                        </form>
                    </li>
                </div>
                <?php endif; ?>
                <!-- Forum Post END -->
            </ul>
        </div>

    </div>
</div>

<script>

$(document).ready(function () {

    $(".upvote").click(function(e) {
        e.preventDefault();
        var update = $(this).parent().find('#count');
        var upvote = $(this).closest('.upvote');
        var downvote = $(this).parent().find('.downvote');
        var upvoteid = $(this).data('post-id');
        var userid = $(this).data('user-id');
        var sessionuserid = $(this).data('session-user-id');
        $.ajax({
            type    : 'POST',
            url     : '../../app/controllers/forumControl.php',
            data    : {
                'upvoteid' : upvoteid,
                'userid' : userid,
                'sessionuserid' : sessionuserid
            },
            success  : function (data) {
                update.html(data);
                console.log(data);
                upvote.attr("disabled", true);
                downvote.attr("disabled", true);
            },
            error    : function (data) {
                if (data.responseText == 'notloggedin') {
                    upvote.attr("disabled", true);
                    downvote.attr("disabled", true);

                } else if (data.responseText == "alreadyvoted"){
                    upvote.attr("disabled", true);
                    downvote.attr("disabled", true);

                } else if (data.responseText == 'ownpost'){
                    upvote.attr("disabled", true);
                    downvote.attr("disabled", true);
                }
            }
        })
    });

    $(".downvote").click(function(e) {
        e.preventDefault();
        var update = $(this).parent().find('#count');
        var downvoteid = $(this).data('post-id');
        var upvote = $(this).closest('.downvote');
        var downvote = $(this).parent().find('.upvote');;
        var userid = $(this).data('user-id');
        var sessionuserid = $(this).data('session-user-id');
        $.ajax({
            type    : 'POST',
            url     : '../../app/controllers/forumControl.php',
            data    : {
                'downvoteid':downvoteid,
                'userid' : userid,
                'sessionuserid' : sessionuserid
            },
            success  : function (data) {
                update.html(data);
                upvote.attr("disabled", true);
                downvote.attr("disabled", true);
            },
            error    : function (data) {
                if (data.responseText == 'notloggedin') {
                    upvote.attr("disabled", true);
                    downvote.attr("disabled", true);

                } else if (data.responseText == "alreadyvoted"){
                    upvote.attr("disabled", true);
                    downvote.attr("disabled", true);

                } else if (data.responseText == 'ownpost'){
                    upvote.attr("disabled", true);
                    downvote.attr("disabled", true);
                }
            }
        })
    });
})


</script>

<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>