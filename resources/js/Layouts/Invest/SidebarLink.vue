<script setup lang="ts">
const props = defineProps<{
  isSidebarActive: boolean;
  isActiveLink: boolean;
  icon: string;
  href: string;
  label: string;
}>();
</script>

<template>
  <Link
    class="w-full px-8 py-5 transition-all cursor-pointer font-heading"
    :class="{
      'bg-slate-50/[0.1] border-l-4 border-l-secondary justify-center':
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
        :class="[props.icon, props.isActiveLink ? 'text-secondary' : '']"
      ></i>

      <span
        :class="{ 'font-bold': props.isActiveLink }"
        v-if="props.isSidebarActive"
        >{{ props.label }}</span
      >
    </span>
  </Link>
</template>
