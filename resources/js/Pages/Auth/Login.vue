<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Image from 'primevue/image';
import InputText from 'primevue/inputtext';
import Password from 'primevue/password';

const form = useForm({
  email: '',
  password: '',
});

const submit = () => {
  form.post(route('auth.login'), {
    onFinish: () => form.reset('password'),
  });
};
</script>

<template>
  <section class="grid place-items-center h-screen">
    <Head title="Log in" />

    <div class="border border-slate-200 p-5 rounded-xl bg-white">
      <Image
        image-class="mx-auto mb-5"
        src="/images/logos/logo-2023.jpg"
        alt="Mei Li Tea House Logo"
        width="100"
      />

      <form @submit.prevent="submit">
        <div>
          <label for="email" value="Email" />

          <InputText
            class="w-full"
            input-id="email"
            type="email"
            v-model="form.email"
            placeholder="Email"
            required
            autofocus
            autocomplete="username"
          />

          <small class="block text-danger mt-2" v-text="form.errors.email" />
        </div>

        <div class="mt-4">
          <label for="password" value="Password" />

          <Password
            class="w-full"
            input-class="w-full"
            :feedback="false"
            v-model="form.password"
            placeholder="Password"
            toggle-mask
            required
            autocomplete="current-password"
          />

          <small class="block text-danger mt-2" v-text="form.errors.password" />
        </div>

        <div class="flex items-center justify-end mt-4">
          <Button type="submit" label="Log in" :loading="form.processing" />
        </div>
      </form>
    </div>
  </section>
</template>

<style scoped>
:deep(.p-icon) {
  @apply cursor-pointer;
}
</style>
