<script setup lang="ts">
import Title from '@/Components/Investments/Title.vue'
import LazyDataTable from '@/Components/LazyDataTable.vue'
import LazyDataTableColumn from '@/Components/LazyDataTableColumn.vue'
import OccupationTag from '@/Components/OccupationTag.vue'
import StatusTag from '@/Components/StatusTag.vue'
import { useDataTable } from '@/Composables/datatable'
import { dynamicDialogProps } from '@/Config/modal'
import { LazyTableProps } from '@/types'
import { Submission } from '@/types/submission'
import _ from 'lodash'
import Column from 'primevue/column'
import { useDialog } from 'primevue/usedialog'
import { markRaw, ref } from 'vue'
import ShowModal from './Modals/ShowModal.vue'
import ShowModalFooter from './Modals/Templates/ShowModalFooter.vue'

const props = defineProps<{
    submissions: LazyTableProps<Submission>
}>()

const dialog = useDialog()
const dt = ref()
const datatable = useDataTable('system.invest.submissions.index')

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
    <div>
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
                        </div>
                    </template>
                </Column>
            </LazyDataTable>
        </section>
    </div>
</template>

<style scoped>
:deep(.p-datatable-wrapper) {
    @apply rounded-xl;
}

:deep(.p-skeleton) {
    height: 2.5rem !important;
}
</style>
