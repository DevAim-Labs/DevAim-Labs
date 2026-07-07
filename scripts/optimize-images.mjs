/**
 * Generates optimized WebP assets for PageSpeed.
 * Run: node scripts/optimize-images.mjs
 */
import sharp from 'sharp'
import { mkdir } from 'node:fs/promises'
import { dirname, join } from 'node:path'
import { fileURLToPath } from 'node:url'

const root = join(dirname(fileURLToPath(import.meta.url)), '..')

async function hero() {
    const src = join(root, 'public/heroimage.jpg')
    const sizes = [
        { width: 768, name: 'heroimage-768.webp' },
        { width: 1280, name: 'heroimage-1280.webp' },
        { width: 1920, name: 'heroimage.webp' },
    ]
    for (const { width, name } of sizes) {
        await sharp(src)
            .rotate()
            .resize({ width, withoutEnlargement: true })
            .webp({ quality: 72 })
            .toFile(join(root, 'public', name))
        console.log('wrote', name)
    }
}

async function clientLogo(file, outName) {
    const src = join(root, 'resources/assets', file)
    await sharp(src)
        .resize({ width: 200, withoutEnlargement: true })
        .webp({ quality: 82 })
        .toFile(join(root, 'resources/assets', outName))
    console.log('wrote', outName)
}

await hero()
await clientLogo('lokanta.png', 'lokanta.webp')
await clientLogo('slowdown.png', 'slowdown.webp')
