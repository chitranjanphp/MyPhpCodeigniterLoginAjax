<div class="container">
  <div class="row">
    <div class="col-12">
      <form>
        <div class="row">
          <div class="col-2">Select date</div>
          <div class="col-6"><input type="date" name="date" id="date"></div>
        </div>

      </form>
    </div>
  </div>
  <div class="row">
  <div class="table-responsive" id="example">
    <table class="table">
      <thead>
        <th>Full Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Date Added</th>
      </thead>
      <tbody>
        <?php
         if(is_array($result)){
          foreach($result as $row):
        ?>
          <tr>
          <td><?= $row['fullname'] ?></td>
          <td><?= $row['email'] ?></td>
          <td><?= $row['mobile'] ?></td>
          <td><?= date("d-m-Y",strtotime($row['created_at'])) ?></td>
          </tr>
        <?php 
         endforeach;
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
</div><br>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {   
    $('#date').on("change",function(){
      $("#example").html('');
      var date = $("#date").val();
     jQuery.ajax({
     type: "POST",
     url: "<?php echo base_url('user/search_list') ?>",    
     data: {date: date},
     success: function(res) {
         $("#example").html(res);
      }
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