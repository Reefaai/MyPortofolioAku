# AGENTS.md — Portfolio Website (Laravel 12 + Tailwind CSS 4)

## Tech Stack
- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates + Tailwind CSS 4 + Vite
- **Database**: SQLite (dev), MySQL-compatible (prod)
- **CI**: GitHub Actions (`.github/workflows/ci.yml`) — runs `php artisan test`

## Setup Commands
```bash
# Full setup (installs deps, copies .env, keys, migrate, builds assets)
composer setup

# Dev server (runs php artisan serve, queue, logs, and vite hot reload concurrently)
composer dev

# Test (clears config cache first, then runs PHPUnit)
composer test
# Or: php artisan test

# Build assets
npm run build
```

## Architecture
- **Content lives in `config/portfolio.php`** — owner info, projects, certificates, skills, social links. Controller (`PortfolioController`) reads from this config and passes to Blade views. **Do not hardcode portfolio data in views or controllers.**
- **Routes** (`routes/web.php`): `/`, `/about`, `/projects`, `/certificates` — all handled by `PortfolioController`
- **`resources/js/app.js`** — theme toggle (dark/light), hamburger menu, scroll observer
- **`resources/css/app.css`** — Tailwind 4 with custom design tokens

## Tailwind CSS 4 Notes
- Uses `@tailwindcss/vite` plugin (`vite.config.js`), NOT PostCSS
- CSS file uses `@import "tailwindcss"` (not `@tailwind base/components/utilities`)
- Vite ignores `storage/framework/views/` (`vite.config.js:15`)

## Design System
- See `DESIGN.md` for full details (339 lines)
- Key colors: Canvas Black `#131313`, Jelly Mint `#3cffd0`, Verge Ultraviolet `#5200ff`
- Fonts: Anton (display), Space Grotesk (body), Space Mono (labels) — substitutes for proprietary Manuka/PolySans/PolySans Mono
- All interactive elements use pill radius (20–40px), 1px hairline borders for elevation (no shadows)

## Static Export & Deployment
- **Vercel**: Export static HTML via `php artisan static:export` → `vercel --prod`. See `DEPLOY-VERCEL.md`
- Karena semua data dari `config/portfolio.php`, bisa di-export sebagai static site — gak perlu database/server

## Key Files
- `config/portfolio.php` — all portfolio content
- `app/Http/Controllers/PortfolioController.php` — 4 page methods
- `resources/views/pages/` — home, about, projects, certificates
- `resources/views/layouts/app.blade.php` — main layout with navbar/footer
- `tests/Feature/PageResponseTest.php` — all 4 pages tested for 200, heading, nav, semantic HTML, meta viewport, unique titles
- `app/Console/Commands/ExportStatic.php` — export static HTML ke folder `static/`
- `vercel.json` — konfigurasi Vercel (output: `static/`)
- `AppServiceProvider.php` — force HTTPS in production (boot method)