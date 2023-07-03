<script setup lang="ts">
import Title from '@/Components/Investments/Title.vue'
import { useDataTable } from '@/Composables/datatable'
import { LazyTableProps } from '@/types'
import { FranchisingFormProps } from '@/types/franchising'
import { ref } from 'vue'
import _ from 'lodash'
import LazyDataTable from '@/Components/LazyDataTable.vue'
import LazyDataTableColumn from '@/Components/LazyDataTableColumn.vue'
import Column from 'primevue/column'

const props = defineProps<{
    submissions: LazyTableProps<FranchisingFormProps>
}>()

const dt = ref()
const datatable = useDataTable('admin.franchise.submissions.index', {})

const columns = [
    { field: 'id', header: 'ID' },
    { field: 'fullName', header: 'Full Name' },
    { field: 'address', header: 'Address' },
    { field: 'age', header: 'Age' },
    { field: 'contactNo', header: 'Contact No.' },
    { field: 'email', header: 'Email' },
    { field: 'targetLocation', header: 'Target Location' },
]
</script>

<template>
    <div>
        <Head title="Franchising Submissions" />

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
