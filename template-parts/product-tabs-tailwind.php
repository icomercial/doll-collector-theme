<?php
/**
 * Template part for displaying product tabs (description, reviews, additional info)
 * Customizado para TailwindCSS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

<div class="w-full max-w-3xl mx-auto">
  <div class="border-b border-gray-200">
    <nav class="-mb-px flex" role="tablist">
      <?php $index = 0; foreach ( $tabs as $key => $tab ) : ?>
        <button
          class="tab-link px-4 py-2 font-medium text-sm text-gray-600 hover:text-gray-800 border-b-2 border-transparent hover:border-gray-300"
          id="tab-title-<?php echo esc_attr( $key ); ?>"
          data-tab="<?php echo esc_attr( $key ); ?>"
          role="tab"
          <?php echo $index === 0 ? 'aria-selected="true" class="active border-b-2 border-[#e92932] text-[#e92932]"' : ''; ?>
        >
          <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
        </button>
      <?php $index++; endforeach; ?>
    </nav>
  </div>

  <div class="mt-4">
    <?php $index = 0; foreach ( $tabs as $key => $tab ) : ?>
      <div
        id="tab-<?php echo esc_attr( $key ); ?>"
        class="tab-content hidden"
        <?php echo $index === 0 ? 'style="display:block"' : ''; ?>
      >
        <?php if ( isset( $tab['callback'] ) ) {
          call_user_func( $tab['callback'], $key, $tab );
        } ?>
      </div>
    <?php $index++; endforeach; ?>
  </div>
</div>

<script>
  document.querySelectorAll('.tab-link').forEach(button => {
    button.addEventListener('click', () => {
      const tab = button.dataset.tab;
      document.querySelectorAll('.tab-link').forEach(btn => btn.classList.remove('active', 'text-[#e92932]', 'border-[#e92932]'));
      document.querySelectorAll('.tab-content').forEach(div => div.style.display = 'none');
      button.classList.add('active', 'text-[#e92932]', 'border-[#e92932]');
      document.getElementById(`tab-${tab}`).style.display = 'block';
    });
  });
</script>

<?php endif; ?>
