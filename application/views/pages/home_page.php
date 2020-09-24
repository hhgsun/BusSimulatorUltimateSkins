    <section class="showcase-section">
        <div class="container">
            <div class="row">
                <div class="showcase">
                    <?php if(isset($editor_choice)) { ?>
                        <div class="showcase__card">
                            <a href="/skins/detail/<?php echo $editor_choice->id; ?>">
                                <span class="sticker">
                                    <i class="fas fa-star"></i> <?php echo $this->lang->line('editor_choice_title'); ?>
                                </span>
                                <img src="/uploads/<?php echo $editor_choice->screen_img; ?>" alt="" class="showcase__card-img">
                                <div class="showcase__card-footer">
                                    <span class="showcase__card-title"><?php echo $editor_choice->title; ?></span>
                                    <span class="showcase__card-category">
                                        <?php
                                        $this->db->where('id', $editor_choice->brand);
                                        $cbrand = $this->db->get('brands')->row();
                                        $this->db->where('id', $editor_choice->model);
                                        $cmodel = $this->db->get('models')->row();
                                        echo $cbrand->name . ' - ' . $cmodel->name; ?>
                                    </span>
                                    <p class="showcase__card-desc">
                                        <?php echo $editor_choice->description; ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="showcase__brands">
                        <p class="showcase__title">
                            <?php echo $this->lang->line('bus_brands_title'); ?>
                        </p>
                        <ul class="showcase__list">

                            <?php foreach ($brands as $key => $value) { ?>
                                <li class="showcase__item">
                                    <a href="/skins/index/1?filter_brands[<?php echo $value->id; ?>]=on" class="showcase__link" title="<?php echo $value->name; ?>">
                                        <img src="/upload_brands/<?php echo $value->logo; ?>" alt="<?php echo $value->name; ?>">
                                    </a>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="block-section">
        <div class="container">
            <div class="row">
                <div class="block__list">
                    <p class="block__caption"><?php echo $this->lang->line('newest_title'); ?></p>
                    <?php foreach ($new_skins as $skey => $skin) {
                        $this->load->view("shared/skin_item_box", array('skin' => $skin));
                    } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="block-section">
        <div class="container">
            <div class="row">
                <div class="block__list">
                    <p class="block__caption"><?php echo $this->lang->line('most_down_title'); ?></p>                    
                    <?php foreach ($most_down_skins as $skey => $skin) {
                        $this->load->view("shared/skin_item_box", array('skin' => $skin));
                    } ?>
                </div>
            </div>
        </div>
    </section>


    <section class="block-section">
        <div class="container">
            <div class="row">
                <div class="block__list">
                    <p class="block__caption"><?php echo $this->lang->line('skin_packs_title'); ?></p>
                    <?php foreach ($skin_packs as $skey => $skin) {
                        $this->load->view("shared/skin_item_box", array('skin' => $skin));
                    } ?>
                </div>
            </div>
        </div>
    </section>
