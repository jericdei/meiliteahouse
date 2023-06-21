<script setup lang="ts">
import StatusTag from '@/Components/Investments/StatusTag.vue'
import { Submission } from '@/types/submission'
import { DynamicDialogInstance } from 'primevue/dynamicdialogoptions'
import { ComputedRef } from 'vue'
import { inject } from 'vue'

const dialogRef = inject<ComputedRef<DynamicDialogInstance>>(
    'dialogRef'
) as ComputedRef<DynamicDialogInstance>

const submission: Submission = dialogRef.value.data.submission
</script>

<template>
    <div class="flex gap-8 p-5">
        <div class="w-1/4 p-3">
            <Image
                :src="`https://api.dicebear.com/6.x/avataaars/svg?seed=${submission.firstName}`"
                width="320"
            />
        </div>

        <div class="w-full">
            <div class="flex items-center justify-between">
                <h1 class="text-4xl font-bold text-center">
                    {{ submission.fullName }}
                </h1>

                <StatusTag :status="submission.status" />
            </div>

            <p class="italic font-bold">
                {{
                    submission.occupation.data[
                        submission.occupation.type === 'Student'
                            ? 'courseYear'
                            : 'position'
                    ]
                }}
                <span class="font-normal">at</span>
                {{ submission.occupation.data.name }}
            </p>

            <div class="grid grid-cols-2 mt-5">
                <div>
                    <h2 class="mb-5 text-2xl font-bold">Personal Details</h2>

                    <p>
                        <span class="font-bold">Contact Number: </span
                        >{{ submission.contactNo }}
                    </p>

                    <p>
                        <span class="font-bold">Email: </span
                        >{{ submission.email }}
                    </p>

                    <p>
                        <span class="font-bold">Age: </span
                        >{{ submission.age }} years old
                    </p>

                    <p>
                        <span class="font-bold">Referred By: </span
                        >{{ submission.referredBy }}
                    </p>
                </div>

                <div>
                    <h2 class="mb-5 text-2xl font-bold">Investment Details</h2>

                    <p>
                        <span class="font-bold">Amount: </span
                        >{{ submission.initialInvestment.amount }}
                    </p>

                    <p>
                        <span class="font-bold">Payment Method: </span
                        >{{ submission.initialInvestment.paymentMethod }}
                    </p>

                    <p>
                        <span class="font-bold">Reference Number: </span
                        >{{ submission.initialInvestment.referenceNumber }}
                    </p>

                    <p>
                        <span class="font-bold">Amount: </span
                        >{{ submission.initialInvestment.amount }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="my-5">
        <div class="grid w-3/4 grid-cols-2 mx-auto mt-5">
            <div>
                <p class="font-bold">Valid ID</p>

                <Image
                    class="border border-slate-500"
                    src="/images/placeholder.png"
                    preview
                    width="320"
                />
            </div>

            <div>
                <p class="font-bold">Proof of Payment</p>

                <Image
                    class="border border-slate-500"
                    src="/images/placeholder.png"
                    preview
                    width="320"
                />
            </div>
        </div>
    </div>
</template>
