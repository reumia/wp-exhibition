<? get_header(); ?>
  <div class="body">
    <div class="list">
      <? if ( have_posts() ) : ?>
        <ul>
          <? while ( have_posts() ) : the_post(); ?>
            <li class="alist__li">
              <a class="alist__a" href="<?the_permalink()?>"><?the_title()?></a>
              <small><?=get_the_date()?></small>
            </li>
          <? endwhile; ?>
        </ul>
      <? endif; ?>
      <?
      if(function_exists('wp_pagenavi')){
        wp_pagenavi();
      }else{
        mbt_paging_nav();
      } ?>
    </div>
  </div>
<? get_footer(); ?>