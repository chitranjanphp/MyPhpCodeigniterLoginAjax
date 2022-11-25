<div class="container">

    <!-- Include Flash Data File -->
    <?php $this->load->view('_FlashAlert\flash_alert.php') ?>
    <div class="error" id="logerror"></div>
    
    <form method="post" id="login_form">
        <div class="form-group">
            <label>Email address</label>
            <input type="email" name="email" value="<?= set_value('email'); ?>" class="form-control <?= (form_error('email') == "" ? '':'is-invalid') ?>" placeholder="Enter Email"> 
            <?= form_error('email'); ?>            
        </div>      
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" value="<?= set_value('password'); ?>" class="form-control <?= (form_error('password') == "" ? '':'is-invalid') ?>" placeholder="Password">
            <?= form_error('password'); ?> 
        </div>
        <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon" style="color: black; font-size: 20px; font-family: monospace;">Enter Captcha: <span id="captcha-img"><?php echo $captchaImg; ?></span> =</div>
                    <input type="text" name="captcha" value="<?= set_value('captcha'); ?>" class="form-control <?= (form_error('captcha') == "" ? '':'is-invalid') ?>" placeholder="?" autocomplete="off">
                    <?= form_error('captcha'); ?>
                </div>
            </div>
        <div class="form-group">
          <p>Can't calculate? click <a href="javascript:void(0);" class="refresh-captcha text-danger">here</a> to refresh.</p>
        </div>
        <!-- <div class="form-group form-check">
            <input type="checkbox" class="form-check-input">
            <label class="form-check-label">Check me out</label>
        </div> -->
        <button type="submit" id="btn-login" class="btn btn-primary">Login</button>
    <?= form_close() ?>
</div>
<script type="text/javascript">

jQuery(document).ready(function(){
    jQuery('a.refresh-captcha').on('click', function(){
      jQuery.get('<?php print base_url().'user/refresh'; ?>', function(data) {
        jQuery('span#captcha-img').html(data);
    });
    });
  });

  $(document).ready(function(){
    $('#login_form').validate(); // form validation  
    $(document).on('click','#btn-login',function(){
      var url = "<?php echo base_url('User/user_login');?>";       
        if($('#login_form').valid()){
          $.ajax({
            type: "POST",
            url: url,
            data: $("#login_form").serialize(), // serializes the form's elements.
            success: function(data)
             {
                //alert(data);
               if(data==1)              
                 window.location.href = "<?php echo base_url('User/Panel'); ?>";
               else if(data==2) 
                 $('#logerror').html('The email you entered is incorrect.');
               else if(data==3) 
                 $('#logerror').html('The password you entered is incorrect.');
               else if(data==4) 
                 $('#logerror').html('The captcha you entered is incorrect.');
               else
                     $('#logerror').html('The email or password you entered is incorrect.');
                     $('#logerror').addClass("error");
                     //window.location.href = "<?php echo base_url('user/registration'); ?>";
             }
          });
       }
       return false;
    });
  });
</script>