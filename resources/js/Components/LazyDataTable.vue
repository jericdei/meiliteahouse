<script setup lang="ts">
import type { Ref } from 'vue';
import type { DataTableProps } from 'primevue/datatable';
import DataTable from 'primevue/datatable';
import { ref } from 'vue';

const table = ref();

defineExpose<{
  table: Ref<DataTableProps>;
}>({ table });
</script>

<template>
  <DataTable
    ref="table"
    class="p-datatable-sm"
    stripedRows
    lazy
    paginator
    removableSort
    paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
    currentPageReportTemplate="{first} to {last} of {totalRecords}"
    v-bind="$attrs"
  >
    <template v-for="slotName in Object.keys($slots)" :slot="slotName">
      <slot :name="slotName" />
    </template>

    <template #empty>
      <p class="p-2 mt-3 text-center">No data available.</p>
    </template>
  </DataTable>
</template>

<style>
.p-datatable.p-datatable-sm .p-datatable-tbody tr td,
.p-datatable .p-column-header-content {
  justify-content: center;
  text-align: center;
}
</style>
