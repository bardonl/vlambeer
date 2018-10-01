<?php require '../partials/head.php'; ?>
<?php
    $id = $_GET['id'];

    $threadInfo = $forum->getThreadInfo($id);
    $stickyThreadInfo = $forum->getStickyThreadInfo($id);
    $isModerator = $user->isMod;

    //Checks if user is permitted to delete a post.
    $userId = $user->userData['user_id'];
    $permittedForumInfos = $forum->getPermittedForumId($userId);

    $permitted = false;

    if($user->checkAdmin()){
        $permitted = true;
    }

    foreach($permittedForumInfos as $info){
        if($info == $id){
            $permitted = true;
        }
    }
    //End the check
?>
<?php include '../partials/header.php';?>

<div class="forum-thread-container">
    <div class="row flex jc-c">
        <h1>Nuclear <span class="red">Throne</span></h1>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <table class="table forum table-striped">
                <thead>
                <tr>
                    <th class="cell-stat"></th>
                    <th>
                        <h3>Vlambeer Games</h3>
                    </th>
                    <th class="cell-stat text-center hidden-xs hidden-sm">Posts</th>
                    <th class="cell-stat-2x hidden-xs hidden-sm">Last Post</th>
                    <?php if ($isModerator == true): ?>
                    <th class="cell-stat hidden-xs hidden-sm">Pin/Unpin</th>
                    <?php endif; ?>
                    <a href="forum-new-thread.php?id=<?= $id ?>" class="pull-right btn btn-success btn-new-thread" id="btn-new-thread"><span class="fa fa-plus"></span> New Thread</a>
                </tr>
                </thead>
                <tbody class="threadstest">

                <?php foreach($stickyThreadInfo as $stickyInfo):
                    $forumId = $id;
//                    Counts all posts
                    $posts = count($forum->getAllPostData($stickyInfo['thread_id']));

                    $allPosts = $forum->getAllStickyPostsInCategorie($forumId);
                    $lastPostDate = $allPosts['post_date_created'];

//                    Sets the date to d-m-Y
                    if(isset($lastPostDate)){
                        $lastPostDate = date('d-m-Y', strtotime($lastPostDate));
                    }

                    $lastPostUID = $allPosts['fk_user_id'];
                    $userData = $user->getUserDataById($lastPostUID);
                    ?>
                    <tr>
                        <td class="text-center"><i class="fa fa-comment fa-2x"></i></td>
                        <td>
                            <h4><a class="red" href="forum-post.php"><?= $stickyInfo['thread_subject']; ?></a><img src=" <?= BASE_URL; ?>/public/img/pin.png" style="height: 20px; width: 20px;"></h4>
                        </td>
                        <td class="text-center hidden-xs hidden-sm"><a href="#"><?= $posts; ?></a></td>
                        <td class="hidden-xs hidden-sm">by <a href="#"><?= $userData['username']; ?></a><br><small><i class="fa fa-clock-o"></i><?= $lastPostDate ?></small></td>
                        <?php if ($isModerator == true): ?>
                        <td class="text-center hidden-sm"><button data-user-id="<?= $userData['user_id'] ?>" data-pinned-thread-id="<?= $stickyInfo['thread_id'] ?>" id="unpin" class="unpin btn btn-default"><img src=" <?= BASE_URL; ?>/public/img/pin.png" style="height: 20px; width: 20px;"></button></td>
                        <?php endif; ?>
                        <?php if($permitted): ?>
                            <td class="hidden-xs hidden-sm"><a href="" class="btn btn-warning">Delete</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                
                <?php foreach($threadInfo as $info):
                    $forumId = $id;
//                    Counts all posts
                    $posts = count($forum->getAllPostData($info['thread_id']));

                    $allPosts = $forum->getAllPostsInCategorie($forumId);
                    $lastPostDate = $allPosts['post_date_created'];

//                    Sets the date to d-m-Y
                    if(isset($lastPostDate)){
                        $lastPostDate = date('d-m-Y', strtotime($lastPostDate));
                    }

                    $lastPostUID = $allPosts['fk_user_id'];
                    $userData = $user->getUserDataById($lastPostUID);
                    ?>
                    <tr>
                        <td class="text-center"><i class="fa fa-comment fa-2x"></i></td>
                        <td>
                            <h4><a href="forum-post.php?id=<?= $info['thread_id'] ?>"><?= $info['thread_subject']; ?></a></h4>
                        </td>
                        <td class="text-center hidden-xs hidden-sm"><a href="#"><?= $posts; ?></a></td>
                        <td class="hidden-xs hidden-sm">by <a href="#"><?= $userData['username']; ?></a><br><small><i class="fa fa-clock-o"></i><?= $lastPostDate ?></small></td>
                        <?php if ($isModerator == true): ?>
                        <td class="text-center hidden-sm"><button data-user-id="<?= $userData['user_id'] ?>" data-unpinned-thread-id="<?= $info['thread_id']?>" id="pin" class="pin btn btn-default"><img src=" <?= BASE_URL; ?>/public/img/pin.png" style="height: 20px; width: 20px;"></button></td>
                        <?php endif; ?>
                        <?php if($permitted): ?>
                        <td class="hidden-xs hidden-sm">
                            <a href="http://valmbeer.badge-webdevelopment.nl/app/controllers/forumControl.php?forum_id=' <?= $id . '&thread_id=' . $info['thread_id']; ?>" class="btn btn-warning">Delete</a>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>
<script src="../js/stickyposts.js">
</script>
