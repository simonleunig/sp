<template>
<div>
    <input type="text" v-model="searchInput" placeholder="Search..." @keyup="search()" />
    </div>
  <div class="container">
    <h1 class="one">Zuordnung</h1>
    <div class="assignment grid-style">
      <button
        v-for="(contact, index) in uniqueContacts"
        :key="index"
        @click="filterByAssignment(contact.assignment)"
      >
        {{ contact.assignment }}
      </button>
    </div>
    <h1 class="two">Ort</h1>
    <div class="city grid-style">
      <button
        v-for="(contact, index) in filteredContacts"
        :key="index"
        @click="filterByCity(contact.city)"
      >
        {{ contact.city }}
      </button>
    </div>
    <h1 class="three">Straße</h1>
    <div class="street grid-style">
      <button
        v-for="(contact, index) in filteredCity"
        :key="index"
        @click="filterByStreet(contact.street)"
        @mouseover="upHere = true"
        @mouseleave="upHere = false"
      >
        {{ contact.street }}
        <img :src="contact.image" alt="" v-show="upHere" />
      </button>
    </div>
    <h1 class="four">Kontakt</h1>
    <div class="contact grid-style">
      <div
        style="margin: 10px"
        v-for="(contact, index) in filteredStreet"
        :key="index"
      >
        {{ contact.personone }}
        <br />
        <a :href="`mailto:${contact.emailone}`"> {{ contact.emailone }}</a>
        <br />
        <a :href="`tel:${contact.phoneone}`"> {{ contact.phoneone }} </a>
        <div style="border-top: 1px solid white">
          {{ contact.persontwo }}
          <br />
          <a :href="`mailto:${contact.emailtwo}`"> {{ contact.emailtwo }}</a>
          <br />
          <a :href="`tel:${contact.phonetwo}`"> {{ contact.phonetwo }} </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "contactsFeed",
  data() {
    return {
      contacts: [],
      filteredContacts: [],
      filteredCity: [],
      filteredStreet: [],
      upHere: false,
    };
  },
  mounted() {
    this.load();
  },
  computed: {
    uniqueContacts() {
      return this.contacts.filter((contact, index) => {
        return (
          this.contacts.findIndex(
            (i) => i.assignment === contact.assignment
          ) === index
        );
      });
    },
  },
  methods: {
    async load() {
      const response = await axios.get("/api/get_all_contacts");
      if (response) {
        this.contacts = response.data.contacts;
      }
    },
    filterByAssignment(assignment) {
      this.resetFilters1();
      this.filteredContacts = this.contacts.filter(
        (contact) => contact.assignment === assignment
      );
    },
    filterByCity(city) {
      this.resetFilters2();
      this.filteredCity = this.contacts.filter(
        (contact) => contact.city === city
      );
    },
    filterByStreet(street) {
      this.filteredStreet = this.contacts.filter(
        (contact) => contact.street === street
      );
    },
    resetFilters1() {
      this.filteredCity = [];
      this.filteredStreet = [];
    },
    resetFilters2() {
      this.filteredStreet = [];
    },
    search() {      
      this.filteredContacts = this.contacts.filter((contact) => contact.assignment.includes(this.searchInput));
      this.filteredCity = this.contacts.filter((contact) => contact.city.includes(this.searchInput));
      this.filteredStreet = this.contacts.filter((contact) => contact.street.includes(this.searchInput) || 
      contact.personone.includes(this.searchInput) || 
      contact.emailone.includes(this.searchInput) || 
      contact.phoneone.includes(this.searchInput) || 
      contact.persontwo.includes(this.searchInput) || 
      contact.emailtwo.includes(this.searchInput) || 
      contact.phonetwo.includes(this.searchInput)
      );
    },
  },
};
</script>

<style scoped>
.container {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  grid-template-rows: 100px 500px;
  gap: 5px 10px;
  grid-template-areas:
    "one two three four"
    "assignment city street contact";
}
h1 {
  font-weight: 500;
  font-size: 24px;
  background: lightgray;
  text-align: center;
}
.one {
  grid-area: one;
}
.two {
  grid-area: two;
}
.three {
  grid-area: three;
}
.four {
  grid-area: four;
}
.grid-style {
  color: white;
  font-size: 22px;
}
.assignment {
  grid-area: assignment;
  background: #1b3d8f;
}
.city {
  grid-area: city;
  background: #1b3d8f;
  color: white;
}
.street {
  grid-area: street;
  background: #1b3d8f;
}
.contact {
  grid-area: contact;
  background: #1b3d8f;
}
button {
  display: block;
  text-align: left;
  margin: 10px;
}
button:hover {
  background-color: grey;
}
</style>
