<script setup>
const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: true,
    },
    status: {
        type: String,
        required: true,
    },
    moveHistory: {
        type: Array,
        required: true,
    },
});

const emits = defineEmits(['resetPuzzle']);

function reset() {
    emits('resetPuzzle');
}
</script>

<template>
    <div class="space-y-6 rounded-3xl bg-white/10 p-6 text-slate-100 ring-1 ring-white/10 backdrop-blur-xl">
        <div class="space-y-4 rounded-3xl bg-slate-900/80 p-5 ring-1 ring-white/10">
            <h2 class="text-2xl font-semibold text-white">{{ title }}</h2>
            <p class="text-sm leading-6 text-slate-300">{{ description }}</p>
        </div>

        <div class="space-y-4 rounded-3xl bg-slate-900/80 p-5 ring-1 ring-white/10">
            <p class="text-sm uppercase tracking-[0.24em] text-cyan-300">Status</p>
            <p class="text-base leading-7 text-slate-100">{{ status }}</p>
        </div>

        <div class="space-y-4 rounded-3xl bg-slate-900/80 p-5 ring-1 ring-white/10">
            <div class="flex items-center justify-between gap-4">
                <h3 class="text-base font-semibold text-white">Move History</h3>
                <button @click="reset" class="rounded-full border border-slate-600 px-3 py-1 text-xs text-slate-100 transition hover:border-cyan-400 hover:text-cyan-300">Reset</button>
            </div>

            <ol class="space-y-2 text-sm text-slate-300">
                <li v-if="moveHistory.length === 0" class="text-slate-500">No moves yet.</li>
                <li v-for="(move, index) in moveHistory" :key="index" class="rounded-2xl bg-slate-950/80 px-3 py-2">{{ index + 1 }}. {{ move }}</li>
            </ol>
        </div>
    </div>
</template>
