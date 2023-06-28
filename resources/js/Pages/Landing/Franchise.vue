<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import InputText from 'primevue/inputtext'
import InputNumber from 'primevue/inputnumber'
import InputMask from 'primevue/inputmask'

interface FranchisingFormProps {
    [key: string]: unknown
    fullName: string
    address: string
    age?: number
    contactNo: string
    email: string
    targetLocation: string
}

const form = useForm<FranchisingFormProps>({
    fullName: '',
    address: '',
    age: undefined,
    contactNo: '',
    email: '',
    targetLocation: '',
})

const handleSubmit = () => {
    console.log(form.data())
}
</script>

<template>
    <section>
        <Head title="Franchise" />

        <div
            class="h-screen bg-[url('/images/backgrounds/chicken.png')] bg-cover bg-no-repeat bg-opacity-50 bg-primary bg-blend-overlay px-24 py-16"
        >
            <div>
                <Image
                    class="rounded-full shadow-2xl shadow-neutral-900"
                    imageClass="rounded-full"
                    src="/images/logos/logo-2023.jpg"
                    alt="Mei Li Tea House Logo"
                    width="80"
                />

                <div class="grid items-center grid-cols-2">
                    <div>
                        <h1 class="text-6xl font-bold leading-relaxed">
                            Let's make<br />
                            <span class="text-7xl">
                                your
                                <span class="italic text-slate-50"
                                    >Pandasy</span
                                > </span
                            ><br />
                            come true.
                        </h1>

                        <Button
                            size="large"
                            class="mt-8"
                            label="FRANCHISE NOW"
                            rounded
                        />
                    </div>

                    <div>
                        <Image
                            src="/images/products/kung-pao-chicken.png"
                            width="750"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="grid h-screen grid-cols-2 bg-primary">
            <div
                class="bg-[url('/images/backgrounds/pancit.jpg')] bg-cover bg-[-12.5rem] bg-no-repeat"
            ></div>

            <div class="p-16 text-slate-50">
                <h2 class="text-6xl font-bold">All About Mei Li Tea House</h2>

                <p class="mt-16 text-xl leading-relaxed">
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

                <Button
                    class="mt-16"
                    label="CONNECT WITH US"
                    severity="secondary"
                    rounded
                    size="large"
                />
            </div>
        </div>

        <div
            class="grid h-screen grid-cols-2 items-center bg-primary-dark bg-[url('/images/backgrounds/table.png')] bg-no-repeat bg-cover bg-opacity-50 bg-blend-soft-light"
        >
            <div class="h-full p-16">
                <div class="w-3/4 h-full p-6 mx-auto bg-white rounded-3xl">
                    <Image
                        src="/images/stores/render-1.webp"
                        imageClass="object-cover h-3/4"
                    />

                    <p
                        class="mt-16 text-5xl font-bold text-center font-heading text-slate-900"
                    >
                        P750,000
                    </p>
                </div>
            </div>

            <div class="p-16 text-center text-slate-50">
                <h2 class="text-6xl font-bold uppercase">What We Offer</h2>

                <p class="mt-4 text-2xl font-bold">
                    Be part of our fast-growing family!
                </p>

                <div class="mt-8">
                    <p class="text-xl font-bold">
                        Avail our Franchising Package for only
                    </p>

                    <div
                        class="w-1/2 p-4 mx-auto mt-2 rounded-3xl bg-secondary"
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
                    />
                </div>
            </div>
        </div>

        <div class="grid items-center h-screen grid-cols-3 bg-primary-dark">
            <div class="h-full col-span-2 py-16">
                <div
                    class="relative w-5/6 h-full p-6 mx-auto bg-slate-100 rounded-3xl"
                >
                    <Image
                        imageClass="w-full h-full object-cover"
                        src="/images/stores/render-1.webp"
                    />

                    <p class="absolute text-xl font-bold bottom-10 left-10">
                        Sample Store Front View
                    </p>
                </div>
            </div>

            <div class="col-span-1 p-8">
                <p
                    class="w-3/4 mx-auto text-xl font-bold text-center text-slate-50 font-heading"
                >
                    We will help in locating the perfect spot for you.
                </p>

                <form @submit.prevent="handleSubmit()">
                    <div
                        class="p-4 mt-4 rounded-3xl bg-slate-100 text-slate-900"
                    >
                        <p class="text-lg font-bold">
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
                                    unmask
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
            class="h-screen bg-primary-dark bg-[url('/images/backgrounds/table.png')] bg-no-repeat bg-cover bg-opacity-50 bg-blend-soft-light text-slate-50 text-center p-16"
        >
            <h2 class="text-6xl font-bold">Previous Turnovers</h2>

            <p class="mt-4 text-3xl font-bold">
                Wanna see our current branches?
            </p>

            <div class="grid grid-cols-2 gap-8 px-32 mt-16 place-items-center">
                <div class="p-4 bg-slate-50 rounded-3xl">
                    <Image src="/images/stores/sm-bataan.jpg" />

                    <p
                        class="my-16 mt-8 text-3xl font-bold text-center uppercase text-slate-900"
                    >
                        SM Bataan
                    </p>
                </div>

                <div class="p-4 bg-slate-50 rounded-3xl">
                    <Image src="/images/stores/lucky-chinatown.png" />

                    <p
                        class="my-16 mt-8 text-3xl font-bold text-center uppercase text-slate-900"
                    >
                        Lucky China Town
                    </p>
                </div>
            </div>
        </div>
    </section>
</template>
