<table>
  <tr>
    <th>id</th>
    <th>User name</th>
    <th>Full name</th>
    <th>E-mail</th>
  </tr>
  <?foreach ($users as $user) {?>
    <tr>
      <td>
        <?=$user['User']['id']?>
      </td>
      <td>
        <?=$user['User']['username']?>
      </td>
      <td>
        <?=$user['User']['full_name']?>
      </td>
      <td>
        <?=$user['User']['email']?>
      </td>
    </tr>
  <?}?>
</table>
    