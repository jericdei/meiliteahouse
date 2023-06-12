<script setup lang="ts">
import Column from 'primevue/column';
import DataTable from 'primevue/datatable';
import Skeleton from 'primevue/skeleton';
import { ref } from 'vue';

interface ColumnProps {
  header: string;
  field: any;
}

const props = defineProps<{
  rows: number;
  columns: ColumnProps[];
}>();

const items = ref(new Array(props.rows));
</script>

<template>
  <DataTable :value="items">
    <Column v-for="col in props.columns" :header="col.header">
      <template #body>
        <Skeleton></Skeleton>
      </template>
    </Column>
  </DataTable>
</template>

<style scoped>
:deep(.p-skeleton) {
  height: 2.5rem !important;
}
</style>
