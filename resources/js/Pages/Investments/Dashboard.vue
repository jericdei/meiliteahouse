<script setup lang="ts">
import Title from '@/Components/Investments/Title.vue'

const props = defineProps<{
    headers: {
        activeInvestors: number
        pendingSubmissions: number
        pendingTransactions: number
    }
}>()
</script>

<template>
    <div>
        <Head title="Dashboard" />

        <Title icon="pi pi-chart-bar">Dashboard</Title>

        <div
            class="grid grid-cols-3 mt-5 border p-3 rounded-3xl bg-slate-200 divide-x divide-slate-400"
        >
            <div class="text-center">
                <h2>Active Investors</h2>
                <p class="font-bold font-heading text-3xl">
                    {{ props.headers.activeInvestors }}
                </p>
            </div>

            <div class="text-center">
                <h2>Pending Submissions</h2>
                <p class="font-bold font-heading text-3xl">
                    {{ props.headers.pendingSubmissions }}
                </p>
            </div>

            <div class="text-center">
                <h2>Pending Transactions</h2>
                <p class="font-bold font-heading text-3xl">
                    {{ props.headers.pendingTransactions }}
                </p>
            </div>
        </div>
    </div>
</template>
