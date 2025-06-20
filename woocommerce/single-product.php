<?php
/**
 * WooCommerce Single Product Template con Tailwind
 * Archivo: single-product.php
 */
get_header();
global $product;

if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
?>
<div class="relative flex size-full min-h-screen flex-col bg-white overflow-x-hidden" style='font-family: Newsreader, "Noto Sans", sans-serif;'>
  <div class="layout-container flex h-full grow flex-col">


    <div class="px-10 flex flex-1 justify-center py-5">
      <div class="layout-content-container flex flex-col max-w-[960px] flex-1">

        <div class="flex flex-wrap gap-2 p-4 text-sm text-[#896176]">
          <a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span>/</span>
          <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Tienda</a><span>/</span>
          <span class="text-[#181115]"><?php the_title(); ?></span>
        </div>

        <h1 class="text-[22px] font-bold text-[#181115] px-4 pb-3 pt-5"><?php the_title(); ?></h1>

        <?php if ($product->get_attribute('pa_edicion')): ?>
        <p class="text-[#181115] px-4 pb-3">Edición: <?php echo $product->get_attribute('pa_edicion'); ?></p>
        <?php endif; ?>

        <div class="flex w-full bg-white @container p-4">
          <div class="w-full grid grid-cols-2 grid-rows-[2fr_1fr_1fr] gap-2 aspect-[2/3] rounded-xl overflow-hidden">
            <div class="col-span-2">
              <?php echo $product->get_image('full'); ?>
            </div>
            <?php
            $attachment_ids = $product->get_gallery_image_ids();
            foreach (array_slice($attachment_ids, 0, 2) as $img_id):
              echo '<div>' . wp_get_attachment_image($img_id, 'large', false, ['class' => 'w-full aspect-auto object-cover']) . '</div>';
            endforeach;
            ?>
          </div>
        </div>

        <div class="text-[#181115] px-4 pt-1 pb-3">
          <?php the_content(); ?>
        </div>

        <?php if ($product->get_attribute('pa_year')): ?>
        <p class="text-[#181115] px-4 pb-3">Año: <?php echo $product->get_attribute('pa_year'); ?></p>
        <?php endif; ?>

        <?php if ($product->get_attribute('pa_condition')): ?>
        <p class="text-[#181115] px-4 pb-3">Condición: <?php echo $product->get_attribute('pa_condition'); ?></p>
        <?php endif; ?>

        <h2 class="text-[22px] font-bold text-[#181115] px-4 pt-5"><?php echo $product->get_price_html(); ?></h2>

        <div class="flex px-4 py-3 justify-start">
          <?php woocommerce_template_single_add_to_cart(); ?>
        </div>
<div class="px-4 pt-4">
  <?php
    /**
     * WooCommerce Tabs (Descripción, Información adicional, Reseñas)
     * Puedes personalizar el diseño con TailwindCSS a continuación.
     */
    wc_get_template( 'single-product/tabs/tabs.php' );
  ?>
</div>

        <div class="pb-10">
          <?php woocommerce_output_related_products(); ?>
        </div>

      </div>
    </div>
  </div>
</div>
<?php
    }
}
get_footer();
