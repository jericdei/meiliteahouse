<script setup lang="ts"></script>

<template>
    <section class="gradient-bg">
        <Head title="About" />

        <div
            class="l grid gap-8 px-8 py-16 text-center lg:px-16 xl:grid-cols-6 xl:py-24"
        >
            <div class="text-slate-50 xl:col-span-2 xl:py-32">
                <h1 class="text-5xl xl:text-7xl">About Us</h1>

                <p class="mt-8 text-justify text-xl xl:text-2xl">
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
                class="hidden justify-center lg:col-span-4 lg:gap-4 lg:px-8 xl:flex xl:gap-16 xl:px-16 2xl:px-32"
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
            class="flex flex-col flex-wrap justify-around gap-4 px-4 py-16 xl:flex-row xl:gap-32 xl:px-64"
        >
            <div
                class="flex flex-1 flex-col justify-center rounded-xl bg-slate-50/70 p-8 xl:p-16"
            >
                <h3 class="text-center text-4xl">Our Mission</h3>

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
                class="flex flex-1 flex-col justify-center rounded-xl bg-slate-50/70 p-8 xl:p-16"
            >
                <h3 class="text-center text-4xl">Our Vision</h3>

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
