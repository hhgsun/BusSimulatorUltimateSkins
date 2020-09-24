<section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-2" style="padding: 0;">
                    <?php $this->load->view('/shared/account_side'); ?>
                </div>
                <div class="col-md-10 pr-0">
                    <section class="block-section">
                        <div class="block__list sub">
                            <p class="block__caption">SKINLERİM</p>
                            <?php foreach ($packets as $key => $value) { ?>
                              <div class="block">
                                  <div class="block__item">
                                      <a href="/skins/uploadskin/<?php echo $value->id; ?>" class="block__title"><?php echo $value->title; ?></a>
                                  </div>
                              </div>
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