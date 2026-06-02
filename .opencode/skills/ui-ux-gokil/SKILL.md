---
name: ui-ux-gokil
description: A brief description, shown to the model to help it understand when to use this skill
---

Instructions for the skill go here. Provide relative paths to other resources in the skill directory as needed.

# 🎨 SKILL: PMW UI Architect
**Version 2.0 — Premium Enterprise UI System for Polsri PMW**

> Design and implement a clean, premium, interactive interface using CodeIgniter 4 + Tailwind CSS CLI + Alpine.js.

---

## 🎯 CORE PHILOSOPHY

**Three Laws of PMW UI:**
1. **Clean, not sterile.** Use whitespace strategically — every element earns its place.
2. **Animated, not distracting.** Motion guides the eye; it never steals focus.
3. **Data-first, always.** The UI serves the content, not the other way around.

---

## 🎨 DESIGN TOKENS

### Color Palette (Sky Blue × Bright Yellow)
```css
:root {
  /* PRIMARY — Sky Blue (Trust, Technology, Focus) */
  --color-primary:       #0EA5E9;  /* sky-500  — Default interactive */
  --color-primary-dark:  #0284C7;  /* sky-600  — Hover states        */
  --color-primary-light: #38BDF8;  /* sky-400  — Tints & glows       */
  --color-primary-glow:  rgba(14, 165, 233, 0.12);

  /* ACCENT — Bright Yellow (Energy, Action, Highlight) */
  --color-accent:        #FACC15;  /* yellow-400 — CTAs, badges       */
  --color-accent-dark:   #EAB308;  /* yellow-500 — Hover accent       */
  --color-accent-glow:   rgba(250, 204, 21, 0.15);

  /* SURFACE (Light Mode) */
  --surface-base:        #F0F9FF;  /* sky-50   — Page background      */
  --surface-card:        #FFFFFF;  /* White    — Card background      */
  --surface-border:      #E0F2FE;  /* sky-100  — Borders              */

  /* TEXT */
  --text-heading:        #0C1A2E;  /* Near-black, slight blue tint   */
  --text-body:           #334155;  /* slate-700                      */
  --text-muted:          #64748B;  /* slate-500                      */
  --text-placeholder:    #94A3B8;  /* slate-400                      */
}
```

### Typography
```
HEADING / DISPLAY : Outfit (700–900 weight, italic for emphasis)
BODY / UI         : Inter (400–600 weight)
MONO / DATA       : JetBrains Mono (tables, IDs, codes)
```

### Spacing Scale (Always use 4px base)
```
XS: 0.5rem  (8px)   — Icon gap, tight labels
SM: 1rem   (16px)   — Card inner padding
MD: 1.5rem (24px)   — Section gaps
LG: 2rem   (32px)   — Page padding
XL: 3rem   (48px)   — Major section breaks
```

### Border Radius System
```
Pill:    9999px  — Badges, chips, tags
Button:  0.75rem — Buttons, inputs
Card:    1rem    — Cards, panels
Panel:   1.25rem — Modals, dropdowns
Feature: 1.5rem  — Hero cards, bento items
```

---

## 📐 LAYOUT SYSTEM

### Page Structure
```
[SIDEBAR 288px] [MAIN AREA flex-1]
                  [HEADER 80px sticky glass]
                  [CONTENT scrollable padded]
                  [FOOTER subtle]
```

### Grid Patterns

**Bento Overview (Dashboard Stats):**
```
Desktop (lg): [ ████ WIDE CARD (col-2) ][ CARD ][ CARD ]
Tablet  (md): [ WIDE (col-2)           ][ COL  ][ COL  ]
Mobile  (sm): [ CARD ][ CARD ][ CARD   ]
```

**Data Table:** Full-width, no bento, clean rows, hover reveals action button.

**Form Layout:** 2-column grid for inputs, full-width for textarea, action buttons right-aligned.

---

## 🧩 COMPONENT LIBRARY

### 1. `.card-premium`
- White background, `1px` sky-100 border
- Soft shadow: `0 4px 6px -1px rgba(0,0,0,0.03)`
- On hover: lift `translateY(-4px)`, glow border `sky-300/50`
- Mouse-tracking radial glow via `--mouse-x / --mouse-y` CSS vars (requires JS snippet)

### 2. `.glass-header`
- `backdrop-filter: blur(16px)`, white/70 background
- Sticky, z-10, subtle bottom border

### 3. `.btn-primary`
- Background: `var(--color-primary)` → hover `var(--color-primary-dark)`
- Text: White, font-semibold
- Shadow: `0 4px 14px rgba(14,165,233,0.35)`
- Transition: 300ms smooth

### 4. `.btn-accent`
- Background: `var(--color-accent)` → hover `var(--color-accent-dark)`
- Text: `var(--text-heading)` (dark, for contrast on yellow)
- Use for: Primary CTAs, "Tambah", "Submit"

### 5. `.pmw-status-*`
```
success  → emerald bg/text
warning  → sky bg/text (in-review)
accent   → yellow bg/text (revision needed)
danger   → rose bg/text
```

### 6. `.sidebar-item`
- Default: `text-slate-500`, icon `text-slate-400`
- Active: `text-primary`, icon `text-primary`, left indicator bar
- Collapsed: icons only, centered, tooltip on hover
- Transition: 400ms, `cubic-bezier(0.25, 1, 0.5, 1)`

### 7. `.input-field` / `.input-group`
- Border: `sky-200`, focus ring `sky-400/25`
- Placeholder: `slate-400`
- Icon prefix supported via `.input-icon`

### 8. `.pmw-table`
- Full-width, collapse border
- Header: uppercase, letter-spacing, sky-50 bg
- Row hover: subtle sky tint
- Action button: `group-hover` reveal pattern

### 9. `.section-title` / `.section-subtitle`
- Display heading: Outfit 800, italic
- Subtitle: uppercase, tracking-widest

### 10. `.progress-bar` / `.progress-bar-fill`
- Height 6px, rounded-full
- Animated fill via `--progress-value` CSS var

---

## ⚡ ANIMATION SPEC

### Timing Functions (CSS Variables)
```css
--ease-smooth: cubic-bezier(0.25, 1, 0.5, 1);   /* Decelerate in */
--ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1); /* Spring pop    */
--ease-sharp:  cubic-bezier(0.4, 0, 0.2, 1);      /* Material      */
```

### Staggered Page Load
```css
/* Apply to section containers */
.animate-stagger { animation: slideUpFade 0.6s var(--ease-bounce) both; }
.delay-100 { animation-delay: 100ms; }
.delay-200 { animation-delay: 200ms; }
.delay-300 { animation-delay: 300ms; }
.delay-400 { animation-delay: 400ms; }
.delay-500 { animation-delay: 500ms; }
```

### Hover Glow (Vanilla JS — Required in layout)
```js
document.addEventListener('mousemove', (e) => {
  document.querySelectorAll('.card-premium').forEach(card => {
    const r = card.getBoundingClientRect();
    card.style.setProperty('--mouse-x', `${e.clientX - r.left}px`);
    card.style.setProperty('--mouse-y', `${e.clientY - r.top}px`);
  });
});
```

---

## 🛠️ TECH STACK (Verified)

| Layer         | Tool                        | Version | Purpose                          |
|---------------|-----------------------------|---------|----------------------------------|
| Framework     | CodeIgniter 4               | v4.7.2  | MVC, routing, Shield auth        |
| CSS Engine    | Tailwind CSS                | v4.2.2  | Utility-first CSS                |
| CSS CLI       | @tailwindcss/cli            | v4.2.2  | Build & watch                    |
| Custom CSS    | `input.css` → `app.css`     | —       | Design tokens & components       |
| JS Reactivity | Alpine.js                   | v3.x    | Sidebar, modals, state           |
| Icons         | Font Awesome 6              | CDN     | `fas fa-*` classes               |
| Fonts         | Google Fonts                | —       | Inter + Outfit                   |
| Auth          | CodeIgniter Shield          | —       | Role-based access (5 groups)     |

---

## 📋 CI4 VIEW CONVENTIONS

```php
// Layout inheritance
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?> ... <?= $this->endSection() ?>

// Section: styles (extra CSS)
<?= $this->section('styles') ?> ... <?= $this->endSection() ?>

// Section: scripts (extra JS)
<?= $this->section('scripts') ?> ... <?= $this->endSection() ?>

// Passing data to views
return view('dashboard/index', ['title' => 'Dashboard', 'stats' => $stats]);
```

---

## 🚫 ANTI-PATTERNS (Never Do)

1. ❌ Use `!important` to override Tailwind — extend config instead
2. ❌ Inline `style=""` for colors — use CSS variables
3. ❌ Nest `@apply` inside `@apply` — use direct CSS properties
4. ❌ Animate `width/height` directly — animate `transform` + `opacity`
5. ❌ Use `display: none` for sidebar text — use `opacity + overflow` for smooth transitions
6. ❌ Generic purple gradients on white — always use sky blue + yellow accent
7. ❌ Plain `font-size: 2rem` headings with no weight — use Outfit 700+ italic for display

---

## ✅ QUALITY CHECKLIST

Before finalizing any UI component, verify:
- [ ] Colors reference CSS variables, not hard-coded hex
- [ ] All interactive elements have `:hover`, `:focus`, `:active` states
- [ ] Animations use `transform` + `opacity` only (hardware-accelerated)
- [ ] Sidebar collapses to icon-only (centered) without JS errors
- [ ] Table rows have group-hover reveal for action buttons
- [ ] Mobile layout degrades gracefully (sidebar off-canvas on mobile)
- [ ] Font: Outfit for headings, Inter for body text
- [ ] Status badges use semantic color mapping