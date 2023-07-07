<script setup lang="ts"></script>

<template>
    <section class="gradient-bg">
        <Head title="About" />

        <div
            class="grid lg:grid-cols-6 gap-8 lg:py-32 px-8 py-16 text-center lg:px-40"
        >
            <div class="text-slate-50 col-span-2">
                <h1 class="text-5xl lg:text-7xl">About Us</h1>

                <p class="text-justify text-xl lg:text-2xl mt-8">
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
                class="justify-center gap-8 col-span-4 lg:px-32 hidden lg:flex"
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
            class="flex flex-col lg:flex-row flex-wrap justify-around lg:gap-32 lg:px-64 px-4 gap-4 py-16"
        >
            <div
                class="bg-slate-50/70 p-8 lg:p-16 flex-1 flex flex-col justify-center rounded-xl"
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
                class="bg-slate-50/70 p-8 lg:p-16 flex-1 flex flex-col justify-center rounded-xl"
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
