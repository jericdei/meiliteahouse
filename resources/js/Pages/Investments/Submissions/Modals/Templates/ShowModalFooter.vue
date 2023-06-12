<script setup lang="ts">
import { DynamicDialogInstance } from 'primevue/dynamicdialogoptions';
import { useConfirm } from 'primevue/useconfirm';
import { ComputedRef } from 'vue';
import { inject } from 'vue';
import { ref } from 'vue';

const confirm = useConfirm();
const dialogRef = inject<ComputedRef<DynamicDialogInstance>>(
    'dialogRef'
) as ComputedRef<DynamicDialogInstance>;

const confirmAction = (action: string) => {
    confirm.require({
        header: 'Confirmation',
        message: `Are you sure you want to ${action} this submission?`,
        accept: () => {
            dialogRef.value.close(action);
        },
    });
};
</script>

<template>
    <div class="flex items-center justify-end">
        <Button
            label="Approve"
            severity="success"
            @click="confirmAction('approve')"
        />
        <Button
            label="Decline"
            severity="danger"
            @click="confirmAction('reject')"
        />
    </div>
</template>
