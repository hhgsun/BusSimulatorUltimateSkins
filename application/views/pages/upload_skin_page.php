<section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="custom-form">
                        <?php if(isset($upload_error)){ ?>
                            <div style="text-align:center;margin-bottom:20px;border: 1px solid red;color: green;color:red;">
                            <?php foreach ($upload_error as $key => $value) {
                                echo $value . '<br>';
                            } ?>
                            </div>
                        <?php } ?>
                        <?php if(isset($upload_skin_success)) { ?>
                            <div style="text-align:center;margin-bottom:20px;border: 1px solid green;color: green;">
                                <h3><?php echo $upload_skin_success; ?></h3>
                            </div>
                        <?php } ?>

                        <form name="upload" action="/skins/uploadskin" method="POST" id="upload-skin" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nameSurname" >Your Name*</label>
                                <input type="text" class="form-control" id="nameSurname" name="nameSurname" placeholder="Required">
                            </div>
                            <div class="form-group">
                                <label for="email">Your E-Mail*</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Required">
                            </div>
                            <div class="form-group">
                                <label for="company">Company*</label>
                                <input type="text" class="form-control" id="company" name="company" placeholder="Required">
                            </div>
                            <div class="form-group">
                                <label for="credits">Credits (Author)*</label>
                                <input type="text" class="form-control" id="credits" name="credits" placeholder="Required">
                            </div>

                            <!-- <div class="form-group" id="title1">
                                <label for="title">Title*</label>
                                <input type="text" class="form-control" id="title" name="title[]" placeholder="Required">
                            </div>
                            <div class="form-group">
                                <label for="manufacturers">Manufacturers</label>
                                <select class="form-control" id="manufacturers" name="manufacturers[]" onchange="selectBrand()">
                                    <?php
                                    $brands = $this->db->get('brands');
                                    foreach ($brands->result() as $value) { ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div> -->
                            <div class="form-group">
                                <label for="model">Model</label>
                                <select class="form-control" id="model" name="model[]">
                                    <?php
                                    $this->db->select('models.id, models.name, models.brand_id, models.layout_file, brands.name as brand_name');
                                    $this->db->from('brands');
                                    $this->db->join('models', 'brands.id = models.brand_id');
                                    $this->db->order_by('id', 'DESC');
                                    $models = $this->db->get();
                                    foreach ($models->result() as $value) { ?>
                                        <option value="<?php echo $value->brand_id . '-' . $value->id; ?>"><?php echo $value->brand_name . ' - ' . $value->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group p-relative">
                                <label for="skin">Skin* <span>Only PNG/JPG</span></label>
                                <div class="input-group">
                                    <div class="file-upload">
                                        <div class="file-select">
                                            <div class="file-select-name noFile">No file chosen...</div>
                                            <input type="file" id="skin" name="skin[]">
                                            <div class="file-select-button">Choose File</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group p-relative">
                                <label for="screenShot">
                                    Screenshot*
                                    <span>Only PNG/JPG</span>
                                </label>
                                <div class="input-group">
                                    <div class="file-upload">
                                        <div class="file-select">
                                            <div class="file-select-name noFile">No file chosen...</div>
                                            <input type="file" id="screenShot" name="screenshot[]">
                                            <div class="file-select-button">Choose File</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description*</label>
                                <textarea class="form-control" id="description" name="description[]" rows="10" placeholder="Required"></textarea>
                            </div>

                            <div id="more-skins"></div>

                            <div class="custom-form__submit double">
                                <button type="button" class="btn btn-default" onclick="insert()">+ Add More Skin</button>
                                <button type="submit" name="upload" class="btn btn-info">Upload Skin</button>
                            </div>
                            <div class="form-group form-check">
                                <label class="check--label">
                                    <span class="check--label-text m-auto"><a class="modal-trigger">Kullanıcı Sözleşmesini </a> okudum ve kabul ediyorum.</span>
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