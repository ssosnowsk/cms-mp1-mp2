<?php
/**
 * page-o-nas.php – szablon tylko dla strony o slugu "o-nas".
 *
 * Hierarchia szablonów: page-o-nas.php (potomek) -> page.php (rodzic) -> index.php.
 * Twenty Twenty-One otwiera znacznik <main> w header.php, więc tutaj wypisujemy tylko <article>.
 *
 * @package mf-child
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'mf-o-nas' ); ?>>
		<header class="entry-header alignwide">
			<h1 class="entry-title"><?php echo esc_html( get_the_title() ); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p class="mf-lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<aside class="mf-o-nas-dane">
			<h2><?php esc_html_e( 'Dane gabinetu', 'mf-child' ); ?></h2>
			<p>
				<?php echo esc_html( get_bloginfo( 'name' ) ); ?><br>
				<?php esc_html_e( 'Telefon:', 'mf-child' ); ?>
				<a href="<?php echo esc_url( 'tel:+48600000000' ); ?>">+48 600 000 000</a>
			</p>
		</aside>
	</article>
	<?php
endwhile;

get_footer();
