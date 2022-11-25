
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
 