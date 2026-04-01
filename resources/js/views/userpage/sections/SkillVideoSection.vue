<template>
    <div class="skill">
        <p class="skill__desc">
            スキルアップ動画では、マネーボード内で使用されている各種指標や内容について、わかりやすく解説しています<br />
            また、〇〇分析＞×××＞△△△といった表記は、実際のマネーボード画面の構成と連動しています
        </p>

        <div class="skill__grid">
            <div
                v-for="video in videos"
                :key="video.id"
                class="skill__card"
            >
                <div class="skill__video-wrap">
                    <video
                        :src="video.src"
                        controls
                        preload="metadata"
                        class="skill__video"
                    ></video>
                </div>
                <div class="skill__info">
                    <h4 class="skill__title">
                        <span class="skill__index">{{ video.id }}</span>
                        {{ video.title }}
                    </h4>
                    <p class="skill__subtitle">{{ video.subtitle }}</p>
                    <p class="skill__path">{{ video.path }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import skillVideoData from "../data/skillVideoData.js";

export default {
    name: "SkillVideoSection",
    data() {
        return {
            videos: skillVideoData,
        };
    },
};
</script>

<style scoped>
.skill__desc {
    font-size: 14px;
    line-height: 1.8;
    color: #555;
    margin-bottom: 24px;
}

.skill__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

@media (max-width: 991px) {
    .skill__grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 575px) {
    .skill__grid {
        grid-template-columns: 1fr;
    }
}

.skill__card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.skill__video-wrap {
    background-color: #f0f0f0;
}

.skill__video {
    width: 100%;
    display: block;
}

.skill__info {
    padding: 16px;
    text-align: center;
}

.skill__title {
    font-size: 16px;
    font-weight: 700;
    color: #333;
    margin: 0 0 4px;
}

.skill__index {
    color: #2FBCED;
    margin-right: 4px;
}

.skill__subtitle {
    font-size: 13px;
    color: #777;
    margin: 0 0 8px;
}

.skill__path {
    font-size: 12px;
    color: #2FBCED;
    margin: 0;
}
</style>
