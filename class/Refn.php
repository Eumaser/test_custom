<?php
/*
 * To change this trefnate, choose Tools | Trefnates
 * and open the trefnate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Refn {

    public function Refn(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function update(){

        $table_field = array('refn_prefix','refn_suffix','refn_length','refn_value');
        $table_value = array($this->refn_prefix,$this->refn_suffix,$this->refn_length,$this->refn_value);
        $remark = "Update Reference No.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_refn','refn_id',$remark,$this->refn_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchRefnDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT * FROM db_refn WHERE refn_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->refn_id = $row['refn_id'];
            $this->refn_prefix = $row['refn_prefix'];
            $this->refn_suffix = $row['refn_suffix'];
            $this->refn_length = $row['refn_length'];
            $this->refn_value = $row['refn_value'];
            $this->refn_seqno = $row['refn_seqno'];
            $this->refn_status = $row['refn_status'];
        }
        return $query;
    }
    public function getInputForm(){
        global $language,$lang;
      include_once 'class/SelectControl.php';
      $this->select = new SelectControl();
      $this->cprofileCrtl = $this->select->getCprofileSelectCtrl($this->menu_id,'N');
      $this->menuCrtl = $this->select->getMenuSelectCtrl($this->menu_id,'N',' AND menu_isrefno = 1');
    ?>
    <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reference Number Management</title>
    <?php
    include_once 'css.php';
    
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
            <h1>Reference Number Management</h1>

        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                    <form id = 'empl_form' class="form-horizontal" action = 'empl.php?action=create' method = "POST">
                        <div class="form-group">
                              <label for="refn_outl_id" class="col-sm-1 control-label">Company</label>
                              <div class="col-sm-2 ">
                                   <select class="form-control" id="refn_outl_id" name="refn_outl_id">
                                       <?php echo $this->cprofileCrtl;?>
                                   </select>
                              </div>
                              <label for="refn_menu_id" class="col-sm-2 control-label">Reference Number Name</label>
                              <div class="col-sm-2">
                                   <select class="form-control" id="refn_menu_id" name="refn_menu_id">
                                       <?php echo $this->menuCrtl;?>
                                   </select>
                              </div>
                              <div class="col-sm-2">
                              <button type="button" data-loading-text="Loading..." id = 'search_btn' onclick = 'getResult()' class="btn btn-primary" autocomplete="off">Search</button>
                              </div>
                        </div>
                    </form>
                </div>
                <div class="box-body">
                    <form id = 'form1' class="form-horizontal" action = 'empl.php?action=create' method = "POST">
                        <div class="form-group">
                              <label for="refn_outl_id" class="col-sm-1 control-label">Company</label>
                              <div class="col-sm-2 ">
                                <label for="refn_outl_id" class="col-sm-12 control-label-text" id = 'outlet'>-</label>
                              </div>
                              <label for="refn_outl_id" class="col-sm-2 control-label">Reference Name</label>
                              <div class="col-sm-2 ">
                                <label for="refn_outl_id" class="col-sm-12 control-label-text" id = 'referrence_name'>-</label>
                              </div>
                        </div>
                        <div class="form-group">
                              <label for="refn_prefix" class="col-sm-1 control-label">Prefix</label>
                              <div class="col-sm-2 ">
                                <input type="text" class="form-control" id="refn_prefix" name="refn_prefix" value = "<?php echo $this->refn_prefix;?>" >
                              </div>
                              <label for="refn_value" class="col-sm-2 control-label">Reference Value</label>
                              <div class="col-sm-2 ">
                                <input type="text" class="form-control" id="refn_value" name="refn_value" value = "<?php echo $this->refn_value;?>" >
                              </div>
<!--                              <label for="refn_suffix" class="col-sm-2 control-label">Suffix</label>
                              <div class="col-sm-2 ">
                                <input type="text" class="form-control" id="refn_suffix" name="refn_suffix" value = "<?php echo $this->refn_suffix;?>" >
                              </div>-->
                        </div>
                        <div class="form-group">
                              <label for="refn_length" class="col-sm-1 control-label">Length</label>
                              <div class="col-sm-2 ">
                                <input type="text" class="form-control" id="refn_length" name="refn_length" value = "<?php echo $this->refn_length;?>" >
                              </div>

                        </div>
                        <input type = "hidden" value = "0" name = "refn_id" id = "refn_id"/>
                     </form>
                </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    
                    <button type = "button" class="btn btn-info" onclick = 'saveResult()' id = 'savebtn' disabled title = "<?php echo $language['en']['submit'];?>">Submit</button>
                    
                  </div><!-- /.box-footer -->
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

      });
       function getResult(){
          $('#search_btn').button('loading');  
          var data ="action=getResult&refn_outl_id="+$('#refn_outl_id').val()+"&refn_menu_id="+$('#refn_menu_id').val()+"&refn_menu_name="+$('#refn_menu_id option:selected').text();              
            $.ajax({
                url:'refn.php',
                type:'POST',
                data:data,
                cache:false,
                success:function(xml){
                jsonObj = eval('('+ xml +')');
                    $('#search_btn').button('reset');
                    if(jsonObj.status = 1){    
                        $('#referrence_name').text($("#refn_menu_id option:selected").text());
                        $('#outlet').text($("#refn_outl_id option:selected").text());
                        $('#refn_value').val(jsonObj.refn_value);
                        $('#refn_length').val(jsonObj.refn_length);
                        $('#refn_prefix').val(jsonObj.refn_prefix);
                        $('#refn_suffix').val(jsonObj.refn_suffix);
                        $('#refn_id').val(jsonObj.refn_id);
                        $('#savebtn').attr('disabled',false);
                        $('#savebtn').attr('title',"Submit");
                    }
                }   
            });      
       }
        function saveResult(){
          $('#savebtn').button('loading');  
          var data ="action=update&refn_outl_id="+$('#refn_outl_id').val()+"&refn_menu_id="+$('#refn_menu_id').val()+"&"+$('#form1').serialize();              
            $.ajax({
                url:'refn.php',
                type:'POST',
                data:data,
                cache:false,
                success:function(xml){
                jsonObj = eval('('+ xml +')');
                    $('#savebtn').button('reset');
                    if(jsonObj.status == 1){
                        alert("<?php echo $language[$lang]['update_success'];?>");
                    }else{
                        alert("<?php echo $language[$lang]['update_fail'];?>");
                    }
                }   
          }); 
       }
    </script>
  </body>
</html>
    <?php
    }

}
?>
