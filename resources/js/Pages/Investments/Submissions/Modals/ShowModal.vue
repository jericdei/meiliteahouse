<script setup lang="ts">
import { Submission } from '@/types/submission';
import { DynamicDialogInstance } from 'primevue/dynamicdialogoptions';
import { ComputedRef } from 'vue';
import { inject } from 'vue';

const dialogRef = inject<ComputedRef<DynamicDialogInstance>>(
    'dialogRef'
) as ComputedRef<DynamicDialogInstance>;

const submission: Submission = dialogRef.value.data.submission;
</script>

<template>
    <div class="p-5">
        <div class="border border-slate-400 rounded-xl w-1/4 p-3">
            <Image src="/images/placeholder.png" width="320" />

            <h1 class="text-4xl font-bold text-center">
                {{ submission.fullName }}
            </h1>
        </div>
    </div>
</template>
