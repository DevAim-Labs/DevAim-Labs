import * as THREE from 'three'

// The hero's one WebGL surface — "Ink & Signal" theme: a technical,
// wireframe signal-grid instead of the soft gradient-mesh blobs the
// previous ("Blueprint Cyan") pattern used. Built directly on bare three.js
// (see supportsHeroGradient.js for why: react-three-fiber/shadergradient
// are React-only, this project is Vue).
//
// Animation decision (per the `animate` skill): this is decorative,
// rare/first-impression brand atmosphere (seen once per session, not a
// frequent UI interaction), so it sits in the "delight" tier where
// continuous motion is allowed. It's *constant* motion, not a discrete
// state change — the skill's easing table puts constant motion (marquee,
// progress) under `linear`, so time drives the pattern directly with no
// eased loop-tween wrapped around it. The brutalist "no soft transitions"
// rule governs discrete UI chrome (buttons, cards — see .btn-hover), not
// this ambient marketing background.
//
// Colors are read from the page's own CSS custom properties at init time,
// so the shader always matches the current theme tokens.

const VERTEX = /* glsl */ `
    varying vec2 vUv;
    void main() {
        vUv = uv;
        gl_Position = vec4(position, 1.0);
    }
`

// A grid of thin lines with a slow per-line phase offset, plus a sparse
// field of "signal" dots that pulse — reads as a technical schematic/scan
// pattern rather than a decorative blur. Cheap: no textures, no noise
// tables, just modulo distance-to-line-fields.
const FRAGMENT = /* glsl */ `
    precision mediump float;
    varying vec2 vUv;
    uniform float uTime;
    uniform vec2 uResolution;
    uniform vec3 uInk;
    uniform vec3 uSignal;

    float gridLine(float coord, float cell, float thickness) {
        float m = mod(coord, cell);
        float d = min(m, cell - m);
        return 1.0 - smoothstep(0.0, thickness, d);
    }

    void main() {
        vec2 uv = vUv;
        vec2 aspectUv = uv;
        aspectUv.x *= uResolution.x / uResolution.y;

        float cell = 0.09;
        // Each row of the grid drifts horizontally at a slightly different
        // speed, so the grid itself feels like it's scanning rather than
        // scrolling as one flat plane.
        float rowIndex = floor(aspectUv.y / cell);
        float drift = uTime * (0.015 + 0.01 * sin(rowIndex * 12.9898));
        float gx = gridLine(aspectUv.x + drift, cell, 0.0015);
        float gy = gridLine(aspectUv.y, cell, 0.0015);
        float grid = max(gx * step(aspectUv.y, 1.0), gy);

        // Sparse pulsing signal dots at grid intersections.
        vec2 cellId = floor(aspectUv / cell);
        float seed = fract(sin(dot(cellId, vec2(12.9898, 78.233))) * 43758.5453);
        float isDot = step(0.985, seed);
        float pulse = 0.5 + 0.5 * sin(uTime * 1.5 + seed * 20.0);
        vec2 cellUv = fract(aspectUv / cell) - 0.5;
        float dot = (1.0 - smoothstep(0.0, 0.12, length(cellUv))) * isDot * pulse;

        float signal = clamp(grid * 0.35 + dot, 0.0, 1.0);
        vec3 color = mix(uInk, uSignal, signal);

        float vignette = smoothstep(1.15, 0.15, distance(vUv, vec2(0.5)));
        float alpha = clamp(signal * 0.9, 0.0, 1.0) * vignette;
        gl_FragColor = vec4(color, alpha);
    }
`

function readColor(varName, fallback) {
    const value = getComputedStyle(document.documentElement).getPropertyValue(varName).trim()
    const el = document.createElement('div')
    el.style.color = value || fallback
    document.body.appendChild(el)
    const rgb = getComputedStyle(el).color.match(/[\d.]+/g)
    document.body.removeChild(el)
    if (!rgb) return new THREE.Color(fallback)
    return new THREE.Color(rgb[0] / 255, rgb[1] / 255, rgb[2] / 255)
}

/**
 * Creates the animated signal-grid scene on `canvas`. Returns controls to
 * pause/resume (via IntersectionObserver + visibilitychange) and to fully
 * tear down (component unmount).
 */
export function createHeroGradient(canvas) {
    const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: false, powerPreference: 'low-power' })
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 1.5))

    const scene = new THREE.Scene()
    const camera = new THREE.Camera() // fullscreen-quad shader, no projection needed

    const uniforms = {
        uTime: { value: 0 },
        uResolution: { value: new THREE.Vector2(1, 1) },
        uInk: { value: readColor('--color-surface-1', '#141415') },
        uSignal: { value: readColor('--color-accent', '#FF5A1F') },
    }

    const mesh = new THREE.Mesh(
        new THREE.PlaneGeometry(2, 2),
        new THREE.ShaderMaterial({
            vertexShader: VERTEX,
            fragmentShader: FRAGMENT,
            uniforms,
            transparent: true,
        })
    )
    scene.add(mesh)

    let rafId = null
    let running = false
    const clock = new THREE.Clock()

    function resize() {
        const { clientWidth: w, clientHeight: h } = canvas
        if (w === 0 || h === 0) return
        renderer.setSize(w, h, false)
        uniforms.uResolution.value.set(w, h)
    }

    function tick() {
        uniforms.uTime.value = clock.getElapsedTime()
        renderer.render(scene, camera)
        rafId = requestAnimationFrame(tick)
    }

    function start() {
        if (running) return
        running = true
        resize()
        clock.start()
        rafId = requestAnimationFrame(tick)
    }

    function stop() {
        running = false
        if (rafId !== null) cancelAnimationFrame(rafId)
        rafId = null
    }

    function destroy() {
        stop()
        mesh.geometry.dispose()
        mesh.material.dispose()
        renderer.dispose()
    }

    const resizeObserver = new ResizeObserver(resize)
    resizeObserver.observe(canvas)

    return {
        start,
        stop,
        destroy: () => {
            resizeObserver.disconnect()
            destroy()
        },
    }
}
