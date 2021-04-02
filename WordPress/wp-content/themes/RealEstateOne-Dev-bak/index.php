<?php
/**
 * The current version of the theme.
 *
 * @package REO
 */

get_header(); ?>

<!-- Banner start -->
<?php get_template_part( 'template-parts/blog/blog-banner' ); ?>
<!-- Banner end -->

<!-- Blog body start -->
<div class="blog-body content-area">
<div class="container">
<?php
$index = get_theme_mod( 'immo2wp_template_blog' );
if ( ! $index ) :
	get_template_part( 'template-parts/blog/template/template-blog-classic-sidebar-right' );
else :
	get_template_part( 'template-parts/blog/template/' . get_theme_mod( 'immo2wp_template_blog' ) );
endif;
?>
</div>
</div>
<!-- Blog body end -->

<!-- Partners block start -->
<?php get_template_part( 'template-parts/blog/partners-block' ); ?>
<!-- Partners block end -->
<?php
	get_footer();
?>
