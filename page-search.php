<?php
get_header();
while (have_posts()) {
  the_post(); 
  pageBanner();
  ?>

 
  <div class="container container--narrow page-section">
    <?php
    //verible
    $theParent = wp_get_post_parent_id(get_the_ID());
    if ($theParent) { ?>
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent) ?>">
            <i class="fa fa-home" aria-hidden="true">
            </i> Back to <?php echo get_the_title($theParent) ?></a> <span class="metabox__main"><?php the_title(); ?></span>
        </p>
      </div>
    <?php } ?>

    <?php
    $testArray = get_pages(array(
      'child_of' => get_the_ID()
    ));

    if ($theParent or $testArray) { ?>

      <!-- Creating for children links/pages for the current view -->
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent) ?>"><?php echo get_the_title($theParent) ?></a></h2>
        <ul class="min-list">

          <?php

          if ($theParent) {
            $findChildrenOf = $theParent;
          } else {
            $findChildrenOf = get_the_ID();
          }
          // the function needs an associative array
          wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findChildrenOf,
            //  Do not that by defualt wprdress sort pages by alphabetical order
            /* To make custome order */
            'sort_column' => 'menu_order'
            /* then go the dashboard -> papges -> click on the specific page
              change the order of the page, then to the same for other pages */
          ));
          ?>
        </ul>
      </div>

    <?php } ?>

    <div class="generic-content">
     <?php get_search_form();?>
    </div>
  </div>

<?php }

get_footer();

?>