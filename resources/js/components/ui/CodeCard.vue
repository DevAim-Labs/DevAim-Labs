<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const props = defineProps({
  title: {
    type: String,
    default: ''
  },
  showDots: {
    type: Boolean,
    default: true
  },
  coloredDots: {
    type: Boolean,
    default: true
  },
  spotlight: {
    type: Boolean,
    default: true
  },
  accentColor: {
    type: String,
    default: 'accent',
    validator: (value) => ['accent', 'violet', 'warm'].includes(value)
  }
})

const cardRef = ref(null)
const spotlightRef = ref(null)
const isHovering = ref(false)

function handleMouseMove(e) {
  if (!props.spotlight || !cardRef.value || !spotlightRef.value) return

  const rect = cardRef.value.getBoundingClientRect()
  const x = e.clientX - rect.left
  const y = e.clientY - rect.top

  spotlightRef.value.style.left = `${x}px`
  spotlightRef.value.style.top = `${y}px`
}

function handleMouseEnter() {
  isHovering.value = true
}

function handleMouseLeave() {
  isHovering.value = false
}
</script>

<template>
  <div
    ref="cardRef"
    class="code-card"
    :class="[`code-card--${accentColor}`]"
    @mousemove="handleMouseMove"
    @mouseenter="handleMouseEnter"
    @mouseleave="handleMouseLeave"
  >
    <!-- Spotlight effect -->
    <div
      v-if="spotlight"
      ref="spotlightRef"
      class="code-card-spotlight"
      :class="{ 'is-visible': isHovering }"
    ></div>

    <!-- Header with dots -->
    <div v-if="showDots || title" class="code-card-header">
      <div v-if="showDots" class="code-card-dots">
        <span
          class="code-card-dot"
          :class="{ 'red': coloredDots }"
        ></span>
        <span
          class="code-card-dot"
          :class="{ 'yellow': coloredDots }"
        ></span>
        <span
          class="code-card-dot"
          :class="{ 'green': coloredDots }"
        ></span>
      </div>
      <span v-if="title" class="code-card-title">{{ title }}</span>
    </div>

    <!-- Content -->
    <div class="code-card-body">
      <slot></slot>
    </div>

    <!-- Footer slot -->
    <div v-if="$slots.footer" class="code-card-footer">
      <slot name="footer"></slot>
    </div>
  </div>
</template>

<style scoped>
.code-card {
  position: relative;
  background: var(--color-surface-1);
  border: 1px solid var(--color-border-dim);
  border-radius: 0.75rem;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
}

.code-card:hover {
  transform: translateY(-4px);
  border-color: var(--color-border);
  box-shadow:
    0 20px 40px -15px rgba(0, 0, 0, 0.3),
    0 0 0 1px var(--color-border-glow);
}

/* Accent color variants */
.code-card--accent:hover {
  box-shadow:
    0 20px 40px -15px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(23, 199, 188, 0.25);
}

.code-card--violet:hover {
  box-shadow:
    0 20px 40px -15px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(139, 92, 246, 0.25);
}

.code-card--warm:hover {
  box-shadow:
    0 20px 40px -15px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(245, 166, 35, 0.25);
}

/* Spotlight effect */
.code-card-spotlight {
  position: absolute;
  width: 400px;
  height: 400px;
  border-radius: 50%;
  pointer-events: none;
  opacity: 0;
  transform: translate(-50%, -50%);
  transition: opacity 0.3s ease;
  z-index: 0;
}

.code-card--accent .code-card-spotlight {
  background: radial-gradient(circle, rgba(23, 199, 188, 0.15) 0%, transparent 70%);
}

.code-card--violet .code-card-spotlight {
  background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
}

.code-card--warm .code-card-spotlight {
  background: radial-gradient(circle, rgba(245, 166, 35, 0.15) 0%, transparent 70%);
}

.code-card-spotlight.is-visible {
  opacity: 1;
}

/* Header */
.code-card-header {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.75rem 1rem;
  background: var(--color-surface-2);
  border-bottom: 1px solid var(--color-border-dim);
}

.code-card-dots {
  display: flex;
  gap: 0.375rem;
}

.code-card-dot {
  width: 0.625rem;
  height: 0.625rem;
  border-radius: 50%;
  background: var(--color-text-dim);
  opacity: 0.4;
}

.code-card-dot.red { background: #EF4444; opacity: 1; }
.code-card-dot.yellow { background: #F59E0B; opacity: 1; }
.code-card-dot.green { background: #22C55E; opacity: 1; }

.code-card-title {
  font-size: 0.75rem;
  font-family: var(--font-mono);
  color: var(--color-text-dim);
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

/* Body */
.code-card-body {
  position: relative;
  z-index: 1;
  padding: 1.5rem;
}

/* Footer */
.code-card-footer {
  position: relative;
  z-index: 1;
  padding: 1rem 1.5rem;
  border-top: 1px solid var(--color-border-dim);
  background: var(--color-surface-2);
}

/* Light theme */
html[data-theme="light"] .code-card {
  background: var(--color-surface-1);
  border-color: var(--color-border-dim);
}

html[data-theme="light"] .code-card:hover {
  box-shadow:
    0 12px 32px -12px rgba(0, 0, 0, 0.1),
    0 0 0 1px rgba(14, 155, 146, 0.2);
}

html[data-theme="light"] .code-card--accent:hover {
  box-shadow:
    0 12px 32px -12px rgba(0, 0, 0, 0.1),
    0 0 0 1px rgba(14, 155, 146, 0.25);
}

html[data-theme="light"] .code-card--violet:hover {
  box-shadow:
    0 12px 32px -12px rgba(0, 0, 0, 0.1),
    0 0 0 1px rgba(124, 58, 237, 0.25);
}

html[data-theme="light"] .code-card--warm:hover {
  box-shadow:
    0 12px 32px -12px rgba(0, 0, 0, 0.1),
    0 0 0 1px rgba(212, 137, 14, 0.25);
}

html[data-theme="light"] .code-card-header {
  background: var(--color-surface-2);
}

html[data-theme="light"] .code-card-footer {
  background: var(--color-surface-2);
}

/* Light theme spotlight - slightly stronger */
html[data-theme="light"] .code-card--accent .code-card-spotlight {
  background: radial-gradient(circle, rgba(14, 155, 146, 0.12) 0%, transparent 70%);
}

html[data-theme="light"] .code-card--violet .code-card-spotlight {
  background: radial-gradient(circle, rgba(124, 58, 237, 0.12) 0%, transparent 70%);
}

html[data-theme="light"] .code-card--warm .code-card-spotlight {
  background: radial-gradient(circle, rgba(212, 137, 14, 0.12) 0%, transparent 70%);
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
  .code-card {
    transition: none;
  }
  .code-card:hover {
    transform: none;
  }
}
</style>
