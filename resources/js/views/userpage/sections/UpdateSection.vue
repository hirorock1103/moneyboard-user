<template>
    <div class="update">
        <p class="update__desc">
            MoneyBoardの更新情報をお知らせします。
        </p>

        <div class="update__notice">
            現在準備中です。更新情報が追加され次第こちらに掲載いたします。
        </div>

        <!-- 更新情報が追加されたらここに配置
        <div class="update__list">
            <div class="update__item">
                <span class="update__date">2025.01.01</span>
                <span class="update__badge update__badge--new">NEW</span>
                <span class="update__text">更新情報のサンプルテキストです。</span>
            </div>
        </div>
        -->
    </div>
</template>

<script>
export default {
    name: "UpdateSection",
};
</script>

<style scoped>
.update__desc {
    font-size: 14px;
    color: #555;
    margin-bottom: 24px;
}

.update__notice {
    text-align: center;
    padding: 48px 0;
    color: #999;
    font-size: 15px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.update__list {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.update__item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px 24px;
    border-bottom: 1px solid #f0f0f0;
    font-size: 14px;
}

.update__item:last-child {
    border-bottom: none;
}

.update__date {
    color: #999;
    font-size: 13px;
    white-space: nowrap;
}

.update__badge {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 3px;
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.update__badge--new {
    background-color: #FF6B6B;
    color: #fff;
}

.update__text {
    color: #333;
}
</style>
