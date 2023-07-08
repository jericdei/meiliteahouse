<script setup lang="ts"></script>

<template>
    <section class="gradient-bg">
        <Head title="About" />

        <div
            class="grid xl:grid-cols-6 gap-8 l lg:px-16 xl:py-24 px-8 py-16 text-center"
        >
            <div class="text-slate-50 xl:col-span-2 xl:py-32">
                <h1 class="text-5xl xl:text-7xl">About Us</h1>

                <p class="text-justify text-xl xl:text-2xl mt-8">
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
            </div>

            <div
                class="justify-center lg:gap-4 xl:gap-16 lg:col-span-4 lg:px-8 xl:px-16 2xl:px-32 hidden xl:flex"
            >
                <Image
                    src="/images/products/fish-tofu-tausi-rice.png"
                    imageClass="h-full object-none rounded-full object-center"
                />

                <Image
                    src="/images/products/hongtang-ribs.png"
                    imageClass="h-full object-none rounded-full object-center"
                />

                <Image
                    src="/images/products/pork-asado.png"
                    imageClass="h-full object-none rounded-full object-center"
                />
            </div>
        </div>

        <div
            class="flex flex-col xl:flex-row flex-wrap justify-around xl:gap-32 xl:px-64 px-4 gap-4 py-16"
        >
            <div
                class="bg-slate-50/70 p-8 xl:p-16 flex-1 flex flex-col justify-center rounded-xl"
            >
                <h3 class="text-4xl text-center">Our Mission</h3>

                <p class="mt-8 text-justify text-xl">
                    Mei Li Tea House opts to serve with high quality in all
                    aspects (food, service, architecture, and etc.,) with
                    instagrammable purchases. Make the customers have a
                    “pandastic experience” that will surely leave each of our
                    transactions with a smile in their faces. To be the first
                    Chinese sizzling bowl - restaurant in the Philippines aiming
                    to serve and to let everyone enjoy it's food and customer
                    service.
                </p>
            </div>

            <div
                class="bg-slate-50/70 p-8 xl:p-16 flex-1 flex flex-col justify-center rounded-xl"
            >
                <h3 class="text-4xl text-center">Our Vision</h3>

                <p class="mt-8 text-justify text-xl">
                    Mei Li Tea House envisions itself to be one of the most
                    well-known brands not only in the Philippines, but,
                    throughout the world. Leaving a mark in the industry of food
                    and services.
                </p>
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
</style>
