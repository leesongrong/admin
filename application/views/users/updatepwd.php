
<!-- 页面主页 -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
            <div class="col-md-4">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">修改密码</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      
                      <?php echo validation_errors(); ?>
                        <?php echo form_open('updatepwd/update_password'); ?>
                        <div class="form-group">
                            <span>输入原密码：</span>
                          <input type="password" class="form-control" name="oldpwd" placeholder="原密码">
                        </div>
                        <div class="form-group">
                            <span>输入新密码：</span>
                          <input type="password" class="form-control" name="newpwd" placeholder="新密码">
                        </div>
                        <div class="form-group">
                            <span>再输入新密码：</span>
                          <input type="password" class="form-control" name="newpwdconf" placeholder="新密码">
                        </div>

                            <button type="submit" class="pull-right btn btn-default"  name="submit" value="submit">提交<i class="fa fa-arrow-circle-right"></i></button>

                      </form>
                    </div>
                  </div>
          </div>
        
      </div>
    </section>

  </div>
 