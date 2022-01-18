<template>
    <footer class="footer">
        <div class="container">

            <div class="footer__container">

                <div class="footer__title">
                    <span class="footer__title-main  [ logo  logo__font-main ]">MoneyBoard</span>
                    <span class="[ logo  logo__font-sub ]">Finance × Technology × Laboratory</span>
                </div>

                <nav class="[ nav  nav--inline  nav--secondary ]">

                    <ul>
                        <li class="[ display-block  display-inline-block-medium ]">
                            <router-link to="/privacy">プライバシーポリシー</router-link>
                        </li>

                        <li class="[ display-block  display-inline-block-medium ]">
                            <router-link to="/terms">利用規約</router-link>
                        </li>
                    </ul>

                </nav>

            </div>


            <div class="footer__copyright">
                <span class="display-block  padding-bottom--16">[ 運営会社 ]</span>
                <a href="https://ppfpart.co.jp/" target="_blank" rel="noopener noreferrer" class="font-weight-bold">株式会社PPFパートナーズ</a>
                <address class="margin-top--16">
                〒530-0041<br>
                大阪府大阪市北区天神橋1丁目7番17号 イケガミノースハウス4階<br>
                <a href="tel:0663146685">TEL : 06-6314-6685</a><br>
                </address>
            </div>

        </div>

    </footer>
</template>

<script>
export default {}
</script>
