<template>
  <div id="app">
    <Header></Header>
    <router-view/>
    <Footer></Footer>
  </div>
</template>

<script>
  import Header from "./components/Header";
  import Footer from "./components/Footer";
  export default {
    name: 'App',
    components: {Footer, Header}
  }
</script>

<style>

  html, body {
    min-height: 100%;
    margin: 0;
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
  }

  #app {
    font-family: "SF Pro Display","SF Pro Icons","Helvetica Neue","Helvetica",
    "Arial",sans-serif;
    margin-top: 50px;
  }

  /* Disable text selection */
  .noselect {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
</style>
