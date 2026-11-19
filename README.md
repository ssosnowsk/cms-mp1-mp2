# MP2 – Własny motyw: „Ruch i Zdrowie”

Autor: Szymon Sosnowski · CMS, laboratorium · Collegium Da Vinci · 2026/2027
Motyw jest użyty na stronie z MP1 (fikcyjny gabinet fizjoterapii). Repozytorium zawiera **dwie ścieżki** z założeń MP2:

| Katalog | Typ | Rodzic | Zadania |
|---|---|---|---|
| `mojafirma/` | **Motyw blokowy** (główny, działa na stronie MP1) | brak, budowany od zera | L4 G1–G3, dodatkowo wariant stylu i front-page |
| `mf-child/` | **Motyw potomny** (klasyczny) | Twenty Twenty-One | L5 G1–G4 |

Dlaczego dwa? Strona MP1 jest zbudowana w edytorze witryny, więc używa motywu blokowego. Motyw potomny z L5 dziedziczy po klasycznym motywie Twenty Twenty-One, który z blokowym nie współpracuje, więc pokazuje drugą technikę (hierarchia szablonów PHP, hooki, style bloków) na osobnej instalacji.

## 1. Instalacja

Oba motywy są w paczce jako katalogi oraz jako gotowe do instalacji pliki `mojafirma.zip` (eksport wtyczką Create Block Theme) i `mf-child.zip` (folder `instalacja/`). Do WordPressa: Wygląd → Motywy → Dodaj nowy → Wyślij motyw. Motyw `mf-child` wymaga zainstalowanego motywu rodzica Twenty Twenty-One (Wygląd → Motywy → Dodaj nowy → „Twenty Twenty-One”). Wymagania: WordPress 6.6+, PHP 7.4+.

## 2. Struktura motywu blokowego `mojafirma/`

```
mojafirma/
├── style.css            nagłówek motywu (nazwa, wersja, licencja GPL, text domain), bez stylów wizualnych
├── theme.json           paleta, typografia, odstępy, style elementów i bloków, CSS dostępności
├── templates/           index, home, front-page, page, single, archive, search, 404
├── parts/               header.html, footer.html
├── patterns/            hero-cta.php, uslugi.php, opinie.php, stopka-dane.php, strona-404.php
├── styles/ciemny.json   wariant stylu: tryb ciemny
└── assets/images/       hero.svg (ilustracja wygenerowana przez AI, CC0)
```

### Hierarchia szablonów (L4 G2)

| Widok | Użyty szablon | Kolejność szukania |
|---|---|---|
| Strona główna (statyczna) | `front-page.html` | front-page → home → index |
| Strona „Aktualności” (lista wpisów) | `home.html` | home → index |
| Strona (O nas, Oferta, Kontakt…) | `page.html` | page-{slug} → page → singular → index |
| Pojedynczy wpis | `single.html` | single-post → single → singular → index |
| Kategoria / archiwum | `archive.html` | category-{slug} → category → archive → index |
| Wyniki wyszukiwania | `search.html` | search → index |
| Błąd 404 | `404.html` | 404 → index |
| Wszystko inne | `index.html` | szablon awaryjny |

Aby to sprawdzić w edytorze witryny: Wygląd → Edytor → Szablony, albo na stronie otwórz Ustawienia → Szablon.

### Części szablonu i wzorce

- `parts/header.html`: nazwa witryny i blok Nawigacja. Menu (wpis `wp_navigation` z jawnymi linkami i podmenu Oferta) tworzy skrypt `tools/seed.php` z MP1. Blok „Lista stron” został zastąpiony, bo generował listę `<ul>` zagnieżdżoną w `<ul>` (błąd dostępności z audytu axe).
- `parts/footer.html` wstawia wzorzec `mojafirma/stopka-dane` (dane kontaktowe, link do polityki prywatności, informacja o AI). Dane są we wzorcu PHP, bo tylko PHP pozwala użyć `home_url()` i `esc_url()`, a linki „od korzenia” psują się w Playground.
- Wzorce: **hero z CTA** (blok Okładka), **trzy usługi**, **opinie (przykładowe)**, **stopka** i **treść strony 404**. Wymóg „min. 2 wzorce” jest spełniony (5, z czego 3 widoczne we Wstawiaczu).
- `404.html` wstawia wzorzec `mojafirma/strona-404`, bo przycisk „Wróć do strony głównej” potrzebuje adresu z `home_url()`; zwykły link `/` prowadził w złe miejsce, gdy WordPress działa w podkatalogu.
- `search.html` ma tytuł wyników jako H1 i wyszukiwarkę; bez niego wyniki wyszukiwania (np. z formularza na stronie 404) korzystały z `index.html` bez nagłówka H1.
- `theme.json` ma `defaultFontSizes: false` i `defaultSpacingSizes: false`. Bez tych ustawień WordPress (theme.json w wersji 3) pomija rozmiary motywu o tych samych nazwach co domyślne (`small`–`x-large`, odstępy `20`–`60`), co dawało m.in. H2 większy od H1 na telefonie.
- `templates/page.html`: treść strony ma `align: full` z własnym układem, dzięki czemu sekcje szerokie we wzorcach mają 1180 px, a zwykły tekst 720 px.
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
  - `init` → `mf_register_block_styles()`: style bloków „Z cieniem” (`core/button`) i „Karta” (`core/group`). CSS obu stylów jest w `inline_style`, więc wyglądają tak samo w edytorze i na stronie (zrzuty `screenshots/01` i `02`).
- `page-o-nas.php` wypisuje sekcję „Dane gabinetu” w klasie `entry-content`, żeby była wyrównana z treścią rodzica.
- Kontrast w motywie potomnym liczony na tle rodzica `#d1e4dd`: linki 5,54:1, nagłówki 8,56:1, zajawka 5,74:1, tekst karty 15,57:1.

## 4. Dobre praktyki

- **Prefiksy:** funkcje `mf_` (child) i `mojafirma` (text domain, slug wzorców); brak ryzyka kolizji nazw.
- **Escaping:** wszystkie wypisywane wartości przechodzą przez `esc_html()`, `esc_html__()`, `esc_html_e()`, `esc_attr__()` i `esc_url()`. Escaping zapobiega XSS, np. tytuł `<script>alert(1)</script>` zostanie wypisany jako tekst, a nie wykonany.
- **i18n:** teksty owinięte w funkcje z domeną `mojafirma` / `mf-child`.
- **Zabezpieczenie plików PHP:** `if ( ! defined( 'ABSPATH' ) ) exit;` w `functions.php`.
- **Brak edycji motywu rodzica:** cała zmiana w `mf-child/`.
- **Dostępność:** kontrast ≥ 4,5:1 (`python3 tools/contrast.py`), widoczny fokus, cele min. 24 px, wbudowany skip link, `prefers-reduced-motion`, `forced-colors`. Szczegóły w raporcie MP1.
- **Licencje:** kod GPL v2+, brak zewnętrznych fontów, ilustracja wygenerowana przez AI i oznaczona na stronie (CC0).

## 5. Git i wersjonowanie

Repozytorium ma historię commitów z opisowymi komunikatami i tagi wersji (`git log --oneline --decorate`). Wersje oznaczam tagami: `v0.1.0` (szkielet), `v1.0.0` (oddanie), `v1.0.1` (dokumentacja), `v1.1.0` (poprawki po końcowej kontroli), `v1.1.1` (strona 404, wyniki wyszukiwania, komunikaty formularza). Po zmianie podbijam `Version` w `style.css` obu motywów, robię commit i `git tag -a vX.Y.Z -m "opis"`, potem `git push --tags`. Plik `.gitignore` wyklucza archiwa ZIP i pliki systemowe.

Repozytorium: https://github.com/ssosnowsk/cms-mp1-mp2 (gałąź `main`, tagi `v0.1.0`, `v1.0.0`, `v1.0.1`, `v1.1.0` i `v1.1.1`).

### Create Block Theme (L4 G3)

Wtyczka Create Block Theme 2.10.2 w Playground z blueprintu MP1:

1. **Eksport do ZIP:** motyw `mojafirma` 1.1.1 wyeksportowany wtyczką to plik `instalacja/mojafirma.zip` (19 plików). Od plików w repozytorium różni się tylko zapisem `theme.json` (posortowane klucze, adres `$schema` dla WordPressa 7.1, pusta lista `customTemplates`); treść ustawień jest taka sama. Wcześniejszy eksport zainstalowano z powrotem przez Wygląd → Motywy → Dodaj nowy → Wyślij motyw („Motyw został zaktualizowany”) i strona działała dalej (strona główna, Oferta, Kontakt, 404).
2. **„Zapisz zmiany w motywie”** (19.11.2026): w edytorze witryny zmieniono kolor marki w palecie (`#0b5d7a` → `#0a4f68`) i w części szablonu Nagłówek rozmiar nazwy witryny (L), zapisano zmiany, a potem użyto „Save Changes to Theme”. Wtyczka przeniosła zmiany z bazy danych do plików motywu. `git diff` pokazał zmiany tylko w `theme.json` (kolor marki) i `parts/header.html` (rozmiar nazwy witryny; wtyczka usunęła też ustawienie `overlayMenu: mobile`, bo jest domyślne) – zrzut `screenshots/08-create-block-theme-git-diff.png`.
3. **Decyzja:** zmian testowych nie zatwierdzono w repozytorium. Kolor marki `#0b5d7a` jest podstawą tabeli kontrastów i stylów motywu potomnego, a zmiany wyglądu wprowadzamy w kodzie motywu i zatwierdzamy commitem z tagiem wersji.

## 6. Co sprawdzono, a czego nie

Sprawdzone 18.11.2026, Docker 19.11.2026 (`mojafirma` 1.1.1, `mf-child` 1.1.0):

- **Statycznie:** `php -l` dla wszystkich plików PHP, poprawność JSON-a (`theme.json`, wariant stylu, blueprinty), kontrasty par kolorów (`tools/contrast.py`).
- **`mojafirma` na żywej stronie MP1** (Playground z blueprintu): wszystkie szablony, części, wzorce i treści otwierają się w edytorze bez błędów walidacji bloków; hierarchia szablonów zgodna z tabelą wyżej (także 404 i wyniki wyszukiwania, przycisk na stronie 404 prowadzi na stronę główną); axe-core na 13 adresach strony (8 stron, 3 wpisy, 2 kategorie): 0 naruszeń z kodu motywu; test klawiaturą; 13 adresów strony × 6 szerokości ekranu bez przewijania w poziomie. Szczegóły w raporcie dostępności MP1.
- **Wariant „Ciemny”** włączony na żywo: 0 naruszeń kontrastu (axe-core, 6 podstron), zrzut `screenshots/07-wariant-ciemny-mojafirma.jpg`.
- **`mf-child` na żywo** (blueprint `tools/mf-child-blueprint.json`: Twenty Twenty-One + `mf-child` + strony testowe): w edytorze w panelu „Style” są style „Z cieniem” i „Karta” i działają w podglądzie (`screenshots/01`, `02`); na stronie `/style-blokow/` (`03`); strona `/o-nas/` używa `page-o-nas.php` (pionowa kreska marki, zajawka, „Dane gabinetu”, `04`), a `/kontakt/` zwykłego `page.php` rodzica (`05`); pod wpisem jest notka z filtra `the_content` (`06`).
- **Create Block Theme:** eksport do ZIP, instalacja ZIP-a i „Zapisz zmiany w motywie” z kontrolą `git diff` (sekcja 5).
- **`docker-compose.yml` w GitHub Codespaces:** oba kontenery (MariaDB 11, WordPress na PHP 8.3) startują, WordPress instaluje się po polsku pod portem 8080, a zamontowane katalogi `mojafirma` i `mf-child` są widoczne w `wp-content/themes`; `mojafirma` 1.1.1 działa jako aktywny motyw. Do pliku dodano `WORDPRESS_CONFIG_EXTRA`, bo za proxy Codespaces WordPress przekierowywał na `localhost:8080`. Zrzuty są w paczce MP1 (`docker-codespaces/`).

Nie sprawdzono: czytnik ekranu.

**Zrzuty do oddania:** strona główna na telefonie (`screenshots/09-mobile-375px-strona-glowna.jpg`), strona główna w wariancie ciemnym (`07`), strona „O nas” z szablonu `page-o-nas.php` (`04`), styl bloku w edytorze (`01`) i zapis zmian przez Create Block Theme (`08`). Pozostałe zrzuty dokumentują testy opisane wyżej.

## 7. Użycie AI

- **Narzędzie:** Claude (Anthropic).
- **Jak pracowaliśmy:** motywy powstały we współpracy z AI. Ja ustalałem założenia i kierunek, a AI na moje polecenia przygotowywało kod: szkielet motywu blokowego, `theme.json`, szablony, wzorce, wariant stylu, motyw potomny z hookami i stylami bloków, ilustrację SVG i README.
- **Moja część:** wybrałem rozwiązanie (motyw blokowy plus motyw potomny) i założenia, prowadziłem pracę według kart L4 i L5, sam uruchamiałem i testowałem motywy w Playground w swojej przeglądarce (strona z motywem `mojafirma`: klawiatura, widok na telefonie, podstrony, menu i formularz; motyw `mf-child`: strona O nas, notka pod wpisem, style „Z cieniem” i „Karta”), zainstalowałem Git, zalogowałem się do GitHuba, wypchnąłem repozytorium z historią commitów i tagami oraz sprawdzałem i zatwierdzałem kolejne poprawki.
- **Testy automatyczne uruchomione przez AI na moje polecenie:** audyty axe-core, pomiar fokusu przy przechodzeniu klawiaturą, test szerokości ekranu, zapis zmian z edytora witryny i eksport przez Create Block Theme oraz zrzuty ekranu. Na podstawie tych testów i moich sprawdzeń wprowadziliśmy poprawki opisane w sekcjach 2 i 3.
- **Co poprawiłem ręcznie:** plików nie edytowałem samodzielnie. Poprawki wynikające z moich testów i z testów automatycznych wprowadzało AI na moje polecenia, a ja sprawdzałem efekt na stronie i w repozytorium oraz zatwierdzałem zmiany.
- Treści i grafika z AI są oznaczone na stronie. Rozumiem rozwiązania zastosowane w motywach i potrafię je wyjaśnić oraz zmodyfikować.
