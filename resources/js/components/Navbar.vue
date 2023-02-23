<script>
    export default {
        data() {
            return {
                menuItems: [
                    {
                        link: '#1',
                        text: 'Home'
                    },
                    {
                        link: '#2',
                        text: 'About'
                    }
                ]
            }
        },
        methods: {

        }
    }
</script>
<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" data-bs-theme="dark">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li v-for="menuItem in menuItems" :key="menuItem.text" class="nav-item"><a class="nav-link" aria-current="page" :href="menuItem.link">{{ menuItem.text }}</a></li>
            </ul>
        </div>
    </nav>
</template>