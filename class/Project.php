<?php
/*
 * To change this tprojectate, choose Tools | Tprojectates
 * and open the tprojectate in the editor.
 */

/**
 * Description of User
 *
 * @author jason
 */
class Project {

    public function Project(){
        include_once 'class/SelectControl.php';
        $this->select = new SelectControl();
        

    }
    public function create(){
//        get_prefix_value("Project",true)
        $table_field = array('project_code','project_code_cn','project_name','project_desc',
                             'project_desc_cn','project_price','project_limit','project_startdate',
                             'project_enddate','project_completeddate','project_outlet','project_remark',
                             'project_progress','project_seqno','project_status','project_leader',
                             'project_subcon','project_loaref','project_customer',
                             'project_site_coordinator');
        $table_value = array($this->project_code,$this->project_code_cn,$this->project_name,$this->project_desc,
                             $this->project_desc_cn,$this->project_price,$this->project_limit,$this->project_startdate,
                             $this->project_enddate,$this->project_completeddate,$this->project_outlet,$this->project_remark,
                             $this->project_progress,$this->project_seqno,1,$this->project_leader,
                             $this->project_subcon,$this->project_loaref,$this->project_customer,
                             $this->project_site_coordinator);
        $remark = "Insert Project.";
        if(!$this->save->SaveData($table_field,$table_value,'db_project','project_id',$remark)){
           return false;
        }else{
           $this->project_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function update(){
        $table_field = array('project_code','project_code_cn','project_name','project_desc',
                             'project_desc_cn','project_price','project_limit','project_startdate',
                             'project_enddate','project_completeddate','project_outlet','project_remark',
                             'project_progress','project_seqno','project_leader',
                             'project_subcon','project_loaref','project_customer',
                             'project_site_coordinator');
        $table_value = array($this->project_code,$this->project_code_cn,$this->project_name,$this->project_desc,
                             $this->project_desc_cn,$this->project_price,$this->project_limit,$this->project_startdate,
                             $this->project_enddate,$this->project_completeddate,$this->project_outlet,$this->project_remark,
                             $this->project_progress,$this->project_seqno,$this->project_leader,
                             $this->project_subcon,$this->project_loaref,$this->project_customer,
                             $this->project_site_coordinator);
        $remark = "Update Project.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_project','project_id',$remark,$this->project_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchProjectDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT p.*,empl.empl_code as insert_by,empl2.empl_code as update_by
                FROM db_project p
                LEFT JOIN db_empl empl ON empl.empl_id = p.insertBy
                LEFT JOIN db_empl empl2 ON empl2.empl_id = p.updateBy
                WHERE p.project_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->project_id = $row['project_id'];
            $this->project_code = $row['project_code'];
            $this->project_code_cn = $row['project_code_cn'];
            $this->project_name = $row['project_name'];
            $this->project_desc = $row['project_desc'];
            $this->project_desc_cn = $row['project_desc_cn'];
            $this->project_price = $row['project_price'];
            $this->project_limit = $row['project_limit'];
            $this->project_startdate = $row['project_startdate'];
            $this->project_enddate = $row['project_enddate'];
            $this->project_completeddate = $row['project_completeddate'];
            $this->project_outlet = $row['project_outlet'];
            $this->project_remark = $row['project_remark'];
            $this->project_progress = $row['project_progress'];
            $this->project_seqno = $row['project_seqno'];
            $this->project_status = $row['project_status'];
            $this->project_leader = $row['project_leader'];
            $this->update_by = $row['update_by'];
            $this->insertDateTime = $row['insertDateTime'];
            $this->insert_by = $row['insert_by'];
            $this->updateDateTime = $row['updateDateTime'];
            $this->project_subcon = $row['project_subcon'];
            $this->project_loaref = $row['project_loaref'];
            $this->project_customer = $row['project_customer'];
            $this->project_site_coordinator = $row['project_site_coordinator'];
            if($row['updateBy'] == 10000){
                $this->update_by = "Webmaster";
            }
            if($row['insertBy'] == 10000){
                $this->insert_by = "Webmaster";
            }
        }
        return $query;
    }
    public function delete(){
        $table_field = array('project_status');
        $table_value = array(0);
        $remark = "Delete Project.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_project','project_id',$remark,$this->project_id)){
           return false;
        }else{
           return true;
        }
    }
    public function getInputForm($action){
        global $mandatory;
        if($action == 'create'){
            $this->project_seqno = 10;
            $this->project_status = 1;
//            $this->project_code = get_prefix_value("Project",false);
        }
        $this->progressCrtl = $this->select->getProjectstatusSelectCtrl($this->project_progress,'N');
        $this->emplCrtl = $this->select->getEmployeeSelectCtrl($this->project_leader);
        $cust_wherestring = " AND partner_issubcon = 1";
        $this->subconCrtl = $this->select->getCustomerSelectCtrl($this->project_subcon,'N',$cust_wherestring,'ismulti');
        $this->customerCrtl = $this->select->getCustomerSelectCtrl($this->project_customer,'Y'," AND partner_iscustomer = '1'");
        $this->sitecoordinatorCrtl = $this->select->getCustomerSelectCtrl($this->project_site_coordinator,'N'," AND partner_issitecoordinator = '1'",'ismulti');
    ?>
   <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Project Management</title>
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
      <div class="content-wrapper">
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Project Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"><?php if($this->project_id > 0){ echo "Update Project";}else{ echo "Create New Project";}?></h3>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;' onclick = "window.location.href='project.php'">Search</button>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='project.php?action=createForm'">Create New</button>
                <?php }?>
              </div>
                
                <form id = 'project_form' class="form-horizontal" action = 'project.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="project_customer" class="col-sm-1 control-label">Customer</label>
                          <div class="col-sm-3">
                               <select class="form-control select2" id="project_customer" name="project_customer" <?php echo $disabled;?>>
                                   <?php echo $this->customerCrtl;?>
                               </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="project_loaref" class="col-sm-1 control-label" >LOA Ref</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="project_loaref" name="project_loaref" value = "<?php echo $this->project_loaref;?>" placeholder="LOA Ref">
                          </div>

                          <label for="project_site_coordinator" class="col-sm-1 control-label">Site Coordinator</label>
                          <div class="col-sm-3">
                               <select class="form-control js-example-basic-multiple select2" id="project_site_coordinator" name="project_site_coordinator[]" multiple="multiple" <?php echo $disabled;?> >
                                   <?php echo $this->sitecoordinatorCrtl;?>
                               </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="project_code" class="col-sm-1 control-label">Project Code <?php echo $mandatory;?></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="project_code" name="project_code" value = "<?php echo $this->project_code;?>" placeholder="Project Code" >
                          </div>
                          <label for="project_startdate" class="col-sm-1 control-label">Start Date</label>
                          <div class="col-sm-3">
                               <input type="text" class="form-control datepicker" id="project_enddate" name="project_startdate" value = "<?php echo format_date($this->project_startdate);?>" placeholder="Start Date">
                          </div>
                        </div> 
                        <div class="form-group">
                          <label for="project_name" class="col-sm-1 control-label">Project Name <?php echo $mandatory;?></label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="project_name" name="project_name" value = "<?php echo $this->project_name;?>" placeholder="Project Name">
                          </div>
                          <label for="project_enddate" class="col-sm-1 control-label">End Date</label>
                          <div class="col-sm-3">
                              <input type="text" class="form-control datepicker" id="project_enddate" name="project_enddate" value = "<?php echo format_date($this->project_enddate);?>" placeholder="End Date">
                          </div>
                        </div>  
                        <div class="form-group">
                          <label for="project_price" class="col-sm-1 control-label">Project SUM</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="project_price" name="project_price" value = "<?php echo $this->project_price;?>" placeholder="Project SUM">
                          </div>
                          <label for="project_completeddate" class="col-sm-1 control-label">Completed Date</label>
                          <div class="col-sm-3">
                               <input type="text" class="form-control datepicker" id="project_completeddate" name="project_completeddate" value = "<?php echo format_date($this->project_completeddate);?>" placeholder="DLP Date">
                          </div>
                        </div>

                    <div class="form-group">
<!--                        <label for="project_subcon" class="col-sm-1 control-label">Sub-Con</label>
                        <div class="col-sm-3">
                             <select class="form-control js-example-basic-multiple select2" id="project_subcon" name="project_subcon[]" multiple="multiple" >
                                 <?php // echo $this->subconCrtl;?>
                             </select>
                        </div>-->
                          <label for="project_outlet" class="col-sm-1 control-label" >Location</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="project_outlet" name="project_outlet" value = "<?php echo $this->project_outlet;?>" placeholder="Location">
                          </div>
                    </div>
                    <div class="form-group">
                      <label for="project_seqno" class="col-sm-1 control-label">Seq No</label>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" id="project_seqno" name="project_seqno" value = "<?php echo $this->project_seqno;?>" placeholder="Seq No">
                      </div>
                            <label for="project_progress" class="col-sm-1 control-label">Progress</label>
                            <div class="col-sm-3">
                                 <select class="form-control select2" id="project_progress" name="project_progress">
                                   <?php echo $this->progressCrtl;?>
                                 </select>
                            </div>
                    </div> 
                    <div class="form-group">
                      <label for="project_desc" class="col-sm-1 control-label">Description</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="project_desc" name="project_desc" placeholder="Description"><?php echo $this->project_desc;?></textarea>
                      </div>
                      <label for="project_remark" class="col-sm-1 control-label">Remark</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="project_remark" name="project_remark" placeholder="Remark"><?php echo $this->project_remark;?></textarea>
                      </div>
                    </div> 
                      <?php if($this->project_id > 0){?>
<!--                      <div class="form-group">
                          <label for="project_code_cn" class="col-sm-1 control-label">Insert Date</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" value = "<?php echo $this->insertDateTime;?>" disabled>
                          </div>
                          <label for="project_code_thai" class="col-sm-1 control-label">Last Edited Date</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" value = "<?php echo $this->updateDateTime;?>" disabled>
                          </div>
                       </div>
                      <div class="form-group">
                          <label for="project_code_cn" class="col-sm-1 control-label">Created By</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" value = "<?php echo $this->insert_by?>" disabled>
                          </div>
                          <label for="project_code_thai" class="col-sm-1 control-label">Last Edited By</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" value = "<?php echo $this->update_by;?>"disabled>
                          </div>
                       </div>-->
                      <?php }?>

                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    <button type="button" class="btn btn-default" onclick = "history.go(-1)">Cancel</button>
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "<?php echo $action;?>" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->project_id;?>" name = "project_id" id = "project_id"/>
                    <?php
                    if($this->project_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
                    <button type = "submit" class="btn btn-info">Submit</button>
                    &nbsp;&nbsp;&nbsp;
                    <a href = "project.php?action=viewawardeditem&project_id=<?php echo $this->project_id;?>" class="btn bg-purple"  >Awarded Items</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href = "project.php?action=viewSubconItem&project_id=<?php echo $this->project_id;?>" class="btn bg-fuchsia"  >Subcon File</a>
                    &nbsp;&nbsp;&nbsp;
                    <a href = "project.php?action=uploadpicture&project_id=<?php echo $this->project_id;?>" class="btn bg-orange"  >Upload Picture</a>
                    <?php }?>
                  </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
            
            <div class="box box-success">
                <div class="nav-tabs-custom" style = 'margin-top:5px;'>
                    <ul class="nav nav-tabs">
                      <!--<li <?php if( $_REQUEST['tab'] == 'work_tab'){ echo 'class="active"';}?>><a href="#work_tab" data-toggle="tab">Works</a></li>-->
                      <li <?php if($_REQUEST['tab'] == "" || $_REQUEST['tab'] == 'worker_tab'){ echo 'class="active"';}?>><a href="#worker_tab" data-toggle="tab">Sub - Contractor's Worker </a></li>
                      <!--<li <?php if($_REQUEST['tab'] == 'claim_tab'){ echo 'class="active"';}?>><a href="#claim_tab" data-toggle="tab">Progress Claim </a></li>-->
                      <li <?php if($_REQUEST['tab'] == 'vo_tab'){ echo 'class="active"';}?>><a href="#vo_tab" data-toggle="tab">Variation Order </a></li>
                      <li <?php if($_REQUEST['tab'] == 'mt_tab'){ echo 'class="active"';}?>><a href="#mt_tab" data-toggle="tab">Material</a></li>
                      <li <?php if($_REQUEST['tab'] == 'pr_tab'){ echo 'class="active"';}?>><a href="#pr_tab" data-toggle="tab">Purchase Request Material</a></li>
                      <li <?php if($_REQUEST['tab'] == 'equip_tab'){ echo 'class="active"';}?>><a href="#equip_tab" data-toggle="tab">Equipment</a></li>
                    </ul>

                    <div class="tab-content">
<!--                        <div class="tab-pane <?php if($_REQUEST['tab'] == 'work_tab'){ echo 'active';}?>" id="work_tab">
                            <?php // echo $this->getWorkListing();?>
                        </div>-->
                        <div class="tab-pane <?php if($_REQUEST['tab'] == "" || $_REQUEST['tab'] == 'worker_tab'){ echo 'active';}?>" id="worker_tab">
                            <?php echo $this->getworkerListing();?>
                        </div>
<!--                        <div class="tab-pane <?php if($_REQUEST['tab'] == 'claim_tab'){ echo 'active';}?>" id="claim_tab">
                            <?php //echo $this->getClaimListing();?>
                        </div>-->
                        <div class="tab-pane <?php if($_REQUEST['tab'] == 'vo_tab'){ echo 'active';}?>" id="vo_tab">
                            <?php echo $this->getvoListing();?>
                        </div>
                        <div class="tab-pane <?php if($_REQUEST['tab'] == 'mt_tab'){ echo 'active';}?>" id="mt_tab">
                            <?php echo $this->getMaterialListing();?>
                        </div>
                        <div class="tab-pane <?php if($_REQUEST['tab'] == 'pr_tab'){ echo 'active';}?>" id="pr_tab">
                            <?php echo $this->getPurchaseRequestMaterialListing();?>
                        </div>
                        <div class="tab-pane <?php if($_REQUEST['tab'] == 'equip_tab'){ echo 'active';}?>" id="equip_tab">
                            <?php echo $this->getEquipmentListing();?>
                        </div>
                    </div>
                </div>
            </div><!-- /.box -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    
    ?>
    <script>
    $(document).ready(function() {
        $("#project_form").validate({
                  rules: 
                  {
                      project_code:
                      {
                          required: true,
                          remote: {
                                  url: "project.php?action=validate_project",
                                  type: "post",
                                  data: 
                                        {
                                            project_id: function()
                                            {
                                                return $("#project_id").val();
                                            }
                                        }
                              }
                      }
                  },
                  messages:
                  {
                      project_code:
                      {
                          required: "Please enter Project Code.",
                          remote: "Project Code duplicate."
                      }
                  }
              });
              
        <?php if($_REQUEST['isnew'] == 1){?>
            <?php if($_REQUEST['tab'] == 'work_tab'){?>
                    $('#work_model').modal('show');
            <?php }else if($_REQUEST['tab'] == 'claim_tab'){?>
                    $('#generate_model').modal('show');
            <?php }else if($_REQUEST['tab'] == 'worker_tab'){?>
                    $('#worker_model').modal('show');
            <?php }else if($_REQUEST['tab'] == 'equip_tab'){?>
                    $('#equip_model').modal('show');
            <?php }?>   
        <?php }?>     
     $('.openwork_btn').on('click',function(){
          $('#add_work_new').css('display','');
          $('#add_work,work_modal_title').text("Create Equipment");
          $('#work_model').modal('show');
          $('#detail_table').css('display','none');
          refreshProjectWorkLine();
     });       
     $('.openclaim_btn').on('click',function(){
           
          $('#generate_model').modal('show');
     });
     $('.openworker_btn').on('click',function(){
          $('#worker_model').modal('show');
     });

     $('.openvo_btn').on('click',function(){
          $('#vo_model').modal('show');
     });
     $('.openequipment_btn').on('click',function(){

          $('#add_equipment_new').css('display','');
          $('#add_equipment,add_equipment_title').text("Create Equipment");
          $('#pequipment_id').val(0);
          $('#pequipment_remarks').html("");
          $('#pequipment_equipment').select2('val','');
          $('#equipment_model').modal('show');
     });
        $('.edit_line_claim').on('click',function(){
            $('#add_claim_new').css('display','none');
            var data = "action=fetch_claim&project_id=<?php echo $this->project_id;?>&pclaim_id="+$(this).attr('pclaim_id');
            $.ajax({ 
                type: 'POST',
                url: 'project.php',
                cache: false,
                data:data,
                error: function(xhr) {
                    alert("System Error.");
                    issend = false;
                },
                success: function(data) {
                   var jsonObj = eval ("(" + data + ")");
                   if(jsonObj.status == 1){
                        $('#pclaim_id').val(jsonObj.pclaim_id);
                        $('#pclaim_date').val(jsonObj.pclaim_date);
                        $('#pclaim_amount').val(jsonObj.pclaim_amount);
                        $('#pclaim_remarks').val(jsonObj.pclaim_remarks);

                        $('#add_claim,#claim_modal_title').text("Update Claim");
                        
                        $('#generate_model').modal('show');
                   }else{
                       alert("Fail to fetch data.");
                   }
                   issend = false;
                }		
             });
             return false;
        }); 
        $('.edit_line_equipment').on('click',function(){
            $('#add_equipment_new').css('display','none');
            var data = "action=fetch_equipment&project_id=<?php echo $this->project_id;?>&pequipment_id="+$(this).attr('pequipment_id');
            $.ajax({ 
                type: 'POST',
                url: 'project.php',
                cache: false,
                data:data,
                error: function(xhr) {
                    alert("System Error.");
                    issend = false;
                },
                success: function(data) {
                   var jsonObj = eval ("(" + data + ")");
                   if(jsonObj.status == 1){
                        $('#pequipment_id').val(jsonObj.pequipment_id);
                        $('#pequipment_equipment').select2('val',jsonObj.pequipment_equipment);
                        $('#pequipment_remarks').html(jsonObj.pequipment_remarks);

                        $('#add_equipment,#claim_modal_title').text("Update Equipment");
                        
                        $('#equipment_model').modal('show');
                   }else{
                       alert("Fail to fetch data.");
                   }
                   issend = false;
                }		
             });
             return false;
        });  
        $('.edit_line_vo').on('click',function(){
            $('#add_worker_new').css('display','none');
            var data = "action=fetch_vo&project_id=<?php echo $this->project_id;?>&vo_id="+$(this).attr('vo_id');
            $.ajax({ 
                type: 'POST',
                url: 'project.php',
                cache: false,
                data:data,
                error: function(xhr) {
                    alert("System Error.");
                    issend = false;
                },
                success: function(data) {
                   var jsonObj = eval ("(" + data + ")");
                   if(jsonObj.status == 1){
                        $('#vo_id').val(jsonObj.vo_id);
                        $('#vo_date').val(jsonObj.vo_date);
                        $('#vo_ref').val(jsonObj.vo_ref);
                        $('#vo_amount').val(jsonObj.vo_amount);
                        $('#vo_remarks').val(jsonObj.vo_remarks);

                        $('#add_vo').text("Update VO");
                        $('#vo_model').modal('show');
                   }else{
                       alert("Fail to fetch data.");
                   }
                   issend = false;
                }		
             });
             return false;
        });  
        $('.edit_line_worker').on('click',function(){
            $('#add_worker_new').css('display','none');
            var data = "action=fetch_subcon_worker&project_id=<?php echo $this->project_id;?>&pworker_id="+$(this).attr('pworker_id');
            $.ajax({ 
                type: 'POST',
                url: 'project.php',
                cache: false,
                data:data,
                error: function(xhr) {
                    alert("System Error.");
                    issend = false;
                },
                success: function(data) {
                   var jsonObj = eval ("(" + data + ")");
                   if(jsonObj.status == 1){
                        $('#pempl_id').select2("val",jsonObj.pempl_id);
                        $('#pworker_remarks').val(jsonObj.pworker_remarks);
                        $('#pworker_id').val(jsonObj.pworker_id);

                        $('#add_worker').text("Update Worker");
                        $('#worker_model').modal('show');
                   }else{
                       alert("Fail to fetch data.");
                   }
                   issend = false;
                }		
             });
             return false;
        }); 
        $('.edit_line_work').on('click',function(){
            $('#detail_table').css('display','');
            $('#add_work_new').css('display','none');
            var data = "action=fetch_work&project_id=<?php echo $this->project_id;?>&pw_id="+$(this).attr('pw_id');
            $.ajax({ 
                type: 'POST',
                url: 'project.php',
                cache: false,
                data:data,
                error: function(xhr) {
                    alert("System Error.");
                    issend = false;
                },
                success: function(data) {
                   var jsonObj = eval ("(" + data + ")");
                   if(jsonObj.status == 1){
                        $('#pwlocation').val(jsonObj.pwlocation);
                        $('#pwdescription').val(jsonObj.pwdescription);
                        $('#pwsubcon').select2("val",jsonObj.pwsubcon);
                        $('#pw_id').val(jsonObj.pw_id);

                        $('#add_work,#work_modal_title').text("Update Work");
                        $('#work_model').modal('show');
                        refreshProjectWorkLine(jsonObj.pw_id);
                   }else{
                       alert("Fail to fetch data.");
                   }
                   issend = false;
                }		
             });
             return false;
        });    
        $('.delete_line_worker').on('click',function(){
            if(confirm('Confirm delete?')){
               
                var data = "action=delete_subcon_worker&project_id=<?php echo $this->project_id;?>&pworker_id="+$(this).attr('pworker_id');
                $.ajax({ 
                    type: 'POST',
                    url: 'project.php',
                    cache: false,
                    data:data,
                    error: function(xhr) {
                        alert("System Error.");
                        issend = false;
                    },
                    success: function(data) {
                       var jsonObj = eval ("(" + data + ")");
                       if(jsonObj.status == 1){
                           alert("Delete successfully.");
                           window.location.reload();
                       }else{
                           alert("Delete fail.");
                       }
                       issend = false;
                    }		
                 });
                 return false;
            }else{
                return false;
            }
        });     
             
        $('.delete_line_claim').on('click',function(){
            if(confirm('Confirm delete?')){
               
                var data = "action=delete_project_claim&project_id=<?php echo $this->project_id;?>&pclaim_id="+$(this).attr('pclaim_id');
                $.ajax({ 
                    type: 'POST',
                    url: 'project.php',
                    cache: false,
                    data:data,
                    error: function(xhr) {
                        alert("System Error.");
                        issend = false;
                    },
                    success: function(data) {
                       var jsonObj = eval ("(" + data + ")");
                       if(jsonObj.status == 1){
                           alert("Delete successfully.");
                           window.location.reload();
                       }else{
                           alert("Delete fail.");
                       }
                       issend = false;
                    }		
                 });
                 return false;
            }else{
                return false;
            }
        });    
        
        $('.delete_line_work').on('click',function(){
            if(confirm('Confirm delete?')){
               
                var data = "action=delete_project_work&project_id=<?php echo $this->project_id;?>&pw_id="+$(this).attr('pw_id');
                $.ajax({ 
                    type: 'POST',
                    url: 'project.php',
                    cache: false,
                    data:data,
                    error: function(xhr) {
                        alert("System Error.");
                        issend = false;
                    },
                    success: function(data) {
                       var jsonObj = eval ("(" + data + ")");
                       if(jsonObj.status == 1){
                           alert("Delete successfully.");
                           window.location.reload();
                       }else{
                           alert("Delete fail.");
                       }
                       issend = false;
                    }		
                 });
                 return false;
            }else{
                return false;
            }
        });  
             
    });
        function refreshProjectWorkLine(pw_id,pwl_id){
            
            var data = "action=refreshProjectWorkLine&project_id=<?php echo $this->project_id;?>&pw_id=" + pw_id + "&pwl_id="+pwl_id;
            $.ajax({ 
                type: 'POST',
                url: 'project.php',
                cache: false,
                data:data,
                success: function(data) {
                   var jsonObj = eval ("(" + data + ")");
                    $('.clms_tr').remove();
                    $('#detail_last_tr_clms').before(jsonObj.html);
                    $('.save_line_pwl').on('click',function(){
                        saveclmsline($(this).attr('line'),$(this).attr('pwl_id'));
                    });
                    $('.delete_line_clms').on('click',function(){
                        deleteclmsline($(this).attr('clms_id'),$(this).attr('clmd_id'));
                    });
                }		
             });
        }
        var issend = false;
        function saveclmsline(line,pwl_id){
            if(issend){
                alert("Please Wait.");
                return false;
            }


            issend = true;
            if(pwl_id != ""){
                var action = 'updatepwlline';
            }else{
                var action = 'savepwlline';
            }

            var data = "pwl_ordl_id="+encodeURIComponent($('#pwl_item_'+line).val());
                data += "&pwl_qty="+encodeURIComponent($('#pwl_qty_'+line).val());
                data += "&action="+action;
                data += "&pwl_id="+pwl_id;
                data += "&pw_id="+$('#pw_id').val();
                data += "&project_id=<?php echo $_REQUEST['project_id'];?>";

            $.ajax({ 
                type: 'POST',
                url: 'project.php',
                cache: false,
                data:data,
                error: function(xhr) {
                    alert("<?php echo $language[$lang]['system_error']?>");
                    issend = false;
                },
                success: function(data) {
                   var jsonObj = eval ("(" + data + ")");
                   if(jsonObj.status == 1){
                       refreshProjectWorkLine(jsonObj.pw_id);
                   }else{
                       alert("<?php echo $language[$lang]['addeditline_error'];?>");
                   }
                   issend = false;
                }		
             });
             return false;
        }
        function deleteline(clmd_id){
        var data = "action=deleteline&claim_id=<?php echo $this->claim_id;?>&clmd_id="+clmd_id;
        $.ajax({ 
            type: 'POST',
            url: '<?php echo $this->document_url;?>',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("<?php echo $language[$lang]['system_error']?>");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   window.location.reload();
               }else{
                   alert("<?php echo $language[$lang]['deleteline_error'];?>");
               }
               issend = false;
            }		
         });
         return false;
    }
    </script>
    <?php 
    echo $this->workDialogForm();
    echo $this->claimDialogForm();
    echo $this->workersDialogForm();
    echo $this->voDialogForm();
    echo $this->equipmentDialogForm();
    ?>
  </body>
</html>
        <?php
        
    }
    public function getListing(){
    ?>
    <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Project Management</title>
    <?php
    include_once 'css.php';
    
    ?>
    <style>
    
   </style>
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
            <h1>Project Management</h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Project Table</h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button class="btn btn-primary pull-right" onclick = "window.location.href='project.php?action=createForm'">Create New + </button>
                
                <!--<button style = 'margin-right:10px;' class="btn btn-primary pull-right import_btn" data-toggle="modal" data-target="#myModal">Import + </button>-->
                <?php }?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="project_table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Customer Name</th>
                        <th style = 'width:8%'>LOA Ref</th>
                        <th style = 'width:10%'>Project Code</th>
                        <th style = 'width:15%'>Project Name</th>
                        
                        <th style = 'width:10%'>Product value</th>
                        <th style = 'width:8%'>Claimed</th>
                        <th style = 'width:8%'>VO</th>
                        <th style = 'width:10%'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php   
                      $sql = "SELECT project.*,cy.category_code,bd.brand_code 
                              FROM db_project project 
                              INNER JOIN db_category cy ON cy.category_id = project.project_category
                              INNER JOIN db_brand bd ON bd.brand_id = project.project_brand
                              WHERE project.project_id > 0 limit 0,100";
//                      $query = mysql_query($sql);
                      $i = 1;
                      while($row1 = mysql_fetch_array($query)){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['project_code'];?></td>
                            <td><?php echo nl2br($row['project_desc']);?></td>
                            <td><?php echo $row['category_code'];?></td>
                            <td><?php echo $row['brand_code'];?></td>
                            <td><?php echo $row['project_sales_price'];?></td>
                            <td><?php if($row['project_status'] == 1){ echo 'Active';}else{ echo 'In-Active';}?></td>
                            <td class = "text-align-right">
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                ?>
                                <button type="button" class="btn btn-primary btn-info " onclick = "location.href = 'project.php?action=edit&project_id=<?php echo $row['project_id'];?>'">Edit</button>
                                <?php }?>
                                <?php 
                                if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                ?>
                                <button type="button" class="btn btn-primary btn-danger " onclick = "confirmAlertHref('project.php?action=delete&project_id=<?php echo $row['project_id'];?>','Confirm Delete?')">Delete</button>
                                <?php }?>
                            </td>
                        </tr>
                    <?php    
                        $i++;
                      }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style = 'width:5%'>No</th>
                        <th style = 'width:15%'>Customer Name</th>
                        <th style = 'width:8%'>LOA Ref</th>
                        <th style = 'width:10%'>Project Code</th>
                        <th style = 'width:15%'>Project Name</th>
                        <th style = 'width:10%'>Product value</th>
                        <th style = 'width:8%'>Claimed</th>
                        <th style = 'width:8%'>VO</th>
                        <th style = 'width:10%'></th>
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
<!--<script type="text/javascript" src="http://www.sanwebe.com/assets/public/js/jquery.form.min.js"></script>-->
    <script>

      $(function () {
        $('#project_table').DataTable({
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "project.php?action=getDataTable",  
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "iDisplayLength": 25,
                "aoColumns": [
                      { "bSortable": false },
                      null,
                      null,
                      null,
                      null,
                      null,
                      null,
                      null,
                      
                      {"sClass": "text-align-right" }
                  ]
        });

            $('#uploadForm').submit(function(e) {	
                if($('#import_file').val()) {
                    e.preventDefault();
                    $('#loader-icon').show();
                    $(this).ajaxSubmit({ 
                        target:   '#targetLayer', 
                        beforeSubmit: function() {
                            $("#targetLayer").html("<img style = 'width:100px;' src = 'dist/img/LoaderIcon.gif'/>");
                            $(".import_btn").val("Importing.......");
                            $(".import_btn").attr("disabled",true);
                        },
                        success:function (data){
                            jsonObj = eval('('+ data +')');
                            if(jsonObj.status == 1){
                                $("#targetLayer").html("<font color = 'green'><b>Import Success. &nbsp;&nbsp;&nbsp;" + jsonObj.data + "rows effect.</b></font>");
                            }else{
                                $("#targetLayer").html("<font color = 'red'><b>Import Fail.</b></font>");
                            }
                            $(".import_btn").val("Import");
                            $(".import_btn").attr("disabled",false);
                        },
                        resetForm: true 
                    }); 
                    return false; 
                }
            });

      });

    </script>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Import Project</h4>
            </div>
                <div id="bar_blank">
   <div id="bar_color"></div>
  </div>
              <div id="status"></div>
            <form id = 'uploadForm' action = 'project.php' method = "POST" >  
                <div class="modal-body">

                    <input type = "file" name = 'import_file' id = 'import_file' style = 'display:inline;'/>
                    
                    <input type = 'hidden' value ='import'  name = 'action' style = 'display:inline;'/>

                    <div id="targetLayer" style = 'display:inline;'></div>
                    <br>Xls,Csv file only.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type = 'submit' class="btn btn-primary pull-right import_btn" value ='Import' />
                </div>
            </form>
          </div>

        </div>
    </div>
  </body>
</html>
    <?php
    }
    public function getDataTable(){
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	$aColumns = array('No','customer_name','project_code','project_name','project_loaref','project_price','0','0','');
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "project_id";
	
	/* DB table to use */
        $sTable = "db_project";
        /* 
	 * Paging
	 */
	$sLimit = "";
	if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1'){
		$sLimit = "LIMIT ".mysql_real_escape_string($_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if($_GET['sSearch'] != ""){
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ ){
                        if($aColumns[$i] == 'No' || $aColumns[$i] == ""){
                            continue;
                        }
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ($i=0;$i<count($aColumns);$i++){
                if($aColumns[$i] == 'No' || $aColumns[$i] == ""){
                    continue;
                }
		if($_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != ''){
			if ($sWhere == "" ){
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
        if($sWhere == ""){
            $sWhere = " WHERE project.project_status = '1'";
        }else{
            $sWhere = " AND project.project_status = '1'";
        }
	/*
	 * SQL queries
	 * Get data to display
	 */

        if(isset($_GET['iSortCol_0'])){
            if($_GET['iSortCol_0'] != 0){
		$sOrder = "ORDER BY  ";
		for($i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ ){
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" ){
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if($sOrder == "ORDER BY" ){
			$sOrder = "";
		}
            }
	}else{
            $sOrder = "ORDER BY project.project_seqno,project.project_code";
        }
        
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS project.*,ps.projectstatus_code,p.partner_name as customer_name
		FROM db_project project
                LEFT JOIN db_projectstatus ps ON ps.projectstatus_id = project.project_progress
                LEFT JOIN db_partner p ON p.partner_id = project.project_customer
		$sWhere
		$sOrder
		$sLimit
	";

	$rResult = mysql_query($sQuery);
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query($sQuery);
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysql_query($sQuery);
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	

	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
        $b = $_GET['iDisplayStart']+1;
	while ($aRow = mysql_fetch_array($rResult)){
		$row = array();
		for ($i=0;$i<sizeof($aColumns);$i++){
			if($aColumns[$i] == "No" ){
				$row[] = $b;
			}else if($aColumns[$i] != ""){
                            if($aColumns[$i] == 'project_status'){
                                if($aRow[$aColumns[$i]] == 1){
                                    $row[] = "Active";
                                }else{
                                    $row[] = "In-Active";
                                }
                            }else if(($aColumns[$i] == 'project_startdate') || ($aColumns[$i] == 'project_enddate') || ($aColumns[$i] == 'project_completeddate')){
                                $row[] = format_date(($aRow[$aColumns[$i]]));
                            }else{
                                $row[] = ($aRow[$aColumns[$i]]);
                            }
			}else{
                           $btn = "";
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                             $btn = "<button type='button' class='btn btn-primary btn-info ' onclick = 'location.href = \"project.php?action=edit&project_id={$aRow['project_id']}\"'>Edit</button>";       
                           }
                           if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                             $btn .= " <button type='button' class='btn btn-primary btn-danger' onclick = 'confirmAlertHref(\"project.php?action=delete&project_id={$aRow['project_id']}\",\"Confirm Delete?\")'>Delete</button>";  
                           }
                                $row[] = $btn;
                        }
		}
		$output['aaData'][] = $row;
                $b++;
	}

	echo json_encode($output);
    }
    public function getProjectDetailTransaction(){
        
        $project_query = $this->fetchProjectDetail(" AND p.project_id = '$this->project_id'","","",0);
        
        if($row = mysql_fetch_array($project_query)){
            return $row;
        }else{
            return null;
        }
    }
    
    
    public function getWorkListing(){
    ?>

    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title">Work Listing</h3></div>
          <div class = "pull-right">
                <button type = 'button' class = "btn btn-primary openwork_btn" >Add Work</button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:15%;'>Sub-Con</th>
                <th style = 'width:30%'>Description</th>
                <th style = 'width:15%;'>Location</th>
                <th style = 'width:10%'></th>
              </tr>
            </thead>
            <tbody>
            <?php   
              $sql = "SELECT * FROM db_pw WHERE pw_id > 0 AND pw_project_id = '$this->project_id' ORDER BY insertDateTime DESC";
              $query = mysql_query($sql);
              $i = 1;
              $total = 0;
              while($row = mysql_fetch_array($query)){
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo getDataCodeBySql("partner_name","db_partner"," WHERE partner_id = '{$row['pwsubcon']}'", $orderby);?></td>
                    <td><?php echo nl2br($row['pwdescription']);?></td>
                    <td><?php echo $row['pwlocation'];?></td>
                    <td class = "text-align-right">
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                        ?>
                        <a title = 'edit' style = "margin-left:10px;margin-right:10px;font-size:20px;" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" pw_id = "<?php echo $row['pw_id'];?>" class = "edit_line_work font-icon" line = "<?php echo $i;?>" ><i class="fa fa-edit" aria-hidden="true"></i></a>
                        <?php }?>
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                        ?>
                        <a title = 'delete' style = "margin-left:10px;margin-right:10px;font-size:20px;color:red" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" pw_id = "<?php echo $row['pw_id'];?>" class = "delete_line_work font-icon" line = "<?php echo $i;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>

            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <?php
    }
    public function getClaimListing(){
    ?>

    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title">Progress Claim Listing</h3></div>
          <div class = "pull-right">
                <button type = 'button' class = "btn btn-primary openclaim_btn" generateto = "<?php echo $generate_to;?>">Add Claim</button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
<!--                <th style = 'width:10%'>Type</th>
                <th style = 'width:15%'>Create By</th>-->
                <th style = 'width:10%'>Date</th>
                <th style = 'width:15%;text-align:right'>Amount</th>
                <th style = 'width:35%'>Remarks</th>
                <th style = 'width:10%'></th>
              </tr>
            </thead>
            <tbody>
            <?php   
              $sql = "SELECT * FROM db_pclaim WHERE pclaim_status > 0 ORDER BY pclaim_date DESC";
              $query = mysql_query($sql);
              $i = 1;
              $total = 0;
              while($row = mysql_fetch_array($query)){
                  $total = $total + $row['pclaim_amount'];
            ?>
                <tr>
                    <td><?php echo $i;?></td>
<!--                    <td>
                        <?php 
                        if($row['pclaim_type'] == 'site'){
                            echo 'Site Coordinator';
                        }else{
                            echo 'Sub - Contractor';
                        }
                        ?>
                    </td>
                    <td><?php echo getDataCodeBySql("CONCAT(partner_code,' - ',partner_name)","db_partner"," WHERE partner_id = '{$row['pclaim_by']}'", $orderby);?></td>-->
                    <td><?php echo format_date($row['pclaim_date']);?></td>
                    <td style = 'text-align:right'>$<?php echo num_format($row['pclaim_amount']);?></td>
                    <td><?php echo nl2br($row['pclaim_remarks']);?></td>
                    <td class = "text-align-right">
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                        ?>
                        <a title = 'edit' style = "margin-left:10px;margin-right:10px;font-size:20px;" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" pclaim_id = "<?php echo $row['pclaim_id'];?>" class = "edit_line_claim font-icon" line = "<?php echo $i;?>" ><i class="fa fa-edit" aria-hidden="true"></i></a>
                        <?php }?>
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                        ?>
                        <a title = 'delete' style = "margin-left:10px;margin-right:10px;font-size:20px;color:red" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" pclaim_id = "<?php echo $row['pclaim_id'];?>" class = "delete_line_claim font-icon" line = "<?php echo $i;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>
                <tr>
                    <td style = 'text-align:right;font-weight:700' colspan = '2' >Total </td>
                    <td style = 'text-align:right;font-weight:700'>$<?php echo num_format($total);?></td>
                </tr>
            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <?php
    }
    public function getworkerListing(){
    ?>

    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title">Sub - Contractor's Worker</h3></div>
          <div class = "pull-right">
            <button type = 'button' class = "btn btn-primary openworker_btn" >Add Worker</button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:20%'>Sub - Contractor</th>
                <th style = 'width:20%'>Worker Name</th>
                <th style = 'width:10%;'>Worker NRIC</th>
                <th style = 'width:35%'>Remarks</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php   
              $sql = "SELECT pw.*,p.*,pr.partner_name as subcon_name
                      FROM db_pworker pw
                      INNER JOIN db_pempl p ON p.pempl_id = pw.pempl_id
                      INNER JOIN db_partner pr ON pr.partner_id = p.pempl_partner_id
                      WHERE pw.pworker_status > 0 AND project_id = '$this->project_id'
                      ORDER BY p.pempl_name DESC";
              $query = mysql_query($sql);
              $i = 1;
              $total = 0;
              while($row = mysql_fetch_array($query)){
                  $total = $total + $row['pclaim_amount'];
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['subcon_name'];?></td>
                    <td><?php echo $row['pempl_name'];?></td>
                    <td><?php echo $row['pempl_nric'];?></td>
                    <td><?php echo nl2br($row['pworker_remarks']);?></td>
                    <td class = "text-align-right">
                        <a title = 'Attendance' style = "margin-left:10px;margin-right:10px;font-size:20px;color:black" href = "project.php?action=attendance&pattendance_project=<?php echo $this->project_id;?>&pattendance_pempl=<?php echo $row['pempl_id'];?>" class = " font-icon"  ><i class="fa fa-fw fa-calendar-check-o" aria-hidden="true"></i></a>
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                        ?>
                        <a title = 'edit' style = "margin-left:10px;margin-right:10px;font-size:20px;" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" pworker_id = "<?php echo $row['pworker_id'];?>" class = "edit_line_worker font-icon" line = "<?php echo $i;?>" ><i class="fa fa-edit" aria-hidden="true"></i></a>
                        <?php }?>
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                        ?>
                        <a title = 'delete' style = "margin-left:10px;margin-right:10px;font-size:20px;color:red" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" pworker_id = "<?php echo $row['pworker_id'];?>" class = "delete_line_worker font-icon" line = "<?php echo $i;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>

            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <?php
    }
    public function getvoListing(){
    ?>

    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title">Variation Order</h3></div>
          <div class = "pull-right">
            <!--<button type = 'button' class = "btn btn-primary openvo_btn" >Add VO</button>-->
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:20%'>Date</th>
                <th style = 'width:20%'>Variation Order No.</th>
                <th style = 'width:20%;text-align:right'>Variation Order Amount</th>
                <th style = 'width:25%'>Remarks</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            <?php   
              $sql = "SELECT o.*
                      FROM db_order o
                      WHERE o.order_id > 0 AND o.order_type = 'vo' AND o.order_prefix_type = 'QT' AND o.order_project_id = '$this->project_id' AND o.order_status = '1'
                      ORDER BY o.order_date DESC";
              $query = mysql_query($sql);
              $i = 1;
              $total = 0;
              while($row = mysql_fetch_array($query)){
                  $total = $total + $row['vo_amount'];
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo format_date($row['order_date']);?></td>
                    <td><?php echo $row['order_no'];?></td>
                    <td style = 'text-align:right' >$<?php echo num_format($row['order_grandtotal']);?></td>
                    <td><?php echo nl2br($row['order_remark']);?></td>
                    <td class = "text-align-right">
                        <?php 
//                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                        ?>
                        <a title = 'edit' target = '_blank' style = "margin-left:10px;margin-right:10px;font-size:20px;" href = "quotation.php?action=edit&order_id=<?php echo $row['order_id'];?>" id = "delete_line_<?php echo $i;?>" order_id = "<?php echo $row['order_id'];?>" class = " font-icon" line = "<?php echo $i;?>" ><i class="fa fa-fw fa-eye" aria-hidden="true"></i></a>
                        <?php // }?>
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                        ?>
                        <!--<a title = 'delete' style = "margin-left:10px;margin-right:10px;font-size:20px;color:red" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" order_id = "<?php echo $row['order_id'];?>" class = "delete_line_vo font-icon" line = "<?php echo $i;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>-->
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>

            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <?php
    }
    public function getMaterialListing(){
    ?>

    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title">Project Material</h3></div>
          <div class = "pull-right">
            <!--<button type = 'button' class = "btn btn-primary openvo_btn" >Add VO</button>-->
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:15%'>Document No.</th>
                <th style = 'width:10%'>Date</th>
                <th style = 'width:25%'>Item</th>
                <th style = 'width:10%;text-align:right'>Qty</th>
                <th style = 'width:10%;text-align:right'>U.Price</th>
                <th style = 'width:10%;text-align:right'>Amount</th>
                <th style = 'width:10%'></th>
              </tr>
            </thead>
            <tbody>
            <?php   
              $sql = "SELECT o.*,ordl.ordl_pro_no,ordl.ordl_qty,u.uom_code,ordl.ordl_fuprice,ordl.ordl_ftotal,ordl.ordl_pro_remark
                      FROM db_order o
                      INNER JOIN db_ordl ordl ON ordl.ordl_order_id = o.order_id
                      LEFT JOIN db_uom u ON u.uom_id = ordl.ordl_uom
                      WHERE o.order_id > 0  AND o.order_prefix_type = 'QT' AND o.order_project_id = '$this->project_id' AND o.order_status IN ('1','2')
                      ORDER BY o.order_date,o.order_no ";
              $query = mysql_query($sql);
              $i = 1;
              $total = 0;
              while($row = mysql_fetch_array($query)){
                  $total = $total + $row['ordl_ftotal'];
                  if($row['order_revtimes'] > 0){
                      $order_no = $row['order_no'] . " (Rev {$row['order_revtimes']})";
                  }else{
                      $order_no = $row['order_no'];
                  }
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo "<a href = 'quotation.php?action=edit&order_id={$row['order_id']}' target = '_blank' >" . $order_no . "</a>";?></td>
                    <td><?php echo format_date($row['order_date']);?></td>
                    <td><?php echo $row['ordl_pro_no'];?></td>
                    <td style = 'text-align:right'><?php echo $row['ordl_qty'] . " " . $row['uom_code'];?></td>
                    <td style = 'text-align:right' >$<?php echo num_format($row['ordl_fuprice']);?></td>
                    <td style = 'text-align:right' >$<?php echo num_format($row['ordl_ftotal']);?></td>
                    <td class = "text-align-right">
                        <?php 
//                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                        ?>
                        <a title = 'edit' target = '_blank' style = "margin-left:10px;margin-right:10px;font-size:20px;" href = "quotation.php?action=edit&order_id=<?php echo $row['order_id'];?>" id = "delete_line_<?php echo $i;?>" order_id = "<?php echo $row['order_id'];?>" class = " font-icon" line = "<?php echo $i;?>" ><i class="fa fa-fw fa-eye" aria-hidden="true"></i></a>
                        <?php // }?>
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                        ?>
                        <!--<a title = 'delete' style = "margin-left:10px;margin-right:10px;font-size:20px;color:red" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" order_id = "<?php echo $row['order_id'];?>" class = "delete_line_vo font-icon" line = "<?php echo $i;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>-->
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>

            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <?php
    }
    public function getPurchaseRequestMaterialListing(){
    ?>

    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title">Purchase Request Material</h3></div>
          <div class = "pull-right">
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:15%'>Document No.</th>
                <th style = 'width:10%'>Date</th>
                <th style = 'width:25%'>Item</th>
                <th style = 'width:10%;text-align:right'>Qty</th>
                <th style = 'width:10%;text-align:right'>U.Price</th>
                <th style = 'width:10%;text-align:right'>Amount</th>
                <th style = 'width:10%;'>Order By</th>
                <th style = 'width:10%'></th>
              </tr>
            </thead>
            <tbody>
            <?php   
              $sql = "SELECT o.*,ordl.ordl_pro_no,ordl.ordl_qty,u.uom_code,ordl.ordl_fuprice,ordl.ordl_ftotal,ordl.ordl_pro_remark
                      FROM db_order o
                      INNER JOIN db_ordl ordl ON ordl.ordl_order_id = o.order_id
                      LEFT JOIN db_uom u ON u.uom_id = ordl.ordl_uom
                      WHERE o.order_id > 0  AND o.order_prefix_type = 'PRF' AND o.order_project_id = '$this->project_id' AND o.order_status IN ('1','2')
                      ORDER BY o.order_date,o.order_no ";
              $query = mysql_query($sql);
              $i = 1;
              $total = 0;
              while($row = mysql_fetch_array($query)){
                  $total = $total + $row['ordl_ftotal'];
                  if($row['order_revtimes'] > 0){
                      $order_no = $row['order_no'] . " (Rev {$row['order_revtimes']})";
                  }else{
                      $order_no = $row['order_no'];
                  }
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo "<a href = 'purchase_request.php?action=edit&order_id={$row['order_id']}' target = '_blank' >" . $order_no . "</a>";?></td>
                    <td><?php echo format_date($row['order_date']);?></td>
                    <td><?php echo $row['ordl_pro_no'];?></td>
                    <td style = 'text-align:right'><?php echo $row['ordl_qty'] . " " . $row['uom_code'];?></td>
                    <td style = 'text-align:right' >$<?php echo num_format($row['ordl_fuprice']);?></td>
                    <td style = 'text-align:right' >$<?php echo num_format($row['ordl_ftotal']);?></td>
                    <td style = 'text-align:right' >
                        <?php 
                        if($row['order_salesperson_prefix'] == 'SUBCON'){
                            echo getDataCodeBySql("partner_name","db_partner"," WHERE partner_id = '{$row['order_salesperson']}'", $orderby);
                        }else{
                            echo getDataCodeBySql("empl_name","db_empl"," WHERE empl_id = '{$row['order_salesperson']}'", $orderby);
                        }
                        
                        ?>
                    </td>
                    <td class = "text-align-right">
                        <?php 
//                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                        ?>
                        <a title = 'edit' target = '_blank' style = "margin-left:10px;margin-right:10px;font-size:20px;" href = "purchase_request.php?action=edit&order_id=<?php echo $row['order_id'];?>" id = "delete_line_<?php echo $i;?>" order_id = "<?php echo $row['order_id'];?>" class = " font-icon" line = "<?php echo $i;?>" ><i class="fa fa-fw fa-eye" aria-hidden="true"></i></a>
                        <?php // }?>
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                        ?>
                        <!--<a title = 'delete' style = "margin-left:10px;margin-right:10px;font-size:20px;color:red" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" order_id = "<?php echo $row['order_id'];?>" class = "delete_line_vo font-icon" line = "<?php echo $i;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>-->
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>

            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <?php
    }
    public function getEquipmentListing(){
    ?>

    <div class="box">
        <div class="box-header">
          <div class = "pull-left"><h3 class="box-title">Project Equipment</h3></div>
          <div class = "pull-right">
            <button type = 'button' class = "btn btn-primary openequipment_btn" >Add Equipment</button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="partner_table" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th style = 'width:3%'>No</th>
                <th style = 'width:15%'>Equipment</th>
                <th style = 'width:10%'>Remarks</th>
                <th style = 'width:10%'></th>
              </tr>
            </thead>
            <tbody>
            <?php   
              $sql = "SELECT p.*,e.equipment_code
                      FROM db_pequipment p
                      LEFT JOIN db_equipment e ON e.equipment_id = p.pequipment_equipment
                      WHERE p.pequipment_project = '$this->project_id'
                      ORDER BY e.equipment_code ";
              $query = mysql_query($sql);
              $i = 1;
              $total = 0;
              while($row = mysql_fetch_array($query)){
                  $total = $total + $row['ordl_ftotal'];
                  if($row['order_revtimes'] > 0){
                      $order_no = $row['order_no'] . " (Rev {$row['order_revtimes']})";
                  }else{
                      $order_no = $row['order_no'];
                  }
            ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row['equipment_code'];?></td>
                    <td><?php echo nl2br($row['pequipment_remarks']);?></td>
                    <td class = "text-align-right">
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                        ?>
                        <a title = 'edit' style = "margin-left:10px;margin-right:10px;font-size:20px;" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" pequipment_id = "<?php echo $row['pequipment_id'];?>" class = "edit_line_equipment font-icon" line = "<?php echo $i;?>" ><i class="fa fa-edit" aria-hidden="true"></i></a>
                        <?php }?>
                        <?php 
                        if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                        ?>
                        <a title = 'delete' style = "margin-left:10px;margin-right:10px;font-size:20px;color:red" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" pequipment_id = "<?php echo $row['pequipment_id'];?>" class = "delete_line_equipment font-icon" line = "<?php echo $i;?>" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        <?php }?>
                    </td>
                </tr>
            <?php    
                $i++;
              }
            ?>

            </tbody>
          </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

    <?php
    }
    
    
    public function workDialogForm(){
        global $language,$lang;
        
        
        
        $subcon_wherestring = " AND partner_issubcon = 1 ";
        $this->subconCrtl = $this->select->getCustomerSelectCtrl(0,'Y',$subcon_wherestring);
        
        $sitecoordinator_wherestring = " AND partner_issitecoordinator = 1 AND partner_status = '1'";
        $this->sitecoordinatorCrtl = $this->select->getCustomerSelectCtrl(0,'Y',$sitecoordinator_wherestring);

    ?>
    <script>        
    $(document).ready(function() {

        
        $('#add_work,#add_work_new').on('click',function(){
            if($(this).attr('id') == 'add_work_new'){
               var isnew = 1;
            }else{
               var isnew = 0;
            }
            var data = "action=createWork&project_id=<?php echo $this->project_id;?>&" + $('#workform').serialize();
             $.ajax({
                type: "POST",
                url: "project.php",  
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    if(jsonObj.status == 1){
                        if($('#pw_id').val() > 0){
                            alert("Update work successfully");
                        }else{
                            alert("Create work successfully");
                        }
                        
                        window.location.href = "<?php echo $this->document_url;?>?action=edit&project_id=<?php echo $this->project_id;?>&tab="+jsonObj.tab+"&isnew="+isnew;
                    }else{
                        alert("Create work fail");
                    }
                }
             });
        });

    });
    </script>
    <div class="modal fade " id="work_model" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id = 'work_modal_title'>Create Work</h4>
              </div>
              <div class="modal-body">
                  <form id = 'workform' class="form-horizontal">
                      <div class="col-sm-12">

                          <div class="form-group">
                            <label for="pwdescription" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-6">
                                <textarea id="pwdescription" name="pwdescription" placeholder="Description" class = 'form-control'></textarea>
                            </div>
                          </div>
                          <div style = 'clear:both' ></div>
                          <div class="form-group">
                            <label for="pwlocation" class="col-sm-3 control-label">Location</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control " id="pwlocation" name="pwlocation" value = "<?php echo $this->pwlocation;?>" placeholder="Location">
                            </div>
                          </div>
                          <div style = 'clear:both' ></div>
                          <div class="form-group">
                            <label for="pwsubcon" class="col-sm-3 control-label">Sub-Con</label>
                            <div class="col-sm-6">
                                 <select style = 'width:100%' class="form-control select2" id="pwsubcon" name="pwsubcon" >
                                     <?php echo $this->subconCrtl;?>
                                 </select>
                            </div>
                          </div>
                          <div style = 'clear:both' ></div>
                                <table id="detail_table" class="table transaction-detail">
                                    <thead>
                                      <tr>
                                        <th class = "" style="width:30px;padding-left:5px">No</th>
                                        <th class = "">Item</th>
                                        <th class = "">Quantity</th>
                                        <th class = "" style="width:80px;"></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <tr id = 'detail_last_tr_clms'></tr>
                                    </tbody>
                                </table>
                      </div>
                      <input type = 'hidden' name = 'pw_id' id = 'pw_id' value = '0'/>
                  </form>
                  <div style = 'clear:both' ></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id = 'add_work' >Add Work</button>
                <button type="submit" class="btn btn-primary" id = 'add_work_new' >Add Work & New</button>
              </div>
            </div>
    </div>
  </div>
    
    
    <?php
    }
    public function claimDialogForm(){
        global $language,$lang;
        
        
        $b = explode(',',$this->project_subcon);
        for($i=0;$i<sizeof($b);$i++){
            $project_subcon .= "'" . $b[$i] . "',";
        }
        $project_subcon = trim($project_subcon,",");
        $subcon_wherestring = " AND partner_issubcon = 1 AND partner_id IN ($project_subcon)";
        $this->subconCrtl = $this->select->getCustomerSelectCtrl(0,'Y',$subcon_wherestring);
        
        $sitecoordinator_wherestring = " AND partner_issitecoordinator = 1 AND partner_status = '1'";
        $this->sitecoordinatorCrtl = $this->select->getCustomerSelectCtrl(0,'Y',$sitecoordinator_wherestring);

    ?>
    <script>        
    $(document).ready(function() {
        <?php if($_REQUEST['isnew'] == 1){?>
            <?php if($_REQUEST['tab'] == 'claim_tab'){?>
                    $('#generate_model').modal('show');
            <?php }else if($_REQUEST['tab'] == 'worker_tab'){?>
                    $('#worker_model').modal('show');
            <?php }?>    
        <?php }?>   
        $('.claim_type').on('click',function(){
            
            if($(this).val() == 'site'){
                $('#claim_site_coordinator').css('display','');
                $('#claim_sub_contractor').css('display','none');
            }else{
                $('#claim_site_coordinator').css('display','none');
                $('#claim_sub_contractor').css('display','');
            }
        });
        
        $('#add_claim,#add_claim_new').on('click',function(){
            if($(this).attr('id') == 'add_claim_new'){
               var isnew = 1;
            }else{
               var isnew = 0;
            }
            var data = "action=createClaim&project_id=<?php echo $this->project_id;?>&" + $('#claimform').serialize();
             $.ajax({
                type: "POST",
                url: "project.php",  
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    if(jsonObj.status == 1){
                        if($('#pclaim_id').val() > 0){
                            alert("Update claim successfully");
                        }else{
                            alert("Create claim successfully");
                        }
                        
                        window.location.href = "<?php echo $this->document_url;?>?action=edit&project_id=<?php echo $this->project_id;?>&tab="+jsonObj.tab+"&isnew="+isnew;
                    }else{
                        alert("Create claim fail");
                    }
                }
             });
        });

    });
    </script>
    <div class="modal fade " id="generate_model" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id = 'claim_modal_title'>Create Claim</h4>
              </div>
              <div class="modal-body">
                  <form id = 'claimform' class="form-horizontal">
                      <div class="col-sm-12">
<!--                          <div class="form-group">
                            <label class="col-sm-3 control-label">Type</label>
                            <div class="col-sm-6">
                                  <div class="checkbox">
                                    <label><input type="radio" class = 'claim_type' name = 'pclaim_type' value="site" checked> Site Coordinator</label>
                                  </div>
                                  <div class="checkbox">
                                    <label><input type="radio" class = 'claim_type' name = 'pclaim_type' value="sub"> Sub - Contractor</label>
                                  </div>
                            </div>
                          </div>
                          <div class="form-group" id = 'claim_site_coordinator' >
                            <label for="pclaim_by_coordinator" class="col-sm-3 control-label">Site Coordinator <?php echo $mandatory;?></label>
                            <div class="col-sm-6">
                                 <select class="form-control select2" id = 'pclaim_by_coordinator' name="pclaim_by_coordinator" style = 'width:100%' >
                                     <?php echo $this->sitecoordinatorCrtl;?>
                                 </select>
                            </div>
                          </div>
                          <div class="form-group" id = 'claim_sub_contractor' style = 'display:none' >
                            <label for="pclaim_by_contractor" class="col-sm-3 control-label">Sub - Contractor <?php echo $mandatory;?></label>
                            <div class="col-sm-6">
                                 <select class="form-control select2" id = 'pclaim_by_contractor' name="pclaim_by_contractor" style = 'width:100%' >
                                     <?php echo $this->subconCrtl;?>
                                 </select>
                            </div>
                          </div>-->
                          <div style = 'clear:both' ></div>
                          <div class="form-group">
                            <label for="pclaim_date" class="col-sm-3 control-label">Date</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control datepicker" id="pclaim_date" name="pclaim_date" value = "<?php echo $this->pclaim_date;?>" placeholder="Date">
                            </div>
                          </div>
                          <div style = 'clear:both' ></div>
                          <div class="form-group">
                            <label for="pclaim_amount" class="col-sm-3 control-label">Claim Amount</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control text-align-right" id="pclaim_amount" name="pclaim_amount" value = "0.00" placeholder="Claim Amount">
                            </div>
                          </div>
                          <div style = 'clear:both' ></div>
                          <div class="form-group">
                            <label for="pclaim_remarks" class="col-sm-3 control-label">Remarks</label>
                            <div class="col-sm-6">
                                <textarea id="pclaim_remarks" name="pclaim_remarks" placeholder="Remarks" class = 'form-control'></textarea>
                            </div>
                          </div>
                      </div>
                      <input type = 'hidden' name = 'pclaim_id' id = 'pclaim_id' value = '0'/>
                  </form>
                  <div style = 'clear:both' ></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id = 'add_claim' >Add Claim</button>
                <button type="submit" class="btn btn-primary" id = 'add_claim_new' >Add Claim & New</button>
              </div>
            </div>
    </div>
  </div>
    
    
    <?php
    }
    public function workersDialogForm(){
        global $language,$lang,$mandatory;
        
        
        $sql = "SELECT pwsubcon FROM db_pw WHERE pw_project_id = '$this->project_id'";
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $project_subcon .= "'" . $row['pwsubcon'] . "',";
        }
        $project_subcon = trim($project_subcon,",");


        $this->subconWorkerCrtl = $this->select->getSubconWorkerSelectCtrl(0,'Y'," AND pe.pempl_partner_id IN ($project_subcon)");

    ?>
    <script>
    $(document).ready(function() {
        $('.claim_type').on('click',function(){
            
            if($(this).val() == 'site'){
                $('#claim_site_coordinator').css('display','');
                $('#claim_sub_contractor').css('display','none');
            }else{
                $('#claim_site_coordinator').css('display','none');
                $('#claim_sub_contractor').css('display','');
            }
        });
        
        $('#add_worker,#add_worker_new').on('click',function(){
            if($('#pempl_id').val() > 0){
                if($(this).attr('id') == 'add_worker_new'){
                   var isnew = 1;
                }else{
                   var isnew = 0;
                }
                var data = "action=createSubconWorker&project_id=<?php echo $this->project_id;?>&" + $('#workerform').serialize();
                 $.ajax({
                    type: "POST",
                    url: "project.php",  
                    data:data,
                    success: function(data) {
                        var jsonObj = eval ("(" + data + ")");
                        alert(jsonObj.msg);
                        if(jsonObj.status == 1){
                            window.location.href = "<?php echo $this->document_url;?>?action=edit&project_id=<?php echo $this->project_id;?>&tab="+jsonObj.tab+"&isnew="+isnew;
                        }
                    }
                 });
             }else{
                alert('Please select worker.');
                return false;
             }
        });

    });
    </script>
    <div class="modal fade " id="worker_model" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create Worker</h4>
              </div>
              <div class="modal-body">
                  <form id = 'workerform' class="form-horizontal">
                      <div class="col-sm-12">

                          <div class="form-group" id = 'claim_site_coordinator' >
                            <label for="pempl_id" class="col-sm-3 control-label">Worker <?php echo $mandatory;?></label>
                            <div class="col-sm-6">
                                 <select class="form-control select2" id = 'pempl_id' name="pempl_id" style = 'width:100%' >
                                     <?php echo $this->subconWorkerCrtl;?>
                                 </select>
                            </div>
                          </div>
                          <div style = 'clear:both' ></div>
                          <div class="form-group">
                            <label for="pworker_remarks" class="col-sm-3 control-label">Remarks</label>
                            <div class="col-sm-6">
                                <textarea id="pworker_remarks" name="pworker_remarks" placeholder="Remarks" class = 'form-control'></textarea>
                            </div>
                          </div>
                      </div>
                      <input type = 'hidden' name = 'pworker_id' id = 'pworker_id' value = '0'/>
                  </form>
                  <div style = 'clear:both' ></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id = 'add_worker' >Add Worker</button>
                <button type="submit" class="btn btn-primary" id = 'add_worker_new' >Add Worker & New</button>
              </div>
            </div>
    </div>
  </div>

    
    <?php
    }
    public function voDialogForm(){
        global $language,$lang;
        
       

    ?>
    <script>        
    $(document).ready(function() {
        $('#add_vo,#add_vo_new').on('click',function(){
            if($(this).attr('id') == 'add_vo_new'){
               var isnew = 1;
            }else{
               var isnew = 0;
            }
            var data = "action=createVO&generate_document_type=PI&project_id=<?php echo $this->project_id;?>&" + $('#voform').serialize();
             $.ajax({
                type: "POST",
                url: "project.php",  
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    if(jsonObj.status == 1){
                        alert("Create vo successfully");
                        window.location.href = "<?php echo $this->document_url;?>?action=edit&project_id=<?php echo $this->project_id;?>&tab="+jsonObj.tab+"&isnew="+isnew;
                    }else{
                        alert("Create vo fail");
                    }
                }
             });
        });

    });
    </script>
    <div class="modal fade " id="vo_model" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create VO</h4>
              </div>
              <div class="modal-body">
                  <form id = 'voform' class="form-horizontal">
                      <div class="col-sm-12">

                          <div class="form-group" id = 'claim_site_coordinator' >
                            <label for="vo_date" class="col-sm-3 control-label">VO Date</label>
                            <div class="col-sm-6">
                               <input type="text" class="form-control datepicker" id="vo_date" name="vo_date" value = "<?php echo $this->vo_date;?>" placeholder="VO Date">
                            </div>
                          </div>
                          <div class="form-group" id = 'claim_sub_contractor'  >
                            <label for="vo_ref" class="col-sm-3 control-label">VO Ref</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control " id="vo_ref" name="vo_ref" value = "<?php echo $this->vo_ref;?>" placeholder="VO Ref">
                            </div>
                          </div>
                          <div style = 'clear:both' ></div>
                          <div class="form-group">
                            <label for="vo_amount" class="col-sm-3 control-label">VO Amount</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control text-align-right" id="vo_amount" name="vo_amount" value = "0.00" placeholder="VO Amount">
                            </div>
                          </div>
                          <div style = 'clear:both' ></div>
                          <div class="form-group">
                            <label for="vo_remarks" class="col-sm-3 control-label">Remarks</label>
                            <div class="col-sm-6">
                                <textarea id="vo_remarks" name="vo_remarks" placeholder="Remarks" class = 'form-control'></textarea>
                            </div>
                          </div>
                      </div>
                      <input type = 'hidden' name = 'vo_id' id = 'vo_id' value = '0'/>
                  </form>
                  <div style = 'clear:both' ></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id = 'add_vo' >Add VO</button>
                <button type="submit" class="btn btn-primary" id = 'add_vo_new' >Add VO & New</button>
              </div>
            </div>
    </div>
  </div>
    
    
    <?php
    }
    public function equipmentDialogForm(){
        global $language,$lang;
        
       $this->equipmentCrtl = $this->select->getEquipmentSelectCtrl(0,'Y',"");

    ?>
    <script>        
    $(document).ready(function() {
        $('#add_equipment,#add_equipment_new').on('click',function(){
            if($(this).attr('id') == 'add_equipment_new'){
               var isnew = 1;
            }else{
               var isnew = 0;
            }
            var data = "action=createEquipment&project_id=<?php echo $this->project_id;?>&" + $('#equipmentform').serialize();
             $.ajax({
                type: "POST",
                url: "project.php",  
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    if(jsonObj.status == 1){
                        if($('#pequipment_id').val() > 0){
                            alert("Update Equipment successfully");
                        }else{
                            alert("Add Equipment successfully");
                        }
                        
                        window.location.href = "<?php echo $this->document_url;?>?action=edit&project_id=<?php echo $this->project_id;?>&tab="+jsonObj.tab+"&isnew="+isnew;
                    }else{
                        if($('#pequipment_id').val() > 0){
                            alert("Update Equipment fail");
                        }else{
                            alert("Add Equipment fail");
                        }
                    }
                }
             });
        });

    });
    </script>
    <div class="modal fade " id="equipment_model" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id = 'add_equipment_title' >Create Equipment</h4>
              </div>
              <div class="modal-body">
                  <form id = 'equipmentform' class="form-horizontal">
                      <div class="col-sm-12">

                          <div class="form-group" >
                            <label for="pequipment_equipment" class="col-sm-3 control-label">Equipment</label>
                            <div class="col-sm-6">
                                 <select style = 'width:100%' class="form-control select2" id="pequipment_equipment" name="pequipment_equipment">
                                   <?php echo $this->equipmentCrtl;?>
                                 </select>
                            </div>
                          </div>
                          <div style = 'clear:both' ></div>
                          <div class="form-group">
                            <label for="pequipment_remarks" class="col-sm-3 control-label">Remarks</label>
                            <div class="col-sm-6">
                                <textarea id="pequipment_remarks" name="pequipment_remarks" placeholder="Remarks" class = 'form-control'></textarea>
                            </div>
                          </div>
                      </div>
                      <input type = 'hidden' name = 'pequipment_id' id = 'pequipment_id' value = '0'/>
                  </form>
                  <div style = 'clear:both' ></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id = 'add_equipment' >Add Equipment</button>
                <button type="submit" class="btn btn-primary" id = 'add_equipment_new' >Add Equipment & New</button>
              </div>
            </div>
    </div>
  </div>
    
    
    <?php
    }
    
    
    public function createWork(){
        $table_field = array('pw_project_id','pwlocation','pwdescription','pwsubcon');
        $table_value = array($this->project_id,$this->pwlocation,$this->pwdescription,$this->pwsubcon);
        
        if($this->pw_id > 0){
            $remark = "Update Project Work.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_pw','pw_id',$remark,$this->pw_id)){
               return false;
            }else{
               return true;
            }
        }else{
            $remark = "Insert Project Work.";
            if(!$this->save->SaveData($table_field,$table_value,'db_pw','pw_id',$remark)){
               return false;
            }else{
               return true;
            }
        }
    }
    public function fetchWorkDetail(){
        
       $sql = "SELECT * FROM db_pw WHERE pw_id = '$this->pw_id'"; 
       $query = mysql_query($sql);
       
       return mysql_fetch_array($query);
    }
    
    public function createClaim(){
        $table_field = array('pclaim_type','pclaim_by','pclaim_date','pclaim_amount',
                             'pclaim_status','pclaim_remarks');
        $table_value = array($this->pclaim_type,$this->pclaim_by,format_date_database($this->pclaim_date),$this->pclaim_amount,
                             1,$this->pclaim_remarks);
        
        if($this->pclaim_id > 0){
            $remark = "Update Project Claim.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_pclaim','pclaim_id',$remark,$this->pclaim_id)){
               return false;
            }else{
               return true;
            }
        }else{
            $remark = "Insert Project Claim.";
            if(!$this->save->SaveData($table_field,$table_value,'db_pclaim','pclaim_id',$remark)){
               return false;
            }else{
               return true;
            }
        }
    }
    public function fetchClaimDetail(){
        
       $sql = "SELECT * FROM db_pclaim WHERE pclaim_id = '$this->pclaim_id'"; 
       $query = mysql_query($sql);
       
       return mysql_fetch_array($query);
    }
    public function createSubconWorker(){
        $table_field = array('pempl_id','pworker_status','pworker_remarks','project_id');
        $table_value = array($this->pempl_id,1,$this->pworker_remarks,$this->project_id);
        
        
        if($this->pworker_id > 0){
            $remark = "Update Project Subcon Worker.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_pworker','pworker_id',$remark,$this->pworker_id)){
               return false;
            }else{
               return true;
            }
        }else{
            $remark = "Insert Project Subcon Worker.";
            if(!$this->save->SaveData($table_field,$table_value,'db_pworker','pworker_id',$remark)){
               return false;
            }else{
               return true;
            }
        }
    }
    public function fetchSubconWorkerDetail(){
        
       $sql = "SELECT * FROM db_pworker WHERE pworker_id = '$this->pworker_id'"; 
       $query = mysql_query($sql);
       
       return mysql_fetch_array($query);
    }
    
    
    public function createVO(){
        $table_field = array('vo_date','vo_ref','vo_amount','vo_remarks');
        $table_value = array(format_date_database($this->vo_date),$this->vo_ref,$this->vo_amount,$this->vo_remarks);
        $remark = "Insert Project VO.";
        if(!$this->save->SaveData($table_field,$table_value,'db_vo','vo_id',$remark)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchVODetail(){
        
       $sql = "SELECT * FROM db_vo WHERE vo_id = '$this->vo_id'";
       $query = mysql_query($sql);
       
       return mysql_fetch_array($query);
    }
    
    
    public function createEquipment(){
        $table_field = array('pequipment_project','pequipment_equipment','pequipment_location','pequipment_remarks');
        $table_value = array($this->project_id,$this->pequipment_equipment,$this->pequipment_location,$this->pequipment_remarks);
       
        
        if($this->pequipment_id > 0){
             $remark = "Update Project Equipment.";
            if(!$this->save->UpdateData($table_field,$table_value,'db_pequipment','pequipment_id',$remark,$this->pequipment_id)){
               return false;
            }else{
               return true;
            }
        }else{
            $remark = "Insert Project Equipment.";
            if(!$this->save->SaveData($table_field,$table_value,'db_pequipment','pequipment_id',$remark)){
               return false;
            }else{
               return true;
            }
        }
    }
    public function fetchEquipmentDetail(){
        
       $sql = "SELECT * FROM db_pequipment WHERE pequipment_id = '$this->pequipment_id'";
       $query = mysql_query($sql);
       
       return mysql_fetch_array($query);
    }
    
    public function deleteSubconWorker(){
        $table_field = array('pworker_status');
        $table_value = array(0);
        $remark = "Delete Project Subcon Worker.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_pworker','pworker_id',$remark,$this->pworker_id)){
           return false;
        }else{
           return true;
        }
    }
    public function deleteProjectClaim(){
        $table_field = array('pclaim_status');
        $table_value = array(0);
        $remark = "Delete Project Subcon Worker.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_pclaim','pclaim_id',$remark,$this->pclaim_id)){
           return false;
        }else{
           return true;
        }
    }
    public function deleteProjectWork(){

        if(!$this->save->DeleteData("db_pw"," WHERE pw_id = '$this->pw_id'")){
           return false;
        }else{
           return true;
        }
    }
    
    
    public function getAttendanceForm(){
        
        $sql = "SELECT pe.pempl_name,p.partner_name
                FROM db_pempl pe 
                INNER JOIN db_partner p ON p.partner_id = pe.pempl_partner_id 
                WHERE pe.pempl_id = '$this->pattendance_pempl'";
        $query = mysql_query($sql);
        if($row = mysql_fetch_array($query)){
            $this->partner_name = $row['partner_name'];
            $this->pempl_name = $row['pempl_name'];
        }
        
        if($this->pattendance_date == ""){
            $this->pattendance_date = system_date;
        }
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Worker Attendance Management</title>
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
      <div class="content-wrapper">
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Worker Attendance Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='project.php?action=edit&project_id=<?php echo $this->pattendance_project;?>&tab=worker_tab'">Back</button>
                <?php }?>
              </div>
                
                <form id = 'project_form' class="form-horizontal" action = 'project.php?action=create' method = "POST">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="project_customer" class="col-sm-1 control-label">Sub-Cons</label>
                          <div class="col-sm-3">
                               <input type="text" class="form-control" value = "<?php echo $this->partner_name;?>" READONLY>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="project_loaref" class="col-sm-1 control-label" >Worker Name</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" value = "<?php echo $this->pempl_name;?>" READONLY>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="pattendance_date" class="col-sm-1 control-label">Work Day <?php echo $mandatory;?></label>
                          <div class="col-sm-3">
                              <input type="text" class="form-control datepicker" id="pattendance_date" name="pattendance_date" value = "<?php echo format_date($this->pattendance_date);?>" placeholder="Work Day" >
                          </div>
                        </div> 
                        <div class="form-group">
                          <label for="pattendance_ina" class="col-sm-1 control-label">Morning</label>
                          <div class="col-sm-3">
                            <input type="checkbox" id="pattendance_ina" name="pattendance_ina" <?php if($this->pattendance_ina == 1){ echo 'CHECKED';}?>>
                          </div>
                        </div>  
                        <div class="form-group">
                          <label for="pattendance_inb" class="col-sm-1 control-label">Afternoon</label>
                          <div class="col-sm-3">
                            <input type="checkbox" id="pattendance_inb" name="pattendance_inb" <?php if($this->pattendance_inb == 1){ echo 'CHECKED';}?>>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="pattendance_inc" class="col-sm-1 control-label">Evening</label>
                          <div class="col-sm-3">
                            <input type="checkbox" id="pattendance_inc" name="pattendance_inc" <?php if($this->pattendance_inc == 1){ echo 'CHECKED';}?>>
                          </div>
                        </div> 
                    <div class="form-group">
                      <label for="pattendance_remarks" class="col-sm-1 control-label">Remarks</label>
                      <div class="col-sm-3">
                            <textarea class="form-control" rows="3" id="pattendance_remarks" name="pattendance_remarks" placeholder="Remarks"><?php echo $this->pattendance_remarks;?></textarea>
                      </div>
                    </div> 
                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "pattendance_create" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->pattendance_pempl;?>" name = "pattendance_pempl" id = "pattendance_pempl"/>
                    <input type = "hidden" value = "<?php echo $this->pattendance_project;?>" name = "pattendance_project" id = "pattendance_project"/>
                    <input type = "hidden" value = "<?php echo $this->pattendance_id;?>" name = "pattendance_id" id = "pattendance_id"/>
                    <?php
                    if($this->project_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
                    <button type = "submit" class="btn btn-info">Submit</button>
                    <?php }?>
                  </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
            
            <div class="box box-success">
                    <div class="box">
                            <div class="box-header">
                              <div class = "pull-left"><h3 class="box-title">Attendance Listing</h3></div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                              <table id="partner_table" class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th style = 'width:3%'>No</th>
                                    <th style = 'width:15%'>Date</th>
                                    <th style = 'width:10%'>Morning</th>
                                    <th style = 'width:10%'>Afternoon</th>
                                    <th style = 'width:10%'>Evening</th>
                                    <th style = 'width:15%'>Remarks</th>
                                    <th style = 'width:10%'>Insert By</th>
                                    <th style = 'width:10%'></th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php   
                                  $sql = "SELECT p.*,e.empl_name
                                          FROM db_pattendance p
                                          LEFT JOIN db_empl e ON empl_id = p.insertBy
                                          WHERE p.pattendance_project = '$this->pattendance_project' AND p.pattendance_pempl = '$this->pattendance_pempl'
                                          ORDER BY p.pattendance_date DESC ";
                                  $query = mysql_query($sql);
                                  $i = 1;
                                  while($row = mysql_fetch_array($query)){
                                ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo format_date($row['pattendance_date']);?></td>
                                        <td><?php if($row['pattendance_ina'] == '1'){ echo 'Y';}else{ echo 'N';}?></td>
                                        <td><?php if($row['pattendance_inb'] == '1'){ echo 'Y';}else{ echo 'N';}?></td>
                                        <td><?php if($row['pattendance_inc'] == '1'){ echo 'Y';}else{ echo 'N';}?></td>
                                        <td><?php echo nl2br($row['pattendance_remarks']);?></td>
                                        <td><?php echo $row['empl_name'];?></td>
                                        <td class = "text-align-right">
                                            <?php 
                                            if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                            ?>
                                            <!--<a title = 'edit' style = "margin-left:10px;margin-right:10px;font-size:20px;" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" pequipment_id = "<?php echo $row['pequipment_id'];?>" class = "edit_line_equipment font-icon" line = "<?php echo $i;?>" ><i class="fa fa-edit" aria-hidden="true"></i></a>-->
                                            <?php }?>
                                            <?php 
                                            if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                            ?>
                                            <a title = 'delete' style = "margin-left:10px;margin-right:10px;font-size:20px;color:red" href = "javascript:void(0)" onclick = "confirmAlertHref('project.php?action=deleteProjectAttendance&pattendance_id=<?php echo $row['pattendance_id'];?>&pattendance_project=<?php echo $this->pattendance_project;?>&pattendance_pempl=<?php echo $this->pattendance_pempl;?>','Confirm Delete?')" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php    
                                    $i++;
                                  }
                                ?>

                                </tbody>
                              </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
            </div><!-- /.box -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    
    ?>
    <script>
    $(document).ready(function() {

             
             
    });
    </script>
    <?php 
    echo $this->claimDialogForm();
    echo $this->workersDialogForm();
    echo $this->voDialogForm();
    echo $this->equipmentDialogForm();
    ?>
  </body>
</html>
<?php    
    }
    public function createProjectAttendance(){
        $table_field = array('pattendance_pempl','pattendance_ina','pattendance_inb',
                             'pattendance_inc','pattendance_project',
                             'pattendance_date','pattendance_remarks');
        $table_value = array($this->pattendance_pempl,$this->pattendance_ina,$this->pattendance_inb,
                             $this->pattendance_inc,$this->pattendance_project,
                             format_date_database($this->pattendance_date),$this->pattendance_remarks);
        $remark = "Insert Project Attendance";
        if(!$this->save->SaveData($table_field,$table_value,'db_pattendance','pattendance_id',$remark)){
           return false;
        }else{
           $this->pattendance_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function updateProjectAttendance(){
        $table_field = array('pattendance_pempl','pattendance_ina','pattendance_inb',
                             'pattendance_inc',
                             'pattendance_date','pattendance_remarks');
        $table_value = array($this->pattendance_pempl,$this->pattendance_ina,$this->pattendance_inb,
                             $this->pattendance_inc,
                             format_date_database($this->pattendance_date),$this->pattendance_remarks);
        $remark = "Update Project Attendance.";
        if(!$this->save->UpdateData($table_field,$table_value,'db_pattendance','pattendance_id',$remark,$this->pattendance_id)){
           return false;
        }else{
           return true;
        }
    }
    public function fetchProjectAttendanceDetail($wherestring,$orderstring,$wherelimit,$type){
        $sql = "SELECT p.*
                FROM db_pattendance p
                WHERE p.pattendance_id > 0  $wherestring $orderstring $wherelimit";
        $query = mysql_query($sql);
        if($type > 0){
            $row = mysql_fetch_array($query);
            $this->pattendance_id = $row['pattendance_id'];
            $this->pattendance_ina = $row['pattendance_ina'];
            $this->pattendance_outa = $row['pattendance_outa'];
            $this->pattendance_inb = $row['pattendance_inb'];
            $this->pattendance_outb = $row['pattendance_outb'];
            $this->pattendance_inc = $row['pattendance_inc'];
            $this->pattendance_outc = $row['pattendance_outc'];
            $this->pattendance_project = $row['pattendance_project'];
            $this->pattendance_date = $row['pattendance_date'];
            $this->pattendance_remarks = $row['pattendance_remarks'];
        }
        return $query;
    }
    public function deleteProjectAttendance(){

        if(!$this->save->DeleteData('db_pattendance'," WHERE pattendance_id = '$this->pattendance_id'","")){
           return false;
        }else{
           return true;
        }
    }
    
    
    public function getProjectWorkLine(){
        $sql = "SELECT * FROM db_pwl WHERE pwl_id > 0 AND pwl_pw_id = '$this->pw_id' AND pwl_pw_id > 0 ORDER BY insertDateTime DESC";
        $query = mysql_query($sql);
        $html = "";
        $line = 0;
        while($row = mysql_fetch_array($query)){
            $line++;

            $ProjectQuotationItemsCtrl = $this->select->getProjectQuotationItemsSelectCtrl($row['pwl_ordl_id'],'Y'," AND o.order_project_id = '$this->project_id'");
            $pwl_id = $row['pwl_id'];
            
            $html .= "<tr id = 'line_$line' class='tbl_grid_odd clms_tr' line = '$line'>";
            $html .= "<td style = 'width:15px;padding-left:5px'>$line</td>";
            $html .= "<td style = 'width:220px;'><select style = 'width:100%' id = 'pwl_item_$line' class='form-control select2'>$ProjectQuotationItemsCtrl</select></td>";
            $html .= "<td style = 'width:60px;'><input type = 'text' id = 'pwl_qty_$line' class='form-control text-align-right' value = '" . num_format($row['pwl_qty']) . "'/></td>";
            $html .= "<td align = 'center' style ='vertical-align:top;width:80px;padding-right:10px;padding-left:5px'>";
            $html .= "<img id = 'save_line_$line' pwl_id = '$pwl_id' clmd_id = '$this->clmd_id' class = 'save_line_pwl' line = '$line' src = 'dist/img/update.png' style = 'cursor:pointer' alt = 'Update'/>";
            $html .= "<img id = 'delete_line_$line' pwl_id = '$pwl_id' clmd_id = '$this->clmd_id' class = 'delete_line_pwl' line = '$line' src = 'dist/img/delete_icon.png' style = 'cursor:pointer' alt = 'Delete'/>";
            $html .= "</td></tr>";
        }
        $ProjectQuotationItemsCtrl = $this->select->getProjectQuotationItemsSelectCtrl("",'Y'," AND o.order_project_id = '$this->project_id'");
        $line = $line + 1;
        $html .= "<tr id = 'line_$line' class='tbl_grid_odd clms_tr' line = ''>";
        $html .= "<td style = 'width:15px;padding-left:5px'>$line</td>";
        $html .= "<td style = 'width:220px;'><select style = 'width:100%' id = 'pwl_item_$line' class='form-control select2'>$ProjectQuotationItemsCtrl</select></td>";
        $html .= "<td style = 'width:60px;'><input type = 'text' id = 'pwl_qty_$line' class='form-control text-align-right' value=''/></td>";
        $html .= "<td align = 'center' class = '' style ='vertical-align:top;width:80px;padding-right:10px;padding-left:5px'>";
        $html .= "<img id = 'save_line_$line' pwl_id = '' class = 'save_line_pwl' line = '$line' src = 'dist/img/add.png' style = 'cursor:pointer' alt = 'Add New'/>";

        return $html;
    }
    public function createWorkLine(){

        $table_field = array('pw_project_id','pw_pwlocation','pw_labour','pw_qty','pw_subcon','pw_remarks',
                             'pw_proaward_id');
        $table_value = array($this->project_id,$this->pw_pwlocation,$this->pw_labour,$this->pw_qty,$this->pw_subcon,$this->pw_remarks,
                             $this->pw_proaward_id);

        if(!$this->save->SaveData($table_field,$table_value,'db_pw','pw_id',$remark)){
           return false;
        }else{
           $this->pw_id = $this->save->lastInsert_id;
           return true;
        }
    }
    public function updateWorkLine(){
        $table_field = array('pw_pwlocation','pw_labour','pw_qty','pw_subcon','pw_remarks','pw_proaward_id');
        $table_value = array($this->pw_pwlocation,$this->pw_labour,$this->pw_qty,$this->pw_subcon,$this->pw_remarks,$this->pw_proaward_id);
        if(!$this->save->UpdateData($table_field,$table_value,'db_pw','pw_id',$remark,$this->pw_id)){
           return false;
        }else{
           return true;
        }
    }
    public function viewAwardedItem(){
    ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Awarded Items Management</title>
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
      <div class="content-wrapper">
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Awarded Items Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'margin-right:10px;' onclick = "window.location.href='project.php?action=edit&project_id=<?php echo $this->project_id;?>&tab=worker_tab'">Back to project management</button>
                <?php }?>
              </div>
                
                <form id = 'project_form' class="form-horizontal" action = 'project.php?action=create&project_id=<?php echo $this->project_id;?>' method = "POST">
                  <div class="box-body">
                      
                      <?php
                        $sql = "SELECT ordl.ordl_pro_no,ordl.ordl_qty,u.uom_code,ordl.ordl_id,p.proaward_ordl_qty
                            FROM db_order o
                            INNER JOIN db_ordl ordl ON ordl.ordl_order_id = o.order_id
                            LEFT JOIN db_uom u ON u.uom_id = ordl.ordl_uom
                            LEFT JOIN db_proaward p ON p.proaward_ordl_id = ordl.ordl_id AND p.proaward_project = o.order_project_id
                            WHERE o.order_project_id = '$this->project_id' AND o.order_status = '2'";
                      $query = mysql_query($sql);
                      $i = 0;
                      while($row = mysql_fetch_array($query)){
                      $p = 0;
                      if($this->islockaward == true){
                          $proaward_ordl_qty = $row['proaward_ordl_qty'];
                      }else{
                          $proaward_ordl_qty = $row['ordl_qty'];
                      }
                      
                      ?>
                        <div class="form-group">
                          <label for="project_customer" class="col-sm-2 control-label" style = 'text-align:left'>Item : </label>
                          <div class="col-sm-10">
                              <label for="project_customer" class="col-sm-12 control-label" style = 'text-align:left' ><?php echo $row['ordl_pro_no'];?></label>
                          </div>
                          <label for="project_customer" class="col-sm-2 control-label" style = 'text-align:left'>Quotation Quantity : </label>
                          <div class="col-sm-10">
                              <label for="project_customer" class="col-sm-12 control-label" style = 'text-align:left' ><?php echo $row['ordl_qty'] . " " . $row['uom_code'];?></label>
                          </div>
                          <label for="project_customer" class="col-sm-2 control-label" style = 'text-align:left'>Award Quantity : </label>
                          <div class="col-sm-10">
                              <div class="col-sm-12">
                                <input type = "text"  <?php if($this->islockaward == true){ echo 'DISABLED';}?> name = "award_qty[]" value = "<?php echo $proaward_ordl_qty; ?>"/><?php echo " " . $row['uom_code'];?>
                                <input type = "hidden"  name = "award_ordl_id[]" value = "<?php echo $row['ordl_id'] ?>"/>
                              </div>
                          </div>
                        </div>
                      <?php
                      $i++;
                      }
                      ?>
<!--                    <div class="form-group">
                      <label for="pattendance_remarks" style = 'text-align:left' class="col-sm-2 control-label">Remarks</label>
                      <div class="col-sm-10">
                          <div class="col-sm-12">
                            <textarea class="form-control" rows="3" id="pattendance_remarks" name="pattendance_remarks" placeholder="Remarks"><?php echo $this->pattendance_remarks;?></textarea>
                          </div>
                      </div>
                    </div> -->
                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    &nbsp;&nbsp;&nbsp;
                    <?php if($this->islockaward == true){?>
                    <input type = "hidden" value = "unlock_award_items" name = "action"/>
                    <?php }else{?>
                    <input type = "hidden" value = "lock_award_items" name = "action"/>
                    <?php }?>
                    <input type = "hidden" value = "<?php echo $this->pattendance_pempl;?>" name = "pattendance_pempl" id = "pattendance_pempl"/>
                    <input type = "hidden" value = "<?php echo $this->pattendance_project;?>" name = "pattendance_project" id = "pattendance_project"/>
                    <input type = "hidden" value = "<?php echo $this->pattendance_id;?>" name = "pattendance_id" id = "pattendance_id"/>
                    <?php
                    if($this->project_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
                    <button type = "submit" class="btn btn-info">
                        <?php if($this->islockaward == true){?>
                        Un-Lock
                        <?php }else{?>
                        Lock
                        <?php }?>
                    </button>
                    <?php }?>
                  </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
            
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    
    ?>
    <script>
    </script>

  </body>
</html>
<?php   
    }
    public function viewSubconItem(){
    ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Subcon File Management</title>
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
      <div class="content-wrapper">
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Subcon File Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'margin-right:10px;' onclick = "window.location.href='project.php?action=edit&project_id=<?php echo $this->project_id;?>&tab=worker_tab'">Back to project management</button>
                <?php }?>
              </div>
                
                <form id = 'project_form' class="form-horizontal" action = 'project.php?action=create' method = "POST">
                  <div class="box-body">
                      
                      <?php
                      $sql = "SELECT ordl.ordl_id,ordl.ordl_pro_no,ordl.ordl_qty,u.uom_code,ordl.ordl_id,ordl.ordl_pro_id,pa.proaward_ordl_qty,pa.proaward_id
                              FROM db_proaward pa
                              INNER JOIN db_ordl ordl ON ordl.ordl_id = pa.proaward_ordl_id
                              LEFT JOIN db_uom u ON u.uom_id = ordl.ordl_uom
                              WHERE pa.proaward_project = '$this->project_id'";
                      $query = mysql_query($sql);
                      $i = 1;
                      while($row = mysql_fetch_array($query)){
                      $p = 0;
                      $p++;
                      $proaward_ordl_qty = $row['proaward_ordl_qty'];
                      ?>
                        <div class="form-group" >
                          <label for="project_customer" class="col-sm-2 control-label" style = 'text-align:left'>Item : </label>
                          <div class="col-sm-10">
                              <label for="project_customer" class="col-sm-12 control-label" style = 'text-align:left' ><?php echo $row['ordl_pro_no'];?></label>
                          </div>
                          <label for="project_customer" class="col-sm-2 control-label" style = 'text-align:left'>Award Quantity : </label>
                          <div class="col-sm-10">
                              <label for="project_customer" class="col-sm-12 control-label" style = 'text-align:left' ><?php echo $proaward_ordl_qty . " " . $row['uom_code'];?></label>
                          </div>
                          <div class="col-sm-12" style = 'margin-top:5px;' >
                              <table class="table transaction-detail" >
                                  <tr>
                                      <th>No.</th>
                                      <th>Location</th>
                                      <th>Labour</th>
                                      <th>Qty</th>
                                      <th>Subcon</th>
                                      <th>Remarks</th>
                                      <th></th>
                                  </tr>
                                  <?php 
                                  $sql2 = "SELECT * FROM db_pw WHERE pw_proaward_id = '{$row['proaward_id']}'";
                                  $query2 = mysql_query($sql2);
                                  $k = 0;
                                  while($row2 = mysql_fetch_array($query2)){
                                    $k++;
                                    $subconCrtl = $this->select->getCustomerSelectCtrl($row2['pw_subcon'],'Y'," AND partner_issubcon = '1'");
                                    $itemlabourCrtl = $this->select->getProductLabourSelectCtrl($row2['pw_labour'],'Y'," AND p.prolabour_product_id = '{$row['ordl_pro_id']}' ");
                                  ?>
                                        <tr id = "line_<?php echo $row['proaward_id']?>_<?php echo $k;?>" class="tbl_grid_odd" line = "<?php echo $k;?>">
                                            <td style = "width:30px;padding-left:5px"><?php echo $k;?></td>
                                            <td style = "width:150px;"><input type = "text" id = "pw_pwlocation_<?php echo $row['proaward_id']?>_<?php echo $k;?>" class="form-control" value="<?php echo $row2['pw_pwlocation'];?>"/></td>
                                            <td style = "width:150px;"><select style = "width:100%" id = "pw_labour_<?php echo $row['proaward_id']?>_<?php echo $k;?>" class="form-control "><?php echo $itemlabourCrtl;?></select></td>
                                            <td style = "width:80px;"><input type = "text" id = "pw_qty_<?php echo $row['proaward_id']?>_<?php echo $k;?>" class="form-control" value="<?php echo $row2['pw_qty'];?>"/></td>
                                            <td style = "width:150px;"><select style = "width:100%" id = "pw_subcon_<?php echo $row['proaward_id']?>_<?php echo $k;?>" class="form-control "><?php echo $subconCrtl;?></select></td>
                                            <td style = "width:150px;"><textarea id = "pw_remarks_<?php echo $row['proaward_id']?>_<?php echo $k;?>" class="form-control"><?php echo $row2['pw_remarks'];?></textarea></td>
                                            <td align = "center" class = "" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">
                                            <input type = "hidden" id = "pw_proaward_id_<?php echo $row['proaward_id']?>_<?php echo $k;?>" value = "<?php echo $row['proaward_id'];?>"/>
                                            <img id = "save_line_<?php echo $k;?>" pw_id = "<?php echo $row2['pw_id'];?>" class = "save_line" proaward_id = "<?php echo $row['proaward_id'];?>" line = "<?php echo $k;?>" src = "dist/img/update.png" style = "cursor:pointer" alt = "Update"/>
                                            <img id = "delete_line_<?php echo $k;?>" pw_id = "<?php echo $row2['pw_id'];?>" class = "delete_line" proaward_id = "<?php echo $row['proaward_id'];?>" line = "<?php echo $k;?>" src = "dist/img/delete_icon.png" style = "cursor:pointer" alt = "Delete"/>
                                            </td>
                                        </tr> 
                                  <?php
                               
                                  }
                                  ?>
                                  <tr totalline = "<?php echo $p;?>" class = "proaward_hidden_class" proaward_id = "<?php echo $row['proaward_id'];?>" item_id = "<?php echo $row['ordl_pro_id'];?>" item_id = "<?php echo $row['ordl_pro_id'];?>" id = 'detail_last_tr_<?php echo $row['proaward_id'];?>'></tr>
                              </table>
                              <input type = 'hidden' id = 'total_line_<?php echo $row['proaward_id'];?>' value = '<?php echo $k;?>'/>
                          </div>
                        </div>
                      <?php
                      $i++;
                      }
                      ?>

                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "pattendance_create" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->pattendance_pempl;?>" name = "pattendance_pempl" id = "pattendance_pempl"/>
                    <input type = "hidden" value = "<?php echo $this->pattendance_project;?>" name = "pattendance_project" id = "pattendance_project"/>
                    <input type = "hidden" value = "<?php echo $this->pattendance_id;?>" name = "pattendance_id" id = "pattendance_id"/>
                    <?php
                    if($this->project_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
                    <!--<button type = "submit" class="btn btn-info">Submit</button>-->
                    <?php }?>
                  </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
            
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    $this->subconCrtl = $this->select->getCustomerSelectCtrl("",'Y'," AND partner_issubcon = '1'");
    ?>
    <script>
        
    var line_copy = '<tr id = "line_@b_@i" class="tbl_grid_odd" line = "@i">' +
                    '<td style = "width:30px;padding-left:5px">@i</td>' + 
                    '<td style = "width:150px;"><input type = "text" id = "pw_pwlocation_@b_@i" class="form-control" value=""/></td>'+
                    '<td style = "width:150px;"><select style = "width:100%" id = "pw_labour_@b_@i" class="form-control "></select></td>'+
                    '<td style = "width:80px;"><input type = "text" id = "pw_qty_@b_@i" class="form-control" value=""/></td>' + 
                    '<td style = "width:150px;"><select style = "width:100%" id = "pw_subcon_@b_@i" class="form-control "><?php echo $this->subconCrtl;?></select></td>'+
                    '<td style = "width:150px;"><textarea id = "pw_remarks_@b_@i" class="form-control"></textarea></td>'+
                    '<td align = "center" class = "" style ="vertical-align:top;width:80px;padding-right:10px;padding-left:5px">' +
                    '<input type = "hidden" id = "pw_proaward_id_@b_@i" value = ""/>' + 
                    '<img id = "save_line_@i" pw_id = "" class = "save_line" proaward_id = "@b" line = "@i" src = "dist/img/add.png" style = "cursor:pointer" alt = "Add New"/>' + 
                    '<img id = "delete_line_@i" pw_id = "" class = "delete_line" proaward_id = "@b" line = "@i" src = "dist/img/delete_icon.png" style = "cursor:pointer" alt = "Delete"/>' + 
                    '</td>'+
                    '</tr>';  
    $(document).ready(function() {
        addline("All");         

        $('.save_line').on('click',function(){
            saveline($(this).attr('line'),$(this).attr('pw_id'),$(this).attr('proaward_id'));
        });
    });
    var issend = false;
    function saveline(line,pw_id,proaward_id){
        if(issend){
            alert("Please wait..");
            return false;
        }

        issend = true;
        if(pw_id != ""){
            var action = 'updatepwlline';
        }else{
            var action = 'savepwlline';
        }
        var data = "ordl_seqno="+$('#ordl_seqno_' + proaward_id + '_'+line).val();
            data += "&pw_pwlocation="+$('#pw_pwlocation_' + proaward_id + '_'+line).val();
            data += "&pw_labour="+$('#pw_labour_' + proaward_id + '_'+line).val();
            data += "&pw_remarks="+encodeURIComponent($('#pw_remarks_' + proaward_id + '_'+line).val());
            data += "&pw_qty="+$('#pw_qty_' + proaward_id + '_'+line).val();
            data += "&pw_subcon="+$('#pw_subcon_' + proaward_id + '_'+line).val();
            data += "&pw_proaward_id="+$('#pw_proaward_id_' + proaward_id + '_'+line).val();
            data += "&project_id=<?php echo $this->project_id;?>";
            data += "&action="+action;
            data += "&pw_id="+pw_id;

        $.ajax({ 
            type: 'POST',
            url: 'project.php',
            cache: false,
            data:data,
            error: function(xhr) {
                alert("System error.");
                issend = false;
            },
            success: function(data) {
               var jsonObj = eval ("(" + data + ")");
               if(jsonObj.status == 1){
                   window.location.reload();
               }else{
                   alert(jsonObj.msg);
               }
               issend = false;
            }		
         });
         return false;
    }
    function addline(line){
        if(line == 'All'){
            var e = 1;
            $('.proaward_hidden_class').each(function(){
                var proaward_id = $(this).attr('proaward_id');
                var item_id = $(this).attr('item_id');
                var total_line = parseInt($('#total_line_' + proaward_id).val());
                total_line = parseInt($('#total_line_' + proaward_id).val()) + parseInt(1);
//                for(var i=1;i<=total_line;i++){
                    var addlinevalue = total_line;
                    var nextvalue = parseInt(addlinevalue);
                    var newline = line_copy.replace(/@i/g,nextvalue);
                        newline = newline.replace(/@b/g,proaward_id);
                  
                    $('#detail_last_tr_' + proaward_id).before(newline);
                    $('#total_line').val(nextvalue);


//alert(total_line);

                    $('#pw_proaward_id_' + proaward_id + '_' + total_line).val(proaward_id);
                    getItemLabour(item_id,nextvalue,proaward_id);
//                }
                e++;
            });
           
            return false;
            var total_line = "<?php echo $i;?>";
            for(var i=0;i<total_line;i++){
                var addlinevalue = $('#total_line_'+i).val();
                var nextvalue = parseInt(addlinevalue)+1;
                var newline = line_copy.replace(/@i/g,nextvalue);
                $('#detail_last_tr_'+i).before(newline);
                $('#total_line').val(nextvalue);
                
               
                
                
                $('#pw_proaward_id_'+parseInt(i+1)).val($('#detail_last_tr_'+i).attr('proaward_id'));
                getItemLabour($('#detail_last_tr_'+i).attr('item_id'),i);
            }
        }else{
            var addlinevalue = $('#total_line').val();
            var nextvalue = parseInt(addlinevalue)+1;
            var newline = line_copy.replace(/@i/g,nextvalue);
            $('#detail_last_tr').before(newline);
            $('#total_line').val(nextvalue);
            $('#ordl_seqno_'+nextvalue).val(nextvalue*10);
        }

    }
    function getItemLabour(item_id,line,proaward_id){
        var data = "action=getItemLabour&product_id=" + item_id;
         $.ajax({
            type: "POST",
            url: "product.php",      
            data:data,
            success: function(data) {
                var jsonObj = eval ("(" + data + ")");
                $('#pw_labour_' + proaward_id + '_'+line).html(jsonObj.itemlabour);
            }
         });
    }
    </script>

  </body>
</html>
<?php   
    }
    
    public function lock_award_items(){

        for($i=0;$i<sizeof($_POST['award_ordl_id']);$i++){
            $proaward_ordl_id = $_POST['award_ordl_id'][$i];
            $proaward_ordl_qty = $_POST['award_qty'][$i];
            
            $table_field = array('proaward_project','proaward_ordl_id','proaward_ordl_qty');
            $table_value = array($this->project_id,$proaward_ordl_id,$proaward_ordl_qty);
            $remark = "Insert Project's award items";
            $this->save->SaveData($table_field,$table_value,'db_proaward','proaward_id',$remark);
            
        }
        return true;
    }
    public function unlock_award_items(){

        if(!$this->save->DeleteData("db_proaward"," WHERE proaward_project = '$this->project_id'")){
           return false;
        }else{
           return true;
        }
        return true;
    }
    public function uploadpictureform(){
        
        $sql = "SELECT pe.pempl_name,p.partner_name
                FROM db_pempl pe 
                INNER JOIN db_partner p ON p.partner_id = pe.pempl_partner_id 
                WHERE pe.pempl_id = '$this->pattendance_pempl'";
        $query = mysql_query($sql);
        if($row = mysql_fetch_array($query)){
            $this->partner_name = $row['partner_name'];
            $this->pempl_name = $row['pempl_name'];
        }
        
        if($this->pattendance_date == ""){
            $this->pattendance_date = system_date;
        }
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Upload Picture Form Management</title>
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
      <div class="content-wrapper">
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Upload Picture Form Management</h1>
        </section>
          <!-- Main content -->
          <section class="content">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title"></h3>
                <?php if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'create')){?>
                <button type = "button" class="btn btn-primary pull-right" style = 'width:150px;margin-right:10px;' onclick = "window.location.href='project.php?action=edit&project_id=<?php echo $this->pattendance_project;?>&tab=worker_tab'">Back</button>
                <?php }?>
              </div>
                
                <form id = 'project_form' class="form-horizontal" action = 'project.php?action=create' method = "POST" enctype="multipart/form-data">
                  <div class="box-body">
                        <div class="form-group">
                          <label for="project_file" class="col-sm-1 control-label">Picture</label>
                          <div class="col-sm-3">
                               <input type="file"  name = "project_file" >
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="project_file_remarks" class="col-sm-1 control-label">Remarks</label>
                          <div class="col-sm-3">
                                <textarea class="form-control" rows="3" id="project_file_remarks" name="project_file_remarks" placeholder="Remarks"><?php echo $this->project_file_remarks;?></textarea>
                          </div>
                        </div> 
                  </div><!-- /.box-body -->
                  
                  <div class="box-footer">
                    &nbsp;&nbsp;&nbsp;
                    <input type = "hidden" value = "project_file" name = "action"/>
                    <input type = "hidden" value = "<?php echo $this->project_id;?>" name = "project_id" id = "project_id"/>
                    <input type = "hidden" value = "<?php echo $this->project_file_id;?>" name = "project_file_id" id = "project_file_id"/>
                    <?php
                    if($this->project_file_id > 0){
                        $prm_code = "update";
                    }else{
                        $prm_code = "create";
                    }
                    if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],$prm_code)){
                    ?>
                    <button type = "submit" class="btn btn-info">Submit</button>
                    <?php }?>
                  </div><!-- /.box-footer -->
                </form>
            </div><!-- /.box -->
            
            <div class="box box-success">
                    <div class="box">
                            <div class="box-header">
                              <div class = "pull-left"><h3 class="box-title">Project Files Listing</h3></div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                              <table id="partner_table" class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th style = 'width:3%'>No</th>
                                    <th style = 'width:15%'></th>
                                    <th style = 'width:10%'>Remarks</th>
                                    <th style = 'width:10%'>Insert By</th>
                                    <th style = 'width:10%'></th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php   
                                  $sql = "SELECT i.*,e.empl_name
                                          FROM db_image i
                                          LEFT JOIN db_empl e ON e.empl_id = i.insertBy
                                          WHERE i.ref_table = 'db_project' AND i.ref_id = '$this->project_id'
                                          ORDER BY i.insertDateTime DESC ";
                                  $query = mysql_query($sql);
                                  $i = 1;
                                  while($row = mysql_fetch_array($query)){
                                ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo "<a href = 'upload/PROJECT/{$row['image_id']}.{$row['image_type']}' target = '_blank' ><img style = 'width:300px;height:300px;' title = '{$row['image']}' src = 'upload/PROJECT/{$row['image_id']}.{$row['image_type']}'/></a>";?></td>
                                        <td><?php echo nl2br($row['image_remarks']);?></td>
                                        <td><?php echo $row['empl_name'];?></td>
                                        <td class = "text-align-right">
                                            <?php 
                                            if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'update')){
                                            ?>
                                            <!--<a title = 'edit' style = "margin-left:10px;margin-right:10px;font-size:20px;" href = "javascript:void(0)" id = "delete_line_<?php echo $i;?>" pequipment_id = "<?php echo $row['pequipment_id'];?>" class = "edit_line_equipment font-icon" line = "<?php echo $i;?>" ><i class="fa fa-edit" aria-hidden="true"></i></a>-->
                                            <?php }?>
                                            <?php 
                                            if(getWindowPermission($_SESSION['m'][$_SESSION['empl_id']],'delete')){
                                            ?>
                                            <a title = 'delete' style = "margin-left:10px;margin-right:10px;font-size:20px;color:red" href = "javascript:void(0)" onclick = "confirmAlertHref('project.php?action=deletepicture&image_id=<?php echo $row['image_id'];?>&project_id=<?php echo $this->project_id;?>&image_type=<?php echo $row['image_type'];?>','Confirm Delete?')" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php    
                                    $i++;
                                  }
                                ?>

                                </tbody>
                              </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
            </div><!-- /.box -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include_once 'footer.php';?>
    </div><!-- ./wrapper -->
    <?php
    include_once 'js.php';
    
    ?>
    <script>
    $(document).ready(function() {

             
             
    });
    </script>
    <?php 
    echo $this->claimDialogForm();
    echo $this->workersDialogForm();
    echo $this->voDialogForm();
    echo $this->equipmentDialogForm();
    ?>
  </body>
</html>
<?php    
    }
    public function createProjectFiles(){

        if(!file_exists("upload/PROJECT")){
           mkdir("upload/PROJECT/");
        }

        if($_FILES['project_file']['size'] > 0 ){
            $type = end(explode(".",$_FILES['project_file']['name']));
            $table_field = array('ref_table','ref_id','image','status','upload_field','image_type','image_remarks');
            $table_value = array("db_project",$this->project_id,$_FILES['project_file']['name'],1,1,$type,$this->project_file_remarks);
            $remark = "Insert db_project's attachment.";
            if($this->save->SaveData($table_field,$table_value,'db_image','image_id',$remark)){
                $image_id = $this->save->lastInsert_id;
                move_uploaded_file($_FILES['project_file']['tmp_name'],"upload/PROJECT/$image_id.$type");
            }
            return true;
        }else{
            return false;
        }
    }
    public function deletepicture(){
        if(!$this->save->DeleteData("db_image"," WHERE image_id = '$this->image_id'")){
           return false;
        }else{
            unlink("upload/PROJECT/$this->image_id.$this->image_type");
           return true;
        }  
    }
}
?>
