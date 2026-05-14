# Portfolio Website — Ahmad Rifa'i

Personal portfolio website built with Laravel 12 for the Pemrograman Web Lanjut (PWL) course. Features a dark editorial design system inspired by The Verge, with dark/light mode toggle, scroll animations, and responsive layout.

## Preview

| Dark Mode | Light Mode |
|-----------|------------|
| Canvas Black (#131313) with acid-mint accents | Clean white with muted green accents |

## Features

- **4 Pages** — Home, About, Projects, Certificates
- **Dark/Light Mode** — Toggle with localStorage persistence and system preference detection
- **The Verge-Inspired Design** — Pill-shaped cards, mono-uppercase labels, hairline borders, color-block tiles
- **Scroll Animations** — Fade-in-up entrance, floating profile photo, tech marquee, hover interactions
- **Responsive** — Mobile-first with hamburger nav, adapts from 320px to 1300px+
- **GitHub Actions CI** — Automated PHPUnit tests on push to main
- **Accessibility** — Semantic HTML, proper heading hierarchy, alt text, ARIA labels

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 12 (PHP 8.2+) |
| Frontend | Blade Templates, Tailwind CSS 4 |
| Build | Vite 7 |
| Fonts | Anton, Space Grotesk, Space Mono (Google Fonts) |
| Database | SQLite |
| CI/CD | GitHub Actions |

## Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js 18+
- npm

### Installation

```bash
# Clone the repository
git clone https://github.com/Reefaai/MyPortofolioAku.git
cd MyPortofolioAku

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Create SQLite database
touch database/database.sqlite
php artisan migrate

# Build frontend assets
npm run build

# Start development server
php artisan serve
```

Visit `http://localhost:8000` in your browser.

### Development

```bash
# Run Vite dev server (hot reload)
npm run dev

# Run tests
php artisan test

# Build for production
npm run build
```

## Project Structure

```
├── app/
│   ├── Http/Controllers/     # PortfolioController
│   └── Models/               # Contact model
├── config/
│   └── portfolio.php         # Portfolio data (projects, certificates, skills)
├── resources/
│   ├── css/app.css           # Tailwind + design system tokens
│   ├── js/
│   │   ├── app.js            # Theme toggle, hamburger menu, scroll observer
│   │   └── theme-manager.js  # Dark/light mode logic
│   └── views/
│       ├── layouts/app.blade.php
│       ├── components/       # Navbar, Footer
│       └── pages/            # Home, About, Projects, Certificates
├── public/images/            # Profile photo, certificate images
├── tests/Feature/            # PHPUnit feature + property tests
└── .github/workflows/ci.yml  # GitHub Actions CI pipeline
```

## Customization

All portfolio content is configured in `config/portfolio.php`:

- **Owner info** — name, email, tagline, bio, photo, skills, education, social links
- **Projects** — title, description, technologies, repository URL
- **Certificates** — name, issuer, year, verification URL, image

## Design System

The visual design follows a custom system documented in `DESIGN.md`, inspired by The Verge's 2024 redesign:

- **Colors** — Canvas Black, Jelly Mint, Ultraviolet, Surface Slate
- **Typography** — Anton (display), Space Grotesk (body), Space Mono (labels)
- **Components** — Pill cards (20-40px radius), hairline borders, color-block tiles
- **Depth** — No box-shadows; elevation via 1px borders and saturated color fills
- **Motion** — Fade-in-up entrances, floating photo, marquee, hover scale/glow

## License

This project is licensed under the MIT License — see the [LICENSE](LICENSE) file for details.

## Author

**Ahmad Rifa'i**
- GitHub: [@Reefaai](https://github.com/Reefaai)
- Instagram: [@ahmd.reefai](https://www.instagram.com/ahmd.reefai)
- Facebook: [Ahmd.Reefai](https://www.facebook.com/Ahmd.Reefai)
