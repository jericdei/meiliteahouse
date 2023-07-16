<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import Image from 'primevue/image'
import InputText from 'primevue/inputtext'
import Password from 'primevue/password'

const form = useForm({
    email: '',
    password: '',
})

const submit = () => {
    form.post(route('auth.login'), {
        onFinish: () => form.reset('password'),
    })
}
</script>

<template>
    <section class="grid h-screen place-items-center">
        <Head title="Log in" />

        <div class="rounded-xl border border-slate-200 bg-white p-5">
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

                    <small
                        class="mt-2 block text-danger"
                        v-text="form.errors.email"
                    />
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

                    <small
                        class="mt-2 block text-danger"
                        v-text="form.errors.password"
                    />
                </div>

                <div class="mt-4 flex items-center justify-end">
                    <Button
                        type="submit"
                        label="Log in"
                        :loading="form.processing"
                    />
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
