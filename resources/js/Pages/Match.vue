<script setup>
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import ChessGame from '@/Components/chess/ChessGame.vue';

const pieceStyle = ref('svg');

function togglePieceStyle() {
    pieceStyle.value = pieceStyle.value === 'svg' ? 'unicode' : 'svg';
}

const startingFen = ref('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1');
</script>

<template>
    <Head title="Match" />

    <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl">
            <div class="mb-6 flex items-center justify-between">
                <h1 class="text-3xl font-bold text-white">Live Match</h1>
                <div class="flex gap-2">
                    <button @click="togglePieceStyle" class="rounded-lg border border-slate-600 bg-slate-700 px-3 py-1 text-sm text-white">{{ pieceStyle === 'svg' ? 'Unicode' : 'SVG' }}</button>
                </div>
            </div>

            <div class="rounded-lg bg-white/5 p-6">
                <ChessGame :initialFen="startingFen" :pieceStyle="pieceStyle" />
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
