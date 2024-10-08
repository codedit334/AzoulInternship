<template>
    <div>
        <header>
            <h1>My Dashboard</h1>
            <nav>
                nav
            </nav>
        </header>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: 'App',
};
</script>

<style>
/* Add your styles here */
header {
    background: #f8f8f8;
    padding: 20px;
    text-align: center;
}
nav a {
    margin: 0 15px;
    text-decoration: none;
    color: #333;
}
</style>
