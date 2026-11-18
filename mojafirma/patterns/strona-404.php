<?php
/**
 * Title: Treść strony 404
 * Slug: mojafirma/strona-404
 * Categories: text
 * Inserter: false
 * Description: Komunikat o błędzie 404, wyszukiwarka i przycisk powrotu na stronę główną.
 *
 * Wzorzec PHP zamiast zwykłego HTML w szablonie, bo adres strony głównej
 * musi pochodzić z home_url(): link "/" psuje się, gdy WordPress działa
 * w podkatalogu (np. w Playground).
 *
 * @package mojafirma
 */
?>
<!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Nie znaleziono strony (błąd 404)', 'mojafirma' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Strona, której szukasz, nie istnieje lub została przeniesiona. Skorzystaj z wyszukiwarki albo wróć do strony głównej.', 'mojafirma' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"<?php echo esc_attr__( 'Szukaj na stronie', 'mojafirma' ); ?>","buttonText":"<?php echo esc_attr__( 'Szukaj', 'mojafirma' ); ?>"} /-->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Wróć do strony głównej', 'mojafirma' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
