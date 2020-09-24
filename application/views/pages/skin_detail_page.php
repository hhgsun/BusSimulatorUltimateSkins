<?php if( !empty($skin_data) ) { ?>
  <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12" style="padding: 0;">
                    <span class="btn btn-default mobile-filter ml-15">Özellikler</span>
                    <form action="">
                        <div class="filter">
                            <div class="filter__close"><i class="fas fa-times"></i>Kapat</div>
                            <div class="filter__caption">Kategori</div>
                            <div class="filter__category">
                                <p class="filter__title">Marka</p>
                                <ul class="filter__list">
                                    <?php
                                    $this->db->where('package_id', $skin_data->package_id);
                                    $other_skins = $this->db->get('skins')->result();
                                    foreach ($other_skins as $okey => $oskin) {
                                        $this->db->where('id', $oskin->brand);
                                        $brand = $this->db->get('brands')->row();
                                        ?>
                                            <li class="filter__item">
                                                <a href="/skins/index/1?filter_brands[<?php echo $brand->id; ?>]=on" class="check--label">
                                                    <span class="check--label-text"><?php echo $brand->name; ?></span>
                                                </a>
                                            </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="filter__category">
                                <p class="filter__title">Model</p>
                                <ul class="filter__list">
                                    <?php
                                    $this->db->where('package_id', $skin_data->package_id);
                                    $other_skins = $this->db->get('skins')->result();
                                    foreach ($other_skins as $okey => $oskin) {
                                        $this->db->where('id', $oskin->model);
                                        $model = $this->db->get('models')->row();
                                        ?>
                                            <li class="filter__item">
                                                <a href="/skins/index/1?filter_models[<?php echo $model->id; ?>]=on" class="check--label">
                                                    <span class="check--label-text"><?php echo $model->name; ?></span>
                                                </a>
                                            </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-10 col-sm-12 col-xs-12 pr-0">
                    <section class="skin-card">
                        <div class="card">
                            <div class="card__img">
                                <img src="/uploads/<?php echo $skin_data->screen_img; ?>" alt="">
                            </div>
                            <div class="card__content">
                                <div class="card__text">
                                    <p class="card__title"><?php echo $skin_data->title; ?></p>
                                    <p class="card__owner">
                                    <?php
                                    $this->db->where('id', $skin_data->package_id);
                                    $package = $this->db->get('packets')->row();
                                    if(isset($package->user_id)) {
                                        $this->db->where('id', $package->user_id);
                                        $user = $this->db->get('users')->row();
                                        if($user) {
                                            echo $user->username;
                                        }
                                    }
                                    ?>
                                    </p>
                                    <p class="card__desc"><?php echo $skin_data->description; ?></p>
                                    <div class="card__point">
                                        Puan ver
                                        <?php
                                        if( isset($this->session->user_id) ) {
                                            if(isset($_POST['rating'])) {
                                                $this->db->where('user_id', $this->session->user_id);
                                                $this->db->where('skin_id', $skin_data->id);
                                                $curr_like = $this->db->get('likes');
                                                if($curr_like->num_rows() > 0) {
                                                    $this->db->set('score', $this->input->post('rating'));
                                                    $this->db->where('user_id', $this->session->user_id);
                                                    $this->db->where('skin_id', $skin_data->id);
                                                    $this->db->update('likes');
                                                } else {
                                                    $this->db->insert('likes', array(
                                                        'user_id' => $this->session->user_id,
                                                        'skin_id' => $skin_data->id,
                                                        'score' => $this->input->post('rating'),
                                                    ));
                                                }
                                            }
                                            $this->db->where('user_id', $this->session->user_id);
                                            $this->db->where('skin_id', $skin_data->id);
                                            $curr_like = $this->db->get('likes');
                                            if($curr_like->num_rows() > 0) {
                                                echo '<span class="hint" style="opacity:1; visibility:visible;">
                                                    Senin puanın '. $curr_like->row()->score .'
                                                </span>';
                                            }
                                        }
                                        $this->db->select('AVG(score) as total_score');
                                        $this->db->where('skin_id', $skin_data->id);
                                        $total_score = $this->db->get('likes')->row()->total_score;
                                        $total_score = round($total_score);
                                        ?>
                                        <?php echo $this->session->user_id ? '<form method="POST">' : '' ?>
                                            <fieldset class="stars rating">
                                                <input type="radio" id="star5" name="rating" value="5" <?php echo $total_score == 5 ? 'checked' : ''; ?> onchange="this.form.submit()" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                <input type="radio" id="star4" name="rating" value="4" <?php echo $total_score == 4 ? 'checked' : ''; ?> onchange="this.form.submit()" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                <input type="radio" id="star3" name="rating" value="3" <?php echo $total_score == 3 ? 'checked' : ''; ?> onchange="this.form.submit()" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                <input type="radio" id="star2" name="rating" value="2" <?php echo $total_score == 2 ? 'checked' : ''; ?> onchange="this.form.submit()" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                <input type="radio" id="star1" name="rating" value="1" <?php echo $total_score == 1 ? 'checked' : ''; ?> onchange="this.form.submit()" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                            </fieldset>
                                        <?php echo $this->session->user_id ? '</form>' : '' ?>
                                        <?php
                                        if(!$this->session->user_id) {
                                            echo '<span class="hint">
                                                    Puanlama yapmak için giriş yapmalısınız.
                                                </span>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="card__btn">
                                    <input type="hidden" value="<?php echo 'http://' . $_SERVER['SERVER_NAME'] .'/skins/download/' . $skin_data->package_id; ?>" id="hiddenUrl">
                                    <button class="btn btn-success" onclick="copyUrl('#hiddenUrl', <?php echo $skin_data->package_id; ?>)"><?php echo $this->lang->line('copy_url_text'); ?></button>
                                    <p class="custom-tooltip"><?php echo $this->lang->line('copy_url_result'); ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="instruction-section">
                        <div class="instruction">
                            <p><?php echo $this->lang->line('how_instruction'); ?></p>
                            <?php echo $this->lang->line('how_iframe_video'); ?>
                        </div>
                    </section>
                    <section class="block-section">
                        <div class="block__list sub">
                            <p class="block__caption">MORE SKINS</p>
                            <?php foreach ($more_skins as $skey => $skin) {
                                $this->load->view("shared/skin_item_box", array('skin' => $skin));
                            } ?>
                        </div>
                    </section>
                </div>
            </div>
        </div>
  </section>
<?php } else { ?>
  <p class="block__caption" style="text-align: center; padding-top: 23px;display: flex; justify-content: center;">
    BULUNAMADI
  </p>
<?php } ?>

<script>
    function copyUrl(element, packege_id) {
        $('.custom-tooltip').removeClass('active');
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).val()).select();
        document.execCommand("copy");
        $temp.remove();
        $('.custom-tooltip').addClass('active');
        lastDown(packege_id);
    }

    function lastDown(packege_id) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
            }
        };
        xhttp.open("GET", "/skins/most_download/" + packege_id, true);
        xhttp.send();
    }
</script>