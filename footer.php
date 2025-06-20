    <?php // Aquí iría el contenido principal (de front-page.php, page.php, single.php, etc.) ?>
    <!-- Botón flotante de WhatsApp -->
<a
  href="https://wa.me/56963553097?text=Hola%2C%20estoy%20interesado%20en%20las%20muñecas%20de%20colección."
  target="_blank"
  class="fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 rounded-full bg-[#25D366] text-white shadow-lg hover:scale-105 transition-transform"
  aria-label="WhatsApp"
>
  <i class="fab fa-whatsapp text-2xl"></i>
</a>

    </div><!-- Cierre de div posterior al inicio de .layout-container -->
  </div><!-- Cierre de .layout-container -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const menuToggle = document.getElementById('menu-toggle');
  const navContainer = document.getElementById('main-menu');

  // Mostrar/ocultar menú principal
  menuToggle?.addEventListener('click', function () {
    const ul = navContainer?.querySelector('ul');
    if (ul) ul.classList.toggle('hidden');
  });

  // Submenús en móviles
  if (window.innerWidth < 1024) {
    const itemsWithChildren = navContainer?.querySelectorAll('.menu-item-has-children');

    itemsWithChildren?.forEach(item => {
      const link = item.querySelector('a');
      link?.addEventListener('click', function (e) {
        e.preventDefault(); // Evita el salto de página
        item.classList.toggle('open');
      });
    });
  }
});
</script>

    <?php wp_footer(); // WordPress hooks, importante para scripts ?>
</body>
</html>