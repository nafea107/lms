import {createI18n} from 'vue-i18n'
import ar from '../lang/ar.json'
import ku from '../lang/ku.json'
import en from '../lang/en.json'


const getI18n = (locale) => createI18n({
    locale: locale,
    fallbackLocale: locale,
    globalInjection: true,
    legacy: false, // Set legacy mode to false
    messages: {
        ar: ar,
        ku: ku,
        en: en,
    }
})


export default getI18n
