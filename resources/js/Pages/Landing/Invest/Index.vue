<script setup lang="ts">
import PrimeDropdown from '@/Components/Form/PrimeDropdown.vue'
import PrimeInputMask from '@/Components/Form/PrimeInputMask.vue'
import PrimeInputNumber from '@/Components/Form/PrimeInputNumber.vue'
import PrimeInputText from '@/Components/Form/PrimeInputText.vue'
import { router, useForm } from '@inertiajs/vue3'
import Dialog from 'primevue/dialog'
import { ref } from 'vue'
import { useBreakpointTailwindCSS } from 'vue-composable'
import { useReCaptcha } from 'vue-recaptcha-v3'
import BackButton from '../Components/BackButton.vue'
import ClassificationCard from './Components/ClassificationCard.vue'
import PaymentChannelCard from './Components/PaymentChannelCard.vue'

const captcha = useReCaptcha()
const tw = useBreakpointTailwindCSS()

const form = useForm<{
    full_name: string
    address: string
    age?: number
    contact_no: string
    email: string
    referral_code: string
    captcha_token?: string
    occupation:
        | {
              type?: 'student'
              school_name: string
              school_address: string
              school_contact_no: string
              course_year: string
          }
        | {
              type?: 'working'
              company_name: string
              company_address: string
              company_contact_no: string
              position: string
              years_employed?: number
          }
}>({
    full_name: '',
    address: '',
    age: undefined,
    contact_no: '',
    email: '',
    referral_code: '',
    occupation: {
        type: undefined,
        school_name: '',
        school_address: '',
        school_contact_no: '',
        course_year: '',
        company_name: '',
        company_address: '',
        company_contact_no: '',
        position: '',
        years_employed: undefined,
    },
})

const isDialogVisible = ref(false)
const dialogMessage = ref('')

const recaptcha = async () => {
    await captcha?.recaptchaLoaded()

    form.captcha_token = await captcha?.executeRecaptcha('login')

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

const scrollToForm = () => (location.hash = '#investment_form')

const paymentChannels = [
    {
        imageLink: '/images/logos/gcash.png',
        accountNumber: '09554580219',
        accountName: 'Elenita Co',
    },
    {
        imageLink: '/images/logos/maya.png',
        accountNumber: '09198161011',
        accountName: 'Cyruss Co',
    },
    {
        imageLink: '/images/logos/cbs.png',
        accountNumber: '601500000353',
        accountName: 'Morning Empress Food OPC',
    },
    {
        imageLink: '/images/logos/bdo.png',
        accountNumber: '001660340883',
        accountName: 'Elenita Co',
    },
]
</script>

<template>
    <section>
        <Head title="Invest" />

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

        <BackButton />

        <div
            class="relative flex flex-col justify-center px-4 py-8 bg-slate-200 lg:px-24 lg:py-16"
        >
            <div
                class="grid items-center grid-cols-1 mt-16 lg:grid-cols-2 lg:mt-0"
            >
                <div>
                    <Image
                        class="rounded-full shadow-2xl shadow-neutral-900"
                        imageClass="rounded-full w-16 lg:w-32 mx-auto lg:mx-0"
                        src="/images/logos/logo-2023.jpg"
                        alt="Mei Li Tea House Logo"
                    />

                    <h1
                        class="mt-16 text-4xl font-bold leading-relaxed text-center uppercase text-primary lg:text-left lg:text-7xl"
                    >
                        Invest in your Pandasy.
                    </h1>

                    <div class="flex justify-center mt-4 lg:justify-start">
                        <p class="lg:text-2xl">
                            Invest now and refer to your friends to increase
                            your investment!
                        </p>
                    </div>
                </div>

                <div class="justify-center hidden lg:flex">
                    <Image
                        class="absolute bottom-0 mx-auto"
                        src="/images/invest/flower-money.png"
                        width="400"
                    />
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center py-4 bg-primary">
            <Image src="/images/invest/panda.png" width="50" />
        </div>

        <div class="relative">
            <div class="grid text-center lg:grid-cols-2">
                <div
                    class="flex flex-col justify-center pt-24 pb-16 px-4 bg-secondary text-slate-50"
                >
                    <p class="max-w-lg mx-auto font-bold uppercase lg:text-3xl">
                        Mei Li Tea House is looking for investors!
                    </p>

                    <p class="lg:text-xl">
                        (Students are allowed. Applicable 16 years old and
                        above)
                    </p>
                </div>

                <div class="py-12 px-4 bg-slate-50 text-slate-900">
                    <p class="max-w-lg mx-auto lg:text-3xl">
                        Get to invest a minimum of P1,000. Get an 8% annual
                        return and freebies as per post, upon registering.
                    </p>
                </div>
            </div>

            <div class="flex justify-center">
                <div
                    class="absolute top-0 p-5 rounded-b-[3rem] text-slate-50 bg-primary"
                >
                    <p class="font-bold uppercase lg:text-xl">
                        Start Investing
                    </p>
                </div>
            </div>
        </div>

        <div class="py-8 bg-zinc-800 text-slate-50">
            <p class="max-w-5xl mx-auto text-center uppercase lg:text-3xl">
                Proceeds will be used for franchise a loan system and expansion
                of Mei Li Tea House.
            </p>
        </div>

        <div
            class="py-16 bg-center bg-no-repeat bg-cover gradient-bg text-slate-50"
        >
            <h2 class="font-bold text-center uppercase text-2xl lg:text-5xl">
                Investor Classifications
            </h2>

            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-4 px-4 lg:px-16 xl:px-32 mt-8 lg:grid-cols-3"
            >
                <ClassificationCard
                    classification="investor"
                    :list="['P1,000', '8% interest per annum']"
                />

                <ClassificationCard
                    classification="bronze"
                    :list="[
                        'P5,000',
                        '8% interest per annum',
                        'Get 2.5% of total investment of referred investors (cash out or invest it)',
                    ]"
                />

                <ClassificationCard
                    classification="silver"
                    :list="[
                        'P7,500',
                        '8% interest per annum',
                        'Get 5% of total investment of referred investors (cash out or invest it)',
                    ]"
                />

                <ClassificationCard
                    classification="gold"
                    :list="[
                        'P10,000',
                        '8% interest per annum',
                        'Get 7.5% of total investment of referred investors (cash out or invest it)',
                        'Certificate with Contract',
                    ]"
                />

                <ClassificationCard
                    class="col-span-1 lg:col-span-2"
                    classification="diamond"
                    :list="[
                        'P25,000',
                        '8% interest per annum',
                        'Get 10% of total investment of referred investors (cash out or invest it)',
                        '20% off to all branches (FREE MEMBERSHIP)',
                        'Diamond Merchandise Package',
                        'Certificate with Contract',
                        'Gather 1,500,000 (worth of investors) then open your own food court branch!',
                    ]"
                    :isTwoSpan="tw.lg.value"
                />
            </div>
        </div>

        <div
            class="flex flex-col lg:flex-row items-center justify-center gap-16 py-16 bg-primary/60 text-slate-50"
        >
            <div
                class="grid grid-flow-row grid-cols-1 xl:grid-cols-2 px-4 col-span-4 gap-4 auto-rows-fr order-2 lg:order-1"
            >
                <PaymentChannelCard
                    v-for="(item, index) in paymentChannels"
                    :key="index"
                    :imageLink="item.imageLink"
                    :accountNumber="item.accountNumber"
                    :accountName="item.accountName"
                />
            </div>

            <div class="flex justify-start xl:col-span-2 order-1 lg:order-2">
                <h2
                    class="font-bold text-center uppercase text-3xl md:text-5xl lg:text-7xl max-w-[8ch] mx-auto"
                >
                    Payment Channels
                </h2>
            </div>
        </div>

        <div
            class="grid items-center grid-cols-1 lg:grid-cols-3 bg-primary-dark"
        >
            <div id="investment_form" class="col-span-2 p-8">
                <form @submit.prevent="recaptcha()">
                    <div
                        class="p-4 mt-4 rounded-3xl bg-slate-100 text-slate-900"
                    >
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
                            <div>
                                <p
                                    class="lg:text-lg font-bold text-center lg:text-left"
                                >
                                    Interested? Fill up the form below.
                                </p>

                                <div class="flex flex-col gap-8 py-8">
                                    <PrimeInputText
                                        v-model="form.full_name"
                                        label="Full Name"
                                        :isInvalid="form.errors.full_name"
                                        :invalidText="form.errors.full_name"
                                    />

                                    <PrimeInputText
                                        v-model="form.address"
                                        label="Address"
                                        :isInvalid="form.errors.address"
                                        :invalidText="form.errors.address"
                                    />

                                    <PrimeInputNumber
                                        v-model="form.age"
                                        label="Age"
                                        :isInvalid="form.errors.age"
                                        :invalidText="form.errors.age"
                                    />

                                    <PrimeInputMask
                                        v-model="form.contact_no"
                                        label="Contact No."
                                        :isInvalid="form.errors.contact_no"
                                        :invalidText="form.errors.contact_no"
                                        mask="9999-999-9999"
                                    />

                                    <PrimeInputText
                                        v-model="form.referral_code"
                                        label="Referral Code (if any)"
                                        :isInvalid="form.errors.referral_code"
                                        :invalidText="form.errors.referral_code"
                                    />
                                </div>

                                <div class="flex flex-col gap-8 py-8">
                                    <PrimeDropdown
                                        v-model="form.occupation.type"
                                        label="Occupation"
                                        :isInvalid="form.errors.occupation"
                                        :invalidText="form.errors.occupation"
                                        :options="[
                                            {
                                                label: 'Student',
                                                value: 'student',
                                            },
                                            {
                                                label: 'Employed / Business',
                                                value: 'working',
                                            },
                                        ]"
                                        optionLabel="label"
                                        optionValue="value"
                                    />

                                    <div
                                        v-if="
                                            form.occupation.type === 'student'
                                        "
                                        class="flex flex-col gap-8"
                                    >
                                        <PrimeInputText
                                            v-model="
                                                form.occupation.school_name
                                            "
                                            label="School Name"
                                            :isInvalid="form.errors.occupation"
                                            :invalidText="
                                                form.errors.occupation
                                            "
                                        />
                                    </div>

                                    <div
                                        v-if="
                                            form.occupation.type === 'working'
                                        "
                                        class="flex flex-col gap-8"
                                    >
                                        <PrimeInputText
                                            v-model="
                                                form.occupation.company_name
                                            "
                                            label="Company Name"
                                        />
                                    </div>
                                </div>
                            </div>

                            <div class=""></div>
                        </div>

                        <small
                            v-if="form.errors.captcha_token"
                            class="mt-2 text-center text-red-700"
                            >{{ form.errors.captcha_token }}</small
                        >
                    </div>

                    <div class="flex justify-center">
                        <Button
                            type="submit"
                            class="w-3/4 mt-4"
                            label="SUBMIT"
                            severity="secondary"
                            rounded
                            size="large"
                            @submit.prevent="recaptcha()"
                        />
                    </div>
                </form>
            </div>

            <div class="h-full col-span-1 py-16">
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
        </div>
    </section>
</template>

<style scoped>
.gradient-bg {
    background-image: linear-gradient(
            to right,
            rgba(137, 2, 2, 1),
            rgba(137, 2, 2, 0.75),
            rgba(137, 2, 2, 0.25)
        ),
        url('/images/invest/noodles.jpg');
}
</style>
