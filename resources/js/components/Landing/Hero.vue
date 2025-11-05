<template>
    <div class="hero-banner">
        <div class="hero-content">
            <!-- Logo Section -->
            <div class="logo-container">
                <img
                    src="/assets/img/logo.png"
                    alt="Future Leaders Organization Logo"
                    class="hero-logo"
                />
            </div>

            <!-- Text Content -->
            <div class="text-content">
                <h1 class="main-title">
                    {{ $t("Future Leaders Organization") }}
                </h1>
                <p class="subtitle">
                    {{ $t("Training a Conscious and Creative leader") }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
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
.hero-banner {
    position: relative;
    width: 100%;
    background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
    padding: 2rem 3rem;
    overflow: hidden;
}

/* Textured background pattern */
.hero-banner::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: radial-gradient(
            circle at 20% 50%,
            rgba(255, 255, 255, 0.03) 0%,
            transparent 50%
        ),
        radial-gradient(
            circle at 80% 80%,
            rgba(255, 255, 255, 0.03) 0%,
            transparent 50%
        ),
        radial-gradient(
            circle at 40% 20%,
            rgba(255, 255, 255, 0.02) 0%,
            transparent 50%
        );
    pointer-events: none;
}

/* Decorative pattern overlay */
.hero-banner::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: repeating-linear-gradient(
        45deg,
        transparent,
        transparent 10px,
        rgba(255, 255, 255, 0.01) 10px,
        rgba(255, 255, 255, 0.01) 20px
    );
    pointer-events: none;
}

.hero-content {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    gap: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.logo-container {
    flex-shrink: 0;
}

.hero-logo {
    height: 120px;
    width: auto;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.3));
}

.text-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.main-title {
    font-size: 3.5rem;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.2;
    letter-spacing: -0.02em;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    margin: 0;
}

.subtitle {
    font-size: 1.75rem;
    font-weight: 400;
    color: #e5e5e5;
    line-height: 1.4;
    letter-spacing: 0.01em;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    margin: 0;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .hero-banner {
        padding: 1.5rem 2rem;
    }

    .hero-logo {
        height: 100px;
    }

    .main-title {
        font-size: 2.75rem;
    }

    .subtitle {
        font-size: 1.5rem;
    }
}

@media (max-width: 768px) {
    .hero-banner {
        padding: 1.5rem;
    }

    .hero-content {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }

    .hero-logo {
        height: 80px;
    }

    .main-title {
        font-size: 2rem;
    }

    .subtitle {
        font-size: 1.25rem;
    }
}

@media (max-width: 480px) {
    .hero-banner {
        padding: 1rem;
    }

    .hero-logo {
        height: 60px;
    }

    .main-title {
        font-size: 1.5rem;
    }

    .subtitle {
        font-size: 1rem;
    }
}
</style>
