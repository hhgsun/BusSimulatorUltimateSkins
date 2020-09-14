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

<h2 class="my-3">Markalar</h2>

<form action="/admin/brands/add" class="form-inline mb-4" method="POST" enctype="multipart/form-data">
  <input class="form-control mr-2" name="name" placeholder="Marka Adı" required />
  <div class="custom-file form-control border-0 mr-2">
    <input type="file" class="custom-file-input" id="logo" name="logo" required />
    <label class="custom-file-label" for="layoutfile" data-browse="Logo Seç">Choose file</label>
  </div>
  <button type="submit" class="btn btn-secondary">Ekle</button>
</form>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>MARKA</th>
        <th>LOGO</th>
        <th>CONFIRM</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($brands as $key => $value) { ?>

        <tr>
          <td><?php echo $value->id; ?></td>
          <td><?php echo $value->name; ?></td>
          <td><img src="/upload_brands/<?php echo $value->logo; ?>" style="max-height:50px;max-width:50px;"></td>
          <td>
            <div class="btn-group mr-2">
              <form action="/admin/brands/delete" class="form-inline" method="POST">
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