<template>
    <main>
        <section
            class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48"
        >
            <div class="container">
                <h2 class="text-center heading-primary">{{ title }}</h2>
                <ProgressBar v-show="currentStep" :current-step="currentStep" />
                <div
                    class="text-center [ [ margin-top--48 margin-top-large--80 ] [ margin-bottom--48 margin-bottom-large--140 ] ]"
                >
                    <p
                        class="margin-bottom--88 [ padding-right--16 padding-left--16 ]"
                    >
                        <span v-for="(msg, index) in message">
                            {{ msg }}
                            <br
                                v-if="index != Object.keys(message).length - 1"
                            />
                        </span>
                    </p>

                    <!-- 開発モード: 登録情報カード -->
                    <div v-if="registrationInfo" class="registration-info-card">
                        <div class="registration-info-header">
                            <span class="registration-info-badge">DEV</span>
                            登録情報（メール送信スキップ）
                        </div>
                        <table class="registration-info-table">
                            <tr>
                                <th>カンパニーコード</th>
                                <td><code>{{ registrationInfo.companyCode }}</code></td>
                            </tr>
                            <tr>
                                <th>カンパニーID</th>
                                <td><code>{{ registrationInfo.companyId }}</code></td>
                            </tr>
                            <tr>
                                <th>会社名</th>
                                <td>{{ registrationInfo.companyName }}</td>
                            </tr>
                            <tr>
                                <th>住所</th>
                                <td>〒{{ registrationInfo.postNumber }} {{ registrationInfo.address }}</td>
                            </tr>
                            <tr>
                                <th>電話番号</th>
                                <td>{{ registrationInfo.phoneNumber }}</td>
                            </tr>
                            <tr>
                                <th>担当者</th>
                                <td>{{ registrationInfo.companyRep }}</td>
                            </tr>
                            <tr>
                                <th>携帯番号</th>
                                <td>{{ registrationInfo.mobileNumber }}</td>
                            </tr>
                            <tr>
                                <th>決済方法</th>
                                <td>{{ registrationInfo.paymentType }}</td>
                            </tr>
                            <tr>
                                <th>プラン</th>
                                <td>{{ registrationInfo.plan }}</td>
                            </tr>
                            <tr>
                                <th>追加ライセンス</th>
                                <td>{{ registrationInfo.addLicenseCount }}社</td>
                            </tr>
                        </table>
                    </div>

                    <Button :type="redirectPage" />
                </div>
            </div>
        </section>
    </main>
</template>

<script>
// ToDo:エラーの解消→<span v-for="(msg, index) in message">
import ProgressBar from "../components/ProgressBarComponent.vue";
import Button from "../components/ButtonComponent.vue";

export default {
    name: "completion",
    props: {
        type: String,
        title: String,
        message: {
            type: Array,
            required: true,
        },
        redirectPage: String,
        currentStep: {
            type: Number,
            required: false,
            default: null,
        },
    },
    data() {
        return {
            registrationInfo: null,
        };
    },
    components: {
        Button,
        ProgressBar,
    },
    mounted() {
        const stored = sessionStorage.getItem('registrationInfo');
        if (stored) {
            this.registrationInfo = JSON.parse(stored);
            sessionStorage.removeItem('registrationInfo');
        }
        if (this.type === "register") {
            localStorage.removeItem("registerToken");
        }
        if (typeof this.title === "undefined") {
            this.$router.push({
                name: "login",
            });
        }
    },
};
</script>

<style scoped>
.registration-info-card {
    max-width: 560px;
    margin: 0 auto 48px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    text-align: left;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}
.registration-info-header {
    background: #f39c12;
    color: #fff;
    padding: 12px 20px;
    font-weight: bold;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.registration-info-badge {
    background: #fff;
    color: #f39c12;
    font-size: 11px;
    font-weight: bold;
    padding: 2px 8px;
    border-radius: 4px;
}
.registration-info-table {
    width: 100%;
    border-collapse: collapse;
}
.registration-info-table tr {
    border-bottom: 1px solid #f0f0f0;
}
.registration-info-table tr:last-child {
    border-bottom: none;
}
.registration-info-table th {
    background: #fafafa;
    padding: 10px 16px;
    font-size: 13px;
    font-weight: 600;
    color: #666;
    width: 140px;
    vertical-align: middle;
}
.registration-info-table td {
    padding: 10px 16px;
    font-size: 14px;
    color: #333;
    vertical-align: middle;
}
.registration-info-table code {
    background: #f5f5f5;
    padding: 2px 8px;
    border-radius: 4px;
    font-family: 'SF Mono', 'Consolas', monospace;
    font-size: 13px;
    color: #e74c3c;
}
</style>
