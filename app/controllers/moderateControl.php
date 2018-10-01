<?php require_once  realpath(__DIR__ . '/../init.php');

$moderator = New Moderator();
$forum = new ForumDennis();

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if($_POST['moderate'] == 'editPermission') {
        $moderator->changeRank($_POST['userid'], $_POST['rankid']);
    }
    
    if($_POST['moderate'] == 'checkNewsletter') {
        echo 'hiii';
        $moderator->checkNewsletter($user->userId, $_POST['checked']);
    }
    
    if($_POST['moderate'] == 'banUser') {
        echo $moderator->banUser($_POST['userId']);
    }
    
    if($_POST['moderate'] == 'addForumMod') {
        $moderator->addForumMod($_POST['userId'], $_POST['forumId']);
    }
    
    if($_POST['moderate'] == 'removeForumMod'){
        $moderator->removeForumMod($_POST['userId'], $_POST['forumId']);
    }
    
    if($_POST['moderate'] == 'refreshUsers') {
        $search = $moderator->searchUser($_POST['result']);
        foreach ($search as $searchUser): ?>

            <?php $checkForums = $moderator->getSelectedCategories($searchUser['user_id']);
            ?>
            <div class="row-user">
                <div class="data-user">
                    <input type="hidden" value="<?= $searchUser['user_id'] ?>" class="user-id">
                </div>
                
                <ul class="row-item-wrap">
                    <li class="row-item"><a href="http://valmbeer.badge-webdevelopment.nl/public/profile/profile.php?username= <?= $searchUser['username'] ?>"><?= $searchUser['username'] ?></a></li>
                    <li class="row-item"><?= $searchUser['email'] ?></li>
                    <?php if($user->checkAdmin() == 1): ?>
                    <li class="row-item">
                        
                        <select class="edit-user-lvl">
                            <?php foreach ($moderator->selectAllRoles() as $role): ?>
                                <option <?= ($searchUser['fk_user_lvl_id'] == $role['user_lvl_id']? 'selected':''); ?> value="<?= $role['user_lvl_id'] ?>"><?= $role['user_lvl_desc'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button class="btn show-categories" style="display: none"><i class="fa fa-arrow-down"></i></button>
                        <div class="list-of-threads" style="display: none">
                            <ul>

                                <?php foreach ($forum->getCategories() as $category): ?>
                                    <li><input <?php
                                        if(!empty($checkForums)){
                                            foreach ($checkForums as $forumId):
                                            if ($forumId['fk_forum_id'] == $category['forum_id']) {
                                                echo 'checked';
                                            }endforeach;} ?>

                                            type="checkbox" class="add-perm-mod" value="<?= $category['forum_id'] ?>"><?=  $category['forum_name'] ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                    <?php endif; ?>
                    <li class="row-item">
                        <?php if($user->checkModerator() && $searchUser['fk_user_lvl_id'] == 1): ?>
                        <button class="btn btn-danger ban-user"><?= ($searchUser['is_banned'] == 1 ? 'un-ban' : 'ban') ?></button>
                        <?php endif; ?>
                        <?php if($user->checkAdmin()): ?>
                        <button class="btn btn-danger ban-user"><?= ($searchUser['is_banned'] == 1 ? 'un-ban' : 'ban') ?></button>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        <?php  endforeach;
        
    }
    
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {

}