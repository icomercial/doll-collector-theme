<?php get_header(); ?>
<h2 class="text-[#181111] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">Nuevas muñecas</h2>
<div class="flex overflow-y-auto [-ms-scrollbar-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
  <div class="flex items-stretch p-4 gap-3">

    <?php
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => 3,
      'orderby' => 'date',
      'order' => 'DESC',
    );
    $loop = new WP_Query($args);
    if ($loop->have_posts()) :
      while ($loop->have_posts()) : $loop->the_post();
        global $product; ?>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-lg min-w-40">
          <a href="<?php the_permalink(); ?>">
            <div class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg flex flex-col" style='background-image: url("<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>");'></div>
          </a>
          <div>
            <p class="text-[#181111] text-base font-medium leading-normal"><?php the_title(); ?></p>
            <p class="text-[#886364] text-sm font-normal leading-normal"><?php echo $product->get_price_html(); ?></p>
          </div>
        </div>
      <?php endwhile;
      wp_reset_postdata();
    else : ?>
      <p class="text-gray-600">No products found.</p>
    <?php endif; ?>

  </div>
</div>
<div class="flex px-4 py-3 justify-center">
  <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>">
    <button class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#e92932] text-white text-sm font-bold leading-normal tracking-[0.015em]">
      <span class="truncate">Visit Our Store</span>
    </button>
  </a>
</div>
<main id="main-content" class="site-main px-4 py-8 md:px-10 lg:px-40">
    <div class="max-w-[960px] mx-auto">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class("mb-8 pb-8 border-b border-gray-200"); ?>>
                    <header class="entry-header mb-4">
                        <?php the_title('<h1 class="entry-title text-3xl font-bold text-[#181111]">', '</h1>'); ?>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail mb-4">
                            <?php the_post_thumbnail('large', ['class' => 'w-full h-auto rounded-lg']); // 'large' es un tamaño de imagen de WP ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content prose max-w-none"> <?php // 'prose' es una clase de Tailwind para formatear contenido de texto ?>
                        <?php the_content(sprintf(
                            wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'dollcollector' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            get_the_title()
                        )); ?>
                    </div>
                </article>
            <?php endwhile; ?>

            <?php
            // Paginación
            the_posts_pagination(array(
                'prev_text' => __('« Previous', 'dollcollector'),
                'next_text' => __('Next »', 'dollcollector'),
                'screen_reader_text' => __('Posts navigation', 'dollcollector')
            ));
            ?>

        <?php else : ?>
            <p><?php _e('Sorry, no posts matched your criteria.', 'dollcollector'); ?></p>
        <?php endif; ?>
    </div>
    
</main>

<?php get_footer(); ?>