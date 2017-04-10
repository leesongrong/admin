
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

              <h3 class="box-title">商户列表</h3>

            </div>
            <div class="box-body">
              <!-- start-->
            
<table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>商户id</th>
                  <th>商户名称</th>
                  <th>开启状态</th>
                  <th>当前状态</th>
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
 
  init();
  function init(){
   
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
               url:"getUserList"

          },
         
      
      "language": {
                  lengthMenu: '<select class="form-control input-xsmall">' + '<option value="5">5</option>' + '<option value="10">10</option>' + '<option value="20">20</option>' + '<option value="30">30</option>' + '<option value="40">40</option>' + '<option value="50">50</option>' + '</select>条记录',//左上角的分页大小显示。
                    processing: "载入中",//处理页面数据的时候的显示
                    paginate: {//分页的样式文本内容。
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

 