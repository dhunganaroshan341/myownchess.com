# ♚ Chess Puzzle Platform ♔

A modern, interactive chess puzzle platform built with **Laravel**, **Vue 3**, **Inertia.js**, and **Tailwind CSS**. Master tactical patterns, improve your chess skills, and enjoy beautifully designed chess pieces with support for both SVG and Unicode rendering.

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat-square&logo=laravel)
![Vue](https://img.shields.io/badge/Vue-3-4FC08D?style=flat-square&logo=vue.js)
![Inertia](https://img.shields.io/badge/Inertia-2.0-9F7AEA?style=flat-square)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3-06B6D4?style=flat-square&logo=tailwindcss)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

## 🎯 Features

### Chess Puzzle System
- ✅ Beautiful, interactive chess board with smooth drag-and-drop support
- ✅ Intelligent move validation using [chess.js](https://github.com/jhlywa/chess.js)
- ✅ Real-time legal move highlighting
- ✅ Move history tracking with PGN notation
- ✅ Undo/Reset functionality
- ✅ Puzzle ratings and difficulty levels

### Chess Pieces
- 🎨 **Professional SVG Rendering** - High-quality, scalable vector graphics with shadow effects
- ⌨️ **Unicode Support** - Classic Unicode chess symbols as alternative style
- ✨ **Smooth Animations** - Floating and pulsing animations for visual appeal
- 📱 **Fully Responsive** - Works perfectly on all screen sizes
- 🎯 **Interactive UI** - Hover effects and smooth transitions

### Game Features
- 🏆 Puzzle-based learning system
- 📊 Rating system for puzzles (1000-2800+ strength)
- 🎨 Theme-based puzzle categorization (Checkmate, Tactics, Openings, etc.)
- 📱 Mobile-friendly responsive design
- 🌙 Dark mode support
- ▶️ Move navigation and replay

## 📋 Tech Stack

### Backend
- **Framework**: Laravel 11
- **Database**: SQLite (dev) / MySQL (production-ready)
- **ORM**: Eloquent
- **Authentication**: Laravel Sanctum/Breeze
- **Cache**: Laravel Cache with Redis support

### Frontend
- **Framework**: Vue 3 (Composition API)
- **Router**: Inertia.js
- **Styling**: Tailwind CSS
- **Chess Engine**: chess.js
- **Build Tool**: Vite

### Database
- Users with ratings (rapid, blitz, bullet, puzzle)
- Games with full move history
- Puzzles with FEN positions and solutions
- Puzzle attempts tracking
- Themes/Tags system

## 🚀 Installation

### Prerequisites
- PHP 8.2+
- Node.js 18+
- Composer
- npm or yarn

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/chess-puzzle.git
   cd chess-puzzle
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Setup database**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build frontend assets**
   ```bash
   npm run build
   # or for development with hot reload:
   npm run dev
   ```

7. **Start the application**
   ```bash
   php artisan serve
   ```

Access the application at `http://localhost:8000`

## 📖 Usage

### Playing Chess Puzzles

1. Navigate to `/puzzle` to see the chess puzzle interface
2. The board displays an interactive chess position
3. Click on a piece to select it (piece highlights in amber)
4. Legal moves are highlighted with cyan dots
5. Click a highlighted square to make a move
6. Complete the puzzle to reach the solution

### Switching Piece Styles

Use the button in the header to switch between:
- **SVG Style**: Beautiful, scalable vector graphics
- **Unicode Style**: Classic chess symbols (♔ ♕ ♖ ♗ ♘ ♙)

### Viewing the Pieces Gallery

Visit the pieces gallery to see all 12 chess pieces with detailed information about their movement and capabilities.

## 📁 Project Structure

```
chess-puzzle/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # API Controllers
│   │   ├── Middleware/         # HTTP Middleware
│   │   └── Requests/           # Form Requests
│   ├── Models/
│   │   ├── User.php            # User with rating fields
│   │   ├── Game.php            # Chess games
│   │   ├── Move.php            # Game moves
│   │   ├── Puzzle.php          # Puzzles
│   │   ├── PuzzleAttempt.php   # User attempts on puzzles
│   │   └── Theme.php           # Puzzle themes/tags
│   └── Providers/              # Service providers
│
├── database/
│   ├── migrations/             # Database migrations
│   │   ├── *_create_users_table.php
│   │   ├── *_create_games_table.php
│   │   ├── *_create_moves_table.php
│   │   ├── *_create_puzzles_table.php
│   │   ├── *_create_puzzle_attempts_table.php
│   │   ├── *_create_themes_table.php
│   │   └── *_create_puzzle_theme_table.php
│   ├── factories/              # Model factories
│   └── seeders/                # Database seeders
│
├── resources/
│   ├── css/
│   │   ├── app.css             # Main styles
│   │   └── chess.css           # Chess-specific styles
│   ├── js/
│   │   ├── app.js              # Application entry
│   │   ├── bootstrap.js        # Bootstrap configuration
│   │   ├── Components/
│   │   │   └── chess/
│   │   │       ├── ChessPiece.vue              # Main piece component (supports SVG/Unicode)
│   │   │       ├── ChessPieceSvg.vue           # SVG piece rendering
│   │   │       ├── ChessBoard.vue              # 8x8 board
│   │   │       ├── ChessSquare.vue             # Individual square
│   │   │       ├── ChessGame.vue               # Game controller (chess.js integration)
│   │   │       ├── ChessPuzzleBoard.vue        # Puzzle-specific UI
│   │   │       └── ChessPiecesGallery.vue      # All pieces showcase
│   │   └── Pages/
│   │       ├── ChessPuzzle.vue                 # Main puzzle page
│   │       ├── Dashboard.vue
│   │       ├── Welcome.vue
│   │       └── Profile/
│   └── views/
│       └── app.blade.php       # Root Blade template
│
├── routes/
│   ├── web.php                 # Web routes
│   ├── auth.php                # Authentication routes
│   └── console.php             # Console commands
│
├── tests/                      # Test files
│   ├── Feature/
│   └── Unit/
│
├── config/                     # Configuration files
├── bootstrap/                  # Application bootstrap
├── storage/                    # Application storage
├── public/                     # Public assets
├── vite.config.js              # Vite configuration
├── tailwind.config.js          # Tailwind configuration
├── postcss.config.js           # PostCSS configuration
├── phpunit.xml                 # PHPUnit configuration
└── package.json                # Node dependencies

```

## 🏗️ Database Schema

### Users Table
```
id (PK)
name, username, email
email_verified_at, password, remember_token
avatar, rapid_rating, blitz_rating, bullet_rating, puzzle_rating
last_seen_at
timestamps
```

### Games Table
```
id (PK)
white_player_id (FK), black_player_id (FK), winner_id (FK)
current_fen, status (enum), result, time_control
started_at, ended_at
timestamps
```

### Moves Table
```
id (PK)
game_id (FK), move_number, side (w/b)
uci_move, san_move
fen_before, fen_after, move_time_ms
timestamps
```

### Puzzles Table
```
id (PK)
title, slug (unique)
starting_fen, solution (JSON), rating
description, created_by (FK), is_active
timestamps
```

### PuzzleAttempts Table
```
id (PK)
user_id (FK), puzzle_id (FK)
success, moves_played (JSON), time_taken_ms
timestamps
```

### Themes Table
```
id (PK)
name, slug (unique)
timestamps
```

### Puzzle_Theme Table (Pivot)
```
puzzle_id (FK)
theme_id (FK)
```

## 🎛️ Chess Pieces Components

### ChessPiece.vue
Main component that renders either SVG or Unicode chess pieces.

**Props:**
- `piece` (String, required): Piece code (e.g., 'wK', 'bQ')
- `style` (String): 'svg' or 'unicode' (default: 'svg')
- `size` (Number): Piece size in pixels (default: 64)
- `animate` (Boolean): Enable animations (default: true)

**Example:**
```vue
<ChessPiece piece="wK" style="svg" size="80" :animate="true" />
```

### ChessGame.vue
Full chess game controller with move validation and history.

**Props:**
- `initialFen` (String): Starting FEN position
- `pieceStyle` (String): 'svg' or 'unicode'
- `enabled` (Boolean): Enable/disable play

**Emits:**
- `@move`: Emitted when a move is made
- `@checkmate`: Emitted on checkmate
- `@stalemate`: Emitted on stalemate
- `@threefold`: Emitted on threefold repetition
- `@insufficient`: Emitted on insufficient material

**Methods (ref):**
- `resetGame()`: Reset to initial position
- `undoMove()`: Undo last move
- `getFen()`: Get current FEN
- `getPgn()`: Get game PGN

### ChessPuzzleBoard.vue
Puzzle-specific UI with hints and solution tracking.

**Props:**
- `puzzle` (Object): Puzzle data
- `pieceStyle` (String): Piece rendering style

**Emits:**
- `@solved`: Emitted when puzzle is solved

### ChessPiecesGallery.vue
Showcase of all 12 chess pieces with descriptions and characteristics.

## 📍 Routes

### Web Routes

| Route | Method | Description |
|-------|--------|-------------|
| `/` | GET | Welcome page |
| `/puzzle` | GET | Chess puzzle interface |
| `/dashboard` | GET | User dashboard (auth required) |
| `/profile` | GET\|PATCH\|DELETE | User profile management |

### Authentication Routes (Breeze)
- `/login` - User login
- `/register` - User registration
- `/forgot-password` - Password reset
- `/reset-password/{token}` - Reset password form

## 🛠️ Development

### Running Development Server

```bash
# Terminal 1: PHP Development Server
php artisan serve

# Terminal 2: Vite Dev Server
npm run dev
```

### Building for Production

```bash
npm run build
php artisan optimize
```

### Running Tests

```bash
php artisan test
```

### Database Commands

```bash
# Fresh migration
php artisan migrate:fresh

# Rollback
php artisan migrate:rollback

# Create seeders
php artisan make:seeder PuzzleSeeder
```

### Creating New Components

```bash
# Create a new Vue component
# Place in: resources/js/Components/

# Example usage in a page:
import YourComponent from '@/Components/YourComponent.vue';
```

## 📚 Key Features Explained

### Chess Logic with chess.js
The application uses the versatile [chess.js](https://github.com/jhlywa/chess.js) library for:
- Move validation
- FEN position generation
- PGN notation
- Legal move detection
- Checkmate/Stalemate detection

### Piece Rendering Modes

**SVG Mode**
- Custom SVG rendering for each piece type
- Smooth drop shadows and gradients
- Fully scalable to any size
- Ideal for modern browsers

**Unicode Mode**
- Standard Unicode chess symbols
- Lightweight and fast-loading
- Classic chess aesthetic
- Works on all devices

### Dark Mode Support
The platform uses Tailwind CSS with full dark mode support. All components automatically adapt to the user's system preference.

## 🐛 Troubleshooting

### Port Already in Use
```bash
# Change the port
php artisan serve --port=8001
```

### Node Dependencies Issues
```bash
# Clear cache and reinstall
rm -rf node_modules package-lock.json
npm install
```

### Database Connection
```bash
# Verify .env file has correct DB settings
# For SQLite:
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database.sqlite
```

## 📦 Dependencies

### Key PHP Packages
- `laravel/framework` - Web framework
- `laravel/breeze` - Authentication scaffolding
- `laravel/tinker` - REPL for debugging

### Key JavaScript Packages
- `vue` - Progressive JavaScript framework
- `@inertiajs/vue3` - Server-side rendering adapter
- `tailwindcss` - Utility-first CSS
- `chess.js` - Chess logic engine
- `vite` - Frontend build tool
- `@vitejs/plugin-vue` - Vue 3 support

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 👨‍💻 Author

Created with ♟ by [Chess Platform Team]

---

**Happy Puzzling! 🎯♚**
