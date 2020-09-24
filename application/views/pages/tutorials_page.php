<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="custom-form">
                    <?php if(isset($layout_link)) { ?>
                        <div style="text-align:center; font-size:1.5em">
                            <a href="<?php echo $layout_link; ?>" title="download link">dosyayı indirmek için tıklayınız</a>
                        </div>
                    <?php } else { ?>
                        <div class="text">
                            <p>
                                <?php echo $this->lang->line('tutorials_toptext'); ?>
                            </p>
                        </div>
                        <form class="was-validated" action="/tutorials" method="POST">
                            <div class="form-group">
                                <label for="manufacturers"><?php echo $this->lang->line('brand_text'); ?></label>
                                <select class="form-control" id="manufacturers" onchange="selectBrand()">
                                    <?php
                                    $brands = $this->db->get('brands');
                                    foreach ($brands->result() as $value) { ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="models"><?php echo $this->lang->line('model_text'); ?></label>
                                <select class="form-control" id="models" name="model_id" required>
                                    <?php
                                    $models = $this->db->get('models');
                                    foreach ($models->result() as $value) { ?>
                                        <option value="<?php echo $value->id; ?>" class="model_option_<?php echo $value->brand_id; ?>"><?php echo $value->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="hidden-box" id="pln" required/>
                                <label for="pln" class="check--label">
                                    <span class="check--label-box"></span>
                                    <span class="check--label-text"><span class="modal-trigger"><?php echo $this->lang->line('contract_title'); ?></span></span>
                                </label>
                            </div>
                            <div class="custom-form__submit">
                                <button type="submit" class="btn btn-info"><?php echo $this->lang->line('tutorials_btn_down_text'); ?></button>
                            </div>
                        </form>
                    <?php } ?>
                    <div class="text">
                        <p class="title"><?php echo $this->lang->line('tutorials_how_skin'); ?></p>
                        <?php echo $this->lang->line('tutorials_how_iframe_video'); ?>
                        </iframe>
                    </div>
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

<script>
function selectBrand() {
    var selectedBrand = document.getElementById('manufacturers').value;
    if(selectedBrand) {
        var models = document.getElementById('models');
        models.value = null;
        for(var i = 0; i < models.childElementCount; i++){
            if(models.children.item(i).className == "model_option_" + selectedBrand) {
                models.children.item(i).hidden = false;
            } else {
                models.children.item(i).hidden = true;
            }
        }
    }
}
selectBrand();
</script>
