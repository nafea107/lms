<template>
    <div
        class="relative py-12 bg-gradient-to-b from-white to-[#1a3636] overflow-hidden"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="flex flex-col lg:flex-row items-center justify-between gap-12"
            >
                <!-- Logo and Tagline Section -->
                <div class="text-center lg:text-right lg:w-1/2">
                    <img
                        src="/assets/img/light-logo.png"
                        alt="Teacher Platform Logo"
                        class="h-32 mx-auto lg:mx-0 mb-6"
                    />
                    <h1
                        class="text-3xl md:text-4xl lg:text-5xl font-rabar-021 text-[#1a3636] mb-4"
                    >
                        {{ $t("منصة المعلم التعليمية") }}
                    </h1>
                    <p
                        class="text-xl md:text-2xl font-rabar-004 text-[#1a3636]/80 mb-8"
                    >
                        {{
                            $t(
                                "بالعلم نصنع المستقبل، وبالإلهام نضيء طريق الأجيال القادمة"
                            )
                        }}
                    </p>
                </div>

                <!-- Stats Section - Modern Flowing Design -->
                <div class="lg:w-1/2 w-full relative overflow-x">
                    <div class="stats-container flex flex-wrap justify-between">
                        <!-- Instructors Stat -->
                        <div
                            class="stat-card stat-instructors w-full animate-float-1"
                        >
                            <div class="stat-content">
                                <div class="stat-icon-wrapper">
                                    <div class="stat-icon">
                                        <Icon
                                            icon="mdi:account-group"
                                            class="text-emerald-700"
                                        />
                                    </div>
                                </div>
                                <div class="stat-info">
                                    <h3 class="stat-title">
                                        {{ $t("المعلمين") }}
                                    </h3>
                                    <div class="stat-value">
                                        <CountUp
                                            :end-val="stats.instructors"
                                            :duration="2.5"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Courses Stat -->
                        <div
                            class="stat-card stat-courses w-full animate-float-2"
                        >
                            <div class="stat-content">
                                <div class="stat-icon-wrapper">
                                    <div class="stat-icon">
                                        <Icon
                                            icon="mdi:book-open-page-variant"
                                            class="text-blue-700"
                                        />
                                    </div>
                                </div>
                                <div class="stat-info">
                                    <h3 class="stat-title">
                                        {{ $t("الكورسات") }}
                                    </h3>
                                    <div class="stat-value">
                                        <CountUp
                                            :end-val="stats.courses"
                                            :duration="2.5"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Students Stat -->
                        <div
                            class="stat-card stat-students w-full animate-float-3"
                        >
                            <div class="stat-content">
                                <div class="stat-icon-wrapper">
                                    <div class="stat-icon">
                                        <Icon
                                            icon="mdi:school"
                                            class="text-amber-700"
                                        />
                                    </div>
                                </div>
                                <div class="stat-info">
                                    <h3 class="stat-title">
                                        {{ $t("الطلاب") }}
                                    </h3>
                                    <div class="stat-value">
                                        <CountUp
                                            :end-val="stats.students"
                                            :duration="2.5"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Experience Stat -->
                        <div
                            class="stat-card stat-experience w-full animate-float-4"
                        >
                            <div class="stat-content">
                                <div class="stat-icon-wrapper">
                                    <div class="stat-icon">
                                        <Icon
                                            icon="mdi:certificate"
                                            class="text-purple-700"
                                        />
                                    </div>
                                </div>
                                <div class="stat-info">
                                    <h3 class="stat-title">
                                        {{ $t("سنوات الخبرة") }}
                                    </h3>
                                    <div class="stat-value">
                                        <CountUp
                                            :end-val="stats.experience"
                                            :duration="2.5"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Background decorative elements -->
                        <div class="stats-decoration stats-decoration-1"></div>
                        <div class="stats-decoration stats-decoration-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Icon } from "@iconify/vue";
import CountUp from "vue-countup-v3";

const props = defineProps({
    data: Object,
    stats: {
        type: Object,
        default: () => ({
            instructors: 0,
            courses: 0,
            students: 0,
            experience: 0,
        }),
    },
});
</script>

<style scoped>
.bg-gradient-to-b {
    background-size: 100% 100%;
    background-position: 0px 0px;
}

.stats-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 1.75rem;
    position: relative;
    max-width: 600px;
    margin: 0 auto;
    z-index: 1;
}

.stats-decoration {
    position: absolute;
    border-radius: 50%;
    filter: blur(30px);
    opacity: 0.15;
    z-index: -1;
}

.stats-decoration-1 {
    width: 250px;
    height: 250px;
    background: linear-gradient(45deg, #10b981, #3b82f6);
    top: -50px;
    left: -70px;
    animation: pulse 8s ease-in-out infinite alternate;
}

.stats-decoration-2 {
    width: 200px;
    height: 200px;
    background: linear-gradient(45deg, #a855f7, #f59e0b);
    bottom: -40px;
    right: -60px;
    animation: pulse 7s ease-in-out 1s infinite alternate-reverse;
}

@keyframes pulse {
    0% {
        transform: scale(1) rotate(0deg);
        opacity: 0.12;
    }
    50% {
        transform: scale(1.1) rotate(5deg);
        opacity: 0.15;
    }
    100% {
        transform: scale(0.95) rotate(-5deg);
        opacity: 0.18;
    }
}

.stat-card {
    border-radius: 2rem;
    padding: 1.5rem 1.25rem;
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    z-index: 1;
    will-change: transform;
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 4px 15px -8px rgba(0, 0, 0, 0.07);
}

.stat-card::before {
    content: none;
}

.stat-card::after {
    content: "";
    position: absolute;
    width: 150%;
    height: 150%;
    background: radial-gradient(
        circle,
        rgba(255, 255, 255, 0.4) 0%,
        rgba(255, 255, 255, 0) 70%
    );
    top: -25%;
    left: -25%;
    opacity: 0;
    transition: opacity 0.5s ease, transform 0.5s ease;
    transform: scale(0.8);
    z-index: -1;
}

.stat-card:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 20px -10px rgba(0, 0, 0, 0.1);
    border-color: rgba(255, 255, 255, 0.4);
}

.stat-card:hover::after {
    opacity: 0.3;
    transform: scale(1);
}

.animate-float-1 {
    animation: floating 5s ease-in-out infinite;
}

.animate-float-2 {
    animation: floating 5.5s ease-in-out 0.3s infinite;
}

.animate-float-3 {
    animation: floating 5.2s ease-in-out 0.7s infinite;
}

.animate-float-4 {
    animation: floating 4.8s ease-in-out 1.1s infinite;
}

@keyframes floating {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-8px);
    }
    100% {
        transform: translateY(0px);
    }
}

.stat-content {
    display: flex;
    align-items: center;
    gap: 1rem;
    position: relative;
    z-index: 1;
}

.stat-icon-wrapper {
    position: relative;
}

.stat-icon-wrapper::before {
    content: "";
    position: absolute;
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    border-radius: 50%;
    background: linear-gradient(
        135deg,
        rgba(255, 255, 255, 0.7),
        rgba(255, 255, 255, 0.1)
    );
    opacity: 0;
    transform: scale(0.8);
    transition: all 0.3s ease;
}

.stat-card:hover .stat-icon-wrapper::before {
    opacity: 0.7;
    transform: scale(1);
}

.stat-icon {
    width: 4rem;
    height: 4rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    position: relative;
    z-index: 1;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    box-shadow: 0 4px 12px -2px rgba(0, 0, 0, 0.12);
}

/* Individual stat icon styles */
.stat-instructors .stat-icon {
    color: #10b981;
    background-color: rgba(16, 185, 129, 0.1);
}

.stat-courses .stat-icon {
    color: #3b82f6;
    background-color: rgba(59, 130, 246, 0.1);
}

.stat-students .stat-icon {
    color: #f59e0b;
    background-color: rgba(245, 158, 11, 0.1);
}

.stat-experience .stat-icon {
    color: #a855f7;
    background-color: rgba(168, 85, 247, 0.1);
}

.stat-info {
    flex: 1;
}

.stat-title {
    font-size: 1.1rem;
    font-weight: 600;
    font-family: var(--font-rabar-021);
    margin-bottom: 0.5rem;
    transition: transform 0.3s ease;
    color: #1f2937;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.stat-card:hover .stat-title {
    transform: translateX(3px);
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1;
    transition: transform 0.3s ease, text-shadow 0.3s ease;
    letter-spacing: -0.025em;
}

.stat-card:hover .stat-value {
    transform: translateY(-2px);
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.stat-card:hover .stat-icon {
    transform: scale(1.1);
}

/* Define different text colors for each stat value */
.stat-instructors .stat-value {
    color: #047857;
    text-shadow: 0 0 1px rgba(4, 120, 87, 0.2);
}

.stat-courses .stat-value {
    color: #1d4ed8;
    text-shadow: 0 0 1px rgba(29, 78, 216, 0.2);
}

.stat-students .stat-value {
    color: #b45309;
    text-shadow: 0 0 1px rgba(180, 83, 9, 0.2);
}

.stat-experience .stat-value {
    color: #7e22ce;
    text-shadow: 0 0 1px rgba(126, 34, 206, 0.2);
}

/* Update the icon size */
.stat-icon svg {
    width: 32px;
    height: 32px;
}

/* Responsive adjustments */
@media (max-width: 640px) {
    .stats-container {
        grid-gap: 1rem;
    }

    .stat-card {
        padding: 1.25rem;
        border-radius: 1.25rem;
    }

    .stat-icon {
        width: 3.5rem;
        height: 3.5rem;
        box-shadow: 0 3px 10px -2px rgba(0, 0, 0, 0.1);
    }

    .stat-icon svg {
        width: 28px;
        height: 28px;
    }

    .stat-title {
        font-size: 0.95rem;
    }

    .stat-value {
        font-size: 2rem;
    }

    .stats-decoration-1,
    .stats-decoration-2 {
        opacity: 0.08;
    }
}
</style>
