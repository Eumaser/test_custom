<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SelectControl
 *
 * @author jason
 */
class SelectControl {
    public function SelectControl(){
     
    }
    public function getBrandSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT brand_id,brand_code from db_brand WHERE (brand_id = '$pid' or brand_id >0) and brand_status = 1 $wherestring
                ORDER BY brand_seqno,brand_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['brand_id'];
            $code = $row['brand_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getProductTypeSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT producttype_id,producttype_code from db_producttype WHERE (producttype_id = '$pid' or producttype_id >0) and producttype_status = 1 $wherestring
                ORDER BY producttype_seqno,producttype_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['producttype_id'];
            $code = $row['producttype_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getShipTermSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT shipterm_id,shipterm_code from db_shipterm WHERE (shipterm_id = '$pid' or shipterm_id >0) and shipterm_status = 1 $wherestring
                ORDER BY shipterm_seqno,shipterm_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['shipterm_id'];
            $code = $row['shipterm_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getCustomerSelectCtrl($pid,$shownull="Y",$wherestring='',$ismulti){
        $sql = "SELECT partner_id,partner_code,partner_name,partner_name_cn,partner_name_thai from db_partner WHERE (partner_id = '$pid' or partner_id >0) and partner_status = 1 $wherestring
                ORDER BY partner_seqno,partner_code ASC";
        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['partner_id'];
            $code = $row['partner_code'];
            
            if(($_SESSION['empl_language'] == "chinese") && ($row['partner_name_cn'] != "")){//taiwan
                $code = $code . " - " . $row['partner_name_cn'];
            }else if(($_SESSION['empl_language'] == "thai") && ($row['partner_name_thai'] != "")){//thailand
                $code = $code . " - " . $row['partner_name_thai'];
            }else{
                $code = $code . " - " . $row['partner_name'];
            }
            
            if($ismulti != ""){
                $b = explode(',',$pid);
                if(in_array($id, $b)){
                    $selected = "SELECTED = 'SELECTED'";
                }else{
                    $selected = "";
                }          

            }else{
                if($id == $pid){
                    $selected = "SELECTED = 'SELECTED'";
                }else{
                    $selected = "";
                }
            }

            $selectctrl .='<option value = "' . $id . '"' . $selected . ' >' . $code . '</option>'; 
        }
       
        return $selectctrl;
    }
    public function getGroupSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT group_id,group_code from db_group WHERE (group_id = '$pid' or group_id >0) and group_status = 1 $wherestring
                ORDER BY group_seqno,group_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['group_id'];
            $code = $row['group_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }

        return $selectctrl;
    }
    public function getMenuSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT * from db_menu WHERE (menu_id = '$pid' or menu_id >0) and menu_status = 1 $wherestring
                ORDER BY menu_seqno,menu_name ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['menu_id'];
            $code = $row['menu_name'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }

        return $selectctrl;
    }
    public function getOutletSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT outl_id,outl_code from db_outl WHERE (outl_id = '$pid' or outl_id >0) and outl_status = 1 $wherestring
                ORDER BY outl_seqno,outl_code ASC";

        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['outl_id'];
            $code = $row['outl_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getCprofileSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT cprofile_id,cprofile_name from db_cprofile WHERE (cprofile_id = '$pid' or cprofile_id >0) $wherestring
                ORDER BY cprofile_name ASC";

        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['cprofile_id'];
            $code = $row['cprofile_name'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getCurrencySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT currency_id,currency_code from db_currency WHERE (currency_id = '$pid' or currency_id >0) and currency_status = 1 $wherestring
                ORDER BY currency_seqno,currency_code ASC";

        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['currency_id'];
            $code = $row['currency_code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    public function getAccountSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT cacc_id,CONCAT(cacc_code,' - ',cacc_name) as cacc_code from db_cacc WHERE (cacc_id = '$pid' or cacc_id >0) and cacc_status = 1 $wherestring
                ORDER BY cacc_seqno,cacc_code ASC";

        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['cacc_id'];
            $code = $row['cacc_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getIndustrySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT industry_id,industry_code from db_industry WHERE (industry_id = '$pid' or industry_id >0) and industry_status = 1 $wherestring
                ORDER BY industry_seqno,industry_code ASC";

        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['industry_id'];
            $code = $row['industry_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getContactSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT contact_id,contact_name from db_contact WHERE (contact_id = '$pid' or contact_id >0) and contact_status = 1 $wherestring
                ORDER BY contact_seqno,contact_name ASC";

        if($shownull =="Y"){
            $selectctrl ="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['contact_id'];
            $code = $row['contact_name'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "'.$id.'" '.$selected.'>'.$code.'</option>'; 
        }
        return $selectctrl;
    }
    public function getUomSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT uom_id,uom_code from db_uom WHERE (uom_id = '$pid' or uom_id >0) and uom_status = 1 $wherestring
                ORDER BY uom_seqno,uom_code ASC";

        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['uom_id'];
            $code = $row['uom_code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    public function getMachineTypeSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT machinetype_id,machinetype_code from db_machinetype WHERE (machinetype_id = '$pid' or machinetype_id >0) and machinetype_status = 1 $wherestring
                ORDER BY machinetype_seqno,machinetype_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['machinetype_id'];
            $code = $row['machinetype_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getManufacturerSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT manufacturer_id,manufacturer_code from db_manufacturer WHERE (manufacturer_id = '$pid' or manufacturer_id >0) and manufacturer_status = 1 $wherestring
                ORDER BY manufacturer_seqno,manufacturer_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['manufacturer_id'];
            $code = $row['manufacturer_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getCountrySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT country_id,country_code from db_country WHERE (country_id = '$pid' or country_id >0) and country_status = 1 $wherestring
                ORDER BY country_seqno,country_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['country_id'];
            $code = $row['country_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getProjectSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT project_id,CONCAT(project_code,' - ',project_name) as project_code from db_project WHERE (project_id = '$pid' or project_id >0) and project_status = 1 $wherestring
                ORDER BY project_seqno,project_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['project_id'];
            $code = $row['project_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getGroupCompSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT groupcomp_id,groupcomp_code from db_groupcomp WHERE (groupcomp_id = '$pid' or groupcomp_id >0) and groupcomp_status = 1 $wherestring
                ORDER BY groupcomp_seqno,groupcomp_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['groupcomp_id'];
            $code = $row['groupcomp_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getProdgrpSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT prodgrp_id,prodgrp_code from db_prodgrp WHERE (prodgrp_id = '$pid' or prodgrp_id >0) and prodgrp_status = 1 $wherestring
                ORDER BY prodgrp_seqno,prodgrp_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['prodgrp_id'];
            $code = $row['prodgrp_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getProjectstatusSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT projectstatus_id,projectstatus_code from db_projectstatus WHERE (projectstatus_id = '$pid' or projectstatus_id >0) and projectstatus_status = 1 $wherestring
                ORDER BY projectstatus_seqno,projectstatus_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = ''>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['projectstatus_id'];
            $code = $row['projectstatus_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getMaterialSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT material_id,material_code,CONCAT(mc.materialcategory_code,' - ',ms.mscategory_code,' - ',mss.msscategory_code,' - ',m.material_code) as  code ,
                material_sale_price 
                FROM db_material m
                LEFT JOIN db_msscategory mss ON mss.msscategory_id = m.material_category
                LEFT JOIN db_mscategory ms ON ms.mscategory_id = mss.mssparent_id
                LEFT JOIN db_materialcategory mc ON ms.msparent_id = mc.materialcategory_id
                WHERE (material_id = '$pid' or material_id >0) and material_status = 1 $wherestring
                ORDER BY material_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['material_id'];
            $code = $row['code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code - $" . $row['material_sale_price'] . "</option>"; 
        }
        return $selectctrl;
    }
    public function getLabourSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT labour_id,labour_code,labour_sale_price from db_labour WHERE (labour_id = '$pid' or labour_id >0) and labour_status = 1 $wherestring
                ORDER BY labour_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['labour_id'];
            $code = $row['labour_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getDepartmentSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT department_id,department_code from db_department WHERE (department_id = '$pid' or department_id >0) and department_status = 1 $wherestring
                ORDER BY department_seqno,department_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['department_id'];
            $code = $row['department_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getMaterialCategorySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT mc.materialcategory_id,mc.materialcategory_code as code 
                FROM db_materialcategory mc
                WHERE (mc.materialcategory_id = '$pid' or mc.materialcategory_id >0) and mc.materialcategory_status = 1 $wherestring
                ORDER BY mc.materialcategory_code  ASC";

        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['materialcategory_id'];
            $code = $row['code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    public function getMaterialSubCategorySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT ms.mscategory_id,CONCAT(mc.materialcategory_code,' - ',ms.mscategory_code) as  code 
                FROM db_mscategory ms
                LEFT JOIN db_materialcategory mc ON ms.msparent_id = mc.materialcategory_id
                WHERE (ms.mscategory_id = '$pid' or ms.mscategory_id >0) and ms.mscategory_status = 1 $wherestring
                ORDER BY mc.materialcategory_code  ASC";

        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['mscategory_id'];
            $code = $row['code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    public function getMaterialSubSubCategorySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT mss.msscategory_id,mc.materialcategory_code,
                CONCAT(COALESCE(mc.materialcategory_code,''),' - ',COALESCE(ms.mscategory_code,''),' - ',COALESCE(mss.msscategory_code,'')) as  code 
                FROM db_materialcategory mc
                LEFT JOIN db_mscategory ms ON ms.msparent_id = mc.materialcategory_id
                LEFT JOIN db_msscategory mss ON ms.mscategory_id = mss.mssparent_id
                WHERE (mc.materialcategory_id = '$pid' or mc.materialcategory_id >0) and mc.materialcategory_status = 1 $wherestring
                ORDER BY mc.materialcategory_code  ASC";
//echo $sql;die;
        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['msscategory_id'];
            $code = $row['code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    
    public function getItemCategorySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT c.category_id,c.category_code
                FROM db_category c
                WHERE (c.category_id = '$pid' or c.category_id >0) and c.category_status = 1 $wherestring
                ORDER BY c.category_code  ASC";

        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['category_id'];
            $code = $row['category_code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    public function getItemSubCategorySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT isc.iscategory_id,isc.iscategory_code as  code 
                FROM db_iscategory isc
                WHERE (isc.iscategory_id = '$pid' or isc.iscategory_id >0) and isc.iscategory_status = 1 $wherestring
                ORDER BY isc.iscategory_code  ASC";
//echo $sql;die;
        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['iscategory_id'];
            $code = $row['code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    public function getItemSubSubCategorySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT mss.isscategory_id as category_id,mss.isscategory_code as  code 
                FROM db_isscategory mss 
                WHERE (mss.isscategory_id = '$pid' or mss.isscategory_id >0) and mss.isscategory_status = 1 $wherestring
                ORDER BY mss.isscategory_code  ASC";
//echo $sql;die;
        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['category_id'];
            $code = $row['code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    
    // Added: Ivan
    public function getPackageCategorySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT c.category_id,c.category_code
                FROM db_category c
                WHERE (c.category_id = '$pid' or c.category_id >0) and c.category_status = 1 $wherestring
                ORDER BY c.category_code  ASC";

        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['category_id'];
            $code = $row['category_code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    public function getPackageSubCategorySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT isc.iscategory_id,isc.iscategory_code as  code 
                FROM db_iscategory isc
                WHERE (isc.iscategory_id = '$pid' or isc.iscategory_id >0) and isc.iscategory_status = 1 $wherestring
                ORDER BY isc.iscategory_code  ASC";
//echo $sql;die;
        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['iscategory_id'];
            $code = $row['code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    public function getPackageSubSubCategorySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT mss.isscategory_id as category_id,mss.isscategory_code as  code 
                FROM db_isscategory mss 
                WHERE (mss.isscategory_id = '$pid' or mss.isscategory_id >0) and mss.isscategory_status = 1 $wherestring
                ORDER BY mss.isscategory_code  ASC";
//echo $sql;die;
        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['category_id'];
            $code = $row['code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    public function getPackageTypeSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT producttype_id,producttype_code from db_producttype WHERE (producttype_id = '$pid' or producttype_id >0) and producttype_status = 1 $wherestring
                ORDER BY producttype_seqno,producttype_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['producttype_id'];
            $code = $row['producttype_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getProductSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT product_id,product_part_no,product_sale_price,product_cost_price,product_desc
                FROM db_product m
                WHERE (product_id = '$pid' or product_id >0) and product_status = 1 $wherestring
                ORDER BY product_part_no ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['product_id'];

            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '".$id."' ".$selected.">(".$id.")".$row['product_part_no']." - " . $row['product_desc'] . "</option>"; 
        }
        return $selectctrl;
    }
    public function getProductNameSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT product_id,product_part_no,product_desc
                FROM db_product
                WHERE (product_id = '$pid' or product_id >0) and product_status = 1 $wherestring
                ORDER BY product_part_no ASC";
        if($shownull =="Y"){
            $selectctrl .='<option value = "" selected="selected">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['product_id'];

            if($id == $pid){
                $selected = 'selected = "selected"';
            }else{
                $selected = '';
            }
            $selectctrl .='<option value = "'.$id.'" qt-type="product" '.$selected.'>'.$row['product_part_no'].' - '.$row['product_desc'].'</option>';
        }
        return $selectctrl;
    }
    public function getPackageNameSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT package_id,package_part_no,package_desc
                FROM db_package
                WHERE (package_id = '$pid' or package_id >0) and package_status = 1 $wherestring
                ORDER BY package_part_no ASC";
        if($shownull =="Y"){
            $selectctrl .='<option value = "" selected="selected">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['package_id'];

            if($id == $pid){
                $selected = 'selected = "selected"';
            }else{
                $selected = '';
            }
            $selectctrl .='<option value = "'.$id.'" qt-type="package" '.$selected.'>'.$row['package_part_no'].' - '.$row['package_desc'].'</option>';
        }
        return $selectctrl;
    }
    public function getDeliverySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT delivery_id,delivery_code,delivery_desc
                FROM db_delivery 
                WHERE delivery_id >0 and delivery_status = 1 $wherestring
                ORDER BY delivery_id ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['delivery_id'];

            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '".$id."' ".$selected.">".$row['delivery_code']. "</option>"; 
        }
        return $selectctrl;
    }
    public function getPriceSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT price_id,price_code,price_desc
                FROM db_price
                WHERE price_id >0 and price_status = 1 $wherestring
                ORDER BY price_id ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['price_id'];

            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '".$id."' ".$selected.">".$row['price_code']. "</option>"; 
        }
        return $selectctrl;
    }
    public function getPaymenttermSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT paymentterm_id,paymentterm_code,paymentterm_desc
                FROM db_paymentterm
                WHERE paymentterm_id >0 and paymentterm_status = 1 $wherestring
                ORDER BY paymentterm_id ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['paymentterm_id'];

            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '".$id."' ".$selected.">".$row['paymentterm_code']. "</option>"; 
        }
        return $selectctrl;
    }
    public function getValiditySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT validity_id,validity_code,validity_desc
                FROM db_validity
                WHERE validity_id >0 and validity_status = 1 $wherestring
                ORDER BY validity_id ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['validity_id'];

            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '".$id."' ".$selected.">".$row['validity_code']. "</option>"; 
        }
        return $selectctrl;
    }
    public function getItemGroupSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT maingroup_id, maingroup_name
                FROM db_maingroup
                WHERE (maingroup_id = '$pid' or maingroup_id >0) and maingroup_status = 1 $wherestring
                ORDER BY maingroup_name  ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED = 'SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['maingroup_id'];
            $code = html_entity_decode($row['maingroup_name']);
            if($id == $pid){
                $selected = " SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '" . $id . "'" . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    public function getItemSubGroupSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT subgroup_id, subgroup_name
                FROM db_subgroup
                WHERE (subgroup_id = '$pid' or subgroup_id >0) and subgroup_status = 1 $wherestring
                ORDER BY subgroup_name  ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED = 'SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['subgroup_id'];
            $code = html_entity_decode($row['subgroup_name']);
            if($id == $pid){
                $selected = " SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '" . $id . "'" . $selected . ">".$code."</option>"; 
        }
        return $selectctrl;
    }
    
    public function getTransittimeSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT transittime_id,transittime_code,transittime_desc
                FROM db_transittime 
                WHERE transittime_id >0 and transittime_status = 1 $wherestring
                ORDER BY transittime_id ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['transittime_id'];

            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '".$id."' ".$selected.">".html_entity_decode($row['transittime_code']). "</option>"; 
        }
        return $selectctrl;
    }
    public function getFreightchargeSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT freightcharge_id,freightcharge_code,freightcharge_desc
                FROM db_freightcharge 
                WHERE freightcharge_id >0 and freightcharge_status = 1 $wherestring
                ORDER BY freightcharge_id ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['freightcharge_id'];

            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '".$id."' ".$selected.">".html_entity_decode($row['freightcharge_code']). "</option>"; 
        }
        return $selectctrl;
    }
    public function getPointofdeliverySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT pointofdelivery_id,pointofdelivery_code,pointofdelivery_desc
                FROM db_pointofdelivery 
                WHERE pointofdelivery_id >0 and pointofdelivery_status = 1 $wherestring
                ORDER BY pointofdelivery_id ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['pointofdelivery_id'];

            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '".$id."' ".$selected.">".html_entity_decode($row['pointofdelivery_code']). "</option>"; 
        }
        return $selectctrl;
    }
    public function getPrefixSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT prefix_id,prefix_code,prefix_desc
                FROM db_prefix 
                WHERE prefix_id >0 and prefix_status = 1 $wherestring
                ORDER BY prefix_id ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['prefix_id'];

            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '".$id."' ".$selected.">".html_entity_decode($row['prefix_code']). "</option>"; 
        }
        return $selectctrl;
    }
    public function getRemarksSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT remarks_id,remarks_code,remarks_desc
                FROM db_remarks 
                WHERE remarks_id >0 and remarks_status = 1 $wherestring
                ORDER BY remarks_id ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['remarks_id'];

            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '".$id."' ".$selected.">".html_entity_decode($row['remarks_code']). "</option>"; 
        }
        return $selectctrl;
    }
    /**public function getCountrySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT country_id,country_code,country_desc
                FROM db_country 
                WHERE country_id >0 and country_status = 1 $wherestring
                ORDER BY country_id ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['country_id'];

            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '".$id."' ".$selected.">".$row['country_code']. "</option>"; 
        }
        return $selectctrl;
    }    
    **/
    public function getExpensesSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT expenses_id,expenses_code from db_expenses WHERE (expenses_id = '$pid' or expenses_id >0) and expenses_status = 1 $wherestring
                ORDER BY expenses_seqno,expenses_code ASC";

        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['expenses_id'];
            $code = $row['expenses_code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    public function getShippingAddressSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT shipping_id,shipping_name from db_shipaddress WHERE (shipping_id = '$pid' or shipping_id >0) and shipping_status = 1 $wherestring
                ORDER BY shipping_seqno,shipping_name ASC";

        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['shipping_id'];
            $code = $row['shipping_name'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getAddressTypeSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT partneraddresstype_id,partneraddresstype_code from db_partneraddresstype WHERE (partneraddresstype_id = '$pid' or partneraddresstype_id >0) and partneraddresstype_status = 1 $wherestring
                ORDER BY partneraddresstype_seqno,partneraddresstype_code ASC";

        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['partneraddresstype_id'];
            $code = $row['partneraddresstype_code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '"' . $selected . ">$code</option>"; 
        }
        return $selectctrl;
    }
    public function getNationalitySelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT nationality_id,nationality_code from db_nationality WHERE (nationality_id = '$pid' or nationality_id >0) and nationality_status = 1 $wherestring
                ORDER BY nationality_seqno,nationality_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['nationality_id'];
            $code = $row['nationality_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getBankSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT bank_id,bank_code from db_bank WHERE (bank_id = '$pid' or bank_id >0) and bank_status = 1 $wherestring
                ORDER BY bank_seqno,bank_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['bank_id'];
            $code = $row['bank_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getEmplPassSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT emplpass_id,emplpass_code from db_emplpass WHERE (emplpass_id = '$pid' or emplpass_id >0) and emplpass_status = 1 $wherestring
                ORDER BY emplpass_seqno,emplpass_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['emplpass_id'];
            $code = $row['emplpass_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getLeaveTypeSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT leavetype_id,leavetype_code from db_leavetype WHERE (leavetype_id = '$pid' or leavetype_id >0) and leavetype_status = 1 $wherestring
                ORDER BY leavetype_seqno,leavetype_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['leavetype_id'];
            $code = $row['leavetype_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getClaimsTypeSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT claimstype_id,claimstype_code from db_claimstype WHERE (claimstype_id = '$pid' or claimstype_id >0) and claimstype_status = 1 $wherestring
                ORDER BY claimstype_seqno,claimstype_code ASC";
        if($shownull =="Y"){
            $selectctrl .='<option value = "" SELECTED="SELECTED">Select One</option>';
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['claimstype_id'];
            $code = $row['claimstype_code'];
            if($id == $pid){
                $selected = 'SELECTED = "SELECTED"';
            }else{
                $selected = "";
            }
            $selectctrl .='<option value = "' . $id . '" ' . $selected . '>' . $code . '</option>'; 
        }
        return $selectctrl;
    }
    public function getEmployeeSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT empl_id,CONCAT(empl_code,' - ',empl_name) as empl_name from db_empl WHERE (empl_id = '$pid' or empl_id >0) and empl_status = 1 $wherestring
                ORDER BY empl_seqno,empl_name ASC"; 

        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['empl_id'];
            $code = $row['empl_name'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getAdditionalTypeSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT additionaltype_id,CONCAT(additionaltype_code,' - ',additionaltype_code) as additionaltype_code from db_additionaltype WHERE (additionaltype_id = '$pid' or additionaltype_id >0) and additionaltype_status = 1 $wherestring
                ORDER BY additionaltype_seqno,additionaltype_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['additionaltype_id'];
            $code = $row['additionaltype_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getSubconWorkerSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT pe.pempl_id,CONCAT(pe.pempl_nric,' - ',pe.pempl_name,' - ',p.partner_name) as pempl_name 
                FROM db_pempl pe
                INNER JOIN db_partner p ON p.partner_id = pe.pempl_partner_id
                WHERE (pe.pempl_id = '$pid' or pe.pempl_id >0) $wherestring
                ORDER BY pe.pempl_name ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['pempl_id'];
            $code = $row['pempl_name'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getEquipmentSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT equipment_id,equipment_code from db_equipment WHERE (equipment_id = '$pid' or equipment_id >0) and equipment_status = 1 $wherestring
                ORDER BY equipment_seqno,equipment_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['equipment_id'];
            $code = $row['equipment_code'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }

    public function getProjectQuotationItemsSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT ordl.*
                FROM db_order o 
                INNER JOIN db_ordl ordl ON ordl.ordl_order_id = o.order_id
                WHERE (ordl.ordl_id = '$pid' or ordl.ordl_id >0) and o.order_status IN ('1','2')  $wherestring
                ORDER BY ordl.ordl_pro_no ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['ordl_id'];
            $code = $row['ordl_pro_no'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getMaterialSupplierSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT p.partner_id,CONCAT(p.partner_code,' - ',p.partner_name) as name
                FROM db_materialline m 
                INNER JOIN db_partner p ON p.partner_id = m.materialline_partner_id
                WHERE (m.materialline_id = '$pid' or m.materialline_id >0) $wherestring
                ORDER BY p.partner_name ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['partner_id'];
            $code = $row['name'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
    public function getProductLabourSelectCtrl($pid,$shownull="Y",$wherestring=''){
        $sql = "SELECT p.prolabour_id,l.labour_code as name
                FROM db_prolabour p 
                INNER JOIN db_labour l ON l.labour_id = p.prolabour_labour_id
                WHERE (p.prolabour_id = '$pid' or p.prolabour_id >0) $wherestring
                ORDER BY l.labour_code ASC";
        if($shownull =="Y"){
            $selectctrl .="<option value = '' SELECTED='SELECTED'>Select One</option>";
        }
        $query = mysql_query($sql);
        while($row = mysql_fetch_array($query)){
            $id = $row['prolabour_id'];
            $code = $row['name'];
            if($id == $pid){
                $selected = "SELECTED = 'SELECTED'";
            }else{
                $selected = "";
            }
            $selectctrl .="<option value = '$id' $selected>$code</option>"; 
        }
        return $selectctrl;
    }
}

?>
