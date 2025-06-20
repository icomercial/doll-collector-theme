<?php
/**
 * Template Name: Página de Contacto
 */
get_header();
?>

<main class="min-h-screen bg-white text-[#181111]" style="font-family: 'Plus Jakarta Sans', 'Noto Sans', sans-serif;">
  <div class="container mx-auto px-4 py-10 max-w-6xl">
    <h1 class="text-3xl font-black mb-6 text-center">Contáctanos</h1>

    <!-- Formulario de contacto -->
    <div class="bg-[#f4f0f0] rounded-lg p-6 mb-10">
      <h2 class="text-xl font-bold mb-4">Envíanos un mensaje</h2>
      <div class="cf7-form">
        <?php echo do_shortcode('[contact-form-7 id="cddcd80" title="Formulario de contacto 1"]'); ?>
      </div>
    </div>

    <!-- Preguntas frecuentes -->
    <div class="mb-10">
      <h2 class="text-xl font-bold mb-4">Preguntas frecuentes</h2>
      <ul class="space-y-4">
        <li>
          <details class="bg-[#f9f9f9] p-4 rounded-lg">
            <summary class="font-medium cursor-pointer">¿Hacen envíos internacionales?</summary>
            <p class="mt-2 text-sm">No, por el momento sólo enviamos dentro de Chile.</p>
          </details>
        </li>
        <li>
          <details class="bg-[#f9f9f9] p-4 rounded-lg">
            <summary class="font-medium cursor-pointer">¿Cómo puedo personalizar una muñeca?</summary>
            <p class="mt-2 text-sm">Puedes usar el formulario para describir tu idea. Te responderemos en 24-48 horas.</p>
          </details>
        </li>
        <li>
          <details class="bg-[#f9f9f9] p-4 rounded-lg">
            <summary class="font-medium cursor-pointer">¿Qué formas de pago aceptan?</summary>
            <p class="mt-2 text-sm">Transferencias, Webpay, tarjetas de crédito y PayPal.</p>
          </details>
        </li>
      </ul>
    </div>

    <!-- Redes sociales -->
    <div class="text-center">
      <h2 class="text-xl font-bold mb-4">Síguenos en redes</h2>
      <div class="flex justify-center gap-6 text-[#e92932] text-xl">
        <a href="https://www.instagram.com/personaliss.cl_beautydolls" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com/personaliss.cl" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
        <a href="https://www.youtube.com/@icomercial_cl" target="_blank" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </div>
  <!-- CTA WhatsApp -->
<div class="mt-12 bg-[#e92932] text-white rounded-lg px-6 py-6 text-center shadow-lg">
  <h2 class="text-2xl font-bold mb-2">¿Tienes dudas o quieres encargar una muñeca?</h2>
  <p class="mb-4 text-lg">Escríbenos directamente por WhatsApp y te respondemos a la brevedad.</p>
  <a
    href="https://wa.me/56963553097"
    target="_blank"
    class="inline-flex items-center justify-center gap-2 rounded-lg bg-white text-[#e92932] font-semibold px-6 py-3 text-base hover:bg-[#f4f0f0] transition"
  >
    <i class="fab fa-whatsapp text-xl"></i> Enviar mensaje
  </a>
</div>

</main>

<?php get_footer(); ?>
