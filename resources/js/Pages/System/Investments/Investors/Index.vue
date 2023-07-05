<script setup lang="ts">
import Title from '@/Components/Investments/Title.vue'
import LazyDataTable from '@/Components/LazyDataTable.vue'
import LazyDataTableColumn from '@/Components/LazyDataTableColumn.vue'
import { useDataTable } from '@/Composables/datatable'
import { LazyTableProps } from '@/types'
import _ from 'lodash'
import Column from 'primevue/column'
import { ref } from 'vue'

const props = defineProps<{
    investors: LazyTableProps<any>
}>()

const dt = ref()
const datatable = useDataTable('system.invest.investors.index')

const columns = [
    { field: 'id', header: 'ID' },
    { field: 'fullName', header: 'Full Name' },
    { field: 'status', header: 'Status' },
    { field: 'classification', header: 'Classification' },
    { field: 'referralCode', header: 'Referral Code' },
    { field: 'age', header: 'Age' },
    { field: 'occupation.type', header: 'Occupation' },
    { field: 'createdAt', header: 'Created At' },
]
</script>

<template>
    <div>
        <Head title="Investors" />

        <section>
            <Title icon="pi pi-id-card" class="mb-5">Investors</Title>

            <LazyDataTable
                class="mx-auto my-2"
                ref="dt"
                :value="props.investors.items"
                :totalRecords="props.investors.total"
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
