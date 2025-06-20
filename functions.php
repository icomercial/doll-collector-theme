<?php

// 1. Encolar estilos y scripts
function dollcollector_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?display=swap&family=Noto+Sans:wght@400;500;700;900&family=Plus+Jakarta+Sans:wght@400;500;700;800',
        array(),
        null // No version needed for external font
    );

    // Tailwind CSS desde CDN (para desarrollo/simplicidad)
    // Para producción, considera compilar Tailwind e incluirlo localmente.
    wp_enqueue_script(
        'tailwindcss',
        'https://cdn.tailwindcss.com?plugins=forms,container-queries',
        array(),
        null, // No version needed for CDN script
        false // Cargar en el <head> ya que es CSS utility framework
              // Aunque se llame enqueue_script, se puede usar para <script> que carga CSS.
              // Alternativamente, podrías registrarlo como estilo si el CDN lo permitiera con <link>
    );

    // El style.css principal del tema (para información y overrides si los hay)
    wp_enqueue_style(
        'dollcollector-style',
        get_stylesheet_uri(),
        array('google-fonts'), // Depende de Google Fonts
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'dollcollector_enqueue_assets');

// 2. Soportes del Tema
function dollcollector_theme_support() {
    // Permitir que WordPress maneje el tag <title>
    add_theme_support('title-tag');

    // Habilitar imágenes destacadas (para "Latest Additions")
    add_theme_support('post-thumbnails');

    // Registrar menús de navegación
    register_nav_menus(array(
        'primary_menu' => __('Menú Principal', 'dollcollector'),
        // Podrías añadir más si los necesitas, ej. 'footer_menu'
    ));

    // (Opcional) Soporte para logo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 48, // Ajusta según tu logo
        'width'       => 200, // Ajusta según tu logo
        'flex-height' => true,
        'flex-width'  => true,
    ));
// Añadir soporte para WooCommerce
add_theme_support('woocommerce');

    // Hacer el tema traducible
    load_theme_textdomain('dollcollector', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'dollcollector_theme_support');

// 3. (Opcional) Personalizar la salida de wp_nav_menu para Tailwind
// Esto es un poco más avanzado, puedes omitirlo al principio y estilizar con CSS si es necesario.
// O buscar un "Tailwind Walker Nav Menu" para WordPress.
// Por ahora, el menú por defecto de WordPress puede que necesite algo de CSS para encajar perfectamente.
//Función para agregar clases de íconos en el menu principal
function personaliss_agregar_iconos_menu($item_output, $item, $depth, $args) {
  $icon = '';

  // Clases Tailwind para mostrar solo en móviles
  $icon_class = 'fas menu-icon block lg:hidden';

  switch (strtolower($item->title)) {
    case 'inicio':
      $icon = '<i class="' . $icon_class . ' fa-home"></i>';
      break;
    case 'tienda':
      $icon = '<i class="' . $icon_class . ' fa-tag"></i>';
      break;
    case 'contacto':
      $icon = '<i class="' . $icon_class . ' fa-envelope"></i>';
      break;
    case 'carrito':
      $icon = '<i class="' . $icon_class . ' fa-shopping-cart"></i>';
      break;
    case 'finalizar compra':
      $icon = '<i class="' . $icon_class . ' fa-credit-card"></i>';
      break;
    case 'mi cuenta':
      $icon = '<i class="' . $icon_class . ' fa-user"></i>';
      break;
  }

  if (!empty($icon)) {
    // Agrega ícono envuelto antes del título
    $item_output = str_replace($item->title, $icon . '<span>' . $item->title . '</span>', $item_output);
  }

  return $item_output;
}
add_filter('walker_nav_menu_start_el', 'personaliss_agregar_iconos_menu', 10, 4);

// Función para obtener IDs de productos desde tu cuenta de ML
function obtener_productos_mercadolibre($user_id = '5406108659387475') {
    $api_url = "https://api.mercadolibre.com/users/$user_id/items/search";
    $response = wp_remote_get($api_url);
    
    if (is_wp_error($response)) return [];

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (!isset($data['results'])) return [];

    return $data['results']; // Retorna los IDs de los productos
}

// Shortcode para mostrar productos como tarjetas
function mostrar_productos_mercadolibre_shortcode() {
    $user_id = '5406108659387475';
    $productos = obtener_productos_mercadolibre($user_id);

    if (empty($productos)) return 'No se encontraron productos.';

    $salida = '<div class="ml-productos-grid" style="display: flex; flex-wrap: wrap; gap: 20px;">';

    foreach ($productos as $item_id) {
        $item_url = "https://api.mercadolibre.com/items/$item_id";
        $response = wp_remote_get($item_url);
        if (is_wp_error($response)) continue;

        $item = json_decode(wp_remote_retrieve_body($response), true);
        if (!$item || !isset($item['title'])) continue;

        $salida .= '<div style="width: 250px; border: 1px solid #ccc; padding: 10px; border-radius: 8px;">';
        $salida .= '<img src="' . esc_url($item['thumbnail']) . '" style="width: 100%; height: auto; border-radius: 4px;">';
        $salida .= '<h3 style="font-size: 1rem; margin: 10px 0;">' . esc_html($item['title']) . '</h3>';
        $salida .= '<p><strong>Precio:</strong> $' . number_format($item['price'], 0, ',', '.') . '</p>';
        $salida .= '<a href="' . esc_url($item['permalink']) . '" target="_blank" style="background: #ffe600; display: inline-block; padding: 8px 12px; text-decoration: none; border-radius: 4px; font-weight: bold;">Comprar en MercadoLibre</a>';
        $salida .= '</div>';
    }

    $salida .= '</div>';
    return $salida;
}
add_shortcode('ml_productos', 'mostrar_productos_mercadolibre_shortcode');
add_filter('get_custom_logo', function ($html) {
  // Elimina width y height fijos
  $html = preg_replace('/(width|height)="[0-9]*"/i', '', $html);
  
  // Reemplaza la clase por clases responsivas de Tailwind
  return str_replace('class="custom-logo"', 'class="custom-logo h-10 md:h-12 lg:h-16 w-auto"', $html);
});

