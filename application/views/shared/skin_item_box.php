<div class="block">
    <div class="block__item">
        <a href="/skins/detail/<?php echo $skin->id; ?>">
          <img src="/uploads/<?php echo $skin->screen_img; ?>" alt="" class="block__img">
        </a>
        <a href="/skins/detail/<?php echo $skin->id; ?>" class="block__title"><?php echo $skin->title; ?></a>
        <div class="block__footer">
            <span class="block__account">
                <?php
                $this->db->where('id', $skin->package_id);
                $package = $this->db->get('packets')->row();
                if(isset($package->user_id)) {
                    $this->db->where('id', $package->user_id);
                    $user = $this->db->get('users')->row();
                    if($user) {
                        echo $user->username;
                    }
                }
                ?>
            </span>
            <?php
            $this->db->select('AVG(score) as total_score');
            $this->db->where('skin_id', $skin->id);
            $total_score = $this->db->get('likes')->row()->total_score;
            $total_score = round($total_score);
            ?>
            <div class="stars">
                <?php
                for ($i=0; $i < $total_score; $i++) {
                  echo '<i class="fas fa-star check"></i>';
                }
                ?>
                <?php
                for ($i=0; $i < (5 - $total_score); $i++) {
                  echo '<i class="fas fa-star"></i>';
                }
                ?>
            </div>
        </div>
    </div>
</div>