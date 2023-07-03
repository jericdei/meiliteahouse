<script setup lang="ts">
import Title from '@/Components/Investments/Title.vue'
import LazyDataTable from '@/Components/LazyDataTable.vue'
import { useDataTable } from '@/Composables/datatable'
import { LazyTableProps } from '@/types'
import Column from 'primevue/column'
import { ref } from 'vue'
import _ from 'lodash'
import LazyDataTableColumn from '@/Components/LazyDataTableColumn.vue'

const props = defineProps<{
    investments: LazyTableProps<any>
}>()

const dt = ref()
const datatable = useDataTable('admin.invest.investments.index')

const columns = [
    { field: 'id', header: 'ID' },
    { field: 'investor', header: 'Investor' },
    { field: 'amount', header: 'Amount' },
    { field: 'status', header: 'Status' },
    { field: 'paymentMethod', header: 'Payment Method' },
    { field: 'referenceNo', header: 'Reference No.' },
    { field: 'createdAt', header: 'Created At' },
]
</script>

<template>
    <div>
        <Head title="Investments" />

        <section>
            <Title icon="pi pi-money-bill" class="mb-5">Investments</Title>

            <LazyDataTable
                class="mx-auto my-2"
                ref="dt"
                :value="props.investments.items"
                :totalRecords="props.investments.total"
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
