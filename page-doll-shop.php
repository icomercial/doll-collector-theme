<?php
/*
Template Name: Shop Dolls
*/
get_header();
?>

<main class="flex min-h-screen flex-col bg-white overflow-x-hidden" style="font-family: 'Plus Jakarta Sans', 'Noto Sans', sans-serif;">
  <div class="layout-container flex grow flex-col">
    <div class="px-10 flex justify-center py-5">
      <div class="layout-content-container flex flex-col max-w-[960px] flex-1">

        <!-- Título -->
        <div class="flex flex-wrap justify-between gap-3 p-4">
          <p class="text-[#181111] tracking-light text-[32px] font-bold leading-tight min-w-72"><?php the_title(); ?></p>
        </div>

        <!-- Buscador -->
        <div class="px-4 py-3">
          <?php get_product_search_form(); ?>
        </div>

        <!-- Filtros personalizados por atributos -->
        <div class="flex gap-3 p-3 flex-wrap pr-4">
          <?php
          $filters = [
            'pa_categoria' => 'Categories',
            'pa_edicion'   => 'Edition',
            'pa_anio'      => 'Year',
            'pa_estado'    => 'Condition',
          ];

          foreach ($filters as $taxonomy => $label) {
            $terms = get_terms($taxonomy, ['hide_empty' => true]);
            if (!empty($terms) && !is_wp_error($terms)) {
              echo '<div class="relative">';
              echo '<select onchange="if(this.value) window.location.href=this.value" class="flex h-8 items-center justify-center gap-x-2 rounded-lg bg-[#f4f0f0] text-[#181111] text-sm font-medium pl-4 pr-2">';
              echo "<option value=''>Filter by $label</option>";
              foreach ($terms as $term) {
                echo '<option value="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</option>';
              }
              echo '</select>';
              echo '</div>';
            }
          }
          ?>
        </div>

        <!-- Loop de productos -->
        <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
          <?php
          $args = [
            'post_type'      => 'product',
            'posts_per_page' => 12,
            'orderby'        => 'date',
            'order'          => 'DESC',
          ];
          $loop = new WP_Query($args);
          if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
              global $product; ?>
              <div class="flex flex-col gap-3 pb-3">
                <a href="<?php the_permalink(); ?>">
                  <div class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-lg" style='background-image: url("<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>");'></div>
                </a>
                <div>
                  <p class="text-[#181111] text-base font-medium leading-normal"><?php the_title(); ?></p>
                  <p class="text-[#886364] text-sm font-normal leading-normal"><?php echo $product->get_price_html(); ?></p>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata();
          else : ?>
            <p class="text-[#886364]">No products found.</p>
          <?php endif; ?>
        </div>

        <!-- Paginación -->
        <div class="flex justify-center py-6">
          <?php the_posts_pagination([
            'prev_text' => __('« Previous'),
            'next_text' => __('Next »'),
          ]); ?>
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer(); ?>
