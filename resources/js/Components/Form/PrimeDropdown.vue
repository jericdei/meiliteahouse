<script setup lang="ts">
import _ from 'lodash'
import Dropdown from 'primevue/dropdown'

const props = defineProps<{
    label: string
    isInvalid?: boolean | string
    invalidText?: string
}>()
</script>

<template>
    <div>
        <div class="p-float-label">
            <Dropdown
                class="w-full"
                :class="{ 'p-invalid': props.isInvalid }"
                v-bind="$attrs"
            >
                <template #option="{ option }">
                    <slot name="option" :option="option" />
                </template>

                <template #value="{ value }">
                    <slot name="value" :value="value" />
                </template>

                <slot />
            </Dropdown>

            <label :for="_.snakeCase(props.label)">{{ props.label }}</label>
        </div>

        <small v-if="props.isInvalid" class="p-error">{{
            props.invalidText
        }}</small>
    </div>
</template>
