<template>
    <ul
        class="progressbar [ [ margin-top--24 margin-top-large--0 ][ margin-bottom--24 margin-bottom-large--48 ] ]"
    >
        <li
            v-for="step in steps"
            :class="{
                'progress-item--done': step.done,
                'progress-transition': step.current,
                'progress-item--current': step.current,
            }"
            :key="step.id"
        >
            <span
                class="[ icon solid ] progress-item__icon"
                :class="[step.icon]"
            ></span>
            <span class="display-block">{{ step.text }}</span>
        </li>
    </ul>
</template>

<script>
export default {
    name: "progressBar",
    data() {
        return {
            steps: [
                {
                    id: 1,
                    text: "情報入力",
                    icon: "fa-pencil-alt",
                    done: true,
                },
                {
                    id: 2,
                    text: "確認",
                    icon: "fa-spell-check",
                    done: false,
                    current: false,
                },
                {
                    id: 3,
                    text: "クレジットカード登録(選択時のみ)",
                    icon: "fa-credit-card",
                    done: false,
                    current: false,
                },
                {
                    id: 4,
                    text: "クレジット情報確認",
                    icon: "fa-spell-check",
                    done: false,
                    current: false,
                },
                {
                    id: 5,
                    text: "完了",
                    icon: "fa-check-circle",
                    done: false,
                    current: false,
                },
            ],
        };
    },

    props: {
        currentStep: Number,
    },

    methods: {
        updateSteps() {
            for (let i = this.currentStep - 1; i >= 0; i--) {
                this.steps[i].done = true;
            }

            setTimeout(() => {
                this.steps[this.currentStep].current = true;
            }, 500);
        },
    },

    beforeMount() {
        if (this.currentStep !== null) {
            this.updateSteps();
        }
    },
};
</script>

<style lang="scss" scoped>
@import "resources/sass/abstracts/_variables.scss";
@import "resources/sass/vendors/_media.scss";
@import "resources/sass/components/_progressbar.scss";
</style>
