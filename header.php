<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>
<body <?php body_class("relative flex size-full min-h-screen flex-col bg-white group/design-root overflow-x-hidden"); ?> style='font-family: "Plus Jakarta Sans", "Noto Sans", sans-serif;'>
<?php wp_body_open(); ?>

<div class="layout-container flex h-full grow flex-col">
  <div class="w-full max-w-screen-2xl mx-auto px-4 lg:px-10">
  <header class="flex flex-wrap items-center justify-between border-b border-solid border-b-[#f4f0f0] px-4 py-3 lg:px-10">
    <div class="flex items-center gap-4">
      <!-- Logo -->
      <div class="flex items-center gap-4 text-[#181111]">
        <?php if (function_exists('the_custom_logo') && has_custom_logo()) {
          the_custom_logo();
        } else { ?>
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="flex items-center gap-4 text-[#181111]">
          <div class="size-4">
            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0_6_330_header)">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 0.757355L47.2426 24L24 47.2426L0.757355 24L24 0.757355ZM21 35.7574V12.2426L9.24264 24L21 35.7574Z" fill="currentColor"></path>
              </g>
              <defs><clipPath id="clip0_6_330_header"><rect width="48" height="48" fill="white"></rect></clipPath></defs>
            </svg>
          </div>
          <h2 class="text-[#181111] text-lg font-bold leading-tight tracking-[-0.015em]"><?php bloginfo('name'); ?></h2>
        </a>
        <?php } ?>
      </div>

      <!-- Botón Hamburguesa (solo en móviles) -->
      <button id="menu-toggle" class="lg:hidden flex items-center px-3 py-2 border rounded text-[#181111] border-[#181111]">
        <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
          <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
        </svg>
      </button>
    </div>

    <!-- Menú Principal -->
    <?php if (has_nav_menu('primary_menu')) {
      wp_nav_menu(array(
        'theme_location' => 'primary_menu',
        'container' => 'nav',
        'container_id' => 'main-menu',
        'container_class' => 'w-full mt-4 lg:mt-0 lg:w-auto',
        'menu_class' => 'hidden flex-col gap-4 lg:flex lg:flex-row lg:items-center lg:gap-9 lg:ml-10',
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
      ));
    } ?>

    <!-- Sección derecha (buscar, wishlist, carrito, login/avatar) -->
    <div class="flex flex-1 justify-end items-center gap-4 mt-4 lg:mt-0 flex-wrap">
      <!-- Formulario búsqueda -->
      <form role="search" method="get" class="search-form w-full max-w-[240px] lg:max-w-64 h-10" action="<?php echo esc_url(home_url('/')); ?>">
        <label class="flex w-full h-full items-stretch rounded-lg">
          <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'dollcollector'); ?></span>
          <div class="text-[#886364] bg-[#f4f0f0] flex items-center justify-center pl-4 rounded-l-lg">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"/></svg>
          </div>
          <input type="search" class="search-field flex-1 rounded-r-lg border-none bg-[#f4f0f0] px-4 placeholder:text-[#886364] text-[#181111]" placeholder="<?php echo esc_attr_x('Search', 'placeholder', 'dollcollector'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        </label>
      </form>

      <!-- Wishlist -->
      <a href="<?php echo esc_url(home_url('/wishlist/')); ?>" class="h-10 flex items-center gap-2 rounded-lg px-2.5 text-sm font-bold bg-[#f4f0f0] text-[#181111]">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32Z"/></svg>
      </a>

      <!-- Carrito -->
      <a href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/cart/')); ?>" class="h-10 flex items-center gap-2 rounded-lg px-2.5 text-sm font-bold bg-[#f4f0f0] text-[#181111]">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M216,40H40A16,16,0,0,0,24,56V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A16,16,0,0,0,216,40ZM176,88a48,48,0,0,1-96,0,8,8,0,0,1,16,0,32,32,0,0,0,64,0,8,8,0,0,1,16,0Z"/></svg>
        <?php if (class_exists('WooCommerce')) : ?>
        <span class="text-xs">(<?php echo WC()->cart->get_cart_contents_count(); ?>)</span>
        <?php endif; ?>
      </a>

      <!-- Avatar o Login -->
      <?php if (is_user_logged_in()) :
        $current_user = wp_get_current_user(); ?>
        <a href="<?php echo esc_url(get_edit_user_link($current_user->ID)); ?>" class="rounded-full overflow-hidden size-10">
          <?php echo get_avatar($current_user->ID, 40, '', $current_user->display_name, array('class' => 'rounded-full size-10 object-cover')); ?>
        </a>
      <?php else : ?>
        <a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" class="text-sm font-medium text-[#181111]">
          <?php esc_html_e('Login', 'dollcollector'); ?>
        </a>
      <?php endif; ?>
    </div>
  </header>
