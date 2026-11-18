# MP2 – Własny motyw: „Ruch i Zdrowie”

Autor: Szymon Sosnowski · CMS, laboratorium · Collegium Da Vinci · 2026/2027
Motyw jest użyty na stronie z MP1 (fikcyjny gabinet fizjoterapii). Repozytorium zawiera **dwie ścieżki** z założeń MP2:

| Katalog | Typ | Rodzic | Zadania |
|---|---|---|---|
| `mojafirma/` | **Motyw blokowy** (główny, działa na stronie MP1) | brak, budowany od zera | L4 G1–G3, dodatkowo wariant stylu i front-page |
| `mf-child/` | **Motyw potomny** (klasyczny) | Twenty Twenty-One | L5 G1–G4 |

Dlaczego dwa? Strona MP1 jest zbudowana w edytorze witryny, więc używa motywu blokowego. Motyw potomny z L5 dziedziczy po klasycznym motywie Twenty Twenty-One, który z blokowym nie współpracuje, więc pokazuje drugą technikę (hierarchia szablonów PHP, hooki, style bloków) na osobnej instalacji.

## 1. Instalacja

Oba motywy to zwykłe katalogi. Do WordPressa: Wygląd → Motywy → Dodaj nowy → Wyślij motyw (plik `mojafirma.zip` lub `mf-child.zip`). Motyw `mf-child` wymaga zainstalowanego motywu rodzica Twenty Twenty-One (Wygląd → Motywy → Dodaj nowy → „Twenty Twenty-One”). Wymagania: WordPress 6.6+, PHP 7.4+.

## 2. Struktura motywu blokowego `mojafirma/`

```
mojafirma/
├── style.css            nagłówek motywu (nazwa, wersja, licencja GPL, text domain), bez stylów wizualnych
├── theme.json           paleta, typografia, odstępy, style elementów i bloków, CSS dostępności
├── templates/           index, home, front-page, page, single, archive, 404
├── parts/               header.html, footer.html
├── patterns/            hero-cta.php, uslugi.php, opinie.php, stopka-dane.php
├── styles/ciemny.json   wariant stylu: tryb ciemny
└── assets/images/       hero.svg (ilustracja własna)
```

### Hierarchia szablonów (L4 G2)

| Widok | Użyty szablon | Kolejność szukania |
|---|---|---|
| Strona główna (statyczna) | `front-page.html` | front-page → home → index |
| Strona „Aktualności” (lista wpisów) | `home.html` | home → index |
| Strona (O nas, Oferta, Kontakt…) | `page.html` | page-{slug} → page → singular → index |
| Pojedynczy wpis | `single.html` | single-post → single → singular → index |
| Kategoria / archiwum | `archive.html` | category-{slug} → category → archive → index |
| Błąd 404 | `404.html` | 404 → index |
| Wszystko inne | `index.html` | szablon awaryjny |

Aby to sprawdzić w edytorze witryny: Wygląd → Edytor → Szablony, albo na stronie otwórz Ustawienia → Szablon.

### Części szablonu i wzorce

- `parts/header.html`: nazwa witryny i blok Nawigacja z listą stron (menu zgodne z mapą strony).
- `parts/footer.html` wstawia wzorzec `mojafirma/stopka-dane` (dane kontaktowe, link do polityki prywatności, informacja o AI). Dane są we wzorcu PHP, bo tylko PHP pozwala użyć `home_url()` i `esc_url()`, a linki „od korzenia” psują się w Playground.
- Wzorce: **hero z CTA**, **trzy usługi**, **opinie (przykładowe)**, **stopka**. Wymóg „min. 2 wzorce” jest spełniony (4).
- **Wariant stylu** `ciemny` podmienia wartości kolorów o tych samych slugach; wszystkie pary mają kontrast ≥ 4,5:1.

## 3. Struktura motywu potomnego `mf-child/`

```
mf-child/
├── style.css         nagłówek z Template: twentytwentyone, zmienne i style nakładki
├── functions.php     enqueue, i18n, filtry, style bloków (prefiks mf_)
├── page-o-nas.php    szablon tylko dla strony o slugu o-nas
└── languages/        miejsce na tłumaczenia (domena mf-child)
```

### Co zmieniono względem motywu bazowego (Twenty Twenty-One)

- Kolor linków i nagłówków oraz krój nagłówków zgodne z identyfikacją MP1 (`#0b5d7a`, `#083f55`, stos systemowy). Motyw rodzica nie jest edytowany.
- `page-o-nas.php` nadpisuje `page.php` rodzica tylko dla strony `o-nas` (WordPress wybiera najbardziej szczegółowy plik, a plik potomka ma pierwszeństwo).
- **Hooki w `functions.php`:**
  - `wp_enqueue_scripts` → `mf_child_enqueue_styles()`: ładuje arkusz potomka po arkuszu rodzica (zależność `twenty-twenty-one-style`).
  - `after_setup_theme` → `mf_child_setup()`: tłumaczenia.
  - filtr `excerpt_length` → `mf_excerpt_length()`: zajawki po 25 słów.
  - filtr `the_content` → `mf_add_note()`: notka „Masz pytania? Napisz do nas.” pod pojedynczym wpisem; filtr zawsze zwraca wartość, a warunek `is_single() && in_the_loop() && is_main_query()` ogranicza go do głównej treści wpisu.
  - `init` → `mf_register_block_styles()`: style bloków „Z cieniem” (`core/button`) i „Karta” (`core/group`).

## 4. Dobre praktyki

- **Prefiksy:** funkcje `mf_` (child) i `mojafirma` (text domain, slug wzorców); brak ryzyka kolizji nazw.
- **Escaping:** wszystkie wypisywane wartości przechodzą przez `esc_html()`, `esc_html__()`, `esc_html_e()`, `esc_attr__()` i `esc_url()`. Escaping zapobiega XSS, np. tytuł `<script>alert(1)</script>` zostanie wypisany jako tekst, a nie wykonany.
- **i18n:** teksty owinięte w funkcje z domeną `mojafirma` / `mf-child`.
- **Zabezpieczenie plików PHP:** `if ( ! defined( 'ABSPATH' ) ) exit;` w `functions.php`.
- **Brak edycji motywu rodzica:** cała zmiana w `mf-child/`.
- **Dostępność:** kontrast ≥ 4,5:1 (`python3 tools/contrast.py`), widoczny fokus, cele min. 24 px, wbudowany skip link, `prefers-reduced-motion`, `forced-colors`. Szczegóły w raporcie MP1.
- **Licencje:** kod GPL v2+, brak zewnętrznych fontów, ilustracja własna (CC0).

## 5. Git i wersjonowanie

Repozytorium ma historię commitów z opisowymi komunikatami i tagi wersji (`git log --oneline --decorate`). Wersje oznaczam tagami w stylu `v0.1.0` (szkielet), `v1.0.0` (oddanie). Po zmianie podbij `Version` w `style.css`, zrób commit i `git tag -a vX.Y.Z -m "opis"`, potem `git push --tags`.

Repozytorium: https://github.com/ssosnowsk/cms-mp1-mp2 (gałąź `main`, tagi `v0.1.0` i `v1.0.0`).

## 6. Co sprawdzono, a czego nie

Sprawdzone:

- Statycznie: `php -l` dla wszystkich plików PHP, poprawność JSON-a (`theme.json`, wariant stylu), parsowanie SVG, kontrasty par kolorów (`tools/contrast.py`), test hooków z atrapami funkcji WordPressa.
- Na żywej witrynie: motyw `mojafirma` uruchomiony w WordPress Playground z blueprintu strony MP1 (motyw aktywny, strona główna z `front-page.html`, 8 stron, menu z podmenu, wzorce hero i usługi, formularz Contact Form 7). Lighthouse (Accessibility): 24/24 audytów zaliczonych, audyt axe-core i zrzuty ekranu są w paczce MP1.

Nie sprawdzone na żywej instalacji:

- motyw potomny `mf-child`: szablon `page-o-nas.php`, notka pod wpisem, style bloków „Z cieniem” i „Karta”. Do tego przygotowałem `tools/mf-child-blueprint.json` (Twenty Twenty-One + `mf-child` + strony testowe). Wklej go w Playground (menu Blueprint) i otwórz strony `/o-nas/`, `/style-blokow/` i wpis `/wpis/`. Pierwsza próba uruchomienia zakończyła się błędem startu samego Playground (a nie motywu), więc wynik tego testu nie jest jeszcze opisany;
- wariant stylu „Ciemny” w panelu Style oraz wstawianie wzorców z Wstawiacza;
- eksport przez wtyczkę Create Block Theme (zadanie opcjonalne).

## 7. Użycie AI

- **Narzędzie:** Claude (Anthropic).
- **Co wykonało AI:** na moje polecenia przygotowało: szkielet motywu blokowego, `theme.json`, szablony, wzorce, wariant stylu, motyw potomny z hookami i stylami bloków, ilustrację SVG i README.
- **Co zrobiłem ja:** wybrałem założenia (motyw blokowy plus motyw potomny, branża gabinet fizjoterapii), zleciłem pracę na podstawie kart L4 i L5, zainstalowałem Git, zalogowałem się do GitHuba, wypchnąłem repozytorium z historią commitów i tagami oraz sprawdziłem wyniki. Poza kodem AI zrobiło: uruchomienie motywu w Playground, zrzuty ekranu i audyt axe-core.
- **Ręczne poprawki:** nie edytowałem plików samodzielnie. Zmiany i poprawki (menu, README, raport dostępności) wprowadzało AI na moje polecenia, a ja sprawdzałem efekt na stronie i w repozytorium.
- Treści i grafika z AI są oznaczone na stronie. Rozumiem rozwiązania zastosowane w motywach i potrafię je wyjaśnić oraz zmodyfikować.
