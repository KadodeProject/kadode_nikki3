import MermaidPlugin from "vitepress-plugin-mermaid";
export default {
    title: "かどで日記総合wiki",
    description: "かどで日記のもろもろが書かれています",
    markdown: {
        config: MermaidPlugin,
        plugins: [["markdown-it-bar", {}]],
    },
    themeConfig: {
        nav: [
            {
                text: "GettingStarted",
                link: "/dev/04_infra/01_localDevelopment",
            },
            { text: "RoadMap", link: "/roadmap" },
            {
                text: "Repository",
                link: "https://github.com/Usuyuki/kadode_nikki3",
            },
        ],
    },
};
