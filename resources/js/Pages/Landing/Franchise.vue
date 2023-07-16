<script setup lang="ts">
import { FranchisingFormProps } from '@/types/franchising'
import { router, useForm } from '@inertiajs/vue3'
import Dialog from 'primevue/dialog'
import InputMask from 'primevue/inputmask'
import InputNumber from 'primevue/inputnumber'
import InputText from 'primevue/inputtext'
import { ref } from 'vue'
import { useReCaptcha } from 'vue-recaptcha-v3'
import BackButton from './Components/BackButton.vue'

const form = useForm<FranchisingFormProps>({
    fullName: '',
    address: '',
    age: undefined,
    contactNo: '',
    email: '',
    targetLocation: '',
    captchaToken: undefined,
})

const captcha = useReCaptcha()
const isDialogVisible = ref(false)
const dialogMessage = ref('')

const recaptcha = async () => {
    await captcha?.recaptchaLoaded()

    form.captchaToken = await captcha?.executeRecaptcha('login')

    handleSubmit()
}

const handleSubmit = () => {
    form.post(route('site.franchise.store'), {
        preserveScroll: true,
        onSuccess: (page: any) => {
            form.reset()

            isDialogVisible.value = true
            dialogMessage.value = page.props.alert
        },
    })
}

const scrollToForm = () => (location.hash = '#franchising_form')
</script>

<template>
    <section>
        <Head title="Franchise" />

        <Dialog
            class="w-3/4 lg:w-1/2"
            v-model:visible="isDialogVisible"
            modal
            header="Success!"
        >
            <p>{{ dialogMessage }}</p>

            <template #footer>
                <Button
                    label="VISIT OUR WEBSITE"
                    @click="router.get(route('site.home'))"
                    autofocus
                />
            </template>
        </Dialog>

        <div
            class="flex h-screen flex-col justify-center bg-primary bg-opacity-50 bg-[url('/images/backgrounds/chicken.png')] bg-cover bg-no-repeat px-4 py-8 bg-blend-overlay lg:px-24 lg:py-16"
        >
            <div>
                <BackButton />

                <Image
                    class="rounded-full shadow-2xl shadow-neutral-900"
                    imageClass="rounded-full w-16 lg:w-32 mx-auto lg:mx-0"
                    src="/images/logos/logo-2023.jpg"
                    alt="Mei Li Tea House Logo"
                />

                <div
                    class="mt-16 grid grid-cols-1 items-center lg:mt-0 lg:grid-cols-2"
                >
                    <div>
                        <h1
                            class="text-center text-4xl font-bold leading-relaxed lg:text-left lg:text-6xl"
                        >
                            Let's make<br />
                            <span class="text-5xl lg:text-7xl">
                                your
                                <span class="italic text-slate-50"
                                    >Pandasy</span
                                > </span
                            ><br />
                            come true.
                        </h1>

                        <div class="flex justify-center lg:justify-start">
                            <Button
                                size="large"
                                class="mt-8"
                                label="FRANCHISE NOW"
                                rounded
                                @click="scrollToForm()"
                            />
                        </div>
                    </div>

                    <div class="hidden lg:block">
                        <Image
                            src="/images/products/kung-pao-chicken.png"
                            width="750"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 bg-primary lg:h-screen lg:grid-cols-2">
            <div
                class="hidden bg-[url('/images/backgrounds/pancit.jpg')] bg-cover bg-[-12.5rem] bg-no-repeat lg:block"
            ></div>

            <div class="p-8 text-slate-50 lg:p-16">
                <h2
                    class="text-center text-4xl font-bold lg:text-left lg:text-6xl"
                >
                    All About Mei Li Tea House
                </h2>

                <p
                    class="mt-16 text-center text-lg leading-relaxed lg:text-left lg:text-xl"
                >
                    Mei Li Tea House is the newest “tea house” established in
                    the year 2019, that will offer the market with topnotch
                    service, food, and overall quality experience, one customer
                    deserves. Mei Li Tea House will provide top notch Food in
                    sizzling bowl set up. Serving favorite Chinese dishes hot
                    and smoking. Our Goal is to make its name and will be one of
                    the topmost known Sizzling - Chinese option in food court
                    not only in the Philippines, but, throughout the world. Mei
                    Li Tea House is formerly Mei Lin Tea House.
                </p>

                <div class="flex justify-center lg:justify-start">
                    <Button
                        class="mt-16"
                        label="CONNECT WITH US"
                        severity="secondary"
                        rounded
                        size="large"
                        @click="scrollToForm()"
                    />
                </div>
            </div>
        </div>

        <div
            class="grid items-center bg-primary-dark bg-opacity-50 bg-[url('/images/backgrounds/table.png')] bg-cover bg-no-repeat bg-blend-soft-light lg:h-screen lg:grid-cols-2"
        >
            <div class="order-2 h-full p-4 lg:order-1 lg:p-16">
                <div
                    class="mx-auto h-full rounded-3xl bg-white p-4 lg:w-3/4 lg:p-6"
                >
                    <Image
                        src="/images/stores/render-1.webp"
                        imageClass="object-cover h-3/4"
                    />

                    <p
                        class="mt-8 text-center font-heading text-3xl font-bold text-slate-900 lg:mt-16 lg:text-5xl"
                    >
                        P750,000
                    </p>
                </div>
            </div>

            <div
                class="order-1 p-8 text-center text-slate-50 lg:order-2 lg:p-16"
            >
                <h2 class="text-4xl font-bold uppercase lg:text-6xl">
                    What We Offer
                </h2>

                <p class="mt-4 text-2xl font-bold">
                    Be part of our fast-growing family!
                </p>

                <div class="mt-8">
                    <p class="text-xl font-bold">
                        Avail our Franchising Package for only
                    </p>

                    <div
                        class="mx-auto mt-2 rounded-3xl bg-secondary p-4 lg:w-1/2"
                    >
                        <p
                            class="font-heading text-5xl font-bold text-slate-900"
                        >
                            P750,000
                        </p>

                        <p class="font-bold">
                            with 1 <span class="uppercase">Million</span> worth
                            of inclusions!
                        </p>
                    </div>

                    <p class="mt-16 text-3xl font-bold">
                        Secured ROI within 6 months to 1 year!
                    </p>

                    <Button
                        class="mt-8"
                        label="START YOUR FRANCHISE NOW"
                        rounded
                        size="large"
                        @click="scrollToForm()"
                    />
                </div>
            </div>
        </div>

        <div
            class="grid grid-cols-1 items-center bg-primary-dark lg:grid-cols-3"
        >
            <div class="order-2 col-span-2 h-full py-16 lg:order-1">
                <div
                    class="relative mx-auto h-full w-5/6 rounded-3xl bg-slate-100 p-6"
                >
                    <Image
                        imageClass="w-full h-full object-cover"
                        src="/images/stores/render-1.webp"
                    />

                    <p
                        class="absolute bottom-5 left-8 font-bold lg:bottom-10 lg:left-10 lg:text-xl"
                    >
                        Sample Store Front View
                    </p>
                </div>
            </div>

            <div
                id="franchising_form"
                class="order-1 col-span-1 p-8 lg:order-2"
            >
                <p
                    class="mx-auto w-3/4 text-center font-heading text-xl font-bold text-slate-50"
                >
                    We will help in locating the perfect spot for you.
                </p>

                <form @submit.prevent="recaptcha()">
                    <div
                        class="mt-4 rounded-3xl bg-slate-100 p-4 text-slate-900"
                    >
                        <p class="text-center text-lg font-bold lg:text-left">
                            Interested? Fill up the form below.
                        </p>

                        <div class="mt-8 flex flex-col gap-8">
                            <div>
                                <div class="p-float-label">
                                    <InputText
                                        class="w-full"
                                        :class="{
                                            'p-invalid': form.errors.fullName,
                                        }"
                                        v-model="form.fullName"
                                    />
                                    <label for="fullName">Full Name</label>
                                </div>

                                <small
                                    v-if="form.errors.fullName"
                                    class="text-red-700"
                                    >{{ form.errors.fullName }}</small
                                >
                            </div>

                            <div>
                                <div class="p-float-label">
                                    <InputText
                                        class="w-full"
                                        :class="{
                                            'p-invalid': form.errors.address,
                                        }"
                                        v-model="form.address"
                                    />
                                    <label for="address">Address</label>
                                </div>

                                <small
                                    v-if="form.errors.address"
                                    class="text-red-700"
                                    >{{ form.errors.address }}</small
                                >
                            </div>

                            <div>
                                <div class="p-float-label">
                                    <InputNumber
                                        class="w-full"
                                        :class="{
                                            'p-invalid': form.errors.age,
                                        }"
                                        v-model="form.age"
                                    />
                                    <label for="age">Age</label>
                                </div>

                                <small
                                    v-if="form.errors.age"
                                    class="text-red-700"
                                    >{{ form.errors.age }}</small
                                >
                            </div>

                            <div>
                                <div class="p-float-label">
                                    <InputMask
                                        class="w-full"
                                        :class="{
                                            'p-invalid': form.errors.contactNo,
                                        }"
                                        v-model="form.contactNo"
                                        mask="9999-999-9999"
                                    />
                                    <label for="contactNo">Contact No.</label>
                                </div>

                                <small
                                    v-if="form.errors.contactNo"
                                    class="text-red-700"
                                    >{{ form.errors.contactNo }}</small
                                >
                            </div>

                            <div>
                                <div class="p-float-label">
                                    <InputText
                                        class="w-full"
                                        :class="{
                                            'p-invalid': form.errors.email,
                                        }"
                                        v-model="form.email"
                                    />
                                    <label for="email">Email Address</label>
                                </div>

                                <small
                                    v-if="form.errors.email"
                                    class="text-red-700"
                                    >{{ form.errors.email }}</small
                                >
                            </div>

                            <div>
                                <div class="p-float-label">
                                    <InputText
                                        class="w-full"
                                        :class="{
                                            'p-invalid':
                                                form.errors.targetLocation,
                                        }"
                                        v-model="form.targetLocation"
                                    />
                                    <label for="targetLocation"
                                        >Target Location</label
                                    >
                                </div>

                                <small
                                    v-if="form.errors.targetLocation"
                                    class="text-red-700"
                                    >{{ form.errors.targetLocation }}</small
                                >
                            </div>
                        </div>

                        <small
                            v-if="form.errors.captchaToken"
                            class="mt-2 text-center text-red-700"
                            >{{ form.errors.captchaToken }}</small
                        >
                    </div>

                    <div class="flex justify-center">
                        <Button
                            type="submit"
                            class="mt-4 w-3/4"
                            label="SUBMIT"
                            severity="secondary"
                            rounded
                            size="large"
                            @submit.prevent="recaptcha()"
                        />
                    </div>
                </form>
            </div>
        </div>

        <div
            class="bg-primary-dark bg-opacity-50 bg-[url('/images/backgrounds/table.png')] bg-cover bg-no-repeat p-16 text-center text-slate-50 bg-blend-soft-light"
        >
            <h2 class="text-4xl font-bold lg:text-6xl">Previous Turnovers</h2>

            <p class="mt-4 text-2xl font-bold lg:text-3xl">
                Wanna see our current branches?
            </p>

            <div
                class="mt-16 grid place-items-center gap-8 lg:grid-cols-2 lg:px-32"
            >
                <div class="rounded-3xl bg-slate-50 p-4">
                    <Image src="/images/stores/sm-bataan.jpg" />

                    <p
                        class="my-16 mt-8 text-center text-2xl font-bold uppercase text-slate-900 lg:text-3xl"
                    >
                        SM Bataan
                    </p>
                </div>

                <div class="rounded-3xl bg-slate-50 p-4">
                    <Image src="/images/stores/lucky-chinatown.png" />

                    <p
                        class="my-16 mt-8 text-center text-2xl font-bold uppercase text-slate-900 lg:text-3xl"
                    >
                        Lucky China Town
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
