
<?php require '../partials/head.php'; ?>
<?php
    $categories = new ForumDennis();
    $array = $categories->getCategories();
?>
<title>Template</title>
</head>
<body>

<?php include '../partials/header.php';?>
<link rel="stylesheet" href="../css/timkt.css">

<div class="forum-categories-main">
    <div class="container">
        <div class="forum-categories-main-content m0auto mx-auto">
            <div class="row flex jc-c">
                <h1>Categories</h1>
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
                                <th class="cell-stat text-center hidden-xs hidden-sm">Topics</th>
                                <th class="cell-stat text-center hidden-xs hidden-sm">Posts</th>
                                <th class="cell-stat-2x hidden-xs hidden-sm">Last Post</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($array as $record):
                            $forumId = $record['forum_id'];

//                            Counts all topics and posts
                            $topics = count($forum->getThreadInfo($forumId));
                            $posts = $forum->countAllPostsInCategorie($forumId);

//                            Gets last post info
                            $allPosts = $forum->getAllPostsInCategorie($forumId);
                            $lastPostDate = $allPosts['post_date_created'];
//                            Sets the date to d-m-Y
                            if(isset($lastPostDate)){
                                $lastPostDate = date('d-m-Y', strtotime($lastPostDate));
                            }

                            $lastPostUID = $allPosts['fk_user_id'];
                            $userData = $user->getUserDataById($lastPostUID);
                            ?>
                            <tr>
                                <td class="text-center"><i class="fa fa-comment fa-2x"></i></td>
                                <td>
                                    <h4><a href="forum-thread.php?id=<?= $forumId; ?>"><?php echo $record['forum_name']; ?></a><br><small><?php echo $record['forum_description'];?></small></h4>
                                </td>
                                <td class="text-center hidden-xs hidden-sm"><a href="#"><?= $topics; ?></a></td>
                                <td class="text-center hidden-xs hidden-sm"><a href="#"><?= $posts; ?></a></td>
                                <td class="hidden-xs hidden-sm">by <a href="#"><?= $userData['username']; ?></a><br><small><i class="fa fa-clock-o"></i><?= $lastPostDate ?></small></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>
