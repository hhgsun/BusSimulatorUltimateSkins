                    <span class="btn btn-default mobile-filter"><?php echo $this->lang->line('account_nav_title'); ?></span>
                    <form action="">
                        <div class="filter">
                            <div class="filter__close"><i class="fas fa-times"></i><?php echo $this->lang->line('close_text'); ?></div>
                            <div class="filter__caption"><?php echo $this->lang->line('account_nav_title'); ?></div>
                            <div class="filter__category">
                                <p class="filter__title"><?php echo $this->lang->line('account_nav_skins_title'); ?></p>
                                <ul class="filter__list">
                                    <li class="filter__item">
                                        <a href="/account/index/1" class="check--label">
                                            <span class="check--label-text"><?php echo $this->lang->line('account_nav_packets_title'); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="filter__category">
                                <p class="filter__title"><?php echo $this->lang->line('account_nav_member_title'); ?></p>
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
                                            <span class="check--label-text"><?php echo $this->lang->line('account_nav_info_title'); ?></span>
                                        </a>
                                    </li>
                                    <li class="filter__item">
                                        <a href="/account/changepass" class="check--label">
                                            <span class="check--label-text"><?php echo $this->lang->line('account_nav_pass_title'); ?></span>
                                        </a>
                                    </li>
                                    <li class="filter__item">
                                        <a href="/account/logout" class="check--label">
                                            <span class="check--label-text"><?php echo $this->lang->line('account_nav_logout_title'); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>