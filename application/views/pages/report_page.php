<section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="custom-form">
                        <?php if(isset($success_msg)) { ?>
                          <div style="text-align:center;margin-bottom:20px;border: 1px solid green;color: green;">
                              <h3><?php echo $success_msg; ?></h3>
                          </div>
                        <?php } ?>
                        <?php echo @$upload_error; ?>

                        <form name="dmca" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nameSurname"><?php echo $this->lang->line('reports_input_name_text'); ?>*</label>
                                <input type="text" class="form-control" id="nameSurname" name="nameSurname" placeholder="Required">
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo $this->lang->line('reports_input_mail_text'); ?>*</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Required">
                            </div>
                            <div class="form-group">
                                <label for="company"><?php echo $this->lang->line('reports_input_company_text'); ?>*</label>
                                <input type="text" class="form-control" id="company" name="company" placeholder="Required">
                            </div>
                            <div class="form-group">
                                <label for="mod"><?php echo $this->lang->line('reports_input_address_url_text'); ?>*</label>
                                <input type="text" class="form-control" id="mod" name="mod" aria-describedby="nameHelp" placeholder="Required">
                            </div>
                            <div class="form-group p-relative">
                                <label for="document"><?php echo $this->lang->line('reports_input_document_text'); ?>*
                                <span>Only PDF/PNG/JPG</span>
                                </label>
                                <div class="input-group">
                                    <div class="file-upload">
                                        <div class="file-select">
                                            <div class="file-select-name noFile">No file chosen...</div>
                                            <input type="file" id="document" name="document">
                                            <div class="file-select-button">Choose File</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="complaint"><?php echo $this->lang->line('reports_input_complait_text'); ?>*</label>
                                <textarea class="form-control" id="complaint" name="complaint" rows="10" placeholder="Required"></textarea>
                            </div>
                            <div class="custom-form__submit">
                                <button type="submit" name="dmca" class="btn btn-info"><?php echo $this->lang->line('reports_btn_submit'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
