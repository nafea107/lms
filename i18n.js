import VueI18NExtract from "vue-i18n-extract";

const report = VueI18NExtract.createI18NReport({
    vueFiles: "./resources/js/**/*.?(js|vue)",
    languageFiles: "./resources/js/lang/*.?(json|yml|yaml|js)",
    // output: "./resources/js/lang/ar.json",
    add: true,
    separator: "                      ",
});
