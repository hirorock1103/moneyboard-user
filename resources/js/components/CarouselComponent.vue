<template>
    <div class="carousel">

        <div class="carousel__controls">

            <button class="[ carousel-controls__button  [ carousel__btn  carousel__btn--left ] ]" @click="previous">
                <span class="[ icon solid icon--bordered fa-caret-left ]"></span>
            </button>

        </div>

        <transition-group
            class="[ flex-container-center  justify-content-center ] carousel__container"
            tag="div">

            <div
                v-for="slide in slides"
                class="[ flex-container-center  justify-content-center  flex-column ]  carousel__slide"
                :key="slide.id">

                <img :src="slide.image" class="carousel__slide-img" alt="Money Boardのアプリのサンプルイメージ">

                <span class="carousel__slide-title  margin-top--16"> {{ slide.title }} </span>
            </div>

        </transition-group>

        <div class="carousel__controls">

            <button class="carousel__btn  carousel__btn--right" @click="next">
                <span class="[ icon solid icon--bordered fa-caret-right ]"></span>
            </button>

        </div>

    </div>
</template>

<script>
export default {
    name: 'Carousel',
    data () {
        return {
            slides: [
                {
                    id: 1,
                    image: 'images/home_page/sample_screen/sample_3.png',
                    title: '過去５期の「同業他社」との重要指標分析を5段階評価と折れ線チャートで表示'
                },
                {
                    id: 2,
                    image: 'images/home_page/sample_screen/sample_1.png',
                    title: '過去５期の自社データの売上や資産などの推移をグラフで表示'
                },
                {
                    id: 3,
                    image: 'images/home_page/sample_screen/sample_2.png',
                    title: '過去５期の「同業他社」との重要指標分析を5段階評価と折れ線チャートで表示'
                }
            ]
        }
    },
    methods: {
        next () {
            const first = this.slides.shift()
            this.slides = this.slides.concat(first)
        },
        previous () {
            const last = this.slides.pop()
            this.slides = [last].concat(this.slides)
        }
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/components/_carousel.scss';
</style>
