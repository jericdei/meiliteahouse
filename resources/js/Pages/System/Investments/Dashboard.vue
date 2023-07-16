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
            class="mt-5 grid grid-cols-3 divide-x divide-slate-400 rounded-3xl border bg-slate-200 p-3"
        >
            <div class="text-center">
                <h2>Active Investors</h2>
                <p class="font-heading text-3xl font-bold">
                    {{ props.headers.activeInvestors }}
                </p>
            </div>

            <div class="text-center">
                <h2>Pending Submissions</h2>
                <p class="font-heading text-3xl font-bold">
                    {{ props.headers.pendingSubmissions }}
                </p>
            </div>

            <div class="text-center">
                <h2>Pending Transactions</h2>
                <p class="font-heading text-3xl font-bold">
                    {{ props.headers.pendingTransactions }}
                </p>
            </div>
        </div>
    </div>
</template>
