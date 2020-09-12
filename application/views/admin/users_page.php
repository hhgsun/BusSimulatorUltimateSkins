<?php if(isset($result)) { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $result; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>

<h2 class="my-3">Kullanıcılar</h2>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>USERNAME</th>
        <th>CONFIRM</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($users as $key => $value) { ?>

        <tr>
          <td><?php echo $value->id; ?></td>
          <td><?php echo $value->name; ?></td>
          <td><?php echo $value->email; ?></td>
          <td><?php echo $value->username; ?></td>
          <td>
            <?php if($value->id != $this->session->user_id) { ?>
            <div class="btn-group mr-2">
              <?php if($value->is_admin) { ?>
                <button type="button" class="btn btn-sm btn-outline-secondary active" onclick="adminSet(<?php echo $value->id; ?>, 0)">Admin</button>
              <?php } else { ?>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="adminSet(<?php echo $value->id; ?>, 1)">Admin</button>
              <?php } ?>
              <?php if($value->is_editor) { ?>
                <button type="button" class="btn btn-sm btn-outline-secondary active" onclick="editorSet(<?php echo $value->id; ?>, 0)">Editör</button>
              <?php } else { ?>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="editorSet(<?php echo $value->id; ?>, 1)">Editör</button>
              <?php } ?>
              <button type="button" class="btn btn-sm btn-outline-danger" onclick="userDelete(<?php echo $value->id; ?>)">Sil</button>
            </div>
            <?php } ?>
          </td>
        </tr>

      <?php } ?>

    </tbody>
  </table>
</div>

<script>
function adminSet(userId, conf) {
  if(conf == 1) {
    var d = confirm('Kullanıcıyı Admin yapmak istediğinize eminmisiniz?');
    if(d) {
      location.replace('/admin/users/admin?id=' + userId + '&confirm=' + conf);
    }
  } else {
    var d = confirm('Kullanıcıyı Adminlikten kaldırmak istediğinize eminmisiniz?');
    if(d) {
      location.replace('/admin/users/admin?id=' + userId + '&confirm=' + conf);
    }
  }
}

function editorSet(userId, conf) {
  if(conf == 1) {
    var d = confirm('Kullanıcıyı Editör yapmak istediğinize eminmisiniz?');
    if(d) {
      location.replace('/admin/users/editor?id=' + userId + '&confirm=' + conf);
    }
  } else {
    var d = confirm('Kullanıcıyı Editörlükten kaldırmak istediğinize eminmisiniz?');
    if(d) {
      location.replace('/admin/users/editor?id=' + userId + '&confirm=' + conf);
    }
  }
}

function userDelete(userId) {
  var d = confirm('Kullanıcıyı silmek istediğinize eminmisiniz?');
  if(d) {
    location.replace('/admin/users/delete?id=' + userId + '&confirm=1');
  }
}
</script>