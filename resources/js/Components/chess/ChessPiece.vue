<script setup>
const props = defineProps({
    piece: {
        type: String,
        required: true,
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

const symbol = pieceSymbols[props.piece] || '';
const isBlack = props.piece.startsWith('b');
</script>

<template>
    <span :class="['select-none', isBlack ? 'text-slate-900' : 'text-slate-100']">{{ symbol }}</span>
</template>
