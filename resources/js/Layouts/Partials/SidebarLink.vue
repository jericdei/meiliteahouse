<script setup lang="ts">
const props = defineProps<{
    isSidebarActive: boolean
    isActiveLink: boolean
    icon: string
    href: string
    label: string
}>()
</script>

<template>
    <Link
        class="w-full cursor-pointer px-8 py-5 font-heading transition-all"
        :class="{
            'justify-center border-l-4 border-l-secondary bg-slate-50/[0.1]':
                props.isActiveLink,
        }"
        :href="props.href"
    >
        <span
            class="flex items-center gap-5"
            :class="props.isSidebarActive ? 'justify-start' : 'justify-center'"
        >
            <i
                class="text-4xl"
                :class="[
                    props.icon,
                    props.isActiveLink ? 'text-secondary' : '',
                ]"
            ></i>

            <span
                :class="{ 'font-bold': props.isActiveLink }"
                v-if="props.isSidebarActive"
                >{{ props.label }}</span
            >
        </span>
    </Link>
</template>
