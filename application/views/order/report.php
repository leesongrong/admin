<link rel="stylesheet" href="<?php echo base_url(); ?>skin/plugins/datatables/dataTables.bootstrap.css">
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
          
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <form action="report" name="form" method="post">
                <div class="box-body">
                  <div class="row">
                    <!--div class="col-xs-2">
                      <input type="text" name="order_no" class="form-control" placeholder="订单号">
                    </div-->
                    <div class="col-xs-2">
                        <select  name="agent" class="form-control select2" style="width: 100%;" id="cp" onchange="getGame()">
                          <option selected="selected" value="0">所有厂商</option>
                          <?php if(count($agents)>0){
                              foreach($agents as $agent){ ?>
                              <option value="<?php echo isset($agent['id'])?$agent['id']:''; ?>"><?php echo isset($agent['cpname'])?$agent['cpname']:''; ?></option>
                          <?php }} ?>
                        </select>
                    </div>
                    <div class="col-xs-2">
                        <select name="game" class="form-control select2" style="width: 100%;" id="game">
                          <option selected="selected" value="0">所有游戏</option>

                        </select>
                    </div>
                    <div class="col-xs-2">
                        <select name="channel" class="form-control select2" style="width: 100%;">
                          <option selected="selected" value="0">所有渠道</option>
                          <?php if(count($channels)>0){
                              foreach($channels as $channel){ ?>
                              <option value="<?php echo isset($channel['id'])?$channel['id']:''; ?>"><?php echo isset($channel['name'])?$channel['name']:''; ?></option>
                          <?php }} ?>
                        </select>
                    </div>
                      
                  <div class="col-xs-2">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="date_time" class="form-control pull-right" id="reservation">
                    </div>
                  </div>
                      <button type="submit" name="search" value="search" class="btn btn-default" id="sendEmail">搜索<i class="fa fa-arrow-circle-right"></i></button>
                  </div>
                </div>
                </form>
            </div>

            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>日期</th>
                  <th>交易金额</th>
                  <th>交易订单数</th>
                  <th>退款金额</th>
                  <th>退款订单数</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(isset($data)){ foreach($data as $row){ ?>
                <tr>
                  <td><?php echo isset($row['date'])?$row['date']:''; ?></td>
                  <td><?php echo isset($row['money_trade'])?$row['money_trade']:''; ?></td>
                  <td><?php echo isset($row['order_trade'])?$row['order_trade']:''; ?></td>
                  <td><?php echo isset($row['money_refund'])?$row['money_refund']:''; ?></td>
                  <td><?php echo isset($row['order_refund'])?$row['order_refund']:''; ?></td>
                </tr>
                    <?php }}?>
                </tbody>
                
              </table>
            </div>
          </div>
        </div>
          
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border"><h3 class="box-title">折线图</h3></div>
                <div class="box-body chart-responsive">
                    <div id="container" style="width: auto; height: 300px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
          
          
          
      </div>
    </section>
  </div>
  
<script src="<?php echo base_url(); ?>skin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>skin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>skin/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<script src="<?php echo base_url(); ?>skin/plugins/highcharts/highcharts.js"></script>
<script type="text/javascript">
     //根据厂商ID获取游戏列表
     function getGame()
     {
        var cp_id = $("#cp").val();
        $.ajax({
            method: "POST",
            url: "account/getGame", //请求account类的getGame方法
            data: { id:cp_id}
        })
        .done(function( msg ) {
          msg = jQuery.parseJSON(msg);
          var str = "<option selected='selected' value='0'>所有游戏</option>";
          if(msg.length > 0){
            for(var i=0;i<msg.length;i++){
              str += "<option value='"+msg[i].id+"'>"+msg[i].name+"</option>";
            }

            $("#game").html(str);
          }
        });
     }   

    //时间控件
    $('#reservation').daterangepicker({
         format : 'yyyy-mm-dd',
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
    });


   //图表控件
   var title = {
      text: '统计报表'   
   };
   var subtitle = {
      text: '订单统计'
   };
   var xAxis = {
      categories: <?php echo !empty($json['date_layout'])?$json['date_layout']:'[]'; ?>
   };
   var yAxis = {
      title: {
         text: '数量(/条)'
      },
      plotLines: [{
         value: 0,
         width: 1,
         color: '#808080'
      }]
   };   

   var tooltip = {
      valueSuffix: '条'
   };

   var legend = {
      layout: 'vertical',
      align: 'right',
      verticalAlign: 'middle',
      borderWidth: 0
   };

   var series =  [
      {
         name: '交易金额',
         data: <?php echo !empty($json['money_trade'])?$json['money_trade']:'[]'; ?>
      }, 
      {
         name: '交易订单数',
         data: <?php echo !empty($json['order_trade'])?$json['order_trade']:'[]'; ?>
      },
      {
         name: '退款金额',
         data: <?php echo !empty($json['money_refund'])?$json['money_refund']:'[]'; ?>
      },
      {
         name: '退款订单数',
         data: <?php echo !empty($json['order_refund'])?$json['order_refund']:'[]'; ?>
      }
   ];

   var json = {};

   json.title = title;
   json.subtitle = subtitle;
   json.xAxis = xAxis;
   json.yAxis = yAxis;
   json.tooltip = tooltip;
   json.legend = legend;
   json.series = series;

   $('#container').highcharts(json);
      
</script>


