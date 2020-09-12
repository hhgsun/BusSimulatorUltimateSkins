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
                                <label for="nameSurname">Adınız Soyadınız*</label>
                                <input type="text" class="form-control" id="nameSurname" name="nameSurname" placeholder="Adınızı ve soyadınızı yazınız">
                            </div>
                            <div class="form-group">
                                <label for="email">E-posta*</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="E-posta adresinizi yazınız">
                            </div>
                            <div class="form-group">
                                <label for="userName">Kullanıcı Adı*</label>
                                <input type="text" class="form-control" id="userName" name="userName" aria-describedby="nameHelp" placeholder="Kullanıcı adınızı yazınız">
                            </div>
                            <div class="form-group">
                                <label for="password">Şifre*</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Şifre yazınız">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="hidden-box" id="pln"/>
                                <label for="pln" class="check--label">
                                    <span class="check--label-text"><a class="modal-trigger">Kullanıcı Sözleşmesini </a> okudum ve kabul ediyorum.</span>
                                </label>
                            </div>
                            <div class="custom-form__submit">
                                <button type="submit" name="register" class="btn btn-info">Hesap Oluştur</button>
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