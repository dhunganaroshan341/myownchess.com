<script setup>
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import ChessPuzzleBoard from '@/Components/chess/ChessPuzzleBoard.vue';

const pieceStyle = ref('svg'); // 'svg' or 'unicode'

const samplePuzzle = ref({
    id: 1,
    title: 'Back Rank Mate',
    description: 'White to move and deliver checkmate in 2 moves. The black king is trapped on the back rank.',
    rating: 1600,
    starting_fen: '6k1/5ppp/8/8/8/8/5RKP w - - 0 1',
    solution: ['Rf8#'],
    themes: ['Checkmate', 'Back Rank', 'Rook'],
});

function togglePieceStyle() {
    pieceStyle.value = pieceStyle.value === 'svg' ? 'unicode' : 'svg';
}

function handlePuzzleSolved(data) {
    console.log('Puzzle solved!', data);
}
</script>

<template>
    <Head title="Chess Puzzle" />
    
    <div class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 px-4 py-8 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl">
            <!-- Header -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white">♚ Chess Puzzles ♔</h1>
                    <p class="mt-2 text-slate-300">Master tactical patterns and improve your chess skills</p>
                </div>
                <div class="flex gap-2">
                    <button
                        @click="togglePieceStyle"
                        class="rounded-lg border border-slate-600 bg-slate-700 px-4 py-2 font-medium text-white hover:bg-slate-600"
                        :title="`Current style: ${pieceStyle}`"
                    >
                        {{ pieceStyle === 'svg' ? '🔤 Unicode' : '🎨 SVG' }}
                    </button>
                </div>
            </div>

            <!-- Puzzle Board -->
            <ChessPuzzleBoard 
                :puzzle="samplePuzzle"
                :pieceStyle="pieceStyle"
                @solved="handlePuzzleSolved"
            />

            <!-- Puzzle Info -->
            <div class="mt-8 rounded-lg border border-slate-600 bg-slate-800 p-6">
                <h2 class="text-lg font-bold text-white">Puzzle Themes</h2>
                <div class="mt-3 flex flex-wrap gap-2">
                    <span
                        v-for="theme in samplePuzzle.themes"
                        :key="theme"
                        class="rounded-lg bg-slate-700 px-3 py-1 text-sm font-medium text-slate-200"
                    >
                        {{ theme }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
