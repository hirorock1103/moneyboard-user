<template>

    <div class="display-flex">
        <SideMenu v-if="isShow"/>
        <main class="mypage__main" :class="{noside_main:!isShow}">
            <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
                <div class="container">
                    <h2 class="text-center  heading-primary">利用規約</h2>
                        <article class="padding--16  bg-gray  [ [ margin-left-medium--48  margin-left-large--24 ] [ margin-right-medium--48  margin-right-large--24 ]  [ margin-bottom--48  margin-bottom-large--88 ] ]">
                            <div class="[ padding--24  padding-large--48 ]  bg-white">
                                <h4 class="margin-bottom--24">約款</h4>
                                <div class="table-scrollable">
                                    <small>
                                        本約款には、当社とユーザーとの間の権利義務関係及び本サービスの提供条件並びに当社の免責事項等が定められていますので、本サービスの利用にあたり、全文をお読みいただいたうえで、これに同意いただく必要があります。
                                    </small>
                                </div>
                            </div>
                        </article>
                </div>
            </section>
        </main>
    </div>
</template>

<script>
import SideMenu from '../../components/SideMenuComponent.vue';

export default {
    components: {
        SideMenu
    },
    data() {
        return {
            isShow: false,
        }
    },
    computed: {
        getCompany() {
            return this.$store.getters['auth/company']
        },
    },
    methods: {
        clearAuthToken () {
            localStorage.removeItem('authToken')
        }
    },
    created() {
        if( localStorage.getItem('authToken') && this.getCompany === null ){
            this.clearAuthToken()
        }

        // trueにしたりfalseにしたり
        this.isShow = localStorage.getItem('authToken')

    },
    mounted: function(){
        document.title = "利用規約 | MoneyBoard"
    },


}
</script>

<style lang="scss" scoped>
@import 'resources/sass/abstracts/_variables.scss';
@import 'resources/sass/vendors/_media.scss';
@import 'resources/sass/pages/_mypage.scss';
</style>
