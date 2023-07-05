<script setup lang="ts">
import InputText from 'primevue/inputtext'
import { ComputedRef, inject } from 'vue'
import { DynamicDialogInstance } from 'primevue/dynamicdialogoptions'

const dialogRef = inject<ComputedRef<DynamicDialogInstance>>(
    'dialogRef'
) as ComputedRef<DynamicDialogInstance>
</script>

<template>
    <div>
        <InputText
            v-model="dialogRef.data.rejectReason"
            class="w-full"
            placeholder="Type here.."
        />
    </div>
</template>
