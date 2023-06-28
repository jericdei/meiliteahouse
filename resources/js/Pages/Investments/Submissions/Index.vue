<script setup lang="ts">
import LazyDataTable from '@/Components/LazyDataTable.vue'
import LazyDataTableColumn from '@/Components/LazyDataTableColumn.vue'
import { Submission } from '@/types/submission'
import Column from 'primevue/column'
import { onMounted, ref, markRaw, onUpdated } from 'vue'
import _ from 'lodash'
import Title from '@/Components/Investments/Title.vue'
import { LazyTableProps } from '@/types'
import { useDataTableActions } from '@/Composables/datatable'
import { useDialog } from 'primevue/usedialog'
import ShowModal from './Modals/ShowModal.vue'
import { dynamicDialogProps } from '@/Config/modal'
import ShowModalFooter from './Modals/Templates/ShowModalFooter.vue'
import { router } from '@inertiajs/vue3'
import StatusTag from '@/Components/StatusTag.vue'
import OccupationTag from '@/Components/OccupationTag.vue'

const props = withDefaults(
    defineProps<{
        submissions: LazyTableProps<Submission>
    }>(),
    {
        submissions: undefined,
    }
)

const dialog = useDialog()
const dt = ref()

const datatable = useDataTableActions({}, ['submissions'])

const columns = [
    { field: 'id', header: 'ID' },
    { field: 'fullName', header: 'Full Name' },
    { field: 'contactNo', header: 'Contact No.' },
    { field: 'email', header: 'Email' },
    { field: 'age', header: 'Age' },
    { field: 'referredBy', header: 'Referral' },
    { field: 'occupation.type', header: 'Occupation' },
    { field: 'initialInvestment.amount', header: 'Investment Amount' },
    { field: 'status', header: 'Status' },
]

onMounted(() => datatable.getData())

const showSubmissionModal = (submission: Submission) => {
    dialog.open(ShowModal, {
        props: {
            ...dynamicDialogProps,
            header: `Submission ID: ${submission.id}`,
            position: 'center',
            closeOnEscape: true,
            style: {
                width: '75%',
            },
        },
        templates: {
            footer: markRaw(ShowModalFooter),
        },
        data: {
            submission,
        },
    })
}
</script>

<template>
    <Head title="Submissions" />

    <section>
        <Title icon="pi pi-list" class="mb-5">Submissions</Title>

        <LazyDataTable
            class="mx-auto my-2"
            ref="dt"
            :value="props.submissions.items"
            :totalRecords="props.submissions.total"
            :isLoading="datatable.loading"
            :rows="10"
            :rowsPerPageOptions="[10, 25, 50, 100]"
            @page="datatable.paginate($event.page + 1, $event.rows)"
        >
            <Column
                v-for="col in columns"
                :header="col.header"
                :key="col.field"
            >
                <template #body="{ data }">
                    <div>
                        <LazyDataTableColumn
                            v-if="col.field === 'status'"
                            :value="_.get(data, col.field)"
                            :isLoading="datatable.loading.value"
                        >
                            <template #content="{ value }">
                                <StatusTag :status="value" />
                            </template>
                        </LazyDataTableColumn>

                        <LazyDataTableColumn
                            v-else-if="col.field === 'occupation.type'"
                            :value="_.get(data, col.field)"
                            :isLoading="datatable.loading.value"
                        >
                            <template #content="{ value }">
                                <OccupationTag :occupation="value" />
                            </template>
                        </LazyDataTableColumn>

                        <LazyDataTableColumn
                            v-else
                            :value="_.get(data, col.field)"
                            :isLoading="datatable.loading.value"
                        />
                    </div>
                </template>
            </Column>

            <Column header="Actions">
                <template #body="{ data }">
                    <div class="flex">
                        <Button
                            severity="success"
                            icon="pi pi-eye"
                            text
                            rounded
                            v-tooltip.top="'View'"
                            @click="showSubmissionModal(data)"
                        />

                        <Button
                            severity="info"
                            icon="pi pi-pencil"
                            text
                            rounded
                            v-tooltip.top="'Edit'"
                        />

                        <Button
                            severiry="danger"
                            icon="pi pi-trash"
                            text
                            rounded
                            v-tooltip.top="'Delete'"
                        />
                    </div>
                </template>
            </Column>
        </LazyDataTable>
    </section>
</template>

<style scoped>
:deep(.p-datatable-wrapper) {
    @apply rounded-xl;
}

:deep(.p-skeleton) {
    height: 2.5rem !important;
}
</style>
