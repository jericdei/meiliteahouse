<script setup lang="ts">
import { ComputedRef, inject } from 'vue'
import { DynamicDialogInstance } from 'primevue/dynamicdialogoptions'

const dialogRef = inject<ComputedRef<DynamicDialogInstance>>(
    'dialogRef'
) as ComputedRef<DynamicDialogInstance>
</script>

<template>
    <div class="flex items-center justify-end">
        <Button label="Cancel" severity="danger" @click="dialogRef.close()" />
    </div>
</template>
