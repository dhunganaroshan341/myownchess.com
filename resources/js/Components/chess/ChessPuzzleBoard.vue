<script setup>
import { ref } from 'vue';
import ChessGame from './ChessGame.vue';

const props = defineProps({
    puzzle: {
        type: Object,
        required: true,
        default: () => ({
            title: 'Puzzle',
            description: 'Solve this puzzle',
            rating: 1200,
            starting_fen: 'rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1',
            solution: [],
        }),
    },
    pieceStyle: {
        type: String,
        default: 'svg',
    },
});

const emits = defineEmits(['solved', 'hint', 'reset']);

const gameRef = ref(null);
const isSolved = ref(false);
const attemptsCount = ref(0);
const showHint = ref(false);

function handlePuzzleMove(move) {
    attemptsCount.value++;
}

function handleCheckmate() {
    isSolved.value = true;
    emits('solved', {
        attempts: attemptsCount.value,
        moves: gameRef.value?.getPgn(),
    });
}

function resetPuzzle() {
    gameRef.value?.resetGame();
    isSolved.value = false;
    attemptsCount.value = 0;
    showHint.value = false;
    emits('reset');
}

function toggleHint() {
    showHint.value = !showHint.value;
}
</script>

<template>
    <div class="chess-puzzle-board">
        <!-- Puzzle Info Header -->
        <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-gradient-to-br from-blue-50 to-blue-100 p-4">
                <p class="text-sm text-slate-600">Puzzle Rating</p>
                <p class="mt-1 text-2xl font-bold text-slate-900">{{ puzzle.rating }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-gradient-to-br from-purple-50 to-purple-100 p-4">
                <p class="text-sm text-slate-600">Attempts</p>
                <p class="mt-1 text-2xl font-bold text-slate-900">{{ attemptsCount }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-gradient-to-br from-green-50 to-green-100 p-4">
                <p class="text-sm text-slate-600">Status</p>
                <p class="mt-1 text-2xl font-bold" :class="isSolved ? 'text-green-600' : 'text-slate-900'">
                    {{ isSolved ? '✓ Solved!' : 'In Progress' }}
                </p>
            </div>
        </div>

        <!-- Puzzle Title and Description -->
        <div class="mb-6 rounded-lg border border-slate-300 bg-slate-50 p-6">
            <h1 class="text-2xl font-bold text-slate-900">{{ puzzle.title }}</h1>
            <p class="mt-2 text-slate-700">{{ puzzle.description }}</p>
        </div>

        <!-- Chess Game Board -->
        <div class="mb-6 rounded-lg border border-slate-300 bg-white p-6 shadow-sm">
            <ChessGame
                ref="gameRef"
                :initialFen="puzzle.starting_fen"
                :pieceStyle="pieceStyle"
                :enabled="!isSolved"
                @move="handlePuzzleMove"
                @checkmate="handleCheckmate"
            />
        </div>

        <!-- Puzzle Actions -->
        <div class="flex flex-wrap gap-3">
            <button
                @click="toggleHint"
                class="rounded-lg border border-slate-300 bg-amber-50 px-4 py-2 font-medium text-amber-900 hover:bg-amber-100"
            >
                💡 {{ showHint ? 'Hide' : 'Show' }} Hint
            </button>
            <button
                @click="resetPuzzle"
                class="rounded-lg border border-slate-300 bg-slate-200 px-4 py-2 font-medium text-slate-900 hover:bg-slate-300"
            >
                ↻ Reset Puzzle
            </button>
            <button
                v-if="isSolved"
                class="ml-auto rounded-lg bg-gradient-to-r from-green-500 to-green-600 px-6 py-2 font-bold text-white hover:from-green-600 hover:to-green-700"
            >
                ✓ Next Puzzle →
            </button>
        </div>

        <!-- Hint Display -->
        <transition name="slide">
            <div v-if="showHint" class="mt-6 rounded-lg border border-amber-300 bg-amber-50 p-4">
                <p class="font-medium text-amber-900">💡 Hint:</p>
                <p class="mt-2 text-amber-800">
                    {{ puzzle.solution && puzzle.solution[0] ? `Start with: ${puzzle.solution[0]}` : 'Think about the key pieces and their positions.' }}
                </p>
            </div>
        </transition>
    </div>
</template>

<style scoped>
.chess-puzzle-board {
    width: 100%;
}

.slide-enter-active,
.slide-leave-active {
    transition: all 0.3s ease;
}

.slide-enter-from,
.slide-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>
