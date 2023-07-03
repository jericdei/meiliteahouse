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
        class="grid p-8 rounded-xl bg-slate-50 text-slate-900"
        :class="
            isTwoSpan ? 'grid-cols-2 items-center' : 'grid-cols-1 items-start'
        "
    >
        <div>
            <CardLogo class="w-1/2 py-4 mx-auto" :color="cardColor" />

            <p class="font-bold text-center uppercase lg:text-3xl">
                {{ props.classification }}
            </p>
        </div>

        <ul class="px-16 mt-4 text-lg list-disc">
            <li v-for="item in props.list">{{ item }}</li>
        </ul>
    </div>
</template>
