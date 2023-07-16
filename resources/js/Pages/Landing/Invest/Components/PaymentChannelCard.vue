<script setup lang="ts">
const props = defineProps<{
    imageLink: string
    accountNumber: string
    accountName: string
}>()
</script>

<template>
    <div
        class="flex items-center justify-between rounded-full bg-slate-50 px-6 py-4 text-slate-900"
    >
        <Image :src="props.imageLink" width="100" />

        <div class="text-center">
            <p class="font-bold lg:text-lg">{{ accountNumber }}</p>
            <p class="max-w-[15ch] font-bold lg:text-lg">{{ accountName }}</p>
        </div>
    </div>
</template>
