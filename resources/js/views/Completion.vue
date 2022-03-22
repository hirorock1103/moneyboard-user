<template>
    <main>
        <section class="[ padding-top--24 padding-top-large--48 ] margin-bottom-large--48">
            <div class="container">
                <h2 class="text-center  heading-primary"> {{ title }}</h2>
                <ProgressBar v-show="currentStep" :current-step="currentStep" />
                <div class="text-center  [ [ margin-top--48  margin-top-large--80 ]  [ margin-bottom--48  margin-bottom-large--140 ] ]">
                    <p class="margin-bottom--88  [ padding-right--16  padding-left--16 ]">
                        <span v-for="(msg, index) in message">
                            {{ msg }}
                            <br v-if="index != Object.keys(message).length - 1">
                        </span>
                    </p>
                    <Button :type="redirectPage" />
                </div>
            </div>
        </section>
    </main>
</template>

<script>
// ToDo:エラーの解消→<span v-for="(msg, index) in message">
import ProgressBar from '../components/ProgressBarComponent.vue';
import Button from '../components/ButtonComponent.vue';

export default {
    name: 'completion',
    props: {
        title: String,
        message: {
            type: Array,
            required: true
        },
        redirectPage: String,
        currentStep: {
            type: Number,
            required: false,
            default: null
        },
    },
    components: {
        Button,
        ProgressBar
    }
}
</script>
