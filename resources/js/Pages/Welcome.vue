<template>
  <div class="bg-gray-100" style="overflow: hidden">
    <Head title="Die Mürwiker" />
    <div class="wrapper">
      <div class="header">
        <img :src="'https://www.muerwiker.de/typo3conf/ext/h2template/Resources/Public/Images/logomuerr.png'" v-on:click="reloadPage" style="height: 100px; cursor: pointer"/>
        <p>{{ time }}</p>
      </div>    
      <div> <ContactsFeed/> </div>
    </div>
  </div>
</template>

<script lang="ts">
import ContactsFeed from "@/Components/ContactsFeed.vue";
import { Head } from "@inertiajs/inertia-vue3";
import axios from "axios";

export default {
  name: "Muerwiker",
  components: {
    Head,
    ContactsFeed,
  },
  data() {
    return {
      time: "",
      config: {},
    };
  },
  mounted() {
    this.updateTime();
    setInterval(this.updateTime, 1000);
  },
  methods: {  
    updateTime() {
      this.time = new Date().toLocaleString();
    },
    reloadPage() {
      location.reload();
    }
  },
};
</script>

<style scoped>
.wrapper {
  margin: 20px;
}
.header {
  background-color: grey;
  padding: 20px;
  border-radius: 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #eee;
  font-weight: 500;
  font-size: 24px;
}
.header p {
  font-size: 20px;
  margin: 0;
}
</style>
