<script setup></script>

<template>
    <div>
        <Head title="Dashboard" />

        <h1 class="font-bold text-2xl">
            <i class="pi pi-chart-bar font-bold text-2xl mr-2" />
            Dashboard
        </h1>

        <div
            class="grid grid-cols-3 mt-5 border p-3 rounded-3xl bg-slate-200 divide-x divide-slate-400"
        >
            <div class="text-center">
                <h2>Active Investors</h2>
                <p class="font-bold font-heading text-3xl">1</p>
            </div>

            <div class="text-center">
                <h2>Pending Submissions</h2>
                <p class="font-bold font-heading text-3xl">69</p>
            </div>

            <div class="text-center">
                <h2>Pending Transactions</h2>
                <p class="font-bold font-heading text-3xl">420</p>
            </div>
        </div>
    </div>
</template>
