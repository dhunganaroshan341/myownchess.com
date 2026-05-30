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
        class="relative aspect-square w-full overflow-hidden rounded-2xl border border-white/10 transition hover:brightness-110"
        :class="[
            isLight ? 'bg-slate-100/80 dark:bg-slate-700/70' : 'bg-slate-900/95 dark:bg-slate-800',
            selected ? 'ring-4 ring-emerald-400/80' : '',
            legal ? 'ring-4 ring-cyan-400/80' : '',
        ]"
    >
        <div class="absolute inset-0"></div>
        <div class="relative flex h-full w-full items-center justify-center text-2xl">
            <ChessPiece v-if="piece" :piece="piece" />
        </div>
    </button>
</template>
