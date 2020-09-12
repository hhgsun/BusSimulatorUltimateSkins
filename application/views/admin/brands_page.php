<?php if(isset($result)) { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $result; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>

<h2 class="my-3">Markalar</h2>

<form action="/admin/brands/add" class="form-inline mb-4" method="POST">
  <input class="form-control mr-2" name="name" placeholder="Marka Adı" />
  <button type="submit" class="btn btn-secondary">Ekle</button>
</form>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>ID</th>
        <th>MARKA</th>
        <th>CONFIRM</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($brands as $key => $value) { ?>

        <tr>
          <td><?php echo $value->id; ?></td>
          <td><?php echo $value->name; ?></td>
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