import Vue from 'vue'
import VueI18n from 'vue-i18n'
import en from './en'
import fr from './fr'

Vue.use(VueI18n)

// Ready translated locale messages
const messages = {
    en: en,
    fr: fr
}

// Create VueI18n instance with options
export const i18n = new VueI18n({
    locale: window.locale, // set locale
    messages, // set locale messages
})

export default i18n
