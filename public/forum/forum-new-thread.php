<?php
/**
 * Created by PhpStorm.
 * User: Duck
 * Date: 23/12/2016
 * Time: 11:13
 */
?>
<?php require '../partials/head.php'; ?>
<?php $id = $_GET['id']; ?>
<?php include '../partials/header.php';?>

<div class="new-thread-title flex jc-c">
    <h3><span class="red">New</span> Thread</h3>
</div>
<form action="../../app/controllers/forumControlDennis.php" method="post">
<div class="new-thread">
    <div class="form-group flex jc-c">
        <div class="col-sm-6 forum-group">
            <label for="thread_subject" class="col-sm-0 control-label">Title</label>
            <input type="text" class="form-control" name="title">
        </div>
    </div>
    <div class="form-group flex jc-c">
        <div class="col-sm-6 forum-group">
            <label for="thread_message" class="col-sm-0 control-label">Message</label>
            <textarea class="form-control" rows="4" name="message"></textarea>
        </div>
    </div>
    <label class="sr-only" for="id"></label>
    <input type="hidden" id="id" name="forum_id" value="<?= $id; ?>">
    <div class="btn-new-thread-wrapper">
        <div class="btn-new-thread">
            <button type="submit" name="type" id="addCustomer" class="pull-right btn btn-success btn-new-thread" id="btn-new-thread" value="create_thread"><span class="fa fa-plus"></span> Add Thread</button>
        </div>
    </div>
</div>
</form>



<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>

