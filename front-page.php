<?php
/**
 * Front Page Template — TMCP Hospital Theme
 * Hero + all main sections managed via Elementor Free
 */
if (!defined('ABSPATH')) exit;
$site_url = get_site_url();
$logo_url = $site_url . '/wp-content/uploads/2024/12/tmname_logo_horizon-1.jpg';
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri() . '/fonts.css'); ?>">
<?php wp_head(); ?>
<style>
:root{--color-topbar:#4C1D95;--color-primary:#1E0842;--color-mid:#3B1478;--color-accent:#7C3AED;--color-pale:#C4B5FD;--font-main:'Roboto',sans-serif;--font-menu:'Montserrat',sans-serif;}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{font-family:var(--font-main);background:#fff;overflow-x:hidden;}
a{text-decoration:none;color:inherit;}
img{max-width:100%;height:auto;display:block;}
.tm-topbar{background:var(--color-topbar);color:rgba(255,255,255,.85);padding:8px 20px;font-family:var(--font-menu);font-size:13px;font-weight:300;}
.tm-topbar-inner{max-width:1200px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:6px;}
.tm-topbar-contacts{display:flex;align-items:center;flex-wrap:wrap;gap:16px;}
.tm-topbar-contacts a{color:rgba(255,255,255,.85);display:flex;align-items:center;gap:6px;}
.tm-topbar-contacts a:hover{color:#D97706;}
.tm-navbar{background:#fff;box-shadow:0 4px 24px rgba(30,8,66,.09);border-bottom:1px solid rgba(124,58,237,.10);position:sticky;top:0;z-index:1000;}
.tm-navbar-inner{max-width:1200px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;padding:12px 20px;gap:20px;}
.tm-navbar-logo img{width:120px;height:50px;object-fit:contain;}
.tm-navbar-menu{display:flex;align-items:center;}
.tm-navbar-menu ul{list-style:none;display:flex;gap:0;margin:0;padding:0;}
.tm-navbar-menu ul li{position:relative;}
.tm-navbar-menu ul li a{display:block;padding:8px 13px;font-family:var(--font-menu);font-size:14px;color:var(--color-primary);white-space:nowrap;transition:color .2s;}
.tm-navbar-menu ul li a:hover,.tm-navbar-menu ul li.current-menu-item>a{color:var(--color-accent);}
.tm-navbar-menu ul li ul.sub-menu{display:none;position:absolute;top:100%;left:0;background:#fff;min-width:220px;box-shadow:0 15px 30px rgba(30,8,66,.14);border-top:2px solid var(--color-accent);flex-direction:column;z-index:100;margin-top:0;padding-top:12px;}
.tm-navbar-menu ul li:hover>ul.sub-menu{display:flex;}
.tm-navbar-menu ul li ul.sub-menu li a{padding:13px 16px;font-size:14px;border-bottom:1px solid #FAF7FF;}
.tm-navbar-menu ul li ul.sub-menu li a:hover{color:var(--color-accent);background:#FAF7FF;}
.admin-bar .tm-navbar{top:32px;}
@media screen and (max-width:782px){.admin-bar .tm-navbar{top:46px;}}
.tm-search-btn{background:none;border:none;cursor:pointer;color:var(--color-primary);padding:6px;display:flex;align-items:center;transition:color .2s;}
.tm-search-btn:hover{color:var(--color-accent);}
.tm-burger{display:none;background:none;border:none;cursor:pointer;padding:4px;flex-direction:column;gap:5px;}
.tm-burger span{display:block;width:24px;height:2px;background:var(--color-primary);border-radius:2px;}
.tm-search-overlay{display:none;position:fixed;inset:0;background:rgba(7,4,26,.96);z-index:9999;align-items:center;justify-content:center;}
.tm-search-overlay.active{display:flex;}
.tm-search-overlay form{display:flex;width:min(700px,90vw);border-bottom:2px solid rgba(196,181,253,.5);}
.tm-search-overlay input{flex:1;background:none;border:none;color:#fff;font-size:34px;font-family:var(--font-menu);font-weight:300;padding:10px 0;outline:none;}
.tm-search-overlay input::placeholder{color:rgba(196,181,253,.5);}
.tm-search-overlay .close-btn{background:none;border:none;color:#C4B5FD;font-size:28px;cursor:pointer;padding:4px 10px;}
.tm-stat-bar{background:var(--color-topbar);color:#fff;padding:24px 20px;}
.tm-stat-bar-inner{max-width:1200px;margin:0 auto;display:flex;align-items:center;flex-wrap:wrap;gap:24px;}
.tm-stat-number{font-family:'Poppins',sans-serif;font-size:48px;font-weight:700;line-height:1.15em;background:linear-gradient(135deg,#C4B5FD,#7C3AED);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.tm-stat-label{font-family:var(--font-menu);font-size:13px;color:#C4B5FD;margin-top:4px;letter-spacing:1.5px;}
.tm-stat-login{flex:1;min-width:240px;}
.tm-login-form{display:flex;flex-wrap:wrap;gap:10px;align-items:center;}
.tm-login-form input[type="text"],.tm-login-form input[type="password"]{padding:10px 14px;border:1px solid rgba(196,181,253,.25);border-radius:6px;font-size:14px;background:rgba(255,255,255,.08);color:#fff;width:170px;outline:none;}
.tm-login-form input::placeholder{color:rgba(196,181,253,.5);}
.tm-login-form input:focus{border-color:var(--color-accent);background:rgba(124,58,237,.15);}
.tm-login-form button{padding:10px 24px;background:var(--color-accent);color:#fff;border:none;border-radius:6px;font-size:14px;font-family:var(--font-menu);cursor:pointer;transition:background .3s;box-shadow:0 4px 16px rgba(124,58,237,.4);}
.tm-login-form button:hover{background:var(--color-mid);}
.tm-login-logged{font-size:15px;font-weight:500;}
.tm-page-content{width:100%;}
.tm-page-content .elementor-section,.tm-page-content .e-con{width:100%;}
@media(max-width:767px){
.tm-navbar-menu{display:none;}
.tm-navbar-menu.open{display:flex;position:absolute;top:100%;left:0;right:0;background:#fff;box-shadow:0 10px 24px rgba(30,8,66,.12);flex-direction:column;z-index:999;padding:10px 0;}
.tm-navbar-menu.open ul{flex-direction:column;}
.tm-navbar-menu.open ul li ul.sub-menu{position:static;box-shadow:none;border-top:none;padding-left:16px;}
.tm-burger{display:flex;}
.tm-stat-number{font-size:32px;}
.tm-topbar-contacts .addr-text{display:none;}
}
@media(min-width:768px){.tm-navbar-inner{position:relative;}}
</style>
</head>
<body <?php body_class('custom-homepage'); ?>>

<div class="tm-search-overlay" id="searchOverlay">
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
        <input type="search" name="s" placeholder="ค้นหาข้อมูลในเว็บไซต์นี้" autocomplete="off">
        <button type="button" class="close-btn" onclick="document.getElementById('searchOverlay').classList.remove('active')">&#x2715;</button>
    </form>
</div>

<div class="tm-topbar">
    <div class="tm-topbar-inner">
        <div class="tm-topbar-contacts">
            <a href="tel:1669">&#128657; 1669</a>
            <a href="tel:076571505">&#128222; 076-571505</a>
            <a href="mailto:tm11354@moph.go.th">&#9993; tm11354@moph.go.th</a>
            <a href="https://maps.app.goo.gl/vw9FZBzTtaZN4mKDA" target="_blank" rel="noopener">&#128205; <span class="addr-text">166 ม.9 ถ.เพชรเกษม อ.ท้ายเหมือง จ.พังงา 82120</span></a>
        </div>
    </div>
</div>

<nav class="tm-navbar" role="navigation">
    <div class="tm-navbar-inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="tm-navbar-logo">
            <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>" width="120" height="50">
        </a>
        <div class="tm-navbar-menu" id="mainMenu">
            <?php wp_nav_menu(['menu'=>4,'container'=>false,'items_wrap'=>'<ul>%3$s</ul>','fallback_cb'=>false]); ?>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
            <button class="tm-search-btn" onclick="document.getElementById('searchOverlay').classList.add('active')" aria-label="Search">
                <svg width="18" height="18" viewBox="0 0 512 512" fill="currentColor"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg>
            </button>
            <button class="tm-burger" id="burgerBtn" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
</nav>

<main class="tm-page-content">
<?php if(have_posts()):while(have_posts()):the_post();the_content();endwhile;endif; ?>
</main>

<div class="tm-stat-bar">
    <div class="tm-stat-bar-inner">
        <div>
            <div class="tm-stat-number">โรงพยาบาล<br>ท้ายเหมืองชัยพัฒน์</div>
            <div class="tm-stat-label">THAIMUANGCHAIPAT HOSPITAL</div>
        </div>
        <div class="tm-stat-login">
            <?php if(is_user_logged_in()): ?>
                <p class="tm-login-logged">สวัสดี, <?php echo esc_html(wp_get_current_user()->display_name); ?> &mdash;
                <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" style="color:#C4B5FD;">ออกจากระบบ</a> |
                <a href="<?php echo esc_url(admin_url()); ?>" style="color:#C4B5FD;">หน้าผู้ดูแล</a></p>
            <?php else: ?>
                <form class="tm-login-form" method="post" action="<?php echo esc_url(site_url('wp-login.php','login_post')); ?>">
                    <?php wp_nonce_field('login-action','_wpnonce_login'); ?>
                    <input type="text" name="log" placeholder="ชื่อผู้ใช้" required autocomplete="username">
                    <input type="password" name="pwd" placeholder="รหัสผ่าน" required autocomplete="current-password">
                    <input type="hidden" name="redirect_to" value="<?php echo esc_url(admin_url()); ?>">
                    <button type="submit" name="wp-submit">เข้าสู่ระบบ</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.getElementById('burgerBtn').addEventListener('click',function(){document.getElementById('mainMenu').classList.toggle('open');});
document.addEventListener('keydown',function(e){if(e.key==='Escape')document.getElementById('searchOverlay').classList.remove('active');});
document.querySelector('.tm-search-overlay form').addEventListener('click',function(e){e.stopPropagation();});
document.getElementById('searchOverlay').addEventListener('click',function(){this.classList.remove('active');});
</script>
<?php wp_footer(); ?>
</body>
</html>
