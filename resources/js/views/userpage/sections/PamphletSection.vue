<template>
    <div class="pamphlet">
        <p class="pamphlet__desc">
            利用者向けの配布パンフレットをダウンロードできます。
        </p>

        <div class="pamphlet__notice">
            現在準備中です。完成次第こちらに掲載いたします。
        </div>

        <!-- パンフレットが追加されたらここに配置
        <div class="pamphlet__grid">
            <div class="pamphlet__card">
                <div class="pamphlet__preview">
                    <img src="/assets/userpage/pamphlets/sample.jpg" alt="パンフレット" />
                </div>
                <div class="pamphlet__actions">
                    <a href="/assets/userpage/pamphlets/sample.pdf" download class="pamphlet__dl-btn">
                        <span class="fas fa-file-pdf"></span> PDF
                    </a>
                    <a href="/assets/userpage/pamphlets/sample.jpg" download class="pamphlet__dl-btn">
                        <span class="fas fa-image"></span> JPEG
                    </a>
                </div>
            </div>
        </div>
        -->
    </div>
</template>

<script>
export default {
    name: "PamphletSection",
};
</script>

<style scoped>
.pamphlet__desc {
    font-size: 14px;
    color: #555;
    margin-bottom: 24px;
}

.pamphlet__notice {
    text-align: center;
    padding: 48px 0;
    color: #999;
    font-size: 15px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.pamphlet__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

.pamphlet__card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.pamphlet__preview img {
    width: 100%;
    display: block;
}

.pamphlet__actions {
    display: flex;
    justify-content: center;
    gap: 12px;
    padding: 16px;
}

.pamphlet__dl-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 20px;
    border: 1px solid #2FBCED;
    border-radius: 4px;
    color: #2FBCED;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.15s ease;
}

.pamphlet__dl-btn:hover {
    background-color: #2FBCED;
    color: #fff;
}
</style>
