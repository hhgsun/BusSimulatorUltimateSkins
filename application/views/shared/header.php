<?php
if( isset($_GET['selectLanguage']) ) {
    $this->session->set_userdata('lang', $this->input->get('selectLanguage'));
    echo '<script>
    location.replace(location.href.split("?")[0]);
    console.log(location);
    </script>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0">

    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="/assets/main.css">

</head>

<body>

    <header>
        <section class="menu">
            <div class="menu__content">
                <a href="/" class="menu__logo-link">
                    <img src="/assets/img/logo.png" alt="Logo" class="menu__logo">
                </a>
                <div class="menu-nav">
                    <a href="/" class="menu-nav__link <?php echo $this->uri->segment(1) == null ? 'active' : ''; ?>">Home</a>
                    <a href="skins.html" class="menu-nav__link">All Skins</a>
                    <a href="#" class="menu-nav__link">Buses</a>
                    <a href="download-skin.html" class="menu-nav__link">Skin Packs</a>
                    <a href="/tutorials" class="menu-nav__link <?php echo $this->uri->segment(1) == 'tutorials' ? 'active' : ''; ?>">Tutorials</a>
                    <div class="menu-nav__multi bg">
                        <div class="menu-nav__multi-text">
                            <!--Kullanıcı giriş yaptıktan sonra ikon yanında adı yazılacak-->
                            <i class="fas fa-user white"></i> <?php echo isset($this->session->user_id) ? $this->session->name : ''; ?>
                        </div>
                        <div class="menu-nav__dropdown bg">
                            <!--Kullanıcı giriş yaptıktan sonra Hesabım menüsü açılacak-->
                            <?php if(isset($this->session->user_id)){ ?>
                                <a href="/account/index" class="menu-nav__dropdown-link">Hesabım</a>
                            <?php } else { ?>
                                <a href="/account/register" class="menu-nav__dropdown-link">Hesap Oluştur</a>
                                <a href="/account/login" class="menu-nav__dropdown-link">Giriş</a>
                            <?php } ?>
                        </div>
                    </div>
                    <a href="/skins/uploadskin" class="menu-nav__btn <?php echo $this->uri->segment(2) == 'uploadskin' ? 'active' : ''; ?>">
                        <i class="fas fa-plus"></i>
                        Upload Skin
                    </a>
                    <div class="menu-nav__multi" style="text-transform: capitalize;">
                        <div class="menu-nav__multi-text">
                            <?php echo $this->session->lang ? $this->session->lang : 'en'; ?> <i class="fas fa-caret-down"></i>
                        </div>
                        <div class="menu-nav__dropdown">
                            <a href="?selectLanguage=en" class="menu-nav__dropdown-link">English</a>
                            <a href="?selectLanguage=tr" class="menu-nav__dropdown-link">Türkçe</a>
                        </div>
                    </div>
                    <div class="menu-mobile-nav">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
            </div>
        </section>
        <section class="container">
            <div class="row">
                <div class="content">
                    <div class="content__text">
                        <p class="content__title"><?php echo $headTitle; ?></p>
                        <p class="content__sub-title"><?php echo $headDesc; ?></p>
                    </div>
                    <div class="content__app">
                        <img src="/assets/img/store-icon.png" alt="" class="content__img-icon">
                        <div>
                            <p class="content__text">Bus Simulator: Ultimate</p>
                            <div>
                                <a href="https://www.apple.com/tr/ios/app-store/" target="_blank">
                                    <img src="/assets/img/app-store.png" alt="" class="content__img">
                                </a>
                                <a href="https://play.google.com/store" target="_blank">
                                    <img src="/assets/img/google-play.png" alt="" class="content__img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mobile-menu">
            <span class="mobile-menu__close">
                <i class="fas fa-times"></i> Close
            </span>
            <a href="#" class="mobile-menu__link active">Home</a>
            <a href="#" class="mobile-menu__link">All Skins</a>
            <a href="#" class="mobile-menu__link">Buses</a>
            <a href="#" class="mobile-menu__link">Skin Packs</a>
            <a href="#" class="mobile-menu__link">Tutorials</a>
            <a href="#" class="mobile-menu__link">Upload Skin</a>
            <a href="#" class="mobile-menu__link">Hesabım</a>
            <a href="#" class="mobile-menu__link">Çıkış Yap</a>
        </section>
    </header>