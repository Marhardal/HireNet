// formkit.config.ts
import { en } from '@formkit/i18n'
import { defaultConfig } from '@formkit/vue'
// import { rootClasses } from '@formkit.theme'
import { genesisIcons } from '@formkit/icons'
import { createMultiStepPlugin } from '@formkit/addons'
import '@formkit/addons/css/multistep'

export default defaultConfig({
  locales: { en },
  locale: 'en',
  plugins: [createMultiStepPlugin()],
  config: {
    // rootClasses,
  },
  // plugins: [proPlugin],
  icons: {
    ...genesisIcons
  }
})