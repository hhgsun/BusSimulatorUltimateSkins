<?php if(isset($result)) { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo $result; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php } ?>






<h2 class="my-3">Skinler</h2>


<div class="accordion" id="accordionPackets">
  <?php
  if(isset($packets)) {
  foreach ($packets as $pkey => $package) { ?>
    <div class="card">
      <div class="card-header" id="headingOne">
        <h2 class="d-flex justify-content-between mb-0">
          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_<?php echo $package->id; ?>" aria-expanded="false" aria-controls="collapse_<?php echo $package->id; ?>">
            <?php echo $package->title; ?>
          </button>
          <?php if($package->status == 1) { ?>
            <a href="?onaykaldir=<?php echo $package->id; ?>" class="btn btn-outline-danger">Onay Kaldır</a>
          <?php } else { ?>
            <a href="?onayla=<?php echo $package->id; ?>" class="btn btn-success">Onayla</a>
          <?php } ?>
        </h2>
      </div>

      <div id="collapse_<?php echo $package->id; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordionPackets">
        <div class="card-body">
          <div class="text-right pb-2">
            <?php if($package->is_pack) { ?>
              <a href="?skinpack=<?php echo $package->id; ?>&skinpack_val=0" class="btn btn-outline-info">Skin Pack Kaldır</a>
            <?php } else { ?>
              <a href="?skinpack=<?php echo $package->id; ?>&skinpack_val=1" class="btn btn-outline-info">Skin Pack Yap</a>
            <?php } ?>
            <?php if($package->editor_choice == 0) { ?>
              <a href="?editor_secimi=<?php echo $package->id; ?>" class="btn btn-outline-info">Editör Seçimi</a>
            <?php } ?>
          </div>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>PACKAGE ID</th>
                  <th>TITLE</th>
                  <th>BRAND-MODEL</th>
                  <th>IMG</th>
                  <th>SKIN</th>
                  <th>işlemler</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $this->db->where('package_id', $package->id);
                $skins = $this->db->get('skins')->result();
                foreach ($skins as $skey => $skin) { ?>
                  <tr>
                    <td><?php echo $skin->id; ?></td>
                    <td><?php echo $skin->package_id; ?></td>
                    <td><?php echo $skin->title; ?></td>
                    <td><?php echo $skin->brand; ?>-<?php echo $skin->model; ?></td>
                    <td>
                      <a href="/uploads/<?php echo $skin->screen_img; ?>" target="_blank">
                        <img src="/uploads/<?php echo $skin->screen_img; ?>" style="max-height:200px; max-width:200px;" />
                      </a>
                    </td>
                    <td>
                      <a href="/uploads/<?php echo $skin->skin_img; ?>" target="_blank">
                        <img src="/uploads/<?php echo $skin->skin_img; ?>" style="max-height:200px; max-width:200px;" />
                      </a>
                    </td>
                    <td>
                      <div class="btn-group mr-2">
                        <form action="/admin/skins/delete" class="form-inline" method="POST">
                          <input name="id" value="<?php echo $skin->id; ?>" hidden="hidden">
                          <button onclick="deleteLine()" class="btn btn-outline-danger">Sil</button>
                        </form>
                      </div>
                    </td>
                  </tr>

                <?php } ?>
              </tbody>
            </table>
            <?php if(count($skins) < 1) { ?>
              <div class="text-right pb-2">
                <a href="?delete_pack=<?php echo $package->id; ?>" class="btn btn-outline-danger">SİL</a>
              </div>
            <?php } ?>
          </div>

        </div>
      </div>
    </div>
  <?php }
} ?>
</div>


<nav aria-label="Page navigation example" class="m-1 my-4">
  <ul class="pagination">
    <?php if(isset($_GET['page'])){
      if($_GET['page'] != 1) { ?>
      <li class="page-item"><a class="page-link" href="?page=<?php echo isset($_GET['page']) ? $_GET['page'] - 1 : 1; ?>"><</a></li>
    <?php }
    } else {
      $_GET['page'] = 1;
    } ?>
    <?php for ($i=1; $i < $pagination_count + 1; $i++) { ?>
      <li class="page-item <?php echo $i == (isset($_GET['page']) ? $_GET['page'] : 1) ? 'active' : ''; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php } ?>
    <?php if($_GET['page'] != $pagination_count) { ?>
      <li class="page-item"><a class="page-link" href="?page=<?php echo isset($_GET['page']) ? $_GET['page'] + 1 : 1; ?>">></a></li>
    <?php } ?>
  </ul>
</nav>


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