<?php
$config['menu'] = array(
    '用户管理' => array(
        '修改密码' => array(
            'id'=>1, 'class'=>'Updatepwd', 'method'=>'index', 'url'=>'index.php/updatepwd'
        ),
        '增加商户' => array(
            'id'=>2, 'class'=>'BusinessUser', 'method'=>'add', 'url'=>'index.php/BusinessUser/add'
        ),
        '查看商户信息' => array(
            'id'=>3, 'class'=>'BusinessUser', 'method'=>'userList', 'url'=>'index.php/BusinessUser/userList',
        ),
     ),
    '订单管理' => array(
        '订单列表' => array(
            'id'=>4, 'class'=>'BusinessUser', 'method'=>'orderList', 'url'=>'index.php/businessUser/orderList'
        ),
        '对账单' => array(
            'id'=>5, 'class'=>'Account', 'method'=>'index', 'url'=>'index.php/Account'
        ),
        '统计报表' => array(
            'id'=>6, 'class'=>'Report', 'method'=>'index', 'url'=>'index.php/Report'
        )
    ),
);