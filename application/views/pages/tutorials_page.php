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
                                Skin oluşturmak için photoshop bilgisine sahip olmanız gerekmektedir!
                            </p>
                            <p>
                                Skin yapmak istediğiniz otobosün yerleşim planını alt bölümde bulunan layout yükleme bölümünden indirebilirsiniz.
                            </p>
                        </div>
                        <form class="was-validated" action="/tutorials" method="POST">
                            <div class="form-group">
                                <label for="manufacturers">Manufacturers</label>
                                <select class="form-control" id="manufacturers" onchange="selectBrand()">
                                    <?php
                                    $brands = $this->db->get('brands');
                                    foreach ($brands->result() as $value) { ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="models">Model</label>
                                <select class="form-control" id="models" name="model_id" required>
                                    <?php
                                    $models = $this->db->get('models');
                                    foreach ($models->result() as $value) { ?>
                                        <option value="<?php echo $value->id; ?>" class="model_option_<?php echo $value->brand_id; ?>"><?php echo $value->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="hidden-box" id="pln"/>
                                <label for="pln" class="check--label">
                                    <span class="check--label-box"></span>
                                    <span class="check--label-text"><span class="modal-trigger">Kullanıcı Sözleşmesini </span> okudum ve kabul ediyorum.</span>
                                </label>
                            </div>
                            <div class="custom-form__submit">
                                <button type="submit" class="btn btn-info">Download Layout</button>
                            </div>
                        </form>
                    <?php } ?>
                    <div class="text">
                        <p class="title">Skin nasıl yapılır?</p>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/w_GC7LeCzaY"
                                frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
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
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. In quae quos repellendus rerum soluta!
            Blanditiis corporis cumque, eveniet facilis ipsam iure neque porro ratione sapiente sed tempora
            temporibus, voluptas voluptatum?
        </p>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. In quae quos repellendus rerum soluta!
            Blanditiis corporis cumque, eveniet facilis ipsam iure neque porro ratione sapiente sed tempora
            temporibus, voluptas voluptatum?
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
