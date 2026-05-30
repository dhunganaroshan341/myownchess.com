<script setup>
import ChessPiece from '@/Components/chess/ChessPiece.vue';

const props = defineProps({
    file: {
        type: String,
        required: true,
    },
    row: {
        type: Number,
        required: true,
    },
    piece: {
        type: String,
        default: '',
    },
    isLight: {
        type: Boolean,
        default: false,
    },
    selected: {
        type: Boolean,
        default: false,
    },
    legal: {
        type: Boolean,
        default: false,
    },
    coordinates: {
        type: Object,
        required: true,
    },
});

const emits = defineEmits(['squareClick']);

function handleClick() {
    emits('squareClick', props.coordinates);
}
</script>

<template>
    <button
        type="button"
        @click="handleClick"
        class="relative aspect-square w-full overflow-hidden rounded-3xl border border-slate-800 transition duration-200 hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-amber-300/80"
        :class="[
            isLight ? 'chess-square-light text-slate-900' : 'chess-square-dark text-slate-950',
            selected ? 'ring-4 ring-amber-300/80' : '',
            legal ? 'ring-4 ring-cyan-400/80' : '',
        ]"
    >
        <div class="relative flex h-full w-full items-center justify-center">
            <ChessPiece v-if="piece" :piece="piece" />
        </div>

        <span v-if="legal" class="absolute inset-x-3 bottom-3 flex justify-center">
            <span class="h-2.5 w-2.5 rounded-full bg-cyan-400/90 shadow-[0_0_0_8px_rgba(34,211,238,0.08)]"></span>
        </span>
    </button>
</template>
