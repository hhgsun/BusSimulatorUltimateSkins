                    <span class="btn btn-default mobile-filter">Hesabım</span>
                    <form action="">
                        <div class="filter">
                            <div class="filter__close"><i class="fas fa-times"></i>Kapat</div>
                            <div class="filter__caption">Hesabım - <?php echo 'UID:' . $this->session->user_id; ?></div>
                            <div class="filter__category">
                                <p class="filter__title">Skinlerim</p>
                                <ul class="filter__list">
                                    <li class="filter__item">
                                        <label class="check--label">
                                            <span class="check--label-text">Mercedes-Benz (22)</span>
                                        </label>
                                    </li>
                                    <li class="filter__item">
                                        <label class="check--label">
                                            <span class="check--label-text">Setra (22)</span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="filter__category">
                                <p class="filter__title">Üyelik</p>
                                <ul class="filter__list">
                                    <?php if($this->session->is_admin){ ?>
                                        <li class="filter__item">
                                            <a href="/admin" class="check--label" target="_blank">
                                                <span class="check--label-text">Admin Panel</span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li class="filter__item">
                                        <a href="/account/myinfo" class="check--label">
                                            <span class="check--label-text">Bilgilerim</span>
                                        </a>
                                    </li>
                                    <li class="filter__item">
                                        <a href="/account/changepass" class="check--label">
                                            <span class="check--label-text">Şifre Değiştir</span>
                                        </a>
                                    </li>
                                    <li class="filter__item">
                                        <a href="/account/logout" class="check--label">
                                            <span class="check--label-text">Çıkış</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>