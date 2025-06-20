<?php
defined('ABSPATH') || exit;

get_header('shop'); ?>

<div class="relative flex size-full min-h-screen flex-col bg-white overflow-x-hidden" style='font-family: "Plus Jakarta Sans", "Noto Sans", sans-serif;'>
  <div class="layout-container flex h-full grow flex-col">

    <div class="px-10 pt-12 pb-4 text-center">
      <h1 class="text-3xl font-extrabold text-[#181111]"><?php woocommerce_page_title(); ?></h1>
      <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
        <p class="text-[#886364] mt-2 text-sm">Aquí es donde puedes ver los productos en esta tienda.</p>
      <?php endif; ?>
    </div>

    <div class="px-10">
      <?php do_action('woocommerce_before_main_content'); ?>
    </div>

    <div class="px-10 flex-1 w-full max-w-[1440px] mx-auto">
      <?php if (woocommerce_product_loop()) : ?>

        <ul class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-6 px-4">
          <?php while (have_posts()) : the_post(); ?>
            <?php wc_get_template_part('content', 'product'); ?>
          <?php endwhile; ?>
        </ul>

        <div class="px-4 mt-8">
          <?php do_action('woocommerce_after_shop_loop'); ?>
        </div>

      <?php else : ?>
        <p class="p-4 text-center"><?php esc_html_e('No hay productos disponibles.', 'woocommerce'); ?></p>
      <?php endif; ?>
    </div>

    <div class="px-10">
      <?php do_action('woocommerce_after_main_content'); ?>
    </div>

  </div>
</div>

<?php get_footer('shop'); ?>
