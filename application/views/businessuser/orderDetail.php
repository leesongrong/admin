
<link rel="stylesheet" href="<?php echo base_url(); ?>skin/plugins/datatables/dataTables.bootstrap.css">


<!-- 页面主页 -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">订单详细信息</h3>

            </div>
            <div class="box-body" style="font-size:1.3em;">
              <!-- start-->
               <div class="row" >
                <div class="col-md-2">交易码：</div>
                <div class="col-md-4"><?php echo !empty($data['transactionNo'])?$data['transactionNo']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">商户订单id：</div>
                <div class="col-md-4"><?php echo !empty($data['cporderid'])?$data['cporderid']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">商户名：</div>
                <div class="col-md-4"><?php echo !empty($data['firm_name'])?$data['firm_name']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">商户游戏：</div>
                <div class="col-md-4"><?php echo !empty($data['game_name'])?$data['game_name']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">渠道订单号：</div>
                <div class="col-md-4"><?php echo !empty($data['tradeno'])?$data['tradeno']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">支付渠道：</div>
                <div class="col-md-4"><?php echo !empty($data['paytype'])?$data['paytype']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">支付状态：</div>
                <div class="col-md-4"><?php echo !empty($data['pay_state'])?$data['pay_state']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">商户通知状态：</div>
                <div class="col-md-4"><?php echo !empty($data['cp_state'])?$data['cp_state']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">订单金额：</div>
                <div class="col-md-4"><?php echo !empty($data['money'])?$data['money']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">实际支付金额：</div>
                <div class="col-md-4"><?php echo !empty($data['fact_money'])?$data['fact_money']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">发起时间：</div>
                <div class="col-md-4"><?php echo !empty($data['insert_time'])?$data['insert_time']:""; ?></div>
               </div>
              
                <div class="row">
                  <div class="col-md-2"></div>
                <div class="col-md-8 col-md-offset-5"><button type="button" onclick="window.history.go(-1)" class="btn btn-default">返回上一页</button></div>
              
              </div> 
              <!-- end -->
            </div>

          </div>
         
        </section>
        
        
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <script src="<?php echo base_url(); ?>skin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>skin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>skin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script type="text/javascript">
 
  </script>

 