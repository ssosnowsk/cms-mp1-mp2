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

Aby opublikować na GitHub: utwórz puste repozytorium (np. `mojafirma`) i wykonaj `git remote add origin <URL>`, `git push -u origin main --tags`.

## 6. Co musisz zrobić samodzielnie

Nie mogłem uruchomić WordPressa w moim środowisku (brak dostępu do wordpress.org), więc kod sprawdziłem statycznie: `php -l` dla wszystkich plików PHP, poprawność JSON-a (`theme.json`, wariant stylu), parsowanie SVG i obliczenie kontrastów. Nie testowałem działania motywu na żywej instalacji. Po instalacji sprawdź:

1. Czy motyw `mojafirma` aktywuje się bez błędów i czy strona główna używa `front-page.html`.
2. Czy wzorce widać w Wstawiaczu (Wzorce) i czy wariant „Ciemny” jest w Stylach.
3. W `mf-child`: czy strona „O nas” używa `page-o-nas.php`, czy notka pojawia się pod wpisem i czy style „Z cieniem” i „Karta” są w panelu Style bloku.
4. Zrób **3–5 zrzutów ekranu** do oddania: strona główna, szablon/strona „O nas”, styl bloku w edytorze, widok mobilny. Zapisz w katalogu `screenshots/`.
5. Opcjonalnie eksport ZIP przez wtyczkę Create Block Theme (zadanie L4 G3) i test w Playground.

## 7. Użycie AI

- **Narzędzie:** Claude (Anthropic).
- **Co wykonało AI:** na moje polecenia przygotowało: szkielet motywu blokowego, `theme.json`, szablony, wzorce, wariant stylu, motyw potomny z hookami i stylami bloków, ilustrację SVG i README.
- **Co zrobiłem ja:** wybrałem założenia (motyw blokowy plus motyw potomny, branża z MP1) i zleciłem pracę na podstawie kart L4 i L5.
- Treści i grafika z AI są oznaczone na stronie. Rozumiem rozwiązania zastosowane w motywach i potrafię je wyjaśnić oraz zmodyfikować.
