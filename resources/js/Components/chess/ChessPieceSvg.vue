<script setup>
import { computed } from 'vue';

const props = defineProps({
    piece: {
        type: String,
        required: true,
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

const isBlack = computed(() => props.piece.startsWith('b'));
const pieceType = computed(() => props.piece[1]);

// Color styles based on piece color
const fillColor = computed(() => (isBlack.value ? '#1e293b' : '#f1f5f9'));
const strokeColor = computed(() => (isBlack.value ? '#0f172a' : '#475569'));
const shadowColor = computed(() => (isBlack.value ? 'rgba(15, 23, 42, 0.4)' : 'rgba(71, 85, 105, 0.3)'));

// Viewbox and scaling
const viewbox = computed(() => `0 0 ${props.size} ${props.size}`);
const centerX = computed(() => props.size / 2);
const centerY = computed(() => props.size / 2);
const scale = computed(() => props.size / 100);

const pieceComponents = {
    K: 'King',
    Q: 'Queen',
    R: 'Rook',
    B: 'Bishop',
    N: 'Knight',
    P: 'Pawn',
};

const animationClass = computed(() => props.animate ? 'chess-piece-animate' : '');
</script>

<template>
    <div :class="['chess-piece-svg-container', animationClass]">
        <svg
            :width="size"
            :height="size"
            :viewBox="viewbox"
            xmlns="http://www.w3.org/2000/svg"
            class="chess-piece-svg drop-shadow-lg"
        >
            <!-- Piece specific SVG rendering -->
            <defs>
                <filter id="shadow" x="-50%" y="-50%" width="200%" height="200%">
                    <feDropShadow dx="0" dy="2" stdDeviation="3" :flood-color="shadowColor" flood-opacity="0.4" />
                </filter>
                <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                    <stop :offset="0" :stop-color="fillColor" stop-opacity="1" />
                    <stop :offset="100%" :stop-color="fillColor" stop-opacity="0.85" />
                </linearGradient>
            </defs>

            <!-- King -->
            <template v-if="pieceType === 'K'">
                <g filter="url(#shadow)">
                    <!-- Base -->
                    <circle :cx="centerX" :cy="centerY + 15" :r="20" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Main body -->
                    <polygon :points="`${centerX - 18},${centerY + 2} ${centerX + 18},${centerY + 2} ${centerX + 15},${centerY - 20} ${centerX},${centerY - 28} ${centerX - 15},${centerY - 20}`" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Crown points -->
                    <circle :cx="centerX - 12" :cy="centerY - 25" :r="4" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                    <circle :cx="centerX" :cy="centerY - 32" :r="5" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                    <circle :cx="centerX + 12" :cy="centerY - 25" :r="4" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                    <!-- Cross on top -->
                    <line :x1="centerX" :y1="centerY - 35" :x2="centerX" :y2="centerY - 42" :stroke="strokeColor" stroke-width="2" />
                    <line :x1="centerX - 3" :y1="centerY - 39" :x2="centerX + 3" :y2="centerY - 39" :stroke="strokeColor" stroke-width="2" />
                </g>
            </template>

            <!-- Queen -->
            <template v-else-if="pieceType === 'Q'">
                <g filter="url(#shadow)">
                    <!-- Base -->
                    <circle :cx="centerX" :cy="centerY + 15" :r="20" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Main body -->
                    <polygon :points="`${centerX - 18},${centerY + 2} ${centerX + 18},${centerY + 2} ${centerX + 16},${centerY - 18} ${centerX},${centerY - 26} ${centerX - 16},${centerY - 18}`" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Crown balls -->
                    <circle :cx="centerX - 14" :cy="centerY - 24" :r="5" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                    <circle :cx="centerX - 7" :cy="centerY - 28" :r="4" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                    <circle :cx="centerX" :cy="centerY - 30" :r="5" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                    <circle :cx="centerX + 7" :cy="centerY - 28" :r="4" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                    <circle :cx="centerX + 14" :cy="centerY - 24" :r="5" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                </g>
            </template>

            <!-- Rook -->
            <template v-else-if="pieceType === 'R'">
                <g filter="url(#shadow)">
                    <!-- Base -->
                    <circle :cx="centerX" :cy="centerY + 15" :r="20" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Tower body -->
                    <polygon :points="`${centerX - 16},${centerY + 2} ${centerX + 16},${centerY + 2} ${centerX + 14},${centerY - 20} ${centerX - 14},${centerY - 20}`" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Castle top -->
                    <polygon :points="`${centerX - 18},${centerY - 20} ${centerX - 12},${centerY - 20} ${centerX - 12},${centerY - 28} ${centerX - 18},${centerY - 28}`" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                    <polygon :points="`${centerX - 6},${centerY - 20} ${centerX},${centerY - 20} ${centerX},${centerY - 28} ${centerX - 6},${centerY - 28}`" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                    <polygon :points="`${centerX + 6},${centerY - 20} ${centerX + 12},${centerY - 20} ${centerX + 12},${centerY - 28} ${centerX + 6},${centerY - 28}`" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                    <polygon :points="`${centerX + 18},${centerY - 20} ${centerX + 24},${centerY - 20} ${centerX + 24},${centerY - 28} ${centerX + 18},${centerY - 28}`" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                </g>
            </template>

            <!-- Bishop -->
            <template v-else-if="pieceType === 'B'">
                <g filter="url(#shadow)">
                    <!-- Base -->
                    <circle :cx="centerX" :cy="centerY + 15" :r="20" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Body -->
                    <polygon :points="`${centerX - 14},${centerY + 2} ${centerX + 14},${centerY + 2} ${centerX + 12},${centerY - 20} ${centerX},${centerY - 26} ${centerX - 12},${centerY - 20}`" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Head/Mitre -->
                    <circle :cx="centerX" :cy="centerY - 26" :r="8" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Top point -->
                    <circle :cx="centerX" :cy="centerY - 35" :r="4" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                </g>
            </template>

            <!-- Knight -->
            <template v-else-if="pieceType === 'N'">
                <g filter="url(#shadow)">
                    <!-- Base -->
                    <circle :cx="centerX" :cy="centerY + 15" :r="20" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Horse body -->
                    <path :d="`M${centerX - 10},${centerY + 2} C${centerX - 14},${centerY - 5} ${centerX - 16},${centerY - 15} ${centerX - 8},${centerY - 22} L${centerX + 6},${centerY - 18} L${centerX + 8},${centerY - 8} L${centerX + 16},${centerY + 2} Z`" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Horse head projection -->
                    <polygon :points="`${centerX - 6},${centerY - 24} ${centerX - 2},${centerY - 28} ${centerX + 2},${centerY - 24}`" :fill="fillColor" :stroke="strokeColor" stroke-width="1.5" />
                </g>
            </template>

            <!-- Pawn -->
            <template v-else-if="pieceType === 'P'">
                <g filter="url(#shadow)">
                    <!-- Base -->
                    <circle :cx="centerX" :cy="centerY + 15" :r="18" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Body -->
                    <polygon :points="`${centerX - 12},${centerY + 2} ${centerX + 12},${centerY + 2} ${centerX + 10},${centerY - 10} ${centerX - 10},${centerY - 10}`" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                    <!-- Head -->
                    <circle :cx="centerX" :cy="centerY - 18" :r="8" :fill="fillColor" :stroke="strokeColor" stroke-width="2" />
                </g>
            </template>
        </svg>
    </div>
</template>

<style scoped>
.chess-piece-svg-container {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

.chess-piece-svg {
    filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
}

@keyframes pieceFloat {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-4px);
    }
}

.chess-piece-animate {
    animation: pieceFloat 3s ease-in-out infinite;
}

.chess-piece-animate:hover .chess-piece-svg {
    filter: drop-shadow(0 8px 12px rgba(0, 0, 0, 0.2));
}
</style>
