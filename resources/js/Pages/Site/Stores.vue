<script setup lang="ts">
import { computed, ref } from 'vue'

const selectedLocation = ref<'smBataan' | 'luckyChinatownMall'>('smBataan')

const storeData = computed(() => {
    switch (selectedLocation.value) {
        case 'smBataan':
            return {
                imageSrc: '/images/stores/sm-bataan.jpg',
                address: 'SM City Bataan Food Court, Balanga, Bataan',
                locationLink:
                    'https://www.google.com/maps/embed/v1/place?q=SM+City+Bataan+Food+Court,+City+of+Balanga,+Bataan,+Philippines&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8',
            }
        case 'luckyChinatownMall':
            return {
                imageSrc: '/images/stores/lucky-chinatown-2.png',
                address: 'Lucky Chinatown Mall, Binondo, Manila',
                locationLink:
                    'https://www.google.com/maps/embed/v1/place?q=Lucky+Chinatown+Mall,+Lachambre+Street,+Binondo,+Manila,+Metro+Manila,+Philippines&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8',
            }
    }
})
</script>

<template>
    <section class="gradient-bg">
        <Head title="Stores" />

        <div class="grid xl:grid-cols-8 gap-16 p-4 xl:p-24">
            <div class="rounded-3xl bg-slate-100 py-8 xl:py-16 xl:col-span-3">
                <ul
                    class="text-center text-xl xl:text-3xl text-slate-700 px-12 xl:px-28 flex flex-col justify-center items-center gap-8"
                >
                    <li
                        class="cursor-pointer"
                        :class="{ active: selectedLocation === 'smBataan' }"
                        @click="selectedLocation = 'smBataan'"
                    >
                        SM Bataan
                    </li>

                    <li
                        class="cursor-pointer"
                        :class="{
                            active: selectedLocation === 'luckyChinatownMall',
                        }"
                        @click="selectedLocation = 'luckyChinatownMall'"
                    >
                        Lucky Chinatown Mall
                    </li>
                </ul>
            </div>

            <div class="xl:col-span-5 bg-slate-50/50 rounded-3xl p-8">
                <div class="grid xl:grid-cols-6 gap-4">
                    <Image
                        :src="storeData.imageSrc"
                        class="col-span-2 hidden xl:block"
                        imageClass="h-full object-cover object-center rounded-3xl"
                    />

                    <div class="flex flex-col gap-4 col-span-4">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <iframe
                                    class="gmap_iframe"
                                    width="100%"
                                    frameborder="0"
                                    scrolling="no"
                                    marginheight="0"
                                    marginwidth="0"
                                    :src="storeData.locationLink"
                                ></iframe>
                            </div>
                        </div>

                        <p class="text-xl font-bold text-center xl:text-left">
                            {{ storeData.address }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.gradient-bg {
    background-image: linear-gradient(
            to bottom,
            rgba(137, 2, 2, 0.8),
            rgba(137, 2, 2, 0.5),
            rgba(137, 2, 2, 0.25)
        ),
        url('/images/backgrounds/pancit.jpg');
}

.active {
    @apply pb-2 border-b-4 border-spacing-y-10 border-primary;
}
</style>
