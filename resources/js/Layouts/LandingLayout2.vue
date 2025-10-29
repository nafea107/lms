<template>
    <div class="bg-amber-100 flex flex-col min-h-screen">
        <Header :style="1" />
        <div class="flex-grow flex-col flex">
            <div class="h-full bg-amber-100 fixed w-full hidden">
                <img
                    alt="vector"
                    class="absolute w-60 top-[1rem] left-0 hidden md:block"
                    src="/assets/img/vectors/vector-1.svg "
                />

                <img
                    alt="vector"
                    class="hidden md:block absolute w-60 top-[1.5rem] right-0 transform rotate-45"
                    src="/assets/img/vectors/vector-1.svg"
                />

                <img
                    alt="vector"
                    class="hidden md:block absolute w-60 transform rotate-45 bottom-0 left-0"
                    src="/assets/img/vectors/vector-1.svg"
                />

                <img
                    alt="vector"
                    class="hidden md:block w-60 absolute bottom-0 left-[25%]"
                    src="/assets/img/vectors/vector-1.svg"
                />

                <img
                    alt="vector"
                    class="hidden md:block w-60 absolute bottom-0 left-[35%]"
                    src="/assets/img/vectors/vector-1.svg"
                />

                <img
                    alt="vector"
                    class="hidden md:block w-60 absolute transform rotate-45 bottom-0 left-[50%]"
                    src="/assets/img/vectors/vector-1.svg"
                />

                <img
                    alt="vector"
                    class="hidden md:block w-60 absolute bottom-0 left-[65%]"
                    src="/assets/img/vectors/vector-1.svg"
                />

                <img
                    alt="vector"
                    class="hidden md:block w-60 absolute bottom-0 left-[75%]"
                    src="/assets/img/vectors/vector-1.svg"
                />

                <img
                    alt="vector"
                    class="hidden md:block w-60 absolute bottom-0 left-[85%]"
                    src="/assets/img/vectors/vector-1.svg"
                />
            </div>

            <div class="relative z-10 flex-grow flex-col flex">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
import Header from "@/components/Landing/Header.vue";
import Footer from "@/components/Landing/Footer.vue";
</script>
