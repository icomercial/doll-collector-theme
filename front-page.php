<?php get_header(); // Incluye header.php ?>

<div class="px-40 flex flex-1 justify-center py-5">
    <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
        <div class="@container">
            <div class="@[480px]:p-4">
                <div
                    class="flex min-h-[480px] flex-col gap-6 bg-cover bg-center bg-no-repeat @[480px]:gap-8 @[480px]:rounded-lg items-center justify-center p-4"
                    style='background-image: linear-gradient(rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.4) 100%), url("https://www.personaliss.cl/web/wp-content/uploads/2025/06/barbieportada2.jpg");'
                >
                    <div class="flex flex-col gap-2 text-center">
                        <h1 class="text-white text-4xl font-black leading-tight tracking-[-0.033em] @[480px]:text-5xl @[480px]:font-black @[480px]:leading-tight @[480px]:tracking-[-0.033em]">
                            <?php echo esc_html__('Encuentra la Barbie de tus Sueños', 'dollcollector'); ?>
                        </h1>
                        <h2 class="text-white text-sm font-normal leading-normal @[480px]:text-base @[480px]:font-normal @[480px]:leading-normal">
                            <?php echo esc_html__('Explora nuestra selecta colección de muñecas antiguas, nuevas y de edición limitada. Cada muñeca cuenta una historia, esperando ser parte de tu colección.', 'dollcollector'); ?>
                        </h2>
                    </div>
                    <button
                        onclick="location.href='<?php echo esc_url(home_url('/tienda/')); ?>'"
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 @[480px]:h-12 @[480px]:px-5 bg-[#e92932] text-white text-sm font-bold leading-normal tracking-[0.015em] @[480px]:text-base @[480px]:font-bold @[480px]:leading-normal @[480px]:tracking-[0.015em]"
                    >
                        <span class="truncate"><?php echo esc_html__('Comprar ahora', 'dollcollector'); ?></span>
                    </button>
                </div>
            </div>
        </div>

        <h2 class="text-[#181111] text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5"><?php echo esc_html__('Últimas novedades', 'dollcollector'); ?></h2>

        <?php
        $latest_args = array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC'
        );
        $latest_query = new WP_Query($latest_args);
        ?>

        <?php if ($latest_query->have_posts()) : ?>
        <div class="flex overflow-y-auto [-ms-scrollbar-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
            <div class="flex items-stretch p-4 gap-3">
                <?php while ($latest_query->have_posts()) : $latest_query->the_post(); ?>
                <div class="flex h-full flex-1 flex-col gap-4 rounded-lg min-w-40">
                    <a href="<?php the_permalink(); ?>" class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-lg flex flex-col"
                       style='background-image: url("<?php echo has_post_thumbnail() ? esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large')) : 'https://via.placeholder.com/300x300.png?text=No+Image'; ?>");'
                       aria-label="<?php the_title_attribute(); ?>"
                    >
                    </a>
                    <div>
                        <p class="text-[#181111] text-base font-medium leading-normal">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </p>
                        <div class="text-[#886364] text-sm font-normal leading-normal">
                            <?php
                            $subtitle = get_post_meta(get_the_ID(), 'doll_subtitle', true);
                            echo !empty($subtitle) ? esc_html($subtitle) : get_the_excerpt();
                            ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
        <?php else : ?>
            <p class="p-4"><?php esc_html_e('No latest additions found.', 'dollcollector'); ?></p>
        <?php endif; ?>

        <div class="flex px-4 py-3 justify-center">
            <button
                onclick="location.href='<?php echo esc_url(home_url('/store/')); ?>'"
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-[#e92932] text-white text-sm font-bold leading-normal tracking-[0.015em]"
            >
                <span class="truncate"><?php echo esc_html__('Visit Our Store', 'dollcollector'); ?></span>
            </button>
        </div>
    </div>
</div>

<?php get_footer(); // Incluye footer.php ?>
