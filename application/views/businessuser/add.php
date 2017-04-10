
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">  
    <div class="modal-dialog" role="document">  
        <div class="modal-content">  
            <div class="modal-header">  
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">  
                    <span aria-hidden="true">×</span>  
                </button>  
                <h4 class="modal-title" id="myModalLabel">添加信息</h4>  
            </div>  
            <div class="modal-body">  
                <p id="add_con"></p>  
            </div>  
           
        </div>  
    </div>  
</div> 


<!-- 页面主页 -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
            <div class="col-md-12">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">添加商户</h3>

                     
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" >
                   
                     <div class="form-group" style="width:30%;">
                    <span>输入商户名称：</span>
                  <input type="text" class="form-control" id="name" >
                </div>
                <div class="form-group" style="width:30%;">
                    <span>输入商户帐号：</span>
                  <input type="text" class="form-control" id="account" >
                </div>

                <?php
                    if(!empty($channelrate)){
                      foreach($channelrate as $key => $val){
                 ?>
                
                <div class="form-group" style="width:30%;">
                    <span><?php echo $val['channel_name']."的费率" ?>：</span>
                  <input type="text" class="form-control" id="charge_<?php echo $key; ?>" value="<?php echo $val['recharge']; ?>">
                </div>
                <?php 
                      }
                     }

                 ?>

                 <!--            <div class="box-footer clearfix">
                    <button type="submit" class="pull-right btn btn-default" id="sendEmail" onclick="sub()">提交<i class="fa fa-arrow-circle-right"></i></button>
                </div>-->
                <div class="col-md-4 col-md-offset-0" ><button type="button" onclick="sub()" class="btn btn-default" style="margin-left:80%;">提交</button></div>
                    
                    </div>
                  </div>
          </div>
        
      </div>
    </section>

  </div>
  <script type="text/javascript">
  var channel_id = <?php echo $channel_id; ?>;

 
  function sub(){
    var name = $("#name").val();
    var account = $("#account").val();
    var pwd = $("#pwd").val();
    var channel = "";
    if(channel_id.length > 0){
      for(var i=0;i<channel_id.length;i++){
           if($("#charge_"+channel_id[i]).val() == ''){
            $("#add_con").html("请填写好渠道信息"); 
            $('#myModal').modal('show');
            return;
           }
           channel += channel_id[i];
           channel += "=";
           channel += $("#charge_"+channel_id[i]).val();
           channel += "&";
      }
    }
    channel = channel.substr(0,channel.length-1);
    
   
    $.ajax({
    method: "POST",
    url: "updateUser",
    data: { name:name, account:account,pwd:pwd,channel:channel }
    })
    .done(function( msg ) {
      msg = jQuery.parseJSON(msg);
    
     $("#add_con").html(msg.msg); 
     $('#myModal').modal('show');
    });
  }

  </script>
 