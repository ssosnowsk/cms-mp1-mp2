<?php
/**
 * Title: Hero z wezwaniem do działania
 * Slug: mojafirma/hero-cta
 * Categories: featured, banner
 * Description: Sekcja otwierająca (blok Okładka): nagłówek H1, korzyść i przycisk CTA (umów wizytę).
 *
 * @package mojafirma
 */

$mojafirma_cta_url = esc_url( home_url( '/kontakt/' ) );
?>
<!-- wp:cover {"overlayColor":"surface","isUserOverlayColor":true,"isDark":false,"tagName":"section","align":"full","className":"mf-hero","layout":{"type":"constrained"}} -->
<section class="wp-block-cover alignfull is-light mf-hero"><span aria-hidden="true" class="wp-block-cover__background has-surface-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:columns {"align":"wide","verticalAlignment":"center"} -->
<div class="wp-block-columns alignwide are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Wróć do ruchu bez bólu', 'mojafirma' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Indywidualna fizjoterapia dla dorosłych: diagnoza, terapia manualna i plan ćwiczeń dopasowany do Twojej codzienności.', 'mojafirma' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo $mojafirma_cta_url; // phpcs:ignore WordPress.Security.EscapeOutput -- zmienna przepuszczona przez esc_url() wyżej. ?>"><?php esc_html_e( 'Umów wizytę', 'mojafirma' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center"} -->
<div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/hero.svg' ) ); ?>" alt="<?php echo esc_attr__( 'Ilustracja: schematyczna sylwetka wykonująca ćwiczenie rozciągające na macie', 'mojafirma' ); ?>"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div></section>
<!-- /wp:cover -->
