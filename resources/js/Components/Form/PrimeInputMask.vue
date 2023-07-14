<script setup lang="ts">
import _ from 'lodash'
import InputMask from 'primevue/inputmask'

const props = defineProps<{
    label: string
    isInvalid?: boolean | string
    invalidText?: string
}>()
</script>

<template>
    <div>
        <div class="p-float-label">
            <InputMask
                class="w-full"
                :class="{ 'p-invalid': props.isInvalid }"
                v-bind="$attrs"
            />

            <label :for="_.snakeCase(props.label)">{{ props.label }}</label>
        </div>

        <small v-if="props.isInvalid" class="p-error">{{
            props.invalidText
        }}</small>
    </div>
</template>
