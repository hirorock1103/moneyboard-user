<template>
    <footer class="footer">
        <div class="container">
            <div class="footer__container">
                <div class="footer__title">
                    <span class="footer__title-main [ logo logo__font-main ]"
                        >MoneyBoard</span
                    >
                    <span class="[ logo logo__font-sub ]"
                        >Finance × Technology × Laboratory</span
                    >
                </div>

                <nav class="[ nav nav--inline nav--secondary ]">
                    <ul>
                        <li
                            class="[ display-block display-inline-block-medium ]"
                        >
                            <router-link to="/privacy"
                                >プライバシーポリシー</router-link
                            >
                        </li>

                        <li
                            class="[ display-block display-inline-block-medium ]"
                        >
                            <router-link to="/terms">利用規約</router-link>
                        </li>

                        <li
                            class="[ display-block display-inline-block-medium ]"
                        >
                            <router-link to="/tokutei"
                                >特定商取引法に基づく表記</router-link
                            >
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="footer__copyright">
                <span
                    >[ 運営会社
                    ]　株式会社マネーボード　　　　〒574-0042　大阪府大東市大野１丁目５番９号</span
                ><br /><br />
                <span
                    >[ 開発会社
                    ]　株式会社ウェルステックラボ　〒574-0042　大阪府大東市大野１丁目５番９号</span
                >
            </div>

            <!-- <div class="footer__copyright">
                <span class="display-block padding-bottom--16"
                    >[ 運営会社 ]</span
                >
                <p>株式会社マネーボード</p>
                <address class="margin-top--16">
                    〒574-0042<br />
                    大阪府大東市大野１丁目５番９号<br />
                </address>
            </div> -->
        </div>
    </footer>
</template>

<script>
export default {};
</script>
