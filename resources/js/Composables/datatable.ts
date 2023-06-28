import { DataTableSortEvent } from 'primevue/datatable'
import _ from 'lodash'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

export interface Params {
    page: number
    perPage: number
    filters?: Object
    sorts?: {
        field: DataTableSortEvent['sortField']
        order: DataTableSortEvent['sortOrder']
    }
}

export function useDataTableActions(
    filters: Params['filters'],
    only: string[]
) {
    const loading = ref<Boolean>(false)

    const params = ref<Params>({
        page: 1,
        perPage: 10,
    })

    const getData = (): void => {
        let query: any = _.omitBy(params.value, _.isNil)

        loading.value = true

        router.reload({
            data: { ...query },
            only: only,
            preserveState: true,
            replace: true,
            onFinish: () => (loading.value = false),
        })
    }

    const paginate = (
        page: Params['page'],
        perPage: Params['perPage']
    ): void => {
        params.value.page = page
        params.value.perPage = perPage

        getData()
    }

    const filter = (): void => {
        paginate(1, params.value.perPage)
    }

    const sort = (event: DataTableSortEvent): void => {
        params.value.sorts = {
            field: event.sortField,
            order: event.sortOrder,
        }

        getData()
    }

    const clearFilters = (): void => {
        params.value.filters = filters

        paginate(1, params.value.perPage)
    }

    return {
        loading,
        params,
        getData,
        paginate,
        filter,
        sort,
        clearFilters,
    }
}
