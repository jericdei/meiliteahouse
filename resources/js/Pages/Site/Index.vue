<script setup lang="ts">
import Carousel from 'primevue/carousel'
import Image from 'primevue/image'

interface Product {
    id: number
    name: string
    slug: string
    description: string
    photo: string
}

interface Location {
    id: number
    name: string
    type: string
}

const props = defineProps<{
    featuredProducts: Product[]
    locations: Location[]
}>()
</script>

<template>
    <Head title="Home" />

    <section>
        <!-- Hero -->
        <div
            class="grid grid-cols-1 lg:grid-cols-2 bg-[url('/images/backgrounds/bg-pattern-sm.png')] bg-contain"
        >
            <div
                class="flex flex-col gap-8 items-center lg:items-end text-slate-100 py-16"
            >
                <h1
                    class="text-4xl lg:text-8xl font-bold text-center lg:text-right"
                >
                    WHERE <br />
                    <span class="text-secondary text-5xl lg:text-8xl"
                        >FOOD</span
                    >
                    <span class="block lg:text-5xl">IS ALWAYS</span> PIPING
                    <br />
                    <span class="text-secondary text-5xl lg:text-8xl"
                        >HOT!</span
                    >
                </h1>

                <Button
                    label="Learn more"
                    severity="secondary"
                    icon="pi pi-angle-down"
                    iconPos="right"
                />
            </div>

            <Image
                class="relative overflow-hidden hidden lg:block"
                imageClass="absolute lg:-left-20 lg:top-10 max-w-[40rem] -rotate-45"
                src="/images/products/kung-pao-chicken.png"
            />
        </div>

        <!-- About -->
        <div class="py-16 lg:px-8 text-center bg-slate-100">
            <h2 class="font-bold text-xl lg:text-4xl italic">
                "THE FIRST SIZZLING ASIAN-CHINESE CUISINE IN THE WORLD."
            </h2>

            <p class="mt-5 lg:text-2xl mx-4 lg:mx-16">
                Ignite your palate with the scintillating essence of Asia as we
                present the world's first sizzling Asian-Chinese cuisine. A
                fusion of tradition and innovation that will leave you craving
                for more.
            </p>
        </div>

        <!-- Featured Products -->
        <div
            class="grid grid-cols-1 lg:grid-cols-2 items-center text-slate-50 bg-secondary py-16 px-4 lg:px-8"
        >
            <div>
                <h2 class="text-3xl lg:text-6xl font-bold text-center">
                    Our Products
                </h2>

                <p class="lg:text-2xl mt-8 text-justify">
                    Indulge in our meticulously crafted products, skillfully
                    prepared with authentic ingredients that cater to every
                    discerning palate. Discover flavors that transcend
                    boundaries and delight even the most selective tastes.
                </p>

                <div class="grid place-items-center">
                    <Button class="mt-16" label="View our menu" />
                </div>
            </div>

            <div>
                <Carousel
                    :value="props.featuredProducts"
                    :numVisible="1"
                    circular
                    :autoplayInterval="2500"
                    :showIndicators="false"
                    :showNavigators="false"
                >
                    <template #item="{ data }">
                        <div class="p-5 text-slate-900 text-center">
                            <Image
                                class="w-3/4"
                                :src="`/images/products/${data.photo}`"
                            />

                            <p class="font-heading font-bold text-xl mt-2">
                                {{ data.name }}
                            </p>

                            <p class="mt-2">{{ data.description }}</p>
                        </div>
                    </template>
                </Carousel>
            </div>
        </div>

        <!-- Location -->
        <div class="py-16 px-4 lg:px-8 text-center bg-slate-100 test">
            <h2 class="font-bold text-2xl lg:text-6xl">
                WHERE ARE WE LOCATED?
            </h2>

            <p class="mt-5">
                You can visit us on SM, Robinson's, or Ayala Malls Food Court.
                We are also available in schools and universities.
            </p>

            <div class="mapouter mt-5">
                <div class="gmap_canvas">
                    <iframe
                        class="gmap_iframe"
                        width="100%"
                        frameborder="0"
                        scrolling="no"
                        marginheight="0"
                        marginwidth="0"
                        src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=sm bataan&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                    ></iframe>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
.mapouter {
    position: relative;
    text-align: right;
    width: 100%;
    height: 400px;
}
.gmap_canvas {
    overflow: hidden;
    background: none !important;
    width: 100%;
    height: 400px;
}
.gmap_iframe {
    height: 400px !important;
}
</style>
