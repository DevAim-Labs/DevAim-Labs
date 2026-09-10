<script setup>
import { computed } from 'vue'

const locale = window.__LOCALE__ || 'nl'
const isEn = locale === 'en'
const defaultText = computed(() => isEn ? 'Available for projects' : 'Beschikbaar voor projecten')

const props = defineProps({
  text: {
    type: String,
    default: null
  },
  size: {
    type: String,
    default: 'default',
    validator: (value) => ['small', 'default', 'large'].includes(value)
  }
})

const displayText = computed(() => props.text || defaultText.value)
</script>

<template>
  <div
    class="availability-badge"
    :class="[`availability-badge--${size}`]"
  >
    <span class="availability-dot" aria-hidden="true">
      <span class="availability-dot-ping"></span>
      <span class="availability-dot-core"></span>
    </span>
    <span class="availability-text">{{ displayText }}</span>
  </div>
</template>

<style scoped>
.availability-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.625rem;
  padding: 0.5rem 1rem;
  background: var(--color-surface-1);
  border: 1px solid var(--color-border-dim);
  border-radius: 9999px;
  font-size: 0.8125rem;
  color: var(--color-text-muted);
  transition: border-color 0.2s ease, background 0.2s ease;
}

.availability-badge:hover {
  border-color: var(--color-border);
  background: var(--color-surface-2);
}

.availability-badge--small {
  padding: 0.375rem 0.75rem;
  font-size: 0.75rem;
  gap: 0.5rem;
}

.availability-badge--large {
  padding: 0.625rem 1.25rem;
  font-size: 0.875rem;
  gap: 0.75rem;
}

.availability-dot {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 0.625rem;
  height: 0.625rem;
}

.availability-badge--small .availability-dot {
  width: 0.5rem;
  height: 0.5rem;
}

.availability-badge--large .availability-dot {
  width: 0.75rem;
  height: 0.75rem;
}

.availability-dot-core {
  position: absolute;
  width: 100%;
  height: 100%;
  background: #22C55E;
  border-radius: 50%;
}

.availability-dot-ping {
  position: absolute;
  width: 100%;
  height: 100%;
  background: #22C55E;
  border-radius: 50%;
  animation: availability-ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
}

@keyframes availability-ping {
  0% {
    transform: scale(1);
    opacity: 0.75;
  }
  75%, 100% {
    transform: scale(2.5);
    opacity: 0;
  }
}

.availability-text {
  font-weight: 500;
  letter-spacing: 0.01em;
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
  .availability-dot-ping {
    animation: none;
    opacity: 0;
  }
}
</style>
