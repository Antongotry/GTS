# GTS Theme - Project Guide

## 📋 Оглавление

- [Структура проекта](#структура-проекта)
- [Сборка и разработка](#сборка-и-разработка)
- [Архитектура стилей](#архитектура-стилей)
- [Naming Conventions](#naming-conventions)
- [Как добавлять блоки](#как-добавлять-блоки)
- [Паттерны и практики](#паттерны-и-практики)
- [Что НЕ делать](#что-не-делать)

---

## 🏗️ Структура проекта

### Основные директории

```
gts-theme/
├── template-parts/blocks/     # Блоки контента (hero, booking-form, etc.)
├── sass/                      # SCSS исходники
│   ├── abstracts/            # Переменные, миксины, функции
│   ├── base/                 # Базовые стили (типографика, элементы)
│   ├── components/           # Переиспользуемые компоненты
│   ├── blocks/               # Стили для блоков
│   ├── layouts/              # Макетные стили
│   └── style.scss            # Главный файл компиляции
├── js/                       # JavaScript файлы
├── inc/                      # PHP функции и хуки
├── assets/                   # Статические ресурсы (шрифты, иконки)
└── functions.php            # Основной файл темы
```

### Блоки (template-parts/blocks/)

- `hero.php` / `hero-limousine-service.php` - Hero секции
- `booking-form.php` / `booking-form-limousine-service.php` - Формы бронирования
- `why-us.php` - Блок "Почему мы"
- `how-it-works.php` - Блок "Как это работает"
- `services.php` - Блок услуг
- `trusted-by.php` - Блок "Нам доверяют"
- `custom-itinerary.php` - Кастомные маршруты
- `final-cta.php` - Финальный призыв к действию

---

## 🔨 Сборка и разработка

### Установка зависимостей

```bash
npm install
composer install
```

### Доступные команды

```bash
# Компиляция SCSS в CSS
npm run compile:css

# Watch режим (автоматическая компиляция при изменениях)
npm run watch

# Генерация RTL версии
npm run compile:rtl

# Линтинг
npm run lint:scss
npm run lint:js
composer lint:wpcs
composer lint:php

# Создание архива для деплоя
npm run bundle
```

### Процесс разработки

1. **Изменения в SCSS**: Используй `npm run watch` для автоматической компиляции
2. **Изменения в PHP**: Проверяй через `composer lint:wpcs` и `composer lint:php`
3. **Изменения в JS**: Проверяй через `npm run lint:js`
4. **Коммит**: Всегда компилируй CSS перед коммитом (`npm run compile:css`)

---

## 🎨 Архитектура стилей

### Компонентная система

Проект использует компонентный подход для переиспользуемых элементов:

#### Компоненты (sass/components/)

- **`_buttons.scss`** - Единая система кнопок
  - `.btn` - базовый класс
  - `.btn-primary` - основная кнопка (градиент)
  - `.btn-secondary` - вторичная кнопка (белая)
  - `.btn-shine` - эффект свечения
  - Модификаторы: `.btn-sm`, `.btn-full`, `.btn-width-auto`, `.btn-no-shadow`

- **`_pills.scss`** - Pill-элементы (округлые бейджи)
  - `.pill` - базовый класс
  - `.pill--glass` - стеклянный эффект
  - `.pill--light` - светлый вариант

- **`_typography.scss`** - Типографика
  - `.hero-title` - заголовок hero-блока
  - `.section-title` - заголовок секции
  - `.section-description` - описание секции
  - Модификаторы: `--center`, `--light`, `--tight`

#### Использование компонентов

```scss
// ✅ ПРАВИЛЬНО: Используй @extend для компонентов
.my-block-title {
    @extend .section-title;
    @extend .section-title--center;
}

.my-button {
    @extend .btn;
    @extend .btn-primary;
}

// ❌ НЕПРАВИЛЬНО: Не дублируй стили компонентов
.my-button {
    padding: 0 24px;
    height: 56px;
    // ... дублирование стилей
}
```

### Блоки (sass/blocks/)

Каждый блок имеет свой файл стилей:
- `_hero.scss` - Hero блок
- `_booking-form.scss` - Форма бронирования
- `_why-us.scss` - Блок "Почему мы"
- и т.д.

**Правило**: Блоки НЕ должны дублировать стили компонентов. Используй `@extend`.

---

## 📝 Naming Conventions

### CSS/SCSS (BEM-like)

```scss
// Блок
.hero-block { }

// Элемент
.hero-block__title { }  // или .hero-title (если используется компонент)
.hero-content { }

// Модификатор
.hero-block--mobile { }
.hero-title--large { }

// Состояние
.hero-block.is-active { }
```

### PHP

- **Функции**: `gts_theme_*` (префикс темы)
- **Классы**: `GTS_*` (PascalCase)
- **Константы**: `GTS_*` (UPPER_SNAKE_CASE)
- **Хуки**: `gts_*` (snake_case с префиксом)

### JavaScript

- **Файлы**: `kebab-case.js` (например: `datetime-placeholder.js`)
- **Функции**: `camelCase`
- **Константы**: `UPPER_SNAKE_CASE`

### Файлы шаблонов

- **Блоки**: `kebab-case.php` (например: `hero-limousine-service.php`)
- **Страницы**: `page-{slug}.php` (например: `page-limousine-service.php`)

---

## ➕ Как добавлять блоки

### 1. Создание нового блока

#### Шаг 1: Создай PHP шаблон

```php
// template-parts/blocks/my-new-block.php
<?php
/**
 * My New Block Template
 *
 * @package GTS
 */
?>

<section class="my-new-block">
    <div class="my-new-block-container">
        <h2 class="section-title">Заголовок</h2>
        <p class="section-description">Описание</p>
        <a href="#" class="btn btn-primary">Кнопка</a>
    </div>
</section>
```

#### Шаг 2: Создай SCSS файл

```scss
// sass/blocks/_my-new-block.scss
.my-new-block {
    padding: 80px 0;
    background: #fff;
}

.my-new-block-container {
    max-width: 1480px;
    margin: 0 auto;
    padding: 0 40px;
}
```

#### Шаг 3: Импортируй в style.scss

```scss
// sass/style.scss
@import "blocks/my-new-block";
```

#### Шаг 4: Используй в шаблоне страницы

```php
// front-page.php или page.php
<?php get_template_part('template-parts/blocks/my-new-block'); ?>
```

### 2. Использование компонентов в блоке

```scss
// ✅ ПРАВИЛЬНО
.my-new-block-title {
    @extend .section-title;
    @extend .section-title--center;
}

.my-new-block-button {
    @extend .btn;
    @extend .btn-primary;
}

// ❌ НЕПРАВИЛЬНО - не дублируй стили
.my-new-block-button {
    padding: 0 24px;
    height: 56px;
    // ...
}
```

---

## 🎯 Паттерны и практики

### 1. Переиспользование компонентов

**Всегда** используй существующие компоненты вместо создания новых:

```scss
// ✅ Используй компоненты
.my-block-title {
    @extend .section-title;
}

// ❌ Не создавай дубликаты
.my-block-title {
    font-size: 40px;
    font-weight: 500;
    // ... дублирование
}
```

### 2. Responsive дизайн

Используй миксины для брейкпоинтов:

```scss
.my-block {
    padding: 40px 20px;

    @include lg {  // 1024px+
        padding: 80px 40px;
    }

    @include md {  // 768px+
        padding: 60px 30px;
    }
}
```

### 3. WordPress функции

**Всегда** используй WordPress функции для безопасности:

```php
// ✅ ПРАВИЛЬНО
<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($alt); ?>">
<a href="<?php echo esc_url($link); ?>">Link</a>
<?php echo esc_html($text); ?>

// ❌ НЕПРАВИЛЬНО
<img src="<?php echo $image_url; ?>">
```

### 4. Enqueue скриптов и стилей

```php
// functions.php
function gts_theme_scripts() {
    $version = time(); // Development

    wp_enqueue_style('gts-theme-style', get_stylesheet_uri(), array(), $version);
    wp_enqueue_script('gts-my-script', get_template_directory_uri() . '/js/my-script.js', array(), $version, true);
}
add_action('wp_enqueue_scripts', 'gts_theme_scripts');
```

### 5. Условная загрузка

```php
// Загружать только на главной странице
if (is_front_page()) {
    wp_enqueue_script('gts-front-page-only', ...);
}

// Загружать только на определенной странице
if (is_page_template('page-limousine-service.php')) {
    // специфичный код
}
```

---

## ❌ Что НЕ делать

### 1. НЕ дублируй стили компонентов

```scss
// ❌ ПЛОХО
.my-button {
    padding: 0 24px;
    height: 56px;
    border-radius: 50px;
    // ... дублирование .btn стилей
}

// ✅ ХОРОШО
.my-button {
    @extend .btn;
    @extend .btn-primary;
}
```

### 2. НЕ используй inline стили

```php
// ❌ ПЛОХО
<div style="color: red; padding: 20px;">

// ✅ ХОРОШО
<div class="my-block">
```

### 3. НЕ забывай про безопасность

```php
// ❌ ПЛОХО
echo $user_input;
echo '<img src="' . $url . '">';

// ✅ ХОРОШО
echo esc_html($user_input);
echo '<img src="' . esc_url($url) . '">';
```

### 4. НЕ создавай новые компоненты без необходимости

Перед созданием нового компонента проверь:
- Есть ли похожий компонент?
- Можно ли использовать существующий с модификатором?
- Действительно ли это переиспользуемый элемент?

### 5. НЕ коммить скомпилированные файлы без компиляции

```bash
# ❌ ПЛОХО: Коммит без компиляции
git commit -m "Update styles"

# ✅ ХОРОШО: Компиляция перед коммитом
npm run compile:css
git add style.css style.css.map
git commit -m "Update styles"
```

### 6. НЕ используй !important без крайней необходимости

```scss
// ❌ ПЛОХО
.my-element {
    color: red !important;
}

// ✅ ХОРОШО
.my-element {
    color: red;
}

// Если действительно нужно переопределить:
.page-template-page-limousine-service .my-element {
    color: red; // более специфичный селектор
}
```

---

## 📚 Полезные ссылки

- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [WordPress Template Hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)
- [BEM Methodology](https://en.bem.info/methodology/)
- [Sass Documentation](https://sass-lang.com/documentation)

---

## 🔍 Быстрый поиск

### Где найти стили компонентов?
→ `sass/components/`

### Где найти стили блоков?
→ `sass/blocks/`

### Где найти PHP шаблоны блоков?
→ `template-parts/blocks/`

### Где найти JavaScript файлы?
→ `js/`

### Где найти функции темы?
→ `functions.php` и `inc/`

---

## 💡 Советы для работы с ИИ

При запросах к ИИ используй:

- "Ориентируйся на PROJECT.md и структуру проекта"
- "Используй существующие компоненты из `_buttons.scss` и `_typography.scss`"
- "Не перечитывай весь проект, работай только с файлом X"
- "Следуй naming conventions из PROJECT.md"
- "Используй паттерны из раздела 'Паттерны и практики'"

---

**Последнее обновление**: 2026-01-15
