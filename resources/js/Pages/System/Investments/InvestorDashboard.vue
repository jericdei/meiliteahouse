<script setup lang="ts">
import Title from '@/Components/Investments/Title.vue'

const props = defineProps<{
    headers: {
        totalInvestments: number
        referralBonus: number
    }
}>()
</script>

<template>
    <div>
        <Head title="Dashboard" />

        <Title icon="pi pi-chart-bar">Dashboard</Title>

        <div
            class="mt-5 grid grid-cols-2 divide-x divide-slate-400 rounded-3xl border bg-slate-200 p-3"
        >
            <div class="text-center">
                <h2>My Total Investments</h2>
                <p class="font-heading text-3xl font-bold">
                    {{ props.headers.totalInvestments }}
                </p>
            </div>

            <div class="text-center">
                <h2>Referral Bonus</h2>
                <p class="font-heading text-3xl font-bold">
                    {{ props.headers.referralBonus }}
                </p>
            </div>
        </div>
    </div>
</template>
