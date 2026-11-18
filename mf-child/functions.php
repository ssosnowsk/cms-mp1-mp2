<?php
/**
 * Motyw potomny MF Child – functions.php
 *
 * Wszystkie funkcje mają prefiks mf_ (ochrona przed kolizją nazw),
 * teksty interfejsu przechodzą przez funkcje i18n z domeną mf-child,
 * a wypisywane wartości są escapowane (esc_html, esc_attr, esc_url).
 *
 * @package mf-child
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Bezpośredni dostęp do pliku jest zabroniony.
}

/**
 * Ładuje arkusz motywu potomnego po arkuszu rodzica.
 * Uchwyt 'twenty-twenty-one-style' pochodzi z motywu Twenty Twenty-One.
 */
add_action( 'wp_enqueue_scripts', 'mf_child_enqueue_styles' );
function mf_child_enqueue_styles() {
	wp_enqueue_style(
		'mf-child-style',
		get_stylesheet_uri(),
		array( 'twenty-twenty-one-style' ),
		wp_get_theme()->get( 'Version' )
	);
}

/**
 * Ładuje tłumaczenia motywu potomnego z katalogu /languages.
 */
add_action( 'after_setup_theme', 'mf_child_setup' );
function mf_child_setup() {
	load_child_theme_textdomain( 'mf-child', get_stylesheet_directory() . '/languages' );
}

/**
 * Filtr: długość zajawki (excerpt) w słowach.
 * 25 słów mieści się w 2-3 liniach karty wpisu na liście Aktualności.
 *
 * @param int $length Domyślna długość.
 * @return int
 */
add_filter( 'excerpt_length', 'mf_excerpt_length', 20 );
function mf_excerpt_length( $length ) {
	return 25;
}

/**
 * Filtr: dodaje notkę pod treścią pojedynczego wpisu.
 * Warunki zapobiegają dopisaniu notki w widżetach, listach i zapytaniach pobocznych.
 *
 * @param string $content Treść wpisu.
 * @return string Filtr ZAWSZE zwraca wartość.
 */
add_filter( 'the_content', 'mf_add_note' );
function mf_add_note( $content ) {
	if ( is_single() && in_the_loop() && is_main_query() ) {
		$note     = esc_html__( 'Masz pytania? Napisz do nas.', 'mf-child' );
		$content .= '<p class="mf-note">' . $note . '</p>';
	}
	return $content;
}

/**
 * Rejestruje własne style bloków widoczne w panelu "Style" edytora.
 */
add_action( 'init', 'mf_register_block_styles' );
function mf_register_block_styles() {
	register_block_style(
		'core/button',
		array(
			'name'         => 'mf-cien',
			'label'        => __( 'Z cieniem', 'mf-child' ),
			'inline_style' => '.wp-block-button.is-style-mf-cien .wp-block-button__link {'
				. ' box-shadow: 0 4px 0 var(--mf-accent-dark, #083f55); }',
		)
	);

	// Wygląd karty jest w style.css (selektor .is-style-mf-karta).
	register_block_style(
		'core/group',
		array(
			'name'  => 'mf-karta',
			'label' => __( 'Karta', 'mf-child' ),
		)
	);
}
