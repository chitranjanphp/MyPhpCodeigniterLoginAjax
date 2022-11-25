<div class="container">

    <!-- Include Flash Data File -->
    <?php $this->load->view('_FlashAlert\flash_alert.php') ?>
    
    <div class="jumbotron">
        <h1 class="display-4">Welcome to <?= $this->session->userdata('USER_NAME') ?></h1>
        <hr class="my-4">
    </div>
</div>