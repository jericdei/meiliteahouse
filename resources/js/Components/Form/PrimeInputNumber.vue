<script setup lang="ts">
import _ from 'lodash'
import InputNumber from 'primevue/inputnumber'

const props = defineProps<{
    label: string
    isInvalid?: boolean | string
    invalidText?: string
    isInputGroup?: boolean
}>()
</script>

<template>
    <div>
        <div
            class="p-float-label"
            :class="{ 'p-inputgroup flex': props.isInputGroup }"
        >
            <InputNumber
                class="w-full"
                inputClass="w-full"
                :class="{ 'p-invalid': props.isInvalid }"
                v-bind="$attrs"
            />

            <label :for="_.snakeCase(props.label)">{{ props.label }}</label>

            <slot />
        </div>

        <small v-if="props.isInvalid" class="p-error">{{
            props.invalidText
        }}</small>
    </div>
</template>
