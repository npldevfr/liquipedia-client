import {defineConfig} from 'vitepress'

// https://vitepress.dev/reference/site-config
export default defineConfig({
    title: "LiquipediaClient",
    description: "The Liquipedia PHP Client documentation",
    lastUpdated: true,
    themeConfig: {
        editLink: {
            pattern: 'https://github.com/npldevfr/liquipedia-client/-/tree/main/docs/:path',
        },
        search: {
            provider: 'local'
        },
        logo: {
            dark: '../../images/dark.png',
            light: '../../images/light.png'
        },
        // nav: [
        //     {text: 'Home', link: '/'},
        //     {text: 'Examples', link: '/markdown-examples'}
        // ],
        sidebar: [
            {
                text: 'Introduction',
                items: [
                    {text: 'What is LiquipediaClient?', link: '/guide/what-is-liquipedia-client'},
                    {text: 'Getting Started', link: '/guide/getting-started'},
                ]
            },
            {
                text: 'Endpoints (Coming Soon)',
                items: []
            },
            {
                text: 'Query Builder',
                items: [
                    {text: 'Methods', link: '/query-builder/methods'},
                ]
            }
        ],

        socialLinks: [
            {icon: 'github', link: 'https://github.com/npldevfr/liquipedia-client'},
        ]
    }
})
