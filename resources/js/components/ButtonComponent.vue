<template>
    <router-link v-if="type === 'login'" to="/login"  class="[ btn  btn--accent ]">ログインする</router-link>

    <router-link v-else to="/"  class="[ btn  btn--accent ]">戻る</router-link>
</template>

<script>
export default {
    name: 'Button',
    props: {
        type: String
    }
}
</script>
