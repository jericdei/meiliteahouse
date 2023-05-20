<script setup lang="ts">
import type { Dropdown as DropdownObj } from '@/types/common'
import type { SchoolDetails, CompanyDetails } from '@/types/submission'

import { useForm } from '@inertiajs/vue3'
import InputText from 'primevue/inputtext'
import InputNumber from 'primevue/inputnumber'
import FileUpload from 'primevue/fileupload'
import Dropdown from 'primevue/dropdown'
import { computed } from 'vue'

const props = defineProps<{
    paymentMethods: Array<DropdownObj>
    occupationTypes: Array<DropdownObj>
}>()

const form = useForm<{
    firstName: string
    middleName: string
    lastName: string
    contactNo: string
    email: string
    age: number
    referralCode: string
    profilePicture: File | null
    occupationType: string
    occupationData: SchoolDetails & CompanyDetails
    paymentMethod: string
    initialInvestment: number
    referenceNumber: string
    validId: File | null
    proofOfPayment: File | null
}>({
    firstName: '',
    middleName: '',
    lastName: '',
    contactNo: '',
    email: '',
    age: 18,
    referralCode: '',
    profilePicture: null,
    occupationType: '',
    occupationData: {
        name: '',
        address: '',
        contactNo: '',
        courseYear: '',
        position: '',
        workYears: 0,
    },
    paymentMethod: '',
    initialInvestment: 0,
    referenceNumber: '',
    validId: null,
    proofOfPayment: null,
})

const occupation = computed(() => {
    return form.occupationType === 'student' ? 'School' : 'Company'
})

const submit = () => console.log(form.data())
</script>

<template>
    <div class="p-5">
        <Head title="Investment Form" />

        <h1 class="form-heading text-center my-10">Investment Form</h1>

        <form @submit.prevent="submit()">
            <div
                class="bg-slate-200 p-3 md:p-10 rounded-xl mx-5 md:mx-10 lg:mx-20"
            >
                <div>
                    <h2 class="form-subheading">Personal Details</h2>

                    <div class="form-grid-3">
                        <span class="p-float-label w-full">
                            <InputText
                                class="w-full"
                                id="firstName"
                                required
                                v-model="form.firstName"
                            />
                            <label class="w-full" for="firstName">
                                First Name
                                <span class="text-danger">*</span>
                            </label>
                        </span>

                        <span class="p-float-label w-full">
                            <InputText
                                class="w-full"
                                id="middleName"
                                v-model="form.middleName"
                            />
                            <label class="w-full" for="middleName"
                                >Middle Name</label
                            >
                        </span>

                        <span class="p-float-label w-full">
                            <InputText
                                class="w-full"
                                id="lastName"
                                required
                                v-model="form.lastName"
                            />
                            <label class="w-full" for="lastName"
                                >Last Name
                                <span class="text-danger">*</span></label
                            >
                        </span>
                    </div>

                    <div class="form-grid-3">
                        <span class="p-float-label w-full">
                            <InputText
                                class="w-full"
                                id="contactNo"
                                required
                                v-model="form.contactNo"
                            />
                            <label class="w-full" for="contactNo"
                                >Contact Number
                                <span class="text-danger">*</span></label
                            >
                        </span>

                        <span class="p-float-label w-full">
                            <InputText
                                class="w-full"
                                id="email"
                                required
                                type="email"
                                v-model="form.email"
                            />
                            <label class="w-full" for="email"
                                >Email <span class="text-danger">*</span></label
                            >
                        </span>

                        <span class="p-float-label w-full">
                            <InputNumber
                                class="w-full"
                                id="age"
                                required
                                v-model="form.age"
                                :min="18"
                                :max="65"
                            />
                            <label class="w-full" for="age"
                                >Age <span class="text-danger">*</span></label
                            >
                        </span>
                    </div>

                    <div
                        class="grid grid-cols-1 md:grid-cols-2 mt-10 gap-10 place-items-center"
                    >
                        <span class="p-float-label w-full px-1">
                            <InputText
                                class="w-full"
                                id="referralCode"
                                v-model="form.referralCode"
                            />
                            <label class="w-full" for="referralCode"
                                >Referral Code</label
                            >
                        </span>

                        <span class="w-full px-1">
                            <label class="w-full" for="profilePicture"
                                >Profile Picture
                                <span class="text-danger">*</span></label
                            >
                            <FileUpload
                                class="w-full"
                                id="profilePicture"
                                mode="basic"
                                name="profilePicture"
                                accept="image/*"
                                chooseLabel="Upload"
                                v-model="form.profilePicture"
                            />
                        </span>
                    </div>
                </div>

                <div class="mt-12 flex flex-col gap-8">
                    <div>
                        <h2 class="form-subheading">Occupation Details</h2>

                        <div class="p-float-label mt-10">
                            <Dropdown
                                v-model="form.occupationType"
                                inputId="occupationType"
                                :options="props.occupationTypes"
                                optionValue="value"
                                optionLabel="label"
                                placeholder="Occupation type"
                                class="w-full md:w-14rem"
                                @change="form.reset('occupationData')"
                            />
                            <label for="occupationType"
                                >Occupation Type
                                <span class="text-danger">*</span></label
                            >
                        </div>
                    </div>

                    <div v-if="form.occupationType">
                        <div class="flex flex-col gap-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <span class="p-float-label w-full">
                                    <InputText
                                        class="w-full"
                                        id="occupationData.name"
                                        required
                                        v-model="form.occupationData.name"
                                    />
                                    <label
                                        class="w-full"
                                        for="occupationData.name"
                                        >{{ occupation }} Name
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                </span>

                                <span class="p-float-label w-full">
                                    <InputText
                                        class="w-full"
                                        id="occupationData.contactNo"
                                        required
                                        v-model="form.occupationData.contactNo"
                                    />
                                    <label
                                        class="w-full"
                                        for="occupationData.contactNo"
                                        >{{ occupation }} Contact Number
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                </span>
                            </div>

                            <span class="p-float-label w-full">
                                <InputText
                                    class="w-full"
                                    id="occupationData.address"
                                    required
                                    v-model="form.occupationData.address"
                                />
                                <label
                                    class="w-full"
                                    for="occupationData.address"
                                    >{{ occupation }} Address
                                    <span class="text-danger">*</span></label
                                >
                            </span>

                            <span
                                class="p-float-label w-full"
                                v-if="form.occupationType === 'student'"
                            >
                                <InputText
                                    class="w-full"
                                    id="occupationData.courseYear"
                                    required
                                    v-model="form.occupationData.courseYear"
                                />
                                <label
                                    class="w-full"
                                    for="occupationData.courseYear"
                                    >Course & Year
                                    <span class="text-danger">*</span></label
                                >
                            </span>

                            <div
                                class="grid grid-cols-1 md:grid-cols-2 gap-8"
                                v-if="form.occupationType === 'working'"
                            >
                                <span class="p-float-label w-full">
                                    <InputText
                                        class="w-full"
                                        id="occupationData.position"
                                        required
                                        v-model="form.occupationData.position"
                                    />
                                    <label
                                        class="w-full"
                                        for="occupationData.position"
                                        >Position
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                </span>

                                <span class="p-float-label w-full">
                                    <InputNumber
                                        class="w-full"
                                        id="occupationData.workYears"
                                        required
                                        v-model="form.occupationData.workYears"
                                    />
                                    <label
                                        class="w-full"
                                        for="occupationData.workYears"
                                        >No. of years working
                                        <span class="text-danger"
                                            >*</span
                                        ></label
                                    >
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="form-subheading mt-10">
                        Initial Investment Details
                    </h2>

                    <div class="form-grid-3">
                        <div class="p-float-label w-full">
                            <Dropdown
                                v-model="form.paymentMethod"
                                inputId="paymentMethod"
                                :options="props.paymentMethods"
                                optionValue="value"
                                optionLabel="label"
                                placeholder="Payment Method"
                                class="w-full md:w-14rem"
                            />
                            <label for="paymentMethod"
                                >Payment Method
                                <span class="text-danger">*</span></label
                            >
                        </div>

                        <span class="p-float-label w-full">
                            <InputNumber
                                class="w-full"
                                id="initialInvestment"
                                required
                                mode="currency"
                                currency="PHP"
                                locale="en-PH"
                                :min="1000"
                                v-model="form.initialInvestment"
                            />
                            <label class="w-full" for="initialInvestment"
                                >Initial Investment Amount
                                <span class="text-danger">*</span></label
                            >
                        </span>

                        <span class="p-float-label w-full">
                            <InputText
                                class="w-full"
                                id="referenceNumber"
                                required
                                type="referenceNumber"
                                v-model="form.referenceNumber"
                            />
                            <label class="w-full" for="referenceNumber"
                                >Reference Number
                                <span class="text-danger">*</span></label
                            >
                        </span>
                    </div>
                </div>

                <div>
                    <h2 class="form-subheading mt-10">Verification</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10">
                        <span class="w-full px-1">
                            <label class="w-full" for="validId"
                                >Valid ID
                                <span class="text-danger">*</span></label
                            >
                            <FileUpload
                                class="w-full"
                                id="validId"
                                mode="basic"
                                name="validId"
                                accept="image/*"
                                chooseLabel="Upload"
                                v-model="form.validId"
                            />
                        </span>

                        <span class="w-full px-1">
                            <label class="w-full" for="proofOfPayment"
                                >Proof of Payment
                                <span class="text-danger">*</span></label
                            >
                            <FileUpload
                                class="w-full"
                                id="proofOfPayment"
                                mode="basic"
                                name="proofOfPayment"
                                accept="image/*"
                                chooseLabel="Upload"
                                v-model="form.proofOfPayment"
                            />
                        </span>
                    </div>
                </div>

                <div class="flex justify-end">
                    <Button
                        class="w-full md:w-1/5 mt-24"
                        severity="success"
                        type="submit"
                        label="Submit"
                        @submit.prevent="submit()"
                    />
                </div>
            </div>
        </form>
    </div>
</template>

<style scoped>
.form-heading {
    @apply font-bold text-xl md:text-2xl lg:text-4xl;
}

.form-subheading {
    @apply font-bold md:text-lg lg:text-xl text-center md:text-left mt-5;
}

.form-grid-3 {
    @apply grid grid-cols-1 md:grid-cols-3 place-items-center gap-10 md:gap-5 mt-10;
}
</style>
