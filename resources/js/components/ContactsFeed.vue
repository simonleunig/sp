<template>
  <div>
    <div>
      <h1>Items</h1>
    </div>
    <div v-for="contact in contacts" :key="contact.id">
      <div>
        <button
          class="custom"
          @click="crbt(contact.id)"
          style="width: 300px; margin: 0"
        >
          {{ contact.assignment }}
        </button>
      </div>
    </div>
    <br />
    <button
      class="custom"
      @click="crbt2(selecarti.id)"
      style="width: 300px; margin: 0"
    >
      {{ selecarti.city }}
    </button>
    <button
      class="custom"
      @click="crbt3(selecarti2.id)"
      style="width: 300px; margin: 0"
      @mouseover="upHere = true"
      @mouseleave="upHere = false"
    >
      {{ selecarti2.street }}
      <img :src="selecarti2.image" alt="" v-show="upHere" />
    </button>

    <button class="custom" style="width: 300px; margin: 0">
      {{ selecarti3.personone }}
      <br />
      <a :href="`mailto:${selecarti3.emailone}`">{{ selecarti3.emailone }}</a>
      <br />
      {{ selecarti3.phoneone }}
    </button>
  </div>
</template>

<script>
export default {
  name: "contactsFeed",
  data() {
    return {
      contacts: [],
      selecarti: {},
      selecarti2: {},
      selecarti3: {},
      upHere: false,
    };
  },
  mounted() {
    this.load();
  },
  methods: {
    async load() {
      const response = await axios.get("/api/get_all_contacts");
      if (response) {
        this.contacts = response.data.contacts;
      }
    },
    async crbt(id) {
      this.selecarti = this.contacts.find((contact) => contact.id == id);
    },
    async crbt2(id) {
      this.selecarti2 = this.contacts.find((contact) => contact.id == id);
    },
    async crbt3(id) {
      this.selecarti3 = this.contacts.find((contact) => contact.id == id);
    },
  },
};
</script>

<style scoped></style>
