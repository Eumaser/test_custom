
<div class="forklifts">
  <div class="form-group">
    <input type="hidden" class="form-control" id="orderfork_id" name="orderfork_id" value = "<?php echo $this->orderfork_id;?>" placeholder="Height" >

        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Brand</label>
        <div class="<?php echo $field_col_sm;?>">
          <select class="form-control select2" id="orderfork_brand" name="orderfork_brand">
              <?php echo $this->brandCrtl;?>
          </select>

        </div>
        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Model</label>
        <div class="<?php echo $field_col_sm;?>">
          <select class="form-control select2" id="orderfork_model" name="orderfork_model">
              <?php echo $this->modelCrtl;?>
          </select>
        </div>
  </div>
  <div class="form-group">
        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Capacity</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="orderfork_capacity" name="orderfork_capacity" value = "<?php echo $this->orderfork_capacity;?>" placeholder="Capacity" >
        </div>
        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Height</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="orderfork_height" name="orderfork_height" value = "<?php echo $this->orderfork_height;?>" placeholder="Height" >
        </div>
  </div>
  <div class="form-group">
        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Mast</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="orderfork_mast" name="orderfork_mast" value = "<?php echo $this->orderfork_mast;?>" placeholder="Mast" >
        </div>
        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Length</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="orderfork_length" name="orderfork_length" value = "<?php echo $this->orderfork_length;?>" placeholder="Length" >
        </div>
  </div>
  <div class="form-group">
        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Attachment</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="orderfork_attachment" name="orderfork_attachment" value = "<?php echo $this->orderfork_attachment;?>" placeholder="Attachments" >
        </div>
        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Accessories</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="orderfork_acc" name="orderfork_acc" value = "<?php echo $this->orderfork_acc;?>" placeholder="Accessories" >
        </div>
  </div>
  <div class="form-group">
        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Serial</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="orderfork_serial" name="orderfork_serial" value = "<?php echo $this->orderfork_serial;?>" placeholder="Serial" >
        </div>
        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Battery</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="orderfork_battery" name="orderfork_battery" value = "<?php echo $this->orderfork_battery;?>" placeholder="Battery">
        </div>
  </div>
  <div class="form-group">
        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Battery Charger</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="orderfork_bat_charger" name="orderfork_bat_charger" value = "<?php echo $this->orderfork_bat_charger;?>" placeholder="Battery Charger" >
        </div>
        <label for="order_customerpo" class="<?php echo $label_col_sm;?> control-label">Charger S/Nr</label>
        <div class="<?php echo $field_col_sm;?>">
            <input type="text" class="form-control" id="orderfork_snr" name="orderfork_snr" value = "<?php echo $this->orderfork_snr;?>" placeholder="Charger S/Nr" >
        </div>
  </div>
</div>
