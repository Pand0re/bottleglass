<template>
  <div class="main-container">
    <h1>{{ $t('t.about.OurEnterprise') }}</h1>
    <p v-html="$t('t.about.OurEnterpriseText')">
    </p>
    <h1>
      {{ $t('t.about.ContactUs') }}
    </h1>
    <p v-html="$t('t.about.ContactUsText') "></p>
  </div>
</template>

<script>
  export default {
    name: "Apropos"
  }
</script>

<style scoped>
</style>
