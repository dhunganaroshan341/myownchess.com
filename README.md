# Chess Puzzle

Lightweight chess puzzle platform built with Laravel, Inertia, Vue 3 and Vite.

Features
- Interactive puzzle and match boards using `chess.js` and Vue components.
- SVG + Unicode piece rendering modes.
- Persistent puzzles, attempts, themes, and games via Laravel models and migrations.

Local development
1. Install PHP dependencies: `composer install`
2. Install JS dependencies: `npm install`
3. Run migrations: `php artisan migrate`
4. Start dev server: `npm run dev` and `php artisan serve` (if needed)

Routes of interest
- `/puzzle` - puzzle UI.
- `/match` - live board (Match page) showing starting position.

Notes
- Chess styles were inlined into `resources/css/app.css` to satisfy PostCSS ordering requirements.
- If Vite reports template parse errors, check recently added SVG components in `resources/js/Components/chess/`.

Planned work
- Add a Pieces Gallery and navigation link.
- Smoke-test puzzle and match pages in browser.
- Implement the following requested feature (see TODO.md).

---

Contributions
Feel free to open issues or PRs. See `composer.json` and `package.json` for dependencies.

License: MIT
