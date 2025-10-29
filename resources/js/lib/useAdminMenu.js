import { useI18n } from "vue-i18n";

export default function useAdminMenu() {
    const { t } = useI18n();
    return {
        items: [
            {
                label: t("الرئيسية"),
                link: route("admin.home"),
            },
            {
                label: t("الكورسات"),
                link: route("admin.courses.index"),
            },
            {
                label: t("الدروس"),
                link: route("admin.lessons.index"),
            },
            {
                label: t("الاقسام"),
                link: route("admin.categories.index"),
            },
            {
                label: t("المواد"),
                link: route("admin.subjects.index"),
            },
            {
                label: t("المعلمين"),
                link: route("admin.instructors.index"),
            },
            {
                label: t("المراحل"),
                link: route("admin.levels.index"),
            },
            {
                label: t("الصفحات"),
                link: route("admin.pages.index"),
            },
            {
                label: t("البودكاست"),
                link: route("admin.podcasts.index"),
            },
            {
                label: t("الاشتراكات"),
                link: route("admin.enroll-course.index"),
            },
            {
                label: t("الاعدادات"),
                link: route("admin.settings.edit"),
            },
        ],
    };
}
