<script setup lang="ts">
import PrimeDropdown from '@/Components/Form/PrimeDropdown.vue'
import PrimeFileUpload from '@/Components/Form/PrimeFileUpload.vue'
import PrimeInputMask from '@/Components/Form/PrimeInputMask.vue'
import PrimeInputNumber from '@/Components/Form/PrimeInputNumber.vue'
import PrimeInputText from '@/Components/Form/PrimeInputText.vue'
import type { SubmissionFormProps } from '@/types/submission'
import { router, useForm } from '@inertiajs/vue3'
import _ from 'lodash'
import Dialog from 'primevue/dialog'
import { ref } from 'vue'
import { useBreakpointTailwindCSS } from 'vue-composable'
import { useReCaptcha } from 'vue-recaptcha-v3'
import BackButton from '../Components/BackButton.vue'
import ClassificationCard from './Components/ClassificationCard.vue'
import PaymentChannelCard from './Components/PaymentChannelCard.vue'

const props = defineProps<{
    paymentMethods: any[]
}>()

const captcha = useReCaptcha()
const tw = useBreakpointTailwindCSS()

const form = useForm<SubmissionFormProps>({
    firstName: '',
    middleName: '',
    lastName: '',
    address: '',
    contactNo: '',
    email: '',
    age: undefined,
    referralCode: '',
    occupation: {
        type: '',
        data: {
            name: '',
            address: '',
            contactNo: '',
            courseYear: '',
            position: '',
            workYears: undefined,
        },
    },
    initialInvestment: {
        amount: undefined,
        paymentMethod: '',
        referenceNumber: '',
    },
    validId: undefined,
    proofOfPayment: undefined,
})

const isDialogVisible = ref(false)
const dialogMessage = ref('')

const recaptcha = async () => {
    await captcha?.recaptchaLoaded()

    form.captcha_token = await captcha?.executeRecaptcha('login')

    handleSubmit()
}

const handleSubmit = () => {
    form.post(route('site.investments.store'), {
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

const getPaymentMethodLabel = (method: string) => {
    switch (method) {
        case 'bpi':
        case 'bdo':
            return method.toUpperCase()
        case 'maya':
            return _.startCase(method)
        case 'gcash':
            return 'GCash'
    }
}

const paymentMethodsDropdown = props.paymentMethods.map((method: string) => ({
    label: getPaymentMethodLabel(method),
    value: method,
}))
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
            class="relative flex flex-col justify-center bg-slate-200 px-4 py-8 lg:px-24 lg:py-16"
        >
            <div
                class="mt-16 grid grid-cols-1 items-center lg:mt-0 lg:grid-cols-2"
            >
                <div>
                    <Image
                        class="rounded-full shadow-2xl shadow-neutral-900"
                        imageClass="rounded-full w-16 lg:w-32 mx-auto lg:mx-0"
                        src="/images/logos/logo-2023.jpg"
                        alt="Mei Li Tea House Logo"
                    />

                    <h1
                        class="mt-16 text-center text-4xl font-bold uppercase leading-relaxed text-primary lg:text-left lg:text-7xl"
                    >
                        Invest in your Pandasy.
                    </h1>

                    <div class="mt-4 flex justify-center lg:justify-start">
                        <p class="lg:text-2xl">
                            Invest now and refer to your friends to increase
                            your investment!
                        </p>
                    </div>
                </div>

                <div class="hidden justify-center lg:flex">
                    <Image
                        class="absolute bottom-0 mx-auto"
                        src="/images/invest/flower-money.png"
                        width="400"
                    />
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center bg-primary py-4">
            <Image src="/images/invest/panda.png" width="50" />
        </div>

        <div class="relative">
            <div class="grid text-center lg:grid-cols-2">
                <div
                    class="flex flex-col justify-center bg-secondary px-4 pb-16 pt-24 text-slate-50"
                >
                    <p class="mx-auto max-w-lg font-bold uppercase lg:text-3xl">
                        Mei Li Tea House is looking for investors!
                    </p>

                    <p class="lg:text-xl">
                        (Students are allowed. Applicable 16 years old and
                        above)
                    </p>
                </div>

                <div class="bg-slate-50 px-4 py-12 text-slate-900">
                    <p class="mx-auto max-w-lg lg:text-3xl">
                        Get to invest a minimum of P1,000. Get an 8% annual
                        return and freebies as per post, upon registering.
                    </p>
                </div>
            </div>

            <div class="flex justify-center">
                <div
                    class="absolute top-0 rounded-b-[3rem] bg-primary p-5 text-slate-50"
                >
                    <p class="font-bold uppercase lg:text-xl">
                        Start Investing
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-zinc-800 py-8 text-slate-50">
            <p class="mx-auto max-w-5xl text-center uppercase lg:text-3xl">
                Proceeds will be used for franchise a loan system and expansion
                of Mei Li Tea House.
            </p>
        </div>

        <div
            class="gradient-bg bg-cover bg-center bg-no-repeat py-16 text-slate-50"
        >
            <h2 class="text-center text-2xl font-bold uppercase lg:text-5xl">
                Investor Classifications
            </h2>

            <div
                class="mt-8 grid grid-cols-1 gap-8 px-4 md:grid-cols-2 lg:grid-cols-3 lg:px-16 xl:px-32"
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
            class="flex flex-col items-center justify-center gap-16 bg-primary/60 py-16 text-slate-50 lg:flex-row"
        >
            <div
                class="order-2 col-span-4 grid grid-flow-row auto-rows-fr grid-cols-1 gap-4 px-4 lg:order-1 xl:grid-cols-2"
            >
                <PaymentChannelCard
                    v-for="(item, index) in paymentChannels"
                    :key="index"
                    :imageLink="item.imageLink"
                    :accountNumber="item.accountNumber"
                    :accountName="item.accountName"
                />
            </div>

            <div class="order-1 flex justify-start lg:order-2 xl:col-span-2">
                <h2
                    class="mx-auto max-w-[8ch] text-center text-3xl font-bold uppercase md:text-5xl lg:text-7xl"
                >
                    Payment Channels
                </h2>
            </div>
        </div>

        <div
            class="grid grid-cols-1 items-center bg-primary-dark lg:grid-cols-3"
        >
            <div id="investment_form" class="col-span-2 p-8">
                <form @submit.prevent="recaptcha()">
                    <div
                        class="mt-4 rounded-3xl bg-slate-100 p-4 text-slate-900"
                    >
                        <p
                            class="text-center font-bold lg:text-left lg:text-lg"
                        >
                            Interested? Fill up the form below.
                        </p>

                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                            <div>
                                <div class="flex flex-col gap-8 py-8">
                                    <PrimeInputText
                                        v-model="form.firstName"
                                        label="First Name"
                                        :isInvalid="form.errors.firstName"
                                        :invalidText="form.errors.firstName"
                                    />

                                    <PrimeInputText
                                        v-model="form.middleName"
                                        label="Middle Name"
                                        :isInvalid="form.errors.middleName"
                                        :invalidText="form.errors.middleName"
                                    />

                                    <PrimeInputText
                                        v-model="form.lastName"
                                        label="Last Name"
                                        :isInvalid="form.errors.lastName"
                                        :invalidText="form.errors.lastName"
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
                                        v-model="form.contactNo"
                                        label="Contact No."
                                        :isInvalid="form.errors.contactNo"
                                        :invalidText="form.errors.contactNo"
                                        mask="9999-999-9999"
                                    />

                                    <PrimeInputText
                                        v-model="form.email"
                                        label="Email Address"
                                        :isInvalid="form.errors.email"
                                        :invalidText="form.errors.email"
                                    />

                                    <PrimeInputText
                                        v-model="form.referralCode"
                                        label="Referral Code (if any)"
                                        :isInvalid="form.errors.referralCode"
                                        :invalidText="form.errors.referralCode"
                                    />
                                </div>
                            </div>

                            <div class="flex flex-col gap-4">
                                <div class="flex flex-col gap-8 py-4">
                                    <PrimeDropdown
                                        v-model="form.occupation.type"
                                        label="Occupation"
                                        :isInvalid="
                                            form.errors['occupation.type']
                                        "
                                        :invalidText="
                                            form.errors['occupation.type']
                                        "
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
                                        class="flex flex-col gap-8"
                                        v-if="form.occupation.type"
                                    >
                                        <div class="flex flex-col gap-8">
                                            <PrimeInputText
                                                v-model="
                                                    form.occupation.data.name
                                                "
                                                :label="
                                                    form.occupation.type ===
                                                    'student'
                                                        ? 'School Name'
                                                        : 'Company Name'
                                                "
                                                :isInvalid="
                                                    form.errors[
                                                        'occupation.data.name'
                                                    ]
                                                "
                                                :invalidText="
                                                    form.errors[
                                                        'occupation.data.name'
                                                    ]
                                                "
                                            />

                                            <PrimeInputText
                                                v-model="
                                                    form.occupation.data.address
                                                "
                                                :label="
                                                    form.occupation.type ===
                                                    'student'
                                                        ? 'School Address'
                                                        : 'Company Address'
                                                "
                                                :isInvalid="
                                                    form.errors[
                                                        'occupation.data.address'
                                                    ]
                                                "
                                                :invalidText="
                                                    form.errors[
                                                        'occupation.data.address'
                                                    ]
                                                "
                                            />

                                            <PrimeInputText
                                                v-model="
                                                    form.occupation.data
                                                        .contactNo
                                                "
                                                :label="
                                                    form.occupation.type ===
                                                    'student'
                                                        ? 'School Contact No.'
                                                        : 'Company Contact No.'
                                                "
                                                :isInvalid="
                                                    form.errors[
                                                        'occupation.data.contactNo'
                                                    ]
                                                "
                                                :invalidText="
                                                    form.errors[
                                                        'occupation.data.contactNo'
                                                    ]
                                                "
                                            />
                                        </div>

                                        <div
                                            v-if="
                                                form.occupation.type ===
                                                'student'
                                            "
                                            class="flex flex-col gap-8"
                                        >
                                            <PrimeInputText
                                                v-model="
                                                    form.occupation.data
                                                        .courseYear
                                                "
                                                label="Course and Year"
                                                :isInvalid="
                                                    form.errors[
                                                        'occupation.data.courseYear'
                                                    ]
                                                "
                                                :invalidText="
                                                    form.errors[
                                                        'occupation.data.courseYear'
                                                    ]
                                                "
                                            />
                                        </div>

                                        <div
                                            v-if="
                                                form.occupation.type ===
                                                'working'
                                            "
                                            class="flex flex-col gap-8"
                                        >
                                            <div
                                                class="flex flex-col gap-8 lg:flex-row"
                                            >
                                                <PrimeInputText
                                                    v-model="
                                                        form.occupation.data
                                                            .position
                                                    "
                                                    label="Position"
                                                    :isInvalid="
                                                        form.errors[
                                                            'occupation.data.position'
                                                        ]
                                                    "
                                                    :invalidText="
                                                        form.errors[
                                                            'occupation.data.position'
                                                        ]
                                                    "
                                                />

                                                <PrimeInputNumber
                                                    v-model="
                                                        form.occupation.data
                                                            .workYears
                                                    "
                                                    label="Years Employed"
                                                    :isInvalid="
                                                        form.errors[
                                                            'occupation.data.workYears'
                                                        ]
                                                    "
                                                    :invalidText="
                                                        form.errors[
                                                            'occupation.data.workYears'
                                                        ]
                                                    "
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-8">
                                    <PrimeDropdown
                                        v-model="
                                            form.initialInvestment.paymentMethod
                                        "
                                        label="Payment Method"
                                        :options="paymentMethodsDropdown"
                                        optionValue="value"
                                        optionLabel="label"
                                        :isInvalid="
                                            form.errors[
                                                'initialInvestment.paymentMethod'
                                            ]
                                        "
                                        :invalidText="
                                            form.errors[
                                                'initialInvestment.paymentMethod'
                                            ]
                                        "
                                    />

                                    <PrimeInputNumber
                                        v-model="form.initialInvestment.amount"
                                        label="Initial Investment Amount"
                                        :isInvalid="
                                            form.errors[
                                                'initialInvestment.amount'
                                            ]
                                        "
                                        :invalidText="
                                            form.errors[
                                                'initialInvestment.amount'
                                            ]
                                        "
                                    />

                                    <PrimeInputText
                                        v-model="
                                            form.initialInvestment
                                                .referenceNumber
                                        "
                                        label="Reference No."
                                        :isInvalid="
                                            form.errors[
                                                'initialInvestment.referenceNumber'
                                            ]
                                        "
                                        :invalidText="
                                            form.errors[
                                                'initialInvestment.referenceNumber'
                                            ]
                                        "
                                    />

                                    <PrimeFileUpload
                                        v-model="form.validId"
                                        label="Valid ID"
                                        accept="image/*"
                                        :isInvalid="form.errors.validId"
                                        :invalidText="form.errors.validId"
                                        @input="
                                            form.validId =
                                                $event.target.files[0]
                                        "
                                    />

                                    <PrimeFileUpload
                                        v-model="form.proofOfPayment"
                                        label="Proof of Payment"
                                        accept="image/*"
                                        :isInvalid="form.errors.proofOfPayment"
                                        :invalidText="
                                            form.errors.proofOfPayment
                                        "
                                        @input="
                                            form.proofOfPayment =
                                                $event.target.files[0]
                                        "
                                    />
                                </div>
                            </div>
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

            <div class="col-span-1 h-full py-16">
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
        </div>

        <div
            class="gradient-bg-chicken bg-cover bg-center bg-no-repeat py-32 text-slate-50"
        >
            <div class="grid lg:grid-cols-2 lg:px-32">
                <div class="relative hidden gap-8 lg:flex">
                    <Image width="250" src="/images/phone/fb.png" />

                    <Image
                        width="250"
                        class="absolute -bottom-20 right-40"
                        src="/images/phone/ig.png"
                    />
                </div>

                <div class="px-4 text-center lg:px-16 lg:text-left">
                    <h3 class="text-4xl lg:text-6xl">Contact Us</h3>

                    <div
                        class="mt-16 flex flex-col items-center gap-4 lg:items-start"
                        role="list"
                    >
                        <span class="flex items-center gap-4">
                            <i
                                class="ri-facebook-circle-fill text-4xl lg:text-6xl"
                            ></i>

                            <p class="text-lg lg:text-2xl">@meiliteahouseph</p>
                        </span>

                        <span class="flex items-center gap-4">
                            <i
                                class="ri-instagram-fill text-4xl lg:text-6xl"
                            ></i>

                            <p class="text-lg lg:text-2xl">
                                @officialmeiliteahouse
                            </p>
                        </span>

                        <span class="flex items-center gap-4">
                            <i class="ri-mail-fill text-4xl lg:text-6xl"></i>

                            <p class="text-lg lg:text-2xl">
                                meiliteahouse@gmail.com
                            </p>
                        </span>

                        <span class="flex items-center gap-4">
                            <i class="ri-phone-fill text-4xl lg:text-6xl"></i>

                            <p class="text-lg lg:text-2xl">
                                (+639) 67 - 297 - 4246
                            </p>
                        </span>
                    </div>
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

.gradient-bg-chicken {
    background-image: linear-gradient(
            to right,
            rgba(137, 2, 2, 1),
            rgba(137, 2, 2, 0.75),
            rgba(137, 2, 2, 0.25)
        ),
        url('/images/backgrounds/chicken.png');
}
</style>
