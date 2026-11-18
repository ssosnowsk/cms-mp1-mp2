<?php
/**
 * Title: Trzy usługi
 * Slug: mojafirma/uslugi
 * Categories: featured
 * Description: Trzy kolumny z kluczowymi usługami gabinetu i linkami do podstron oferty.
 *
 * @package mojafirma
 */
?>
<!-- wp:group {"tagName":"section","align":"full","className":"mf-uslugi","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull mf-uslugi"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'W czym możemy pomóc', 'mojafirma' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Terapia manualna', 'mojafirma' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Ból kręgosłupa, karku i stawów? Delikatne techniki manualne przywracają zakres ruchu.', 'mojafirma' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( home_url( '/oferta/terapia-manualna/' ) ); ?>"><?php esc_html_e( 'Poznaj terapię manualną', 'mojafirma' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Rehabilitacja pooperacyjna', 'mojafirma' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Po operacji kolana, barku czy biodra prowadzimy Cię krok po kroku do pełnej sprawności.', 'mojafirma' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( home_url( '/oferta/rehabilitacja-pooperacyjna/' ) ); ?>"><?php esc_html_e( 'Zobacz rehabilitację pooperacyjną', 'mojafirma' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php esc_html_e( 'Ćwiczenia indywidualne', 'mojafirma' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Plan ćwiczeń na dom i w gabinecie, który da się zrobić nawet przy napiętym grafiku.', 'mojafirma' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( home_url( '/oferta/' ) ); ?>"><?php esc_html_e( 'Cała oferta gabinetu', 'mojafirma' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
