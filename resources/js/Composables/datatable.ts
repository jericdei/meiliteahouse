import { router } from '@inertiajs/vue3'
import _ from 'lodash'
import { DataTableSortEvent } from 'primevue/datatable'
import { ref } from 'vue'

export interface Params {
    page: number
    perPage: number
    filters?: Object
    sorts?: {
        field: DataTableSortEvent['sortField']
        order: DataTableSortEvent['sortOrder']
    }[]
}

export function useDataTable(
    routeName: string,
    options?: {
        filters?: Params['filters']
        sorts?: Params['sorts']
    }
) {
    const loading = ref<Boolean>(false)

    const params = ref<Params>({
        page: 1,
        perPage: 10,
        filters: options?.filters,
        sorts: options?.sorts,
    })

    const getData = (): void => {
        let query: any = _.omitBy(params.value, _.isNil)

        loading.value = true

        router.get(
            route(routeName),
            { ...query },
            {
                preserveState: true,
                preserveScroll: true,
                replace: true,
                onFinish: () => (loading.value = false),
            }
        )
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
        params.value.sorts?.push({
            field: event.sortField,
            order: event.sortOrder,
        })

        getData()
    }

    const clearFilters = (): void => {
        params.value.filters = {}

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
