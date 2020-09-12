<section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-2" style="padding: 0;">
                    <?php $this->load->view('/shared/account_side'); ?>
                </div>
                <div class="col-md-10 pr-0">
                    <section class="block-section">
                        <div class="block__list sub">
                            <p class="block__caption"><?php echo $this->lang->line('pass_title'); ?></p>
                            
                            <div class="custom-form" style="padding:10px 20px; margin-top:10px;">
                                <div style="text-align:center;margin-bottom:20px;color:red;">
                                  <?php echo @$validation_error; ?>
                                </div>
                                <div style="text-align:center;margin-bottom:20px;color:green;">
                                  <?php echo @$success_text; ?>
                                </div>
                                <form name="passchange" action="/account/changePass" method="POST" class="was-validated">
                                    <div class="form-group">
                                        <label for="password">Mevcut Şifre</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Şifrenizi yazınız">
                                    </div>
                                    <div class="form-group">
                                        <label for="password2">Yeni Şifre</label>
                                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Yeni Şifrenizi yazınız">
                                    </div>
                                    <div class="custom-form__submit">
                                        <button type="submit" name="passchange" class="btn btn-info">Kaydet</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>