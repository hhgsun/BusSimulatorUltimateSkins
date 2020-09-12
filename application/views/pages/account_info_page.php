<section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-2" style="padding: 0;">
                    <?php $this->load->view('/shared/account_side'); ?>
                </div>
                <div class="col-md-10 pr-0">
                    <section class="block-section">
                        <div class="block__list sub">
                            <p class="block__caption"><?php echo $this->lang->line('info_title'); ?></p>
                            
                            <div class="custom-form" style="padding:10px 20px; margin-top:10px;">
                                <div style="text-align:center;margin-bottom:20px;color:red;">
                                  <?php echo @$validation_error; ?>
                                </div>
                                <div style="text-align:center;margin-bottom:20px;color:green;">
                                  <?php echo @$success_text; ?>
                                </div>
                                <form name="save" action="/account/myinfo" method="POST">
                                    <div class="form-group">
                                        <label for="nameSurname">Adınız Soyadınız*</label>
                                        <input type="text" class="form-control" id="nameSurname" name="nameSurname" value="<?php echo $form_data['name']; ?>" placeholder="Adınızı ve soyadınızı yazınız" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="userName">Kullanıcı Adı*</label>
                                        <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $form_data['username']; ?>" aria-describedby="nameHelp" placeholder="Kullanıcı adınızı yazınız" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-posta*</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $form_data['email']; ?>" placeholder="E-posta adresinizi yazınız" disabled>
                                    </div>
                                    <div class="custom-form__submit">
                                        <button type="submit" name="save" class="btn btn-info">Kaydet</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>