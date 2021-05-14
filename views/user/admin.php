<?php
$this->title = "Gestion de membres"
?>

<table class="table">
   <thead class="thead-dark">
      <th>Username</th>
      <th>Email</th>
      <th></th>
   </thead>
   <tbody>
      <?php foreach($users as $user): ?>
         <tr>
            <td><?= $user->username ?></td>
            <td><?= $user->email ?></td>
         </tr>
      <?php endforeach; ?>
   </tbody>
</table>