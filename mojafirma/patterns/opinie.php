<?php
/**
 * Title: Opinie pacjentów (przykładowe)
 * Slug: mojafirma/opinie
 * Categories: featured
 * Description: Trzy cytaty z opiniami. Treści są fikcyjne i oznaczone jako przykładowe.
 *
 * @package mojafirma
 */
?>
<!-- wp:group {"tagName":"section","align":"full","backgroundColor":"surface","className":"mf-opinie","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull mf-opinie has-surface-background-color has-background"><!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Co mówią pacjenci', 'mojafirma' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","textColor":"muted","fontSize":"small"} -->
<p class="has-text-align-center has-muted-color has-text-color has-small-font-size"><?php esc_html_e( 'Przykładowe opinie – dane fikcyjne, strona powstała na potrzeby ćwiczenia.', 'mojafirma' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Po trzech tygodniach terapii znów mogę siedzieć przy biurku cały dzień.', 'mojafirma' ); ?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( 'Anna, księgowa (przykład)', 'mojafirma' ); ?></cite></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Plan ćwiczeń był prosty i konkretny. Wróciłem do biegania po kontuzji kolana.', 'mojafirma' ); ?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( 'Marek, biegacz amator (przykład)', 'mojafirma' ); ?></cite></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Wszystko zostało wytłumaczone zrozumiałym językiem, bez pośpiechu.', 'mojafirma' ); ?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( 'Ewa, nauczycielka (przykład)', 'mojafirma' ); ?></cite></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></section>
<!-- /wp:group -->
