<?php
/**
 * WooCommerce: Custom Tabs UI with Tailwind
 */
defined( 'ABSPATH' ) || exit;

$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $product_tabs ) ) : ?>

  <div x-data="{ tab: '<?php echo key($product_tabs); ?>' }" class="w-full">
    <div class="flex space-x-6 border-b border-gray-200 mb-4">
      <?php foreach ( $product_tabs as $key => $tab ) : ?>
        <button
          @click.prevent="tab = '<?php echo esc_attr( $key ); ?>'"
          :class="tab === '<?php echo esc_attr( $key ); ?>' ? 'border-b-2 border-[#e92932] text-[#181114]' : 'text-gray-400 hover:text-[#181114]'"
          class="pb-2 text-sm font-semibold transition-colors"
        >
          <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
        </button>
      <?php endforeach; ?>
    </div>

    <?php foreach ( $product_tabs as $key => $tab ) : ?>
      <div x-show="tab === '<?php echo esc_attr( $key ); ?>'" x-cloak class="text-[#181114] text-sm leading-relaxed">
        <?php
        if ( isset( $tab['callback'] ) ) {
          call_user_func( $tab['callback'], $key, $tab );
        }
        ?>
      </div>
    <?php endforeach; ?>
  </div>

<?php endif; ?>
