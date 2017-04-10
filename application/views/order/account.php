<link rel="stylesheet" href="<?php echo base_url(); ?>skin/plugins/datatables/dataTables.bootstrap.css">
<div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <form action="account" name="form" method="post">
                <div class="box-body">
                  <div class="row">
                    <!--div class="col-xs-2">
                      <input type="text" class="form-control" name="order_no" placeholder="订单号">
                    </div-->
                    <div class="col-xs-2">
                        <select name="agent" class="form-control select2" style="width: 100%;" id="cp" onchange="getGame()">
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
                      <button type="submit" name="search"  value="search" class="btn btn-default" id="sendEmail">搜索<i class="fa fa-arrow-circle-right"></i></button>
                  </div>
                </div>
                </form>
            </div>

            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>日期</th>
                  <th>代理商分润</th>
                  <th>商户分润</th>
                  <th>交易额</th>
                </tr>
                </thead>
                <tbody>
                    
                    <?php if(isset($data)){ foreach($data as $row){ ?>
                <tr>
                  <td><?php echo isset($row['date'])?$row['date']:''; ?></td>
                  <td><?php echo isset($row['money_agent'])?$row['money_agent']:''; ?></td>
                  <td><?php echo isset($row['money_firm'])?$row['money_firm']:''; ?></td>
                  <td><?php echo isset($row['money_trade'])?$row['money_trade']:''; ?></td>
                </tr>
                    <?php }}?>
                
                </tbody>
                
              </table>
                <?php //echo $this->pagination->create_links();?>
            </div>
          </div>
        </div>
          
      </div>
    </section>
  </div>
  
  <script src="<?php echo base_url(); ?>skin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>skin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>skin/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<script type="text/javascript">
     //根据厂商ID获取游戏列表
     function getGame()
     {
        var cp_id = $("#cp").val();
        $.ajax({
            method: "POST",
            url: "account/getGame",
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

  </script>

 