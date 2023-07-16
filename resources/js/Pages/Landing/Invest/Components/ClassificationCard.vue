<script setup lang="ts">
import { computed } from 'vue'
import CardLogo from './CardLogo.vue'

const props = withDefaults(
    defineProps<{
        classification: 'investor' | 'bronze' | 'silver' | 'gold' | 'diamond'
        list: string[]
        isTwoSpan?: boolean
    }>(),
    {
        isTwoSpan: false,
    }
)

const cardColor = computed(() => {
    switch (props.classification) {
        case 'investor':
            return 'fill-primary'
        case 'bronze':
            return 'fill-yellow-700'
        case 'silver':
            return 'fill-zinc-500'
        case 'gold':
            return 'fill-amber-500'
        case 'diamond':
            return 'fill-teal-400'
    }
})
</script>

<template>
    <div
        class="grid rounded-xl bg-slate-50 p-8 text-slate-900"
        :class="
            isTwoSpan ? 'grid-cols-2 items-center' : 'grid-cols-1 items-start'
        "
    >
        <div>
            <CardLogo class="mx-auto w-1/2 py-4" :color="cardColor" />

            <p class="text-center text-xl font-bold uppercase lg:text-3xl">
                {{ props.classification }}
            </p>
        </div>

        <ul class="mt-4 list-disc px-4 lg:px-8 lg:text-lg xl:px-16">
            <li v-for="item in props.list">{{ item }}</li>
        </ul>
    </div>
</template>
