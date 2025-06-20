<?php
/**
 * Template Name: Catalog Page
 *
 * Esto le dice a WordPress que este archivo es una plantilla de página
 * y aparecerá en el desplegable "Plantilla" al editar una Página.
 */

get_header(); // Incluye header.php
?>

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
        <div class="flex flex-wrap justify-between gap-3 p-4">
            <div class="flex min-w-72 flex-col gap-3">
                <h1 class="text-[#181111] tracking-light text-[32px] font-bold leading-tight">
                    <?php
                    // Obtener el título de la página actual de WordPress
                    // o usar un título fijo si lo prefieres.
                    the_title();
                    // echo esc_html__('Catalog', 'dollcollector');
                    ?>
                </h1>
                <div class="text-[#886364] text-sm font-normal leading-normal">
                    <?php
                    // Mostrar el contenido de la página de WordPress (que puedes editar en el admin)
                    // O un texto fijo.
                    if (have_posts()) : while (have_posts()) : the_post();
                        the_content();
                    endwhile; endif;
                    // echo esc_html__('Explore our curated collection of Barbie dolls, each with its own unique story and history.', 'dollcollector');
                    ?>
                </div>
            </div>
        </div>

        <div class="flex gap-3 p-3 flex-wrap pr-4">
            <?php // --- INICIO: FILTROS (Versión Estática) ---
                  // Para hacerlos dinámicos, necesitarías conectarlos a taxonomías
                  // (Categorías, Etiquetas, o Taxonomías Personalizadas para "Edition", "Year")
                  // y usar JavaScript/PHP para actualizar el query.
                  // Plugins como FacetWP o Search & Filter Pro ayudan mucho aquí.
            ?>
            <button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#f4f0f0] pl-4 pr-2">
                <p class="text-[#181111] text-sm font-medium leading-normal"><?php esc_html_e('Category', 'dollcollector'); ?></p>
                <div class="text-[#181111]" data-icon="CaretDown" data-size="20px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path></svg>
                </div>
            </button>
            <button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#f4f0f0] pl-4 pr-2">
                <p class="text-[#181111] text-sm font-medium leading-normal"><?php esc_html_e('Edition', 'dollcollector'); ?></p>
                <div class="text-[#181111]" data-icon="CaretDown" data-size="20px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path></svg>
                </div>
            </button>
            <button class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#f4f0f0] pl-4 pr-2">
                <p class="text-[#181111] text-sm font-medium leading-normal"><?php esc_html_e('Year', 'dollcollector'); ?></p>
                <div class="text-[#181111]" data-icon="CaretDown" data-size="20px" data-weight="regular">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path></svg>
                </div>
            </button>
            <?php // --- FIN: FILTROS --- ?>
        </div>

        <?php
        // --- INICIO: GRID DE PRODUCTOS/MUÑECAS ---
        // Query para mostrar muñecas.
        // Idealmente, esto sería un Custom Post Type "dolls" o productos de WooCommerce.
        // Por ahora, usaremos posts normales para el ejemplo.
        $catalog_args = array(
            'post_type'      => 'post', // Cambia a 'doll' o 'product' si usas CPT/WooCommerce
            'posts_per_page' => 12,     // Cuántos mostrar por página
            'paged'          => get_query_var('paged') ? get_query_var('paged') : 1, // Para paginación
            // Aquí podrías añadir filtros por taxonomía si los filtros fueran funcionales
            // 'tax_query' => array( ... ),
        );
        $catalog_query = new WP_Query($catalog_args);
        ?>

        <?php if ($catalog_query->have_posts()) : ?>
        <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
            <?php while ($catalog_query->have_posts()) : $catalog_query->the_post(); ?>
            <div class="flex flex-col gap-3 pb-3">
                <a href="<?php the_permalink(); ?>"
                   class="w-full bg-center bg-no-repeat aspect-[3/4] bg-cover rounded-lg"
                   style='background-image: url("<?php
                       if (has_post_thumbnail()) {
                           echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large')); // Ajusta tamaño 'medium_large', 'large', 'full'
                       } else {
                           // Placeholder si no hay imagen
                           echo 'https://via.placeholder.com/300x400.png?text=No+Image';
                       }
                   ?>");'
                   aria-label="<?php the_title_attribute(); ?>"
                >
                    <?php // Puedes poner algo superpuesto a la imagen aquí si quieres ?>
                </a>
                <div>
                    <p class="text-[#181111] text-base font-medium leading-normal">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </p>
                    <div class="text-[#886364] text-sm font-normal leading-normal">
                        <?php
                        // Extracto del post o un campo personalizado para la descripción corta
                        // Si es un producto de WooCommerce, podrías usar $product->get_short_description();
                        $short_desc = get_post_meta(get_the_ID(), 'doll_short_description', true);
                        if (!empty($short_desc)) {
                            echo esc_html($short_desc);
                        } else {
                            the_excerpt(); // Muestra el extracto
                        }
                        ?>
                    </p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>

        <?php
        // Paginación para el query del catálogo
        echo '<div class="pagination p-4">';
        $big = 999999999; // Un número grande
        echo paginate_links( array(
            'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format'  => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total'   => $catalog_query->max_num_pages,
            'prev_text' => __('« Previous', 'dollcollector'),
            'next_text' => __('Next »', 'dollcollector'),
        ) );
        echo '</div>';
        ?>

        <?php wp_reset_postdata(); // Importante después de un custom WP_Query ?>

        <?php else : ?>
            <p class="p-4"><?php esc_html_e('No dolls found in the catalog matching your criteria.', 'dollcollector'); ?></p>
        <?php endif; ?>
        <?php // --- FIN: GRID DE PRODUCTOS/MUÑECAS --- ?>

    </div>
</div>

<?php
get_footer(); // Incluye footer.php
?>