<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import ChessBoard from '@/Components/chess/ChessBoard.vue';
import ChessSidebar from '@/Components/chess/ChessSidebar.vue';

const files = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];

const initialBoard = [
    ['', '', '', '', 'bK', '', '', ''],
    ['', '', '', '', '', '', '', ''],
    ['', '', '', '', '', '', '', ''],
    ['', '', '', '', 'wK', '', '', ''],
    ['', '', '', '', 'wQ', '', '', ''],
    ['', '', '', '', '', '', '', ''],
    ['', '', '', '', '', '', '', ''],
    ['', '', '', '', '', '', '', ''],
];

const board = ref(JSON.parse(JSON.stringify(initialBoard)));
const selectedSquare = ref(null);
const legalMoves = ref([]);
const status = ref('White to move. Select the queen to start.');
const moveHistory = ref([]);
const puzzleTitle = ref('Checkmate Puzzle');
const puzzleDescription = ref('White to move. Use the queen and king to force black into checkmate.');
const sideToMove = ref('w');

function fileIndex(file) {
    return files.indexOf(file);
}

function getSquare(file, row) {
    const ix = fileIndex(file);
    if (ix === -1 || row < 1 || row > 8) {
        return '';
    }

    return board.value[8 - row][ix];
}

function setSquare(file, row, value) {
    const ix = fileIndex(file);
    if (ix === -1 || row < 1 || row > 8) {
        return;
    }

    board.value[8 - row][ix] = value;
}

function isAlly(piece, color) {
    return piece && piece.startsWith(color);
}

function isEnemy(piece, color) {
    return piece && piece[0] && piece[0] !== color;
}

function inBounds(fileIdx, row) {
    return fileIdx >= 0 && fileIdx < 8 && row >= 1 && row <= 8;
}

function buildCoords(fileIdx, row) {
    return { file: files[fileIdx], row };
}

function getLegalMoves(piece, from) {
    if (!piece) {
        return [];
    }

    const color = piece[0];
    const type = piece[1];
    const startFileIdx = fileIndex(from.file);
    const startRow = from.row;
    const moves = [];

    function addMove(fileIdx, row) {
        if (!inBounds(fileIdx, row)) {
            return false;
        }

        const target = getSquare(files[fileIdx], row);
        if (isAlly(target, color)) {
            return false;
        }

        moves.push({ file: files[fileIdx], row, capture: Boolean(target) });
        return Boolean(target);
    }

    if (type === 'N') {
        const offsets = [
            [1, 2], [2, 1], [2, -1], [1, -2],
            [-1, -2], [-2, -1], [-2, 1], [-1, 2],
        ];

        offsets.forEach(([dx, dy]) => addMove(startFileIdx + dx, startRow + dy));
    }

    if (type === 'K') {
        const offsets = [
            [1, 0], [1, 1], [0, 1], [-1, 1],
            [-1, 0], [-1, -1], [0, -1], [1, -1],
        ];

        offsets.forEach(([dx, dy]) => addMove(startFileIdx + dx, startRow + dy));
    }

    if (type === 'P') {
        const direction = color === 'w' ? 1 : -1;
        const forward = { fileIdx: startFileIdx, row: startRow + direction };
        if (inBounds(forward.fileIdx, forward.row) && !getSquare(files[forward.fileIdx], forward.row)) {
            moves.push(buildCoords(forward.fileIdx, forward.row));
        }

        [1, -1].forEach((dx) => {
            const fileIdx = startFileIdx + dx;
            const row = startRow + direction;
            if (inBounds(fileIdx, row)) {
                const target = getSquare(files[fileIdx], row);
                if (isEnemy(target, color)) {
                    moves.push(buildCoords(fileIdx, row));
                }
            }
        });
    }

    const slidingDirections = {
        Q: [
            [1, 0], [0, 1], [-1, 0], [0, -1],
            [1, 1], [-1, 1], [-1, -1], [1, -1],
        ],
        R: [[1, 0], [0, 1], [-1, 0], [0, -1]],
        B: [[1, 1], [-1, 1], [-1, -1], [1, -1]],
    };

    if (type in slidingDirections) {
        slidingDirections[type].forEach(([dx, dy]) => {
            let fileIdx = startFileIdx + dx;
            let row = startRow + dy;

            while (inBounds(fileIdx, row)) {
                const blocked = addMove(fileIdx, row);
                if (blocked) {
                    break;
                }
                fileIdx += dx;
                row += dy;
            }
        });
    }

    return moves;
}

function markSelectedSquare(coords) {
    selectedSquare.value = coords;
    const piece = getSquare(coords.file, coords.row);
    legalMoves.value = getLegalMoves(piece, coords);
    status.value = `${piece} selected at ${coords.file}${coords.row}. Choose a destination.`;
}

function clearSelection() {
    selectedSquare.value = null;
    legalMoves.value = [];
    status.value = 'White to move. Select the queen to start.';
}

function makeMove(from, to) {
    const movingPiece = getSquare(from.file, from.row);
    const destinationPiece = getSquare(to.file, to.row);

    setSquare(from.file, from.row, '');
    setSquare(to.file, to.row, movingPiece);

    moveHistory.value.push(`${movingPiece} ${from.file}${from.row} → ${to.file}${to.row}${destinationPiece ? ' x' : ''}`);
    selectedSquare.value = null;
    legalMoves.value = [];

    if (destinationPiece === 'bK') {
        status.value = 'Puzzle solved — black king captured!';
        return;
    }

    status.value = 'Move complete. Select your next piece.';
}

function handleSquareClick(coords) {
    const targetPiece = getSquare(coords.file, coords.row);

    if (selectedSquare.value) {
        const sameSquare = selectedSquare.value.file === coords.file && selectedSquare.value.row === coords.row;
        const targetIsOwn = isAlly(targetPiece, sideToMove.value);

        if (sameSquare) {
            clearSelection();
            return;
        }

        if (targetIsOwn) {
            markSelectedSquare(coords);
            return;
        }

        const moveAllowed = legalMoves.value.some((move) => move.file === coords.file && move.row === coords.row);
        if (moveAllowed) {
            makeMove(selectedSquare.value, coords);
            return;
        }
    }

    if (targetPiece && isAlly(targetPiece, sideToMove.value)) {
        markSelectedSquare(coords);
        return;
    }

    status.value = 'Select a white piece to continue.';
}

function resetPuzzle() {
    board.value = JSON.parse(JSON.stringify(initialBoard));
    selectedSquare.value = null;
    legalMoves.value = [];
    moveHistory.value = [];
    status.value = 'White to move. Select the queen to start.';
}
</script>

<template>
    <Head title="Chess Puzzle" />

    <div class="min-h-screen bg-slate-950 text-slate-100">
        <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <h1 class="text-4xl font-bold tracking-tight text-white">Chess Puzzle</h1>
                    <p class="mt-3 max-w-2xl text-slate-300">Build the chess board with Vue components and practice tactical moves.</p>
                </div>

                <div class="flex gap-3">
                    <Link href="/" class="rounded-lg bg-slate-800 px-4 py-2 text-sm text-slate-200 transition hover:bg-slate-700">Home</Link>
                    <button @click="resetPuzzle" class="rounded-lg bg-emerald-500 px-4 py-2 text-sm text-slate-950 transition hover:bg-emerald-400">Reset Puzzle</button>
                </div>
            </div>

            <div class="mt-10 grid gap-6 lg:grid-cols-[1.4fr_0.6fr]">
                <div class="rounded-3xl bg-slate-900/90 p-5 shadow-xl ring-1 ring-white/10">
                    <ChessBoard
                        :board="board"
                        :selectedSquare="selectedSquare"
                        :legalMoves="legalMoves"
                        @squareClick="handleSquareClick"
                    />
                </div>

                <div class="space-y-6">
                    <ChessSidebar
                        :title="puzzleTitle"
                        :description="puzzleDescription"
                        :status="status"
                        :moveHistory="moveHistory"
                        @resetPuzzle="resetPuzzle"
                    />
                </div>
            </div>
        </section>
    </div>
</template>
