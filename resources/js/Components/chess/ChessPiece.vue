<script setup>
import { computed } from 'vue';
import ChessPieceSvg from './ChessPieceSvg.vue';

const props = defineProps({
    piece: {
        type: String,
        required: true,
    },
    style: {
        type: String,
        default: 'svg', // 'svg' or 'unicode'
    },
    size: {
        type: Number,
        default: 64,
    },
    animate: {
        type: Boolean,
        default: true,
    },
});

const pieceSymbols = {
    wK: '♔',
    wQ: '♕',
    wR: '♖',
    wB: '♗',
    wN: '♘',
    wP: '♙',
    bK: '♚',
    bQ: '♛',
    bR: '♜',
    bB: '♝',
    bN: '♞',
    bP: '♟︎',
};

const symbol = computed(() => pieceSymbols[props.piece] || '');
const isBlack = computed(() => props.piece.startsWith('b'));
const useSvg = computed(() => props.style === 'svg');

const symbolSize = computed(() => {
    const baseFontSize = props.size * 0.9;
    return `${baseFontSize}px`;
});
</script>

<template>
    <!-- SVG Style Chess Piece -->
    <ChessPieceSvg
        v-if="useSvg"
        :piece="piece"
        :size="size"
        :animate="animate"
    />

    <!-- Unicode Style Chess Piece -->
    <span
        v-else
        :class="['chess-piece-symbol', isBlack ? 'text-slate-950' : 'text-slate-100', animate && 'animate-bounce']"
        :style="{ fontSize: symbolSize }"
    >
        {{ symbol }}
    </span>
</template>

<style scoped>
.chess-piece-symbol {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 900;
    line-height: 1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    user-select: none;
    filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.15));
}

@keyframes piecePulse {
    0%, 100% {
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }
    50% {
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
    }
}

.chess-piece-symbol.animate-bounce {
    animation: piecePulse 2s ease-in-out infinite;
}
</style>

