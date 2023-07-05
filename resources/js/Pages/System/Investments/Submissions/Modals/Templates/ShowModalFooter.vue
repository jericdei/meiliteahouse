<script setup lang="ts">
import { dynamicDialogProps } from '@/Config/modal'
import { SubmissionAction } from '@/types/submission'
import { useForm } from '@inertiajs/vue3'
import { DynamicDialogInstance } from 'primevue/dynamicdialogoptions'
import { useConfirm } from 'primevue/useconfirm'
import { useDialog } from 'primevue/usedialog'
import { ComputedRef, inject, markRaw } from 'vue'
import RejectReasonModal from '../RejectReasonModal.vue'
import RejectReasonModalFooter from './RejectReasonModalFooter.vue'

const confirm = useConfirm()
const dialog = useDialog()

const dialogRef = inject<ComputedRef<DynamicDialogInstance>>(
    'dialogRef'
) as ComputedRef<DynamicDialogInstance>

const form = useForm<{
    action?: SubmissionAction
    reject_reason?: string
}>({
    action: undefined,
    reject_reason: undefined,
})

const confirmAction = (action: SubmissionAction) => {
    if (action === 'reject') {
        dialog.open(RejectReasonModal, {
            props: {
                ...dynamicDialogProps,
                header: 'Reject Reason',
            },
            data: {
                rejectReason: '',
            },
            templates: {
                footer: markRaw(RejectReasonModalFooter),
            },
            onClose: options => {
                if (options && options.data) {
                    form.reject_reason = options.data

                    showConfirm(action)
                }
            },
        })
    } else {
        showConfirm(action)
    }
}

const showConfirm = (action: SubmissionAction) => {
    confirm.require({
        header: 'Confirmation',
        message: `Are you sure you want to ${action} this submission?`,
        accept: () => {
            form.transform(data => ({
                ...data,
                action: action,
            })).patch(
                route(
                    'system.invest.submissions.update',
                    dialogRef.value.data.submission.id
                )
            )

            dialogRef.value.close()
        },
    })
}
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
