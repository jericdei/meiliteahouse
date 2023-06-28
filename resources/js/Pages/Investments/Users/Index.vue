<script setup lang="ts">
import Title from '@/Components/Investments/Title.vue'
import LazyDataTable from '@/Components/LazyDataTable.vue'
import { useDataTableActions } from '@/Composables/datatable'
import { LazyTableProps } from '@/types'
import type { User } from '@/types/user'
import Column from 'primevue/column'
import { onMounted } from 'vue'
import { ref } from 'vue'
import _ from 'lodash'
import LazyDataTableColumn from '@/Components/LazyDataTableColumn.vue'

const props = withDefaults(
    defineProps<{
        users: LazyTableProps<User>
    }>(),
    {
        users: undefined,
    }
)

const dt = ref()
const datatable = useDataTableActions(route('invest.users.index'), {})

const columns = [
    { field: 'id', header: 'ID' },
    { field: 'fullName', header: 'Full Name' },
    { field: 'contactNo', header: 'Contact No.' },
    { field: 'email', header: 'Email' },
    { field: 'role', header: 'Role' },
]

onMounted(() => datatable.getData())
</script>

<template>
    <div>
        <Head title="Users" />

        <section>
            <Title icon="pi pi-user" class="mb-5">Users</Title>

            <LazyDataTable
                class="mx-auto my-2"
                ref="dt"
                :value="props.users.items"
                :totalRecords="props.users.total"
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
