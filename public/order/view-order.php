<!-- copy en paste dit wanneer je een nieuwe pagina maakt! -->

<?php require '../partials/head.php'; ?>

</head>
<body>

<?php include '../partials/header.php';?>

<?php

$order = new Order();

?>

<div class="main-content">

    <div class="container order-container">

       
        <br>
        <h3>Your orders</h3>
        <br>

        <?php  if($order->getOrderFromUser($user->userId) != 'none' && $order->getAllOrders($_GET['userid']) != 'none'): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <?php if($user->userData['fk_user_lvl_id'] == 2): ?>
                    <th>username</th>
                    <?php endif; ?>
                    <th>order date</th>
                    <th>order status</th>
                    <th>Order is paid</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            
                <?php foreach (
                    ($user->userData['fk_user_lvl_id'] != 2
                        ? $order->getOrderFromUser($user->userId)
                        : $order->getAllOrders($_GET['userid']))
                     as $item):  ?>
                <tr>
                    <td><?= $item['order_id'] ?></td>
                    <?php if($user->userData['fk_user_lvl_id'] == 2): ?>
                    <td><?= $order->getUsernameFromOrder($item['order_id']) ?></td>
                    <?php endif; ?>
                    <td><?= $item['create_date'] ?></td>

                    <?php if($user->userData['fk_user_lvl_id'] == 2): ?>
                        <td>
                            <select class="edit-order-status">
                                <option style="background-color: #286090; color: white;" class="selected-option-order"
                                        value="<?= $item['order_status'] ?>"><?= $item['order_status'] ?>
                                </option>
                                <option value="To be send">To be send</option>
                                <option value="Has been send">Has been send</option>
                                <option value="Has arrived">Has arrived</option>
                            </select>
                            <input type="hidden" id="orderId" value="<?= $item['order_id'] ?>">
                        </td>
                        <?php else: ?>
                        <td><?= $item['order_status'] ?></td>
                    <?php endif; ?>
                    <td><?= ($item['paid'] == 0? 'no' : 'yes') ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>public/order/single-order.php?orderid=<?= $item['order_id'] ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
            <?php else:
            ?>

            <h3 style="color: red;">You don't have any orders</h3>
            <br>
            <br>
        <?php endif; ?>
    </div>

</div>
<?php require '../partials/footer.php'?>
<?php require '../partials/foot.php'?>
