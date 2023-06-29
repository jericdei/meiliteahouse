<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import InputText from 'primevue/inputtext'
import InputNumber from 'primevue/inputnumber'
import InputMask from 'primevue/inputmask'
import Dialog from 'primevue/dialog'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import { FranchisingFormProps } from '@/types/franchising'

const form = useForm<FranchisingFormProps>({
    fullName: '',
    address: '',
    age: undefined,
    contactNo: '',
    email: '',
    targetLocation: '',
})

const isDialogVisible = ref(false)
const dialogMessage = ref('')

const handleSubmit = () => {
    form.post(route('site.franchise.store'), {
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
            class="flex flex-col justify-center h-screen bg-[url('/images/backgrounds/chicken.png')] bg-cover bg-no-repeat bg-opacity-50 bg-primary bg-blend-overlay px-4 py-8 lg:px-24 lg:py-16"
        >
            <div>
                <Image
                    class="rounded-full shadow-2xl shadow-neutral-900"
                    imageClass="rounded-full w-16 lg:w-32 mx-auto lg:mx-0"
                    src="/images/logos/logo-2023.jpg"
                    alt="Mei Li Tea House Logo"
                />

                <div
                    class="grid items-center grid-cols-1 mt-16 lg:grid-cols-2 lg:mt-0"
                >
                    <div>
                        <h1
                            class="text-4xl font-bold leading-relaxed text-center lg:text-left lg:text-6xl"
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

        <div class="grid grid-cols-1 lg:h-screen lg:grid-cols-2 bg-primary">
            <div
                class="bg-[url('/images/backgrounds/pancit.jpg')] bg-cover bg-[-12.5rem] bg-no-repeat hidden lg:block"
            ></div>

            <div class="p-8 lg:p-16 text-slate-50">
                <h2
                    class="text-4xl font-bold text-center lg:text-left lg:text-6xl"
                >
                    All About Mei Li Tea House
                </h2>

                <p
                    class="mt-16 text-lg leading-relaxed text-center lg:text-xl lg:text-left"
                >
                    Mei Li Tea House is the newest “tea house” established in
                    the year 2019, that will offer the market with topnotch
                    service, food, and overall quality experience, one customer
                    deserves. Mei Lin Tea House will provide top notch Food in
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
            class="grid lg:h-screen lg:grid-cols-2 items-center bg-primary-dark bg-[url('/images/backgrounds/table.png')] bg-no-repeat bg-cover bg-opacity-50 bg-blend-soft-light"
        >
            <div class="order-2 h-full p-4 lg:p-16 lg:order-1">
                <div
                    class="h-full p-4 mx-auto bg-white lg:w-3/4 lg:p-6 rounded-3xl"
                >
                    <Image
                        src="/images/stores/render-1.webp"
                        imageClass="object-cover h-3/4"
                    />

                    <p
                        class="mt-8 text-3xl font-bold text-center lg:mt-16 lg:text-5xl font-heading text-slate-900"
                    >
                        P750,000
                    </p>
                </div>
            </div>

            <div
                class="order-1 p-8 text-center lg:p-16 text-slate-50 lg:order-2"
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
                        class="p-4 mx-auto mt-2 lg:w-1/2 rounded-3xl bg-secondary"
                    >
                        <p
                            class="text-5xl font-bold text-slate-900 font-heading"
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
            class="grid items-center grid-cols-1 lg:grid-cols-3 bg-primary-dark"
        >
            <div class="order-2 h-full col-span-2 py-16 lg:order-1">
                <div
                    class="relative w-5/6 h-full p-6 mx-auto bg-slate-100 rounded-3xl"
                >
                    <Image
                        imageClass="w-full h-full object-cover"
                        src="/images/stores/render-1.webp"
                    />

                    <p
                        class="absolute font-bold lg:text-xl bottom-5 lg:bottom-10 left-8 lg:left-10"
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
                    class="w-3/4 mx-auto text-xl font-bold text-center text-slate-50 font-heading"
                >
                    We will help in locating the perfect spot for you.
                </p>

                <form @submit.prevent="handleSubmit()">
                    <div
                        class="p-4 mt-4 rounded-3xl bg-slate-100 text-slate-900"
                    >
                        <p class="text-lg font-bold text-center lg:text-left">
                            Interested? Fill up the form below.
                        </p>

                        <div class="flex flex-col gap-8 mt-8">
                            <div class="p-float-label">
                                <InputText
                                    class="w-full"
                                    v-model="form.fullName"
                                />

                                <label for="fullName">Full Name</label>
                            </div>

                            <div class="p-float-label">
                                <InputText
                                    class="w-full"
                                    v-model="form.address"
                                />

                                <label for="address">Address</label>
                            </div>

                            <div class="p-float-label">
                                <InputNumber
                                    class="w-full"
                                    v-model="form.age"
                                />

                                <label for="age">Age</label>
                            </div>

                            <div class="p-float-label">
                                <InputMask
                                    class="w-full"
                                    v-model="form.contactNo"
                                    mask="9999-999-9999"
                                />

                                <label for="contactNo">Contact No.</label>
                            </div>

                            <div class="p-float-label">
                                <InputText
                                    class="w-full"
                                    v-model="form.email"
                                />

                                <label for="email">Email Address</label>
                            </div>

                            <div class="p-float-label">
                                <InputText
                                    class="w-full"
                                    v-model="form.targetLocation"
                                />

                                <label for="targetLocation"
                                    >Target Location</label
                                >
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <Button
                            type="submit"
                            class="w-3/4 mt-4"
                            label="SUBMIT"
                            severity="secondary"
                            rounded
                            size="large"
                            @submit.prevent="handleSubmit()"
                        />
                    </div>
                </form>
            </div>
        </div>

        <div
            class="bg-primary-dark bg-[url('/images/backgrounds/table.png')] bg-no-repeat bg-cover bg-opacity-50 bg-blend-soft-light text-slate-50 text-center p-16"
        >
            <h2 class="text-4xl font-bold lg:text-6xl">Previous Turnovers</h2>

            <p class="mt-4 text-2xl font-bold lg:text-3xl">
                Wanna see our current branches?
            </p>

            <div
                class="grid gap-8 mt-16 lg:grid-cols-2 lg:px-32 place-items-center"
            >
                <div class="p-4 bg-slate-50 rounded-3xl">
                    <Image src="/images/stores/sm-bataan.jpg" />

                    <p
                        class="my-16 mt-8 text-2xl font-bold text-center uppercase lg:text-3xl text-slate-900"
                    >
                        SM Bataan
                    </p>
                </div>

                <div class="p-4 bg-slate-50 rounded-3xl">
                    <Image src="/images/stores/lucky-chinatown.png" />

                    <p
                        class="my-16 mt-8 text-2xl font-bold text-center uppercase lg:text-3xl text-slate-900"
                    >
                        Lucky China Town
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
