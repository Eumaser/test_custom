<?php
/*
 * To change this tcountryate, choose Tools | Tcountryates
 * and open the tcountryate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Recordinfo {

    public function Recordinfo(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function fetchMenuDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_menu WHERE menu_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->menu_id = $row['menu_id'];
            $this->menu_table = $row['menu_table'];
            $this->menu_name = $row['menu_name'];
            $this->menu_path = $row['menu_path'];
        }
        return $query;
    }
    public function getRecordInfo(){
    ?>
    <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Record Info Management</title>
    <?php
    include_once 'css.php';
    $this->menuCrtl = $this->select->getMenuSelectCtrl($this->menu_id,'N'," AND menu_parent >0 AND menu_path <> 'recordinfo.php'");
    ?>
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      <!-- include header-->
      <?php include_once 'header.php';?>
      <!-- Full Width Column -->
      <div class="">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Record Info Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                    <form id = 'empl_form' class="form-horizontal" action = 'recordinfo.php' method = "POST">
                        <div class="form-group">
                              <label for="menu_id" class="col-sm-2 control-label">Reference Number Name</label>
                              <div class="col-sm-2">
                                   <select class="form-control" id="menu_id" name="menu_id">
                                       <?php echo $this->menuCrtl;?>
                                   </select>
                              </div>
                              <div class="col-sm-2">
                              <button type="submit" data-loading-text="Loading..." id = 'search_btn' class="btn btn-primary" autocomplete="off">Search</button>
                              </div>
                        </div>
                    </form>
                </div>  
                <div class="box-header">
                  <h3 class="box-title">Record Info Table</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="country_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>No</th>  
                        <th>User Name</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Remark</th>
                        <th>Description</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                     
                     $sql = "SELECT t.*,empl.empl_name 
                            FROM db_info t
                            LEFT JOIN db_empl empl on empl.empl_id = t.insertBy
                            WHERE t.info_table = '$this->menu_table' ORDER BY t.insertDateTime DESC";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php if($row['insertBy'] == '10000'){ echo 'Webmaster';}else{ echo $row['empl_name'];}?></td>
                            <td><?php echo $row['insertDateTime'];?></td>
                            <td><?php echo $row['info_action'];?></td>
                            <td><?php echo $row['info_remark'];?></td>
                            <td><?php echo $row['info_desc'];?></td>
                        </tr>
                    <?php    
                        $i++;
                      }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No</th>     
                        <th>User Name</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Description</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper --><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    ?>
    <script>
      $(function () {
        $('#country_table').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

      });
    </script>
  </body>
</html>
    <?php
    }

}
?>
