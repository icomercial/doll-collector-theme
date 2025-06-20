<?php
/**
 * Template Name: Blog Noticias
 * Description: Plantilla personalizada para mostrar las entradas del blog estilo "Noticias".
 */

get_header(); ?>

<div class="relative flex size-full min-h-screen flex-col bg-white group/design-root overflow-x-hidden" style='font-family: Newsreader, "Noto Sans", sans-serif;'>
  <div class="layout-container flex h-full grow flex-col">
    <div class="px-10 py-5 border-b border-solid border-b-[#f4f0f2]">
      <h1 class="text-[#181114] text-[32px] font-bold leading-tight"><?php the_title(); ?></h1>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="text-[#896175] text-sm mb-6"><?php the_content(); ?></div>
      <?php endwhile; endif; rewind_posts(); ?>
    </div>

    <div class="flex flex-col items-center p-4">
      <div class="layout-content-container max-w-[960px] w-full">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <div class="p-4 @container">
            <div class="flex flex-col items-stretch justify-start rounded-lg @xl:flex-row @xl:items-start">
              <?php if (has_post_thumbnail()) : ?>
                <div class="w-full bg-center bg-no-repeat aspect-video bg-cover rounded-lg" style='background-image: url("<?php the_post_thumbnail_url('large'); ?>")'></div>
              <?php endif; ?>

              <div class="flex w-full min-w-72 grow flex-col items-stretch justify-center gap-1 py-4 @xl:px-4">
                <h2 class="text-[#181114] text-lg font-bold leading-tight tracking-[-0.015em]">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="flex items-end gap-3 justify-between">
                  <p class="text-[#896175] text-base font-normal leading-normal">
                    <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
                  </p>
                  <a href="<?php the_permalink(); ?>"
                     class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-8 px-4 bg-[#ef4298] text-white text-sm font-medium leading-normal">
                    <span class="truncate">Read More</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; else : ?>
          <p class="text-center text-gray-600">No hay noticias aún.</p>
        <?php endif; ?>

        <!-- Navegación -->
        <div class="flex items-center justify-center p-4">
          <?php the_posts_pagination(array(
            'prev_text' => '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"18\" height=\"18\" fill=\"currentColor\" viewBox=\"0 0 256 256\"><path d=\"M165.66,202.34a8,8,0,0,1-11.32,11.32l-80-80a8,8,0,0,1,0-11.32l80-80a8,8,0,0,1,11.32,11.32L91.31,128Z\"></path></svg>',
            'next_text' => '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"18\" height=\"18\" fill=\"currentColor\" viewBox=\"0 0 256 256\"><path d=\"M181.66,133.66l-80,80a8,8,0,0,1-11.32-11.32L164.69,128,90.34,53.66a8,8,0,0,1,11.32-11.32l80,80A8,8,0,0,1,181.66,133.66Z\"></path></svg>',
            'mid_size' => 2,
            'screen_reader_text' => ' ',
            'type' => 'list'
          )); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
