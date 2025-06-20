<?php
defined('ABSPATH') || exit;

global $product;

if (empty($product) || !$product->is_visible()) {
    return;
}
?>

<li <?php wc_product_class('flex flex-col bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden min-w-[200px]', $product); ?>>
    <a href="<?php the_permalink(); ?>" class="block aspect-[4/5] bg-center bg-cover"
       style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: 'https://via.placeholder.com/300x400?text=No+Image'); ?>');">
    </a>

    <div class="p-4 flex flex-col gap-2">
        <h2 class="text-[#181114] text-base font-semibold leading-tight">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>

        <?php if ($price_html = $product->get_price_html()) : ?>
            <span class="text-[#e92932] text-sm font-bold"><?php echo $price_html; ?></span>
        <?php endif; ?>

        <a href="<?php the_permalink(); ?>" class="mt-2 inline-block bg-[#e92932] text-white text-xs font-semibold py-2 px-3 rounded hover:bg-[#c91f27] transition">
            Ver más
        </a>
    </div>
</li>
