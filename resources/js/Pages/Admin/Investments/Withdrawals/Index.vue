<script setup lang="ts">
import Title from '@/Components/Investments/Title.vue'
import LazyDataTable from '@/Components/LazyDataTable.vue'
import { useDataTableActions } from '@/Composables/datatable'
import { LazyTableProps } from '@/types'
import Column from 'primevue/column'
import { ref } from 'vue'
import _ from 'lodash'
import LazyDataTableColumn from '@/Components/LazyDataTableColumn.vue'

const props = defineProps<{
    withdrawals: LazyTableProps<any>
}>()

const dt = ref()
const datatable = useDataTableActions(
    route('admin.invest.withdrawals.index'),
    {}
)

const columns = [
    { field: 'id', header: 'ID' },
    { field: 'investor', header: 'Investor' },
    { field: 'amount', header: 'Amount' },
    { field: 'status', header: 'Status' },
    { field: 'paymentMethod', header: 'Payment Method' },
    { field: 'accountNumber', header: 'Account No.' },
    { field: 'createdAt', header: 'Created At' },
]
</script>

<template>
    <div>
        <Head title="Withdrawals" />

        <section>
            <Title icon="pi pi-credit-card" class="mb-5">Withdrawals</Title>

            <LazyDataTable
                class="mx-auto my-2"
                ref="dt"
                :value="props.withdrawals.items"
                :totalRecords="props.withdrawals.total"
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
                                :value="_.get(data, col.field)"
                                :isLoading="datatable.loading.value"
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
