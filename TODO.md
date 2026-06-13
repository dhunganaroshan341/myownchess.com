TODO: Move-only-to-nonempty feature

Description
- Implement a gameplay/UX feature that restricts piece moves so a player may only move a chess piece to squares that are non-empty (i.e., only capture moves are allowed).

Rationale
- This is an experimental rule variant requested for a specific puzzle/mini-game mode where only capture moves are permitted.

Acceptance criteria
- A new game mode or toggle is available (e.g., `allowOnlyCaptureMoves`).
- When enabled, attempted moves that land on empty squares are rejected and not applied.
- Visual feedback: illegal move animation or tooltip explaining the restriction.
- Unit/component tests covering legal vs illegal moves under the mode.

High-level implementation steps
1. Add a game-mode flag from the server or local UI toggle (component state). Example prop: `onlyCaptures`.
2. In `resources/js/Components/chess/ChessGame.vue` or the move handler, intercept attempted moves.
   - Before applying a move, check the destination square: if empty and `onlyCaptures` is true, reject the move.
3. Show feedback to the user when a move is rejected.
4. Add a small UI toggle on `Match.vue` and `ChessPuzzle.vue` to enable the mode for testing.
5. Add Jest/Vitest tests to assert behavior.

Notes
- This feature intentionally changes standard chess rules; ensure it's opt-in and documented.
