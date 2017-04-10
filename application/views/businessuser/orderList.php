
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

              <h3 class="box-title">订单列表</h3>

            </div>

            <div class="box-body">
              <!-- start-->
              <div class="row">
                    <div class="col-xs-2">
                        <select class="form-control select2" style="width: 100%;" id="cp" onchange="cpname()">
                          <option selected="selected" value="0">选择厂商</option>
                        <?php 
                           if(!empty($cpname)){
                            foreach($cpname as $v){

                         ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['cpname'] ?></option>
                        <?php
                            } 
                           }
                         ?>
                        </select>
                    </div>
                    <div class="col-xs-2">
                        <select class="form-control select2" style="width: 100%;" id="game">
                          <option selected='selected' value='0'>选择游戏</option>
                         
                         
                          
                        </select>
                    </div>
                    <div class="col-xs-2">
                        <select class="form-control select2" style="width: 100%;" id="channel">
                          <option selected="selected" value="0">选择渠道</option>
                          <?php 
                           if(!empty($channel)){
                            foreach($channel as $val){

                         ?>
                          <option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
                        <?php
                            } 
                           }
                         ?>
                        </select>
                    </div>
                      
                  <div class="col-xs-2">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" value="<?php echo $times; ?>">
                    </div>
                  </div>
                  
                  <div class="col-xs-2">
                    <div class="form-group">
                  <input type="text" class="form-control" id="orderid" placeholder="输入订单号">
                </div>

                  </div>    
                      <button type="submit" onclick="search()" class="btn btn-default" id="sendEmail">搜索<i class="fa fa-arrow-circle-right" ></i></button>
                  </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>订单Id</th>
                  <th>订单码</th>
                  <th>订单金额</th>
                  <th>订单实际支付金额</th>
                  <th>下单时间</th>
                  <th>支付状态</th>
                  <th>操作</th>
                </tr>
                </thead>
            
              
              </table>

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
 function search(){
  $("#example1").DataTable().draw();
 }

 function cpname(){
   var cp = $("#cp").val();
   getGame(cp);
 }

 //根据cp_id查游戏
 function getGame(cp_id){
    $.ajax({
    method: "POST",
    url: "getGame",
    data: { id:cp_id}
    })
    .done(function( msg ) {
      msg = jQuery.parseJSON(msg);
      var str = "<option selected='selected' value='0'>选择游戏</option>";
      if(msg.length > 0){
        for(var i=0;i<msg.length;i++){
          str += "<option value='"+msg[i].id+"'>"+msg[i].name+"</option>";
        }
     
        $("#game").html(str);
      }
     
      
    });
 }
 
  init();
  function init(){
     //alert(12);
     /*
     $('#reservation').daterangepicker(
      {
         
         separator : ' to ',
         opens : 'right', //日期选择框的弹出位置
         locale : {
          applyLabel : '确定',  
          cancelLabel : '取消',
          fromLabel : '起始时间',  
          toLabel : '结束时间',
          customRangeLabel : '自定义',
          daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
          monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月'],
          firstDay : 1    
          },
        
      

      }
      );
      */
    $('#datepicker').datepicker({
      autoclose: true
    
    });
      $('#example1').DataTable({
          "serverSide": true,
          "processing": true,
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": true,
          "autoWidth": false,
          "pageLength": 10,
         
         "ajax":{
               type:"post",
               url:"userdata",
               dataSrc: "data",//默认data，也可以写其他的，格式化table的时候取里面的数据
               data: function (d) {//d 是原始的发送给服务器的数据，默认很长。
                        var cp = $("#cp").val();
                        var game = $("#game").val();
                        var channel = $("#channel").val();
                        var datepicker = $("#datepicker").val();
                        var orderid = $("#orderid").val();
                        var param = {};//因为服务端排序，可以新建一个参数对象
                        param.start = d.start;//开始的序号
                        param.length = d.length;//要取的数据的
                        param.draw = d.draw;
                        param.cp = cp;
                        param.game = game;
                        param.channel = channel;
                        param.datepicker = datepicker;
                        param.orderid = orderid;
                       
                        //param.times = '2013';
                      //  var formData = $("#filter_form").serializeArray();//把form里面的数据序列化成数组
                      //  formData.forEach(function (e) {
                       //     param[e.name] = e.value;
                       // });
                        return param;//自定义需要传递的参数。
                    },
          },      
          
          "language": {
                      lengthMenu: '<select class="form-control input-xsmall">' + '<option value="5">5</option>' + '<option value="10">10</option>' + '<option value="20">20</option>' + '<option value="30">30</option>' + '<option value="40">40</option>' + '<option value="50">50</option>' + '</select>条记录',//左上角的分页大小显示。
                        processing: "载入中",//处理页面数据的时候的显示
                        //分页的样式文本内容。
                        paginate: {
                            previous: "上一页",
                            next: "下一页",
                            first: "第一页",
                            last: "最后一页"
                        },

                        zeroRecords: "没有内容",//table tbody内容为空时，tbody的内容。
                        //下面三者构成了总体的左下角的内容。
                        info: "总共_PAGES_ 页，显示第_START_ 到第 _END_ ，筛选之后得到 _TOTAL_ 条，初始_MAX_ 条 ",//左下角的信息显示，大写的词为关键字。
                        infoEmpty: "0条记录",//筛选为空时左下角的显示。
                        infoFiltered: ""//筛选之后的左下角筛选提示(另一个是分页信息显示，在上面的info中已经设置，所以可以不显示)，
                    }
        });
  }

  </script>

 