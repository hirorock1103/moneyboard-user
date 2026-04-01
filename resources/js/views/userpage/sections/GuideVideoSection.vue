<template>
    <div class="guide">
        <div class="guide__grid">
            <div
                v-for="(video, index) in videos"
                :key="video.id"
                class="guide__card"
            >
                <div class="guide__video-wrap">
                    <video
                        :ref="'video' + video.id"
                        :src="video.src"
                        controls
                        preload="metadata"
                        class="guide__video"
                    ></video>
                </div>
                <h3 class="guide__title">
                    <span class="guide__number">{{ index + 1 }}</span>
                    {{ video.title }}
                </h3>
                <ul class="guide__timestamps">
                    <li
                        v-for="ts in video.timestamps"
                        :key="ts.time"
                        class="guide__ts-item"
                    >
                        <button
                            type="button"
                            class="guide__ts-btn"
                            @click="seekTo(video.id, ts.time)"
                        >
                            <span class="guide__ts-time">{{ formatTime(ts.time) }}</span>
                            <span class="guide__ts-label">{{ ts.label }}</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import guideVideoData from "../data/guideVideoData.js";

export default {
    name: "GuideVideoSection",
    data() {
        return {
            videos: guideVideoData,
        };
    },
    methods: {
        formatTime(seconds) {
            const min = String(Math.floor(seconds / 60)).padStart(2, "0");
            const sec = String(seconds % 60).padStart(2, "0");
            return min + ":" + sec;
        },
        seekTo(videoId, seconds) {
            const refKey = "video" + videoId;
            const videoEl = this.$refs[refKey];
            if (videoEl) {
                const el = Array.isArray(videoEl) ? videoEl[0] : videoEl;
                el.currentTime = seconds;
                el.play();
            }
        },
    },
};
</script>

<style scoped>
.guide__grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
}

@media (max-width: 991px) {
    .guide__grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 575px) {
    .guide__grid {
        grid-template-columns: 1fr;
    }
}

.guide__card {
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.guide__video-wrap {
    background-color: #f0f0f0;
}

.guide__video {
    width: 100%;
    display: block;
}

.guide__title {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 16px 20px 8px;
    font-size: 18px;
    font-weight: 700;
    color: #333;
    margin: 0;
}

.guide__number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background-color: #2FBCED;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    flex-shrink: 0;
}

.guide__timestamps {
    list-style: none;
    margin: 0;
    padding: 8px 20px 20px;
}

.guide__ts-item {
    border-bottom: 1px solid #f0f0f0;
}

.guide__ts-item:last-child {
    border-bottom: none;
}

.guide__ts-btn {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    padding: 8px 0;
    background: none;
    border: none;
    cursor: pointer;
    text-align: left;
    font-size: 14px;
    color: #555;
}

.guide__ts-btn:hover {
    color: #2FBCED;
}

.guide__ts-time {
    color: #2FBCED;
    font-weight: 700;
    font-family: monospace;
    min-width: 48px;
}

.guide__ts-label {
    flex: 1;
}
</style>
