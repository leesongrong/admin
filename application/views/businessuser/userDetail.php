
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

              <h3 class="box-title">商户详细信息</h3>

            </div>
            <div class="box-body" style="font-size:1.3em;">
              <!-- start-->
               <div class="row" >
                <div class="col-md-2">厂商名称：</div>
                <div class="col-md-4"><?php echo !empty($data['cpname'])?$data['cpname']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">当前状态：</div>
                <div class="col-md-4"><?php echo !empty($data['status'])?$data['status']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">开启状态：</div>
                <div class="col-md-4"><?php echo !empty($data['open'])?$data['open']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">商户类型：</div>
                <div class="col-md-4"><?php echo !empty($data['cptype'])?$data['cptype']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">类别：</div>
                <div class="col-md-4"><?php echo !empty($data['cpunit'])?$data['cpunit']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">行业类型：</div>
                <div class="col-md-4"><?php echo !empty($data['industrytype'])?$data['industrytype']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">国家：</div>
                <div class="col-md-4"><?php echo !empty($data['countrysname'])?$data['countrysname']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">登录账号：</div>
                <div class="col-md-4"><?php echo !empty($data['username'])?$data['username']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">结算银行：</div>
                <div class="col-md-4"><?php echo !empty($data['banktype'])?$data['banktype']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">银行帐号：</div>
                <div class="col-md-4"><?php echo !empty($data['accountid'])?$data['accountid']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">账户类型：</div>
                <div class="col-md-4"><?php echo !empty($data['bankname'])?$data['bankname']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">联行号：</div>
                <div class="col-md-4"><?php echo !empty($data['unionpay'])?$data['unionpay']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">帐户名称：</div>
                <div class="col-md-4"><?php echo !empty($data['accountname'])?$data['accountname']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">公司网址：</div>
                <div class="col-md-4"><?php echo !empty($data['cplink'])?$data['cplink']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">商务联系人：</div>
                <div class="col-md-4"><?php echo !empty($data['ccontact'])?$data['ccontact']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">商务联系人QQ：</div>
                <div class="col-md-4"><?php echo !empty($data['cpQq'])?$data['cpQq']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">商务联系人电话：</div>
                <div class="col-md-4"><?php echo !empty($data['ccall'])?$data['ccall']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">客服联系人：</div>
                <div class="col-md-4"><?php echo !empty($data['ssontact'])?$data['ssontact']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">客服联系人QQ：</div>
                <div class="col-md-4"><?php echo !empty($data['serviceQq'])?$data['serviceQq']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">客服联系人电话：</div>
                <div class="col-md-4"><?php echo !empty($data['scall'])?$data['scall']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">结算联系人：</div>
                <div class="col-md-4"><?php echo !empty($data['tcontact'])?$data['tcontact']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">结算联系人QQ：</div>
                <div class="col-md-4"><?php echo !empty($data['technicQq'])?$data['technicQq']:""; ?></div>
               </div>
               <div class="row">
                <div class="col-md-2">结算联系人电话：</div>
                <div class="col-md-4"><?php echo !empty($data['tcall'])?$data['tcall']:""; ?></div>
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

 