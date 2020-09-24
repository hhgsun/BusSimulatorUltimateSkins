    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="custom-form">
                        <div style="text-align:center;margin-bottom:20px;color:red;">
                          <?php echo @$validation_error; ?>
                        </div>
                        <form name="register" action="/account/register" method="POST">
                            <div class="form-group">
                                <label for="nameSurname"><?php echo $this->lang->line('register_namesurname_text'); ?>*</label>
                                <input type="text" class="form-control" id="nameSurname" name="nameSurname" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo $this->lang->line('register_email_text'); ?>*</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="userName"><?php echo $this->lang->line('register_username_text'); ?>*</label>
                                <input type="text" class="form-control" id="userName" name="userName" aria-describedby="nameHelp" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="password"><?php echo $this->lang->line('register_password_text'); ?>*</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="hidden-box" id="pln"/>
                                <label for="pln" class="check--label">
                                    <span class="check--label-text"><a class="modal-trigger"><?php echo $this->lang->line('contract_title'); ?></a></span>
                                </label>
                            </div>
                            <div class="custom-form__submit">
                                <button type="submit" name="register" class="btn btn-info"><?php echo $this->lang->line('register_btn_submit'); ?></button>
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