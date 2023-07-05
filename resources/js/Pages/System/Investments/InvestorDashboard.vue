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
            class="grid grid-cols-2 p-3 mt-5 border divide-x rounded-3xl bg-slate-200 divide-slate-400"
        >
            <div class="text-center">
                <h2>My Total Investments</h2>
                <p class="text-3xl font-bold font-heading">
                    {{ props.headers.totalInvestments }}
                </p>
            </div>

            <div class="text-center">
                <h2>Referral Bonus</h2>
                <p class="text-3xl font-bold font-heading">
                    {{ props.headers.referralBonus }}
                </p>
            </div>
        </div>
    </div>
</template>
