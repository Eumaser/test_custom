    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="plugins/jqueryvalidation/jquery.validate.1.8.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.js"></script>
    <script src="plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->

    <script>

      var system_gst_percent = "<?php  echo system_gst_percent;?>";
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2({
            width: '100%',
        });

        $('.datepicker').datepicker({
            format: 'dd-M-yyyy',
            autoclose: true,
            pickerPosition: "bottom-left"
        });

        //For DO and QT
        //forklift id is 2, check table db_doctype
      //  $('.forklifts').hide();

       var tests = $('#order_doc_type').val();
        if($('#order_doc_type').val() == '2') {
            $('.forklifts').show();
        } else {
            $('.forklifts').hide();
        }
        $('#order_doc_type').change(function(){

            if($('#order_doc_type').val() == '2') {
                $('.forklifts').show();
            } else {
                $('.forklifts').hide();
            }
        });

        //edr dependent dropdown for model. When a brand is selected, auto generate model list based on brand
        //For DO and QT
        $('#orderfork_brand').change(function(){
          //  var data = "action=getForkModel&fork_id="+$(this).val()
            var data = "action=getForkModel&fork_brand="+$(this).val();
             $.ajax({
                type: "POST",
                url: "forklift.php",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#orderfork_model').html(jsonObj.fork_model);
                }
             });
        });
        
        //For Sales Invoice
        if($('#invoice_doc_type').val() == '2') {
          console.log('test');
            $('.forklifts-inv').show();
        } else {
            $('.forklifts-inv').hide();
        }
        $('#invoice_doc_type').change(function(){

            if($('#invoice_doc_type').val() == '2') {
                $('.forklifts-inv').show();
            } else {
                $('.forklifts-inv').hide();
            }
        });

        $('#invfork_brand').change(function(){
          //  var data = "action=getForkModel&fork_id="+$(this).val()
            var data = "action=getForkModel&fork_brand="+$(this).val();
             $.ajax({
                type: "POST",
                url: "forklift.php",
                data:data,
                success: function(data) {
                    var jsonObj = eval ("(" + data + ")");
                    $('#invfork_model').html(jsonObj.fork_model);
                }
             });
        });



        $('.top_language').click(function(){

            var data = "action=switchLanguage&language="+$(this).attr('language');
             $.ajax({
                type: "POST",
                url: "langsetting.php",
                data:data,
                success: function(data) {
                    window.location.reload();

                }
             });
        });
      });
      function confirmAlertHref(url,message){
            if(confirm(message)){
                window.location.href = url;
            }else{
                return false;
            }
      }
      function changeNumberFormat(nStr){
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                    x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
       }
      function RoundNum(num, length) {
            var number = parseFloat(Math.round(num * Math.pow(10, length)) / Math.pow(10, length)).toFixed(2);
            return number;
       }
        function nl2br (str, is_xhtml) {
            var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
            return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
        }
    </script>
