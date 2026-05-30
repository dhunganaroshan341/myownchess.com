<script setup>
import { computed } from 'vue';
import ChessSquare from '@/Components/chess/ChessSquare.vue';

const props = defineProps({
    board: {
        type: Array,
        required: true,
    },
    selectedSquare: {
        type: Object,
        default: null,
    },
    legalMoves: {
        type: Array,
        required: true,
    },
});

const emits = defineEmits(['squareClick']);

const files = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];

const rows = computed(() => [8, 7, 6, 5, 4, 3, 2, 1]);

function fileIndex(file) {
    return files.indexOf(file);
}

function isLightSquare(file, row) {
    const fileIdx = fileIndex(file);
    return (fileIdx + row) % 2 === 0;
}

function isLegalSquare(file, row) {
    return props.legalMoves.some((move) => move.file === file && move.row === row);
}

function isSelectedSquare(file, row) {
    return props.selectedSquare && props.selectedSquare.file === file && props.selectedSquare.row === row;
}

function onSquareClick(file, row) {
    emits('squareClick', { file, row });
}
</script>

<template>
    <div class="space-y-2">
        <div class="grid grid-cols-8 gap-2 text-center text-xs uppercase text-slate-400">
            <div v-for="file in files" :key="file" class="py-1">{{ file }}</div>
        </div>

        <div class="space-y-2">
            <div v-for="row in rows" :key="row" class="grid grid-cols-8 gap-2">
                <ChessSquare
                    v-for="file in files"
                    :key="`${file}${row}`"
                    :file="file"
                    :row="row"
                    :piece="board[8 - row][files.indexOf(file)]"
                    :isLight="isLightSquare(file, row)"
                    :selected="isSelectedSquare(file, row)"
                    :legal="isLegalSquare(file, row)"
                    :coordinates="{ file, row }"
                    @squareClick="onSquareClick"
                />
            </div>
        </div>
    </div>
</template>
