// formkit.config.ts
import { en } from '@formkit/i18n'
import { defaultConfig } from '@formkit/vue'
// import { rootClasses } from '@formkit.theme'
import { genesisIcons } from '@formkit/icons'

export default defaultConfig({
  locales: { en },
  locale: 'en',
  config: {
    // rootClasses,
  },
  // plugins: [proPlugin],
  icons: {
    ...genesisIcons
  }
})