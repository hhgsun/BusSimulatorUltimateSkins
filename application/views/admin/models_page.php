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

<h2 class="my-3">Modeller</h2>

<form action="/admin/models/add" class="form-inline mb-4" method="POST" enctype="multipart/form-data">
  <select class="form-control mr-2" name="brand_id" required>
    <option value="-1">Marka Seçiniz</option>
    <?php
    $brands = $this->db->get('brands');
    foreach ($brands->result() as $value) { ?>
        <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
    <?php } ?>
  </select>
  <input class="form-control mr-2" name="name" placeholder="Model Adı" required />
  <div class="custom-file form-control border-0 mr-2">
    <input type="file" class="custom-file-input" id="layoutfile" name="layoutfile" required>
    <label class="custom-file-label" for="layoutfile" data-browse="PSD seçin">Choose file</label>
  </div>
  <button type="submit" class="btn btn-secondary">Ekle</button>
</form>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>MODEL</th>
        <th>MARKA</th>
        <th>LAYOUT DOSYA</th>
        <th>CONFIRM</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($models as $key => $value) { ?>
        <tr>
          <td><?php echo $value->id; ?></td>
          <td><?php echo $value->name; ?></td>
          <td><?php echo $value->brand_name; ?></td>
          <td>
            <a href="<?php echo '/upload_layouts/' . $value->layout_file; ?>"><?php echo 'upload_layouts/' . $value->layout_file; ?></a>
          </td>
          <td>
            <div class="btn-group mr-2">
              <form action="/admin/models/delete" class="form-inline" method="POST">
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
