<template>
    <div class="faq">
        <!-- 検索ボックス -->
        <div class="faq__search">
            <span class="fas fa-search faq__search-icon"></span>
            <input
                type="text"
                class="faq__search-input"
                placeholder="キーワードで検索"
                v-model="searchQuery"
            />
        </div>

        <!-- Q&A一覧 -->
        <div v-if="filteredFaq.length === 0" class="faq__empty">
            該当する質問が見つかりませんでした。
        </div>
        <div
            v-for="item in filteredFaq"
            :key="item.id"
            class="faq__item"
        >
            <button
                type="button"
                class="faq__question"
                @click="toggle(item.id)"
            >
                <span class="faq__q-icon">Q</span>
                <span class="faq__q-text">{{ item.question }}</span>
                <span
                    class="fas faq__arrow"
                    :class="openIds.includes(item.id) ? 'fa-chevron-up' : 'fa-chevron-down'"
                ></span>
            </button>
            <div
                v-show="openIds.includes(item.id)"
                class="faq__answer"
            >
                <span class="faq__a-icon">A</span>
                <span class="faq__a-text" v-html="formatAnswer(item.answer)"></span>
            </div>
        </div>
    </div>
</template>

<script>
import faqData from "../data/faqData.js";

export default {
    name: "FaqSection",
    data() {
        return {
            faqItems: faqData,
            searchQuery: "",
            openIds: [],
        };
    },
    computed: {
        filteredFaq() {
            if (!this.searchQuery) return this.faqItems;
            const q = this.searchQuery.toLowerCase();
            return this.faqItems.filter(
                (item) =>
                    item.question.toLowerCase().includes(q) ||
                    item.answer.toLowerCase().includes(q)
            );
        },
    },
    methods: {
        toggle(id) {
            const index = this.openIds.indexOf(id);
            if (index >= 0) {
                this.openIds.splice(index, 1);
            } else {
                this.openIds.push(id);
            }
        },
        formatAnswer(text) {
            return text.replace(/\n/g, "<br>");
        },
    },
};
</script>

<style scoped>
.faq__search {
    position: relative;
    margin-bottom: 24px;
    max-width: 400px;
}

.faq__search-icon {
    position: absolute;
    top: 50%;
    left: 12px;
    transform: translateY(-50%);
    color: #999;
    font-size: 14px;
}

.faq__search-input {
    width: 100%;
    padding: 10px 12px 10px 36px;
    border: 1px solid #D5D5D5;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
}

.faq__search-input:focus {
    outline: none;
    border-color: #2FBCED;
}

.faq__empty {
    text-align: center;
    color: #999;
    padding: 48px 0;
}

.faq__item {
    margin-bottom: 12px;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
}

.faq__question {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 20px;
    background-color: #E8F7FC;
    border: none;
    cursor: pointer;
    text-align: left;
    font-size: 15px;
    font-weight: 700;
    color: #333;
}

.faq__question:hover {
    background-color: #D6F0F9;
}

.faq__q-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background-color: #2FBCED;
    color: #fff;
    font-weight: 700;
    font-size: 14px;
    flex-shrink: 0;
}

.faq__q-text {
    flex: 1;
}

.faq__arrow {
    color: #999;
    font-size: 12px;
    flex-shrink: 0;
}

.faq__answer {
    display: flex;
    gap: 12px;
    padding: 16px 20px;
    background-color: #f9f9f9;
    border-top: 1px solid #e0e0e0;
    font-size: 14px;
    line-height: 1.7;
    color: #555;
}

.faq__a-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background-color: #ccc;
    color: #fff;
    font-weight: 700;
    font-size: 14px;
    flex-shrink: 0;
}

.faq__a-text {
    flex: 1;
}
</style>
