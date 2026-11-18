<?php
/**
 * Title: Stopka z danymi kontaktowymi
 * Slug: mojafirma/stopka-dane
 * Categories: footer
 * Inserter: false
 * Description: Stopka: dane kontaktowe, link do polityki prywatności i informacja o treściach AI.
 *
 * @package mojafirma
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"primary-dark","textColor":"base","className":"mf-footer","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull mf-footer has-base-color has-primary-dark-background-color has-text-color has-background"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2,"fontSize":"large","textColor":"base"} -->
<h2 class="wp-block-heading has-base-color has-text-color has-large-font-size"><?php esc_html_e( 'Ruch i Zdrowie', 'mojafirma' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Gabinet fizjoterapii (firma fikcyjna)', 'mojafirma' ); ?><br><?php esc_html_e( 'ul. Przykładowa 12, 00-000 Miasto', 'mojafirma' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2,"fontSize":"large","textColor":"base"} -->
<h2 class="wp-block-heading has-base-color has-text-color has-large-font-size"><?php esc_html_e( 'Kontakt', 'mojafirma' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Telefon:', 'mojafirma' ); ?> <a href="tel:+48600000000">+48 600 000 000</a><br><?php esc_html_e( 'E-mail:', 'mojafirma' ); ?> <a href="mailto:kontakt@ruchizdrowie.example">kontakt@ruchizdrowie.example</a><br><?php esc_html_e( 'Pon.–pt. 8:00–19:00', 'mojafirma' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:heading {"level":2,"fontSize":"large","textColor":"base"} -->
<h2 class="wp-block-heading has-base-color has-text-color has-large-font-size"><?php esc_html_e( 'Informacje', 'mojafirma' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><a href="<?php echo esc_url( home_url( '/polityka-prywatnosci/' ) ); ?>"><?php esc_html_e( 'Polityka prywatności i cookies', 'mojafirma' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
<p class="has-text-align-center has-small-font-size"><?php esc_html_e( 'Treści i ilustracje na stronie powstały z udziałem narzędzia AI (Claude) i zostały sprawdzone przez autora. Dane firmy są fikcyjne.', 'mojafirma' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
