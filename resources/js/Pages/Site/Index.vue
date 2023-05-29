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

const props = defineProps<{
    featuredProducts: Product[]
}>()
</script>

<template>
    <Head title="Home" />

    <section>
        <!-- Hero -->
        <div
            class="grid grid-cols-1 lg:grid-cols-2 bg-[url('images/backgrounds/bg-pattern-sm.png')]"
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
                    label="See our products"
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

        <!-- Featured Products -->
        <div
            class="grid grid-cols-1 lg:grid-cols-2 text-slate-100 bg-secondary py-16 px-8"
        >
            <div>
                <h2 class="text-8xl font-bold text-center">Our Products</h2>

                <p class="text-3xl mt-8 text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Voluptatibus animi tempora nesciunt, repellendus praesentium
                    ratione accusantium, ullam pariatur suscipit consectetur
                    similique beatae excepturi. Commodi voluptatum totam
                    incidunt, eum iusto similique.
                </p>

                <Button class="mt-16" size="large" label="View our menu" />
            </div>

            <div>
                <Carousel
                    :value="props.featuredProducts"
                    :numVisible="1"
                    circular
                    :autoplayInterval="2500"
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
    </section>
</template>
