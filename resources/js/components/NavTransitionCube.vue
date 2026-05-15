<template>
  <div ref="overlay" style="position:fixed;inset:0;z-index:9998;display:flex;align-items:center;justify-content:center;visibility:hidden;pointer-events:none;">
    <div ref="cube" style="transform-style:preserve-3d;position:relative;">
      <div v-for="n in 6" :key="n" :style="faceStyle" />
    </div>
    <div ref="label" style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;z-index:1;opacity:0;pointer-events:none;">
      <span :style="textStyle">{{ text }}</span>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { gsap } from 'gsap'

const props = defineProps({
  text:           { type: String, default: 'DEVAIM' },
  primaryColor:   { type: String, default: 'rgba(8,12,20,0.97)' },
  secondaryColor: { type: String, default: '#0B8598' },
})

const overlay = ref(null)
const cube    = ref(null)
const label   = ref(null)

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

onMounted(() => {
  const size = Math.min(window.innerWidth, window.innerHeight) * 0.38
  const half = size / 2
  cube.value.style.width  = size + 'px'
  cube.value.style.height = size + 'px'

  const transforms = [
    `translateZ(${half}px)`,
    `rotateY(180deg) translateZ(${half}px)`,
    `rotateY(90deg) translateZ(${half}px)`,
    `rotateY(-90deg) translateZ(${half}px)`,
    `rotateX(90deg) translateZ(${half}px)`,
    `rotateX(-90deg) translateZ(${half}px)`,
  ]
  cube.value.querySelectorAll('div').forEach((face, i) => {
    face.style.transform = transforms[i]
  })

  gsap.set(cube.value,  { scale: 0, rotateX: 50, rotateY: 45, rotateZ: 15 })
  gsap.set(label.value, { opacity: 0, scale: 0.75 })

  const coverScale = (Math.hypot(window.innerWidth, window.innerHeight) / size) * 1.15
  let busy = false

  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', e => {
      const href = link.getAttribute('href')
      if (!href || href === '#' || busy) return
      const target = document.querySelector(href)
      if (!target) return
      e.preventDefault()
      busy = true

      gsap.timeline({ onComplete: () => { busy = false } })
        .set(overlay.value, { visibility: 'visible' })
        .to(cube.value,  { scale: coverScale, rotateX: 0, rotateY: 0, rotateZ: 0, duration: 0.5, ease: 'power3.in' })
        .to(label.value, { opacity: 1, scale: 1, duration: 0.22, ease: 'power2.out' }, '-=0.1')
        .add(() => {
          const html = document.documentElement
          html.style.scrollBehavior = 'auto'
          target.scrollIntoView()
          requestAnimationFrame(() => { html.style.scrollBehavior = '' })
        })
        .to({}, { duration: 0.06 })
        .to(label.value, { opacity: 0, scale: 0.85, duration: 0.15, ease: 'power2.in' })
        .to(cube.value,  { scale: 0, rotateX: -55, rotateY: 55, rotateZ: -20, duration: 0.52, ease: 'power3.out' })
        .set(overlay.value, { visibility: 'hidden' })
        .set(cube.value,  { rotateX: 50, rotateY: 45, rotateZ: 15 })
        .set(label.value, { opacity: 0, scale: 0.75 })
    })
  })
})
</script>
