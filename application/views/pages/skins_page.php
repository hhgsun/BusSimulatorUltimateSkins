<?php
function isBrandChecked($value) {
  if(isset($_GET['filter_brands'])) { 
    echo array_key_exists($value->id, $_GET['filter_brands']) ? 'checked' : '';
  };
}

function isModelChecked($value) {
  if(isset($_GET['filter_models'])) { 
    echo array_key_exists($value->id, $_GET['filter_models']) ? 'checked' : '';
  };
}
?>

<section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12" style="padding: 0;">
                    <span class="btn btn-default mobile-filter"><?php echo $this->lang->line('filter_text'); ?></span>
                    <form name="filter" action="1" method="GET">
                        <div class="filter">
                            <div class="filter__close"><i class="fas fa-times"></i><?php echo $this->lang->line('close_text'); ?></div>
                            <div class="filter__caption"><?php echo $this->lang->line('filter_text'); ?></div>
                            <div class="filter__category">
                                <p class="filter__title"><?php echo $this->lang->line('brand_text'); ?></p>
                                <ul class="filter__list">
                                    <?php
                                    $brands = $this->db->get('brands');
                                    foreach ($brands->result() as $key => $value) { ?>
                                      <li class="filter__item">
                                          <input type="checkbox" class="hidden-box" name="filter_brands[<?php echo $value->id; ?>]" id="brand_<?php echo $key; ?>" <?php isBrandChecked($value); ?> />
                                          <label for="brand_<?php echo $key; ?>" class="check--label">
                                              <span class="check--label-box"></span>
                                              <span class="check--label-text"><?php echo $value->name; ?></span>
                                          </label>
                                      </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="filter__category">
                                <p class="filter__title"><?php echo $this->lang->line('model_text'); ?></p>
                                <ul class="filter__list">
                                    <?php
                                    $models = $this->db->get('models');
                                    foreach ($models->result() as $key => $value) { ?>
                                      <li class="filter__item">
                                          <input type="checkbox" class="hidden-box" name="filter_models[<?php echo $value->id; ?>]" id="model_<?php echo $key; ?>" <?php isModelChecked($value); ?>/>
                                          <label for="model_<?php echo $key; ?>" class="check--label">
                                              <span class="check--label-box"></span>
                                              <span class="check--label-text"><?php echo $value->name; ?></span>
                                          </label>
                                      </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="filter__btn">
                                <button type="submit" class="btn btn-info"><?php echo $this->lang->line('btn_filter_update_text'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-10 col-sm-12 col-xs-12 pr-0">
                    <section class="block-section">
                        <div class="block__list sub">
                            <p class="block__caption"><?php echo $headTitle; ?></p>
                            <?php
                            if( !empty($skin_list) ) {
                              foreach ($skin_list as $key => $skin) {
                                $this->load->view("shared/skin_item_box", array('skin' => $skin));
                              }
                            } else { ?>
                              <h2 class="block__caption" style="text-align: center; font-size: 20px;">Bulunamadı</h2>
                            <?php } ?>
                        </div>
                    </section>
                    <section class="pagination-section">
                        <?php if( !empty($skin_list) ) { ?>
                          <div class="pagination">
                              <?php
                                $filter_query = '';
                                $url_q = explode('?', $_SERVER['REQUEST_URI']);
                                if(count($url_q) > 1) {
                                  $filter_query = $url_q[1];
                                }
                              ?>
                              <?php if($this->uri->segment(3) != 1) { ?>
                                <a href="<?php echo $this->uri->segment(3) - 1; ?>?<?php echo $filter_query; ?>" class="pagination__link text">
                                    <i class="fas fa-angle-left"></i> Önceki
                                </a>
                              <?php } ?>
                              <?php
                              for ($i=1; $i < $pagination_count + 1; $i++) { ?>
                                <a href="<?php echo $i; ?>?<?php echo $filter_query; ?>" class="pagination__link number <?php echo $this->uri->segment(3) == $i ? 'active' : '' ?> "><?php echo $i; ?></a>
                              <?php }
                              ?>
                              <?php if($this->uri->segment(3) != $pagination_count) { ?>
                                <a href="<?php echo $this->uri->segment(3) + 1; ?>?<?php echo $filter_query; ?>" class="pagination__link text">
                                    Sonraki <i class="fas fa-angle-right"></i>
                                </a>
                              <?php } ?>
                          </div>
                        <?php } ?>
                    </section>
                </div>
            </div>
        </div>
    </section>