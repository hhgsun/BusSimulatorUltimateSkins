<?php if(isset($result)) { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $result; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>

<?php
if(isset($upload_error)){
  echo '<pre>';
  print_r($upload_error);
  echo '</pre>';
}
?>

<h2 class="my-3">Raporlar / DMCA</h2>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>EMAIL</th>
        <th>COMPANY</th>
        <th>MOD URL</th>
        <th>COMPLAIT</th>
        <th>DOCUMENT</th>
        <th>ISLEM</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($reports as $key => $value) { ?>

        <tr>
          <td><?php echo $value->id; ?></td>
          <td><?php echo $value->name; ?></td>
          <td><?php echo $value->email; ?></td>
          <td><?php echo $value->company; ?></td>
          <td><?php echo $value->mod_url; ?></td>
          <td><?php echo $value->complaint; ?></td>
          <td><img src="/report_docs/<?php echo $value->document; ?>" style="max-height:50px;max-width:50px;"></td>
          <td>
            <div class="btn-group mr-2">
              <form action="/admin/reports/delete" class="form-inline" method="POST">
                <input name="id" value="<?php echo $value->id; ?>" hidden="hidden">
                <button onclick="deleteLine()" class="btn btn-outline-danger">Sil</button>
              </form>
            </div>
          </td>
        </tr>

      <?php } ?>

    </tbody>
  </table>
</div>

<script>
function deleteLine() {
  var c = confirm("Silmek istediğinize eminmisiniz?");
  if(c){
    $(this).submit();
  } else {
    event.preventDefault();
  }
}
</script>