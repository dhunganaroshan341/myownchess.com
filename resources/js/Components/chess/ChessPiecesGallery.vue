<script setup>
import { ref } from 'vue';
import ChessPiece from './ChessPiece.vue';

const pieceStyle = ref('svg');

const pieces = [
    { code: 'wK', name: 'White King', symbol: '♔' },
    { code: 'wQ', name: 'White Queen', symbol: '♕' },
    { code: 'wR', name: 'White Rook', symbol: '♖' },
    { code: 'wB', name: 'White Bishop', symbol: '♗' },
    { code: 'wN', name: 'White Knight', symbol: '♘' },
    { code: 'wP', name: 'White Pawn', symbol: '♙' },
    { code: 'bK', name: 'Black King', symbol: '♚' },
    { code: 'bQ', name: 'Black Queen', symbol: '♛' },
    { code: 'bR', name: 'Black Rook', symbol: '♜' },
    { code: 'bB', name: 'Black Bishop', symbol: '♝' },
    { code: 'bN', name: 'Black Knight', symbol: '♞' },
    { code: 'bP', name: 'Black Pawn', symbol: '♟︎' },
];

const pieceInfo = {
    K: 'The King is the most important piece. It can move one square in any direction. The game ends when the king is checkmated.',
    Q: 'The Queen is the most powerful piece. It can move any number of squares horizontally, vertically, or diagonally.',
    R: 'The Rook can move any number of squares horizontally or vertically. It is particularly powerful on open files.',
    B: 'The Bishop can move any number of squares diagonally. Each bishop stays on its original color throughout the game.',
    N: 'The Knight moves in an L-shape: two squares in one direction and one square perpendicular, or vice versa.',
    P: 'The Pawn moves forward one square (or two on its first move). It captures diagonally. It can promote to a stronger piece.',
};

function toggleStyle() {
    pieceStyle.value = pieceStyle.value === 'svg' ? 'unicode' : 'svg';
}
</script>

<template>
    <div class="chess-gallery">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white">♟ Chess Pieces Gallery ♚</h1>
            <p class="mt-2 text-slate-300">
                Explore beautiful renderings of chess pieces in both SVG and Unicode styles
            </p>
        </div>

        <!-- Style Toggle -->
        <div class="mb-8 flex items-center justify-between rounded-lg border border-slate-600 bg-slate-800 p-4">
            <p class="font-medium text-white">Current Style: <span class="text-amber-400">{{ pieceStyle.toUpperCase() }}</span></p>
            <button
                @click="toggleStyle"
                class="rounded-lg bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-2 font-bold text-white hover:from-amber-600 hover:to-amber-700"
            >
                🎨 Switch to {{ pieceStyle === 'svg' ? 'Unicode' : 'SVG' }}
            </button>
        </div>

        <!-- Pieces Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <div
                v-for="piece in pieces"
                :key="piece.code"
                class="rounded-lg border border-slate-600 bg-gradient-to-br from-slate-800 to-slate-900 p-6 shadow-lg transition hover:border-amber-400 hover:shadow-xl hover:shadow-amber-500/20"
            >
                <!-- Piece Display -->
                <div class="mb-4 flex items-center justify-center rounded-lg bg-slate-950/50 py-8">
                    <div class="inline-flex items-center justify-center">
                        <ChessPiece
                            :piece="piece.code"
                            :style="pieceStyle"
                            size="80"
                            :animate="true"
                        />
                    </div>
                </div>

                <!-- Piece Info -->
                <h2 class="text-lg font-bold text-white">{{ piece.name }}</h2>
                <p class="mt-1 text-sm text-slate-400">{{ piece.code }} • {{ piece.symbol }}</p>
                <p class="mt-3 text-sm leading-relaxed text-slate-300">
                    {{ pieceInfo[piece.code[1]] }}
                </p>

                <!-- Piece Stats -->
                <div class="mt-4 grid grid-cols-2 gap-3 rounded-lg bg-slate-800 p-3 text-center text-xs">
                    <div>
                        <p class="text-slate-400">Type</p>
                        <p class="font-semibold text-white">{{ piece.code[1] }}</p>
                    </div>
                    <div>
                        <p class="text-slate-400">Color</p>
                        <p class="font-semibold" :class="piece.code[0] === 'w' ? 'text-slate-50' : 'text-slate-950'">
                            {{ piece.code[0] === 'w' ? 'Light' : 'Dark' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Legend -->
        <div class="mt-12 rounded-lg border border-slate-600 bg-slate-800 p-6">
            <h2 class="mb-4 text-xl font-bold text-white">Notation Guide</h2>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="piece in pieces" :key="`legend-${piece.code}`" class="flex items-center gap-3">
                    <span class="text-sm font-mono font-bold text-amber-400">{{ piece.code }}</span>
                    <span class="text-sm text-slate-300">= {{ piece.name }}</span>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg border border-slate-600 bg-slate-800 p-4">
                <p class="text-2xl">🎨</p>
                <p class="mt-2 font-semibold text-white">Beautiful SVG Rendering</p>
                <p class="mt-1 text-sm text-slate-400">High-quality, scalable vector graphics with shadow effects</p>
            </div>
            <div class="rounded-lg border border-slate-600 bg-slate-800 p-4">
                <p class="text-2xl">⌨️</p>
                <p class="mt-2 font-semibold text-white">Unicode Support</p>
                <p class="mt-1 text-sm text-slate-400">Classic Unicode chess symbols as an alternative style</p>
            </div>
            <div class="rounded-lg border border-slate-600 bg-slate-800 p-4">
                <p class="text-2xl">✨</p>
                <p class="mt-2 font-semibold text-white">Smooth Animations</p>
                <p class="mt-1 text-sm text-slate-400">Floating and pulsing animations for visual appeal</p>
            </div>
            <div class="rounded-lg border border-slate-600 bg-slate-800 p-4">
                <p class="text-2xl">📱</p>
                <p class="mt-2 font-semibold text-white">Fully Responsive</p>
                <p class="mt-1 text-sm text-slate-400">Works perfectly on all screen sizes and devices</p>
            </div>
            <div class="rounded-lg border border-slate-600 bg-slate-800 p-4">
                <p class="text-2xl">🎯</p>
                <p class="mt-2 font-semibold text-white">Interactive UI</p>
                <p class="mt-1 text-sm text-slate-400">Hover effects and smooth transitions throughout</p>
            </div>
            <div class="rounded-lg border border-slate-600 bg-slate-800 p-4">
                <p class="text-2xl">♔</p>
                <p class="mt-2 font-semibold text-white">Chess Ready</p>
                <p class="mt-1 text-sm text-slate-400">Built on chess.js for accurate game logic</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.chess-gallery {
    display: flex;
    flex-direction: column;
}
</style>
