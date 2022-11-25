<div class="container">
<div class="ajax_response_result">
<form id="reg_form" method="post" enctype="multipart/form-data">
    <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="full_name" value="<?= set_value('full_name'); ?>" class="form-control <?= (form_error('full_name') == "" ? '':'is-invalid') ?>" placeholder="Enter Full Name">
            <div class="errorMessage full_name"><?= form_error('full_name'); ?></div>    
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?= set_value('username'); ?>" class="form-control <?= (form_error('username') == "" ? '':'is-invalid') ?>" placeholder="Enter Userame">  
            <div class="errorMessage username"><?= form_error('username'); ?></div>    
        </div>
        <div class="form-group">
            <label>Email address</label>
            <input type="email" name="email" value="<?= set_value('email'); ?>" class="form-control <?= (form_error('email') == "" ? '':'is-invalid') ?>" placeholder="Enter Email"> 
            <div class="errorMessage email"><?= form_error('email'); ?></div>     
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="number" name="mobile" value="<?= set_value('mobile'); ?>" class="form-control <?= (form_error('mobile') == "" ? '':'is-invalid') ?>" placeholder="Enter Phone Number">  
            <div class="errorMessage mobile"><?= form_error('mobile'); ?></div>    
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" value="<?= set_value('password'); ?>" class="form-control <?= (form_error('password') == "" ? '':'is-invalid') ?>" placeholder="Password">
            <div class="errorMessage password"><?= form_error('password'); ?></div>
        </div>
        <div class="form-group">
            <label>Password Confirmation</label>
            <input type="password" name="passconf" value="<?= set_value('passconf'); ?>" class="form-control <?= (form_error('passconf') == "" ? '':'is-invalid') ?>" placeholder="Password Confirmation">
            <div class="errorMessage passconf"><?= form_error('passconf'); ?></div>
        </div>
       <div class="form-group">
            <p id="msg"></p>
            <input type="file" id="file" name="file" value="<?= set_value('file'); ?>" />
            <div class="errorMessage file"><?= form_error('file'); ?></div> 
        </div>  
         
    <div><input type="submit" id="click_form" class="btn btn-primary" value="Register" /></div>
</form>
</div>
</div><br>

<!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function() {   
    $('#reg_form').submit(function(){
     jQuery.ajax({
     type: "POST",
     url: "<?php echo base_url('user/ajax_signup') ?>",    
     data:new FormData(this),
     processData:false,
     contentType:false,
     cache:false,
     async:false,
    
     success: function(res) {
         //alert(res);
         if(res==1){
            alert("Register successfully");
            window.location.href = "<?php echo base_url('user/ajax_login'); ?>";
         }
          $(".ajax_response_result").html(res);
        
      }
      
     });
   });



   

 $('#file').on('change', function () {
    var file_data = $('#file').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    $.ajax({
        url: '<?php echo base_url('user/upload_file') ?>', // point to server-side controller method
        dataType: 'text', // what to expect back from the server
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (response) {
            $('#msg').html(response); // display success response from the server
        },
        error: function (response) {
            $('#msg').html(response); // display error response from the server
        }
    });
});



});


jQuery(document).ready(function(){
    jQuery('a.refresh-captcha').on('click', function(){
      jQuery.get('<?php print base_url().'user/refresh'; ?>', function(data) {
        jQuery('span#captcha-img').html(data);
    });
    });
  });
</script>

<style type="text/css">
.errorMessage {
    color: red;
    background-color: #FEEFB3;
}
</style>