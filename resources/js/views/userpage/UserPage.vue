<template>
    <div class="up">
        <!-- 専用ヘッダー -->
        <header class="up-header">
            <div class="up-header__inner">
                <div class="up-header__logo">
                    <img src="/images/header_logo.png" alt="MoneyBoard" />
                    <span class="up-header__logo-text">MoneyBoard</span>
                </div>
                <div class="up-header__right">
                    <div class="up-header__line">
                        <img
                            src="/images/common/line_icon.png"
                            alt="LINE"
                            class="up-header__line-icon"
                            onerror="this.style.display='none'"
                        />
                        <div class="up-header__line-text">
                            <span>MoneyBoard公式LINE</span><br />
                            <span>ID　@774wxsfi</span>
                        </div>
                        <img
                            src="/assets/userpage/images/line_qr.png"
                            alt="QRコード"
                            class="up-header__qr"
                            onerror="this.style.display='none'"
                        />
                    </div>
                    <a
                        href="https://lin.ee/placeholder"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="up-header__line-btn"
                    >友だち追加</a>
                    <button
                        type="button"
                        class="up-header__logout-btn"
                        @click="logout"
                    >ログアウト</button>
                </div>
            </div>
        </header>

        <!-- タブナビゲーション（sticky） -->
        <nav class="up-tabs" ref="tabsNav">
            <button
                v-for="tab in tabs"
                :key="tab.id"
                type="button"
                class="up-tabs__btn"
                :class="{ 'up-tabs__btn--active': activeTab === tab.id }"
                @click="activeTab = tab.id"
            >【{{ tab.label }}】</button>
        </nav>

        <!-- タブコンテンツ -->
        <main class="up-content">
            <FaqSection v-show="activeTab === 'faq'" />
            <GuideVideoSection v-show="activeTab === 'guide'" />
            <SkillVideoSection v-show="activeTab === 'skillup'" />
            <PamphletSection v-show="activeTab === 'pamphlet'" />
            <UpdateSection v-show="activeTab === 'update'" />
        </main>
    </div>
</template>

<script>
import { mapActions } from "vuex";
import FaqSection from "./sections/FaqSection.vue";
import GuideVideoSection from "./sections/GuideVideoSection.vue";
import SkillVideoSection from "./sections/SkillVideoSection.vue";
import PamphletSection from "./sections/PamphletSection.vue";
import UpdateSection from "./sections/UpdateSection.vue";

export default {
    name: "UserPage",
    components: {
        FaqSection,
        GuideVideoSection,
        SkillVideoSection,
        PamphletSection,
        UpdateSection,
    },
    data() {
        return {
            activeTab: "faq",
            tabs: [
                { id: "faq", label: "よくあるご質問" },
                { id: "guide", label: "操作ガイド動画" },
                { id: "skillup", label: "スキルアップ動画" },
                { id: "pamphlet", label: "利用者配布パンフレット" },
                { id: "update", label: "更新情報" },
            ],
        };
    },
    methods: {
        ...mapActions("auth", ["sendLogoutRequest"]),
        async logout() {
            await this.sendLogoutRequest();
            this.$router.push("/login");
        },
    },
    mounted() {
        document.title = "担当者ページ | MoneyBoard";
    },
};
</script>

<style scoped>
/* ===== 全体 ===== */
.up {
    min-height: 100vh;
    background-color: #f5f5f5;
}

/* ===== ヘッダー ===== */
.up-header {
    background-color: #ffffff;
    border-bottom: 1px solid #e0e0e0;
    padding: 12px 24px;
}

.up-header__inner {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}

.up-header__logo {
    display: flex;
    align-items: center;
    gap: 8px;
}

.up-header__logo img {
    height: 36px;
}

.up-header__logo-text {
    font-size: 22px;
    font-weight: 700;
    color: #333;
    letter-spacing: 0.05em;
}

.up-header__right {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.up-header__line {
    display: flex;
    align-items: center;
    gap: 10px;
}

.up-header__line-icon {
    width: 40px;
    height: 40px;
}

.up-header__line-text {
    font-size: 13px;
    line-height: 1.4;
    color: #333;
}

.up-header__qr {
    width: 48px;
    height: 48px;
}

.up-header__line-btn {
    display: inline-block;
    background-color: #06C755;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    padding: 8px 20px;
    border-radius: 4px;
    text-decoration: none;
    white-space: nowrap;
}

.up-header__line-btn:hover {
    opacity: 0.85;
}

.up-header__logout-btn {
    background: none;
    border: 1px solid #ccc;
    color: #666;
    font-size: 13px;
    padding: 6px 16px;
    border-radius: 4px;
    cursor: pointer;
}

.up-header__logout-btn:hover {
    background-color: #f0f0f0;
}

/* ===== タブナビゲーション ===== */
.up-tabs {
    position: sticky;
    top: 0;
    z-index: 100;
    background-color: #ffffff;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 0;
    padding: 16px 24px 0;
    border-bottom: 1px solid #e0e0e0;
}

.up-tabs__btn {
    background: none;
    border: 1px solid #D5D5D5;
    border-bottom: none;
    color: #4E4E4E;
    cursor: pointer;
    font-size: 14px;
    font-weight: 700;
    padding: 12px 20px;
    letter-spacing: 0.05em;
    border-radius: 4px 4px 0 0;
    transition: all 0.15s ease;
    white-space: nowrap;
}

.up-tabs__btn--active {
    background-color: #2FBCED;
    border-color: #2FBCED;
    color: #ffffff;
}

.up-tabs__btn:hover:not(.up-tabs__btn--active) {
    background-color: #f0f0f0;
}

/* ===== コンテンツ ===== */
.up-content {
    max-width: 1400px;
    margin: 0 auto;
    padding: 32px 24px;
}
</style>
