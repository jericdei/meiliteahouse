import { router } from '@inertiajs/vue3';
import { ref } from 'vue';

export function useDataTableActions(dt, route, filters) {
    const loading = ref(false);

    const params = ref({
        page: 1,
        perPage: 15,
        filters: {},
    });

    const removeNullValues = (items) => {
        return Object.keys(items).forEach((key) => {
            if (items[key] == null || items[key] === '') {
                delete items[key];
            } else if (typeof items[key] == 'object') {
                let object = items[key];

                Object.keys(object).forEach((key) => {
                    if (
                        object[key] == null ||
                        object[key] === '' ||
                        object[key] === false
                    ) {
                        delete object[key];
                    }
                });
            }
        });
    };

    const getData = () => {
        let query = params.value;

        loading.value = true;

        removeNullValues(query);

        router.get(
            route,
            { ...query },
            {
                preserveState: true,
                replace: true,
                onFinish: () => (loading.value = false),
            }
        );
    };

    const paginate = (page, perPage) => {
        params.value.page = page;
        params.value.perPage = perPage;

        getData();
    };

    const filter = () => {
        dt.value.resetPage();

        paginate(1, params.value.perPage);
    };

    const sort = (event) => {
        params.value.sort = {
            field: event.sortField,
            order: event.sortOrder,
        };

        getData();
    };

    const clearFilters = () => {
        params.value.filters = filters;

        dt.value.resetPage();

        paginate(1, params.value.perPage);
    };

    return {
        loading,
        removeNullValues,
        getData,
        paginate,
        filter,
        sort,
        clearFilters,
    };
}
