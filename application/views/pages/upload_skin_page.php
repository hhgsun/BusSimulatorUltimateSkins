<?php

class ItemSpace { public function __construct() {} }

if($update_id) {
    $result = $this->db->where('id', $update_id)->get('packets');
    $update_package_data = $result->result()[0];

    $result = $this->db->where('package_id', $update_id)->get('skins');
    $update_skins_data = $result->result();
} else {
    $update_skins_data = array();
    $d = new ItemSpace();
    $d->title = '';
    $d->brand = '';
    $d->model = '';
    $d->skin_img = '';
    $d->screen_img = '';
    $d->description = '';
    array_push($update_skins_data, $d);
}

?>

<section class="main">
        <div class="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="custom-form">
                        <?php if(isset($upload_error)){ ?>
                            <div style="text-align:center;margin-bottom:20px;border: 1px solid red;color: green;color:red;">
                            <?php
                            if(is_array($upload_error)) {
                                foreach ($upload_error as $key => $value) {
                                    echo $value . '<br>';
                                }
                            } else {
                                echo $upload_error;
                            } ?>
                            </div>
                        <?php } ?>
                        <?php if(isset($upload_skin_success)) { ?>
                            <div style="text-align:center;margin-bottom:20px;border: 1px solid green;color: green;">
                                <h3><?php echo $upload_skin_success; ?></h3>
                            </div>
                        <?php } ?>

                        <form name="upload" action="/skins/uploadskin<?php echo isset($update_id) ? '/' . $update_id : '' ?>" method="POST" id="upload-skin" enctype="multipart/form-data">
                            <div class="form-group" id="title_package_w">
                                <label for="title_package"><?php echo $this->lang->line('upload_input_package_title_text'); ?>*</label>
                                <input type="text" class="form-control" id="title_package" name="package_title" placeholder="Required" value="<?php echo isset($update_package_data) ? $update_package_data->title : ''; ?>" required>
                            </div>

                            <hr>

                            <?php foreach ($update_skins_data as $key => $skin) { ?>
                                <div class="form-group" id="title1">
                                    <label for="title"><?php echo $this->lang->line('upload_input_title_text'); ?>*</label>
                                    <input type="text" class="form-control" id="title" name="title[]" placeholder="Required" value="<?php echo isset($skin->title) ? $skin->title : ''; ?>"  required>
                                </div>
                                <div class="form-group">
                                    <label for="model"><?php echo $this->lang->line('upload_input_model_text'); ?>*</label>
                                    <select class="form-control" id="model" name="model[]" required>
                                        <?php
                                        $this->db->select('models.id, models.name, models.brand_id, models.layout_file, brands.name as brand_name');
                                        $this->db->from('brands');
                                        $this->db->join('models', 'brands.id = models.brand_id');
                                        $this->db->order_by('id', 'DESC');
                                        $models = $this->db->get();
                                        foreach ($models->result() as $model) { ?>
                                            <option value="<?php echo $model->brand_id . '-' . $model->id; ?>" <?php echo $skin->brand . '-' . $skin->model == $model->brand_id . '-' . $model->id ? 'selected' : ''; ?>><?php echo $model->brand_name . ' - ' . $model->name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group p-relative">
                                    <label for="skin"><?php echo $this->lang->line('upload_input_skin_text'); ?>* <span>Only PNG/JPG</span></label>
                                    <div class="input-group">
                                        <div class="file-upload">
                                            <div class="file-select">
                                                <div class="file-select-name noFile">No file chosen...</div>
                                                <input type="file" id="skin" name="skin[]" <?php echo isset($update_id) ? '' : 'required' ?>>
                                                <div class="file-select-button">Choose File</div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo $skin->skin_img ? '<img height="80" src="/uploads/'. $skin->skin_img .'">' : ''; ?>
                                </div>
                                <div class="form-group p-relative">
                                    <label for="screenShot"><?php echo $this->lang->line('upload_input_screen_text'); ?>* <span>Only PNG/JPG</span></label>
                                    <div class="input-group">
                                        <div class="file-upload">
                                            <div class="file-select">
                                                <div class="file-select-name noFile">No file chosen...</div>
                                                <input type="file" id="screenShot" name="screenshot[]" <?php echo isset($update_id) ? '' : 'required' ?>>
                                                <div class="file-select-button">Choose File</div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo $skin->screen_img ? '<img height="80" src="/uploads/'. $skin->screen_img .'">' : ''; ?>
                                </div>
                                <div class="form-group">
                                    <label for="description"><?php echo $this->lang->line('upload_input_desc_text'); ?>*</label>
                                    <textarea class="form-control" id="description" name="description[]" rows="10" placeholder="Required"><?php echo isset($skin->description) ? $skin->description : ''; ?></textarea>
                                </div>
                                <?php if($update_id){ ?>
                                    <a href="<?php echo '?skin_sil='. $skin->id; ?>">Delete</a>
                                    <input name="skin_ids[]" value="<?php echo $skin->id; ?>" hidden>
                                <?php } ?>
                                <hr>

                            <?php } ?>

                            <div id="more-skins"></div>

                            <div class="custom-form__submit double">
                                <button type="button" class="btn btn-default" onclick="insert()">+ <?php echo $this->lang->line('upload_btn_addmore'); ?></button>
                                <button type="submit" name="upload" class="btn btn-info"><?php echo $update_id ? $this->lang->line('save_text') : $this->lang->line('upload_btn_submit'); ?></button>
                            </div>
                            <div class="form-group form-check">
                                <label class="check--label">
                                    <span class="check--label-text m-auto"><a class="modal-trigger"><?php echo $this->lang->line('contract_title'); ?></a></span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal-container">
        <div class="modal-content">
            <div class="modal-close"><i class="fas fa-times"></i></div>
            <p>
                <?php echo $this->lang->line('contract_text'); ?>
            </p>
        </div>
    </div>

    <div class="modal-overlay"></div>