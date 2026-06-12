<script setup>
import { ref, computed, onMounted } from 'vue';
import { Chess } from 'chess.js';
import ChessBoard from './ChessBoard.vue';
import ChessPiece from './ChessPiece.vue';

const props = defineProps({
    initialFen: {
        type: String,
        default: null,
    },
    pieceStyle: {
        type: String,
        default: 'svg', // 'svg' or 'unicode'
    },
    enabled: {
        type: Boolean,
        default: true,
    },
});

const emits = defineEmits(['move', 'checkmate', 'stalemate', 'threefold', 'insufficient']);

const chess = ref(null);
const selectedSquare = ref(null);
const legalMoves = ref([]);
const moveHistory = ref([]);
const gameStatus = ref('');
const currentFen = ref('');

onMounted(() => {
    initializeGame();
});

function initializeGame() {
    chess.value = new Chess(props.initialFen);
    currentFen.value = chess.value.fen();
    updateGameStatus();
}

function updateGameStatus() {
    if (chess.value.isCheckmate()) {
        gameStatus.value = chess.value.turn() === 'w' ? 'Black wins by checkmate' : 'White wins by checkmate';
        emits('checkmate');
    } else if (chess.value.isStalemate()) {
        gameStatus.value = 'Stalemate - Draw';
        emits('stalemate');
    } else if (chess.value.isThreefoldRepetition()) {
        gameStatus.value = 'Threefold repetition - Draw';
        emits('threefold');
    } else if (chess.value.isInsufficientMaterial()) {
        gameStatus.value = 'Insufficient material - Draw';
        emits('insufficient');
    } else if (chess.value.isCheck()) {
        gameStatus.value = `${chess.value.turn() === 'w' ? 'White' : 'Black'} is in check`;
    } else {
        gameStatus.value = `${chess.value.turn() === 'w' ? 'White' : 'Black'} to move`;
    }
}

function getLegalMovesForSquare(square) {
    if (!chess.value) return [];
    
    const moves = chess.value.moves({ square, verbose: true });
    return moves.map(move => ({
        file: move.to[0],
        row: parseInt(move.to[1]),
    }));
}

function handleSquareClick(coordinates) {
    if (!props.enabled || !chess.value) return;

    const square = `${coordinates.file}${coordinates.row}`;
    const piece = chess.value.get(square);

    // If clicking on a legal move destination
    if (selectedSquare.value) {
        const from = `${selectedSquare.value.file}${selectedSquare.value.row}`;
        const to = `${coordinates.file}${coordinates.row}`;

        try {
            const result = chess.value.move({ from, to, promotion: 'q' });
            
            if (result) {
                moveHistory.value.push(result);
                currentFen.value = chess.value.fen();
                selectedSquare.value = null;
                legalMoves.value = [];
                updateGameStatus();
                emits('move', result);
                return;
            }
        } catch (e) {
            // Invalid move
        }
    }

    // If clicking on own piece
    if (piece && piece.color === chess.value.turn()) {
        selectedSquare.value = coordinates;
        legalMoves.value = getLegalMovesForSquare(square);
    } else {
        selectedSquare.value = null;
        legalMoves.value = [];
    }
}

function getBoard() {
    if (!chess.value) return Array(8).fill(null).map(() => Array(8).fill(''));
    
    const board = [];
    for (let i = 0; i < 8; i++) {
        board[i] = [];
        for (let j = 0; j < 8; j++) {
            const file = String.fromCharCode(97 + j); // a-h
            const rank = 8 - i;
            const piece = chess.value.get(`${file}${rank}`);
            
            if (piece) {
                board[i][j] = `${piece.color === 'w' ? 'w' : 'b'}${piece.type.toUpperCase()}`;
            } else {
                board[i][j] = '';
            }
        }
    }
    return board;
}

function resetGame() {
    initializeGame();
    selectedSquare.value = null;
    legalMoves.value = [];
    moveHistory.value = [];
}

function undoMove() {
    if (chess.value && moveHistory.value.length > 0) {
        chess.value.undo();
        moveHistory.value.pop();
        currentFen.value = chess.value.fen();
        selectedSquare.value = null;
        legalMoves.value = [];
        updateGameStatus();
    }
}

function getFen() {
    return chess.value ? chess.value.fen() : '';
}

function getPgn() {
    return chess.value ? chess.value.pgn() : '';
}

// Expose methods for parent component
defineExpose({
    resetGame,
    undoMove,
    getFen,
    getPgn,
    getBoard,
});
</script>

<template>
    <div class="chess-game">
        <div class="mb-6 rounded-lg border border-slate-200 bg-gradient-to-br from-slate-50 to-slate-100 p-4">
            <h2 class="text-lg font-bold text-slate-900">{{ gameStatus }}</h2>
            <p class="mt-2 text-sm text-slate-600">FEN: <code class="text-xs">{{ currentFen }}</code></p>
        </div>

        <div class="mb-6">
            <ChessBoard
                :board="getBoard()"
                :selectedSquare="selectedSquare"
                :legalMoves="legalMoves"
                :pieceStyle="pieceStyle"
                @squareClick="handleSquareClick"
            />
        </div>

        <div class="flex gap-2">
            <button
                @click="undoMove"
                :disabled="moveHistory.length === 0"
                class="rounded-lg border border-slate-300 bg-white px-4 py-2 font-medium text-slate-700 hover:bg-slate-50 disabled:opacity-50"
            >
                ← Undo
            </button>
            <button
                @click="resetGame"
                class="rounded-lg bg-slate-700 px-4 py-2 font-medium text-white hover:bg-slate-800"
            >
                ↻ Reset
            </button>
        </div>

        <div v-if="moveHistory.length > 0" class="mt-6">
            <h3 class="mb-3 font-semibold text-slate-900">Move History:</h3>
            <div class="flex flex-wrap gap-2">
                <span
                    v-for="(move, index) in moveHistory" 
                    :key="index"
                    class="rounded-md bg-slate-200 px-3 py-1 text-sm font-medium text-slate-700"
                >
                    {{ index + 1 }}. {{ move.san }}
                </span>
            </div>
        </div>
    </div>
</template>

<style scoped>
.chess-game {
    width: 100%;
}

code {
    font-family: 'Courier New', monospace;
    background-color: rgba(0, 0, 0, 0.05);
    padding: 0.125rem 0.5rem;
    border-radius: 0.25rem;
}
</style>
