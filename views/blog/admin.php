<?php

use yii\helpers\Url;
$this->title = "Admin Article";
?>

<table class="table table-hover mt-2">
   <thead class="thead-dark">
      <th width="40%">Titre</th>
      <th>Utilisateur</th>
      <th>
         Crée le <a href="<?= Url::toRoute(['blog/admin', 'order' => ($order == 'ASC') ? 'DESC' : 'ASC']) ?>" class="text-white px-2">
                     <i class="fas fa-chevron-<?= ($order == 'ASC') ? "up" : "down" ?>"></i>
                  </a>
      </th>
      <th>Publié</th>
      <th width="20%"></th>
   </thead>
   <tbody>
   <?php foreach($articles as $article): ?>
   <tr>
      <td><?= $article->title ?></td>
      <td><?= $article->user->username ?></td>
      <td><?= $article->created_at ?></td>
      <td><?= ($article->published) ? 'Oui' : 'Non' ?></td>
      <td class="text-right">
         <a href="<?= Url::toRoute(['blog/publish', 'id' => $article->id, 'adm' => true]) ?>" class="text-dark mx-1"><i class="fas fa-eye<?= (!$article->published)? '-slash' : '' ?>"></i></a>
         <a href="<?= Url::toRoute(['blog/update', 'id' => $article->id, 'adm' => true]) ?>" class="text-dark mx-1"><i class="fas fa-edit"></i></a>
         <a href="<?= Url::toRoute(['blog/delete', 'id' => $article->id, 'adm' => true]) ?>" class="text-dark mx-1"><i class="fas fa-trash-alt"></i></a>
      </td>
   </tr>
   <?php endforeach; ?>
   </tbody>
</table>