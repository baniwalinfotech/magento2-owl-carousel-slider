var config = {
    map: {
        '*': {
            owl_carousel: 'Baniwal_OwlCarouselSlider/js/owl.carousel',
            owl_config: 'Baniwal_OwlCarouselSlider/js/owl.config',
            owlAjax: 'Baniwal_OwlCarouselSlider/js/owlAjax'
        }
    },
    shim: {
        owl_carousel: {
            deps: ['jquery']
        },
        owl_config: {
            deps: ['jquery','owl_carousel']
        },
        owlAjax: {
            deps: ['jquery','owl_carousel', 'owl_config']
        }
    }
};