<script setup lang="ts">
import _ from 'lodash'
import FileUpload from 'primevue/fileupload'

const props = defineProps<{
    label: string
    isInvalid?: boolean | string
    invalidText?: string
}>()
</script>

<template>
    <div>
        <div class="w-full px-1">
            <label
                class="w-full"
                :class="{ 'p-error': props.isInvalid }"
                :for="_.snakeCase(props.label)"
                >{{ props.label }}</label
            >

            <FileUpload
                class="w-full"
                mode="basic"
                chooseLabel="Upload"
                v-bind="$attrs"
            />
        </div>

        <small v-if="props.isInvalid" class="p-error">{{
            props.invalidText
        }}</small>
    </div>
</template>
