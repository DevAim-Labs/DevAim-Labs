<template>
  <div data-nav-overlay style="position:fixed;inset:0;z-index:9998;display:flex;align-items:center;justify-content:center;visibility:hidden;pointer-events:none;">
    <div data-nav-cube style="transform-style:preserve-3d;position:relative;">
      <div v-for="n in 6" :key="n" data-nav-face :style="faceStyle" />
    </div>
    <div data-nav-label style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;z-index:1;opacity:0;pointer-events:none;">
      <span :style="textStyle">{{ text }}</span>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  text:           { type: String, default: 'DEVAIM' },
  primaryColor:   { type: String, default: 'rgba(8,12,20,0.97)' },
  secondaryColor: { type: String, default: '#0B8598' },
})

const borderColor = computed(() => {
  const c = props.secondaryColor.trim()
  return c.startsWith('#') && c.length === 7 ? c + '4d' : c
})

const faceStyle = computed(() => ({
  position: 'absolute',
  width: '100%',
  height: '100%',
  background: props.primaryColor,
  border: `1px solid ${borderColor.value}`,
}))

const textStyle = computed(() => ({
  fontFamily: "'Space Grotesk', sans-serif",
  fontSize: '4rem',
  fontWeight: '700',
  letterSpacing: '0.5em',
  color: props.secondaryColor,
  textTransform: 'uppercase',
  userSelect: 'none',
}))
</script>
