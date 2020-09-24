    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="custom-form">
                        <div style="text-align:center;margin-bottom:20px;color:red;">
                          <?php echo @$validation_error; ?>
                        </div>
                        <form name="login" action="/account/login" method="POST" class="was-validated">
                            <div class="form-group">
                                <label for="email"><?php echo $this->lang->line('register_email_text'); ?></label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-posta adresinizi yazınız">
                            </div>
                            <div class="form-group">
                                <label for="password"><?php echo $this->lang->line('register_password_text'); ?></label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Şifrenizi yazınız">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="hidden-box" id="pln"/>
                                <label for="pln" class="check--label">
                                    <span class="check--label-box"></span>
                                    <span class="check--label-text"><?php echo $this->lang->line('login_remember'); ?></span>
                                </label>
                            </div>
                            <div class="custom-form__submit">
                                <button type="submit" name="login" class="btn btn-info"><?php echo $this->lang->line('login_btn_submit'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>