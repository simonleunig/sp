<!-- This file is used on the starting screen to display all items -->
<template>
  <div>
    <input
      type="text"
      v-model="searchInput"
      placeholder="Suchen..."
      @keyup="search()"
    />
    <button @click="showModal = true">Hilfe</button>
    <modal v-if="showModal" @close="showModal = false" class="overlay">
      <div class="form">
        <h2 style="text-decoration: underline">Hier bekommst du Hilfe!</h2>
        Die Webseite funktioniert ganz einfach. <br />
        - Klicke einfach unter der Tabelle Zuordnung auf eine beliebige
        Zuordnung. <br />
        - Danach erscheint in der Tabelle Ort, Orte die angeklickt werden
        können. Suche hier einen aus und klicke diesen an. <br />
        - In der Tabelle Straße sind dann alle Straßen zum zugehörigen Ort zu
        sehen. Wenn du mit dem Cursor rüber schwebst, ist manchmal auch ein Bild
        dabei. <br />
        - Klicke einfach auf eine beliebige Straße. <br />
        - Nun ist in der letzten Tabelle Kontakt ein Überblick aller Kontakte,
        die zu den vorher ausgewählten Tabellen gehören! <br />
        Falls keine Zuordnungen zu sehen sind, spreche mit dem Administrator.
        <div>
          <button @click="showModal = false" class="custom">Schließen</button>
        </div>
      </div>
    </modal>
  </div>
  <!-- The following div is used to show all the data. Each button has a @click function to show the next item -->
  <div class="container">
    <h1 class="one">Zuordnung
      <img src="/images/select-area-icon.png" alt="" style="height: 50%; width: 15%;display: block; margin: auto">
    </h1>
    <div class="assignment grid-style">
      <button
        v-for="(assignment, index) in uniqueAssignments"
        :key="index"
        @click="filterByAssignment(assignment)"
      >
        {{ assignment }}
      </button>
    </div>
    <h1 class="two">Ort
      <img src="/images/search-map-location-icon.png" alt="" style="height: 50%; width: 15%;display: block; margin: auto">
    </h1>
    <div class="city grid-style">
      <button
        v-for="(city, index) in uniqueCities"
        :key="index"
        @click="filterByCity(city)"
      >
        {{ city }}
      </button>
    </div>
    <h1 class="three">Straße
      <img src="/images/direction-road-sign-icon.png" alt="" style="height: 50%; width: 15%;display: block; margin: auto">
    </h1>
    <div class="street grid-style">
      <button
        v-for="(contact, index) in filteredCity"
        :key="index"
        @click="filterByStreet(contact.street)"
        @mouseover="
          upHere = true;
          streetImages[index] = contact.image;
        "
        @mouseleave="
          upHere = false;
          streetImages = {};
        "
      >
        {{ contact.street }}
        <img
          :src="streetImages[index]"
          alt=""
          v-show="upHere"
          class="grid-image"
        />
      </button>
    </div>
    <h1 class="four">Kontakt
      <img src="/images/contact-book-line-icon.png" alt="" style="height: 50%; width: 15%;display: block; margin: auto">
    </h1>
    <div class="contact grid-style">
      <div
        style="margin: 10px"
        v-for="(contact, index) in filteredStreet"
        :key="index"
      >
        {{ contact.personone }}
        <br />
        <a :href="`mailto:${contact.emailone}`"> {{ contact.emailone }}
        <img src="/images/email-icon.png" alt="" style="height: 7%; width: 7%; display: inline-block">
        </a>
        <br />
        <a :href="`tel:${contact.phoneone}`"> {{ contact.phoneone }}
        <img src="/images/phone-outline-icon.png" alt="" style="height: 7%; width: 7%; display: inline-block">
        </a>
        <div style="border-top: 4px solid white">
          {{ contact.persontwo }}
          <br />
          <a :href="`mailto:${contact.emailtwo}`"> {{ contact.emailtwo }}
          <img src="/images/email-icon.png" alt="" style="height: 7%; width: 7%; display: inline-block">
          </a>
          <br />
          <a :href="`tel:${contact.phonetwo}`"> {{ contact.phonetwo }}
          <img src="/images/phone-outline-icon.png" alt="" style="height: 7%; width: 7%; display: inline-block">
        </a>
        </div>
        <div style="border: 1px solid yellow">
          <a :href="`tel:${contact.emergency}`">
            Notfallnummer: {{ contact.emergency }}            
            <img src="/images/phone-outline-icon.png" alt="" style="height: 7%; width: 7%; display: inline-block">
          </a>
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
      searchInput: "",
      filteredContacts: [],
      filteredCity: [],
      filteredStreet: [],
      upHere: false,
      streetImages: {},
      showModal: false,
    };
  },
  mounted() {
    this.load();
  },
  // The two methods here are used to make sure only unique items are shown. No duplicates.
  computed: {
    uniqueAssignments() {
      return this.contacts
        .map((contact) => contact.assignment)
        .filter(
          (assignment, index, self) => self.indexOf(assignment) === index
        );
    },
    uniqueCities() {
      return this.filteredContacts
        .map((contact) => contact.city)
        .filter((city, index, self) => self.indexOf(city) === index);
    },
  },
  methods: {
    // Get the data from the api
    async load() {
      const response = await axios.get("/api/get_all_contacts");
      if (response) {
        this.contacts = response.data.contacts;
      }
    },
    // The filterBy methods are used when clicking on a button to load the next item.
    filterByAssignment(assignment) {
      this.resetFilters1();
      this.filteredContacts = this.contacts.filter(
        (contact) => contact.assignment === assignment
      );
    },
    filterByCity(city) {
      this.resetFilters2();
      this.filteredCity = this.filteredContacts.filter(
        (contact) => contact.city === city
      );
    },
    filterByStreet(street) {
      this.resetFilters3();
      this.filteredStreet = this.filteredCity.filter(
        (contact) => contact.street === street
      );
    },
    // When clicking on a Button the resetFilter methods get called to show only the next corresponding item.
    resetFilters1() {
      this.filteredContacts = [];
      this.filteredCity = [];
      this.filteredStreet = [];
    },
    resetFilters2() {
      this.filteredCity = [];
      this.filteredStreet = [];
    },
    resetFilters3() {
      this.filteredStreet = [];
    },
    // The Search and filterList method is used to search all items and display them using a text input.
    search() {
      if (this.searchInput === "") {
        // Reset the search input and filtered lists
        this.searchInput = "";
        this.filteredContacts = [];
        this.filteredCity = [];
        this.filteredStreet = [];
      } else {
        // Filter the contacts based on the search input
        this.filteredContacts = this.filterList(this.contacts);
        this.filteredCity = this.filterList(this.filteredContacts);
        this.filteredStreet = this.filterList(this.filteredCity);
      }
    },
    filterList(list) {
      return list.filter((contact) => {
        return (
          contact.assignment
            .toLowerCase()
            .includes(this.searchInput.toLowerCase()) ||
          contact.city.toLowerCase().includes(this.searchInput.toLowerCase()) ||
          contact.street
            .toLowerCase()
            .includes(this.searchInput.toLowerCase()) ||
          contact.personone
            .toLowerCase()
            .includes(this.searchInput.toLowerCase()) ||
          contact.phoneone
            .toLowerCase()
            .includes(this.searchInput.toLowerCase()) ||
          contact.phonetwo
            .toLowerCase()
            .includes(this.searchInput.toLowerCase()) ||
          contact.persontwo
            .toLowerCase()
            .includes(this.searchInput.toLowerCase())
        );
      });
    },
  },
};
</script>

<style scoped>
.container {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  grid-template-rows: 100px 100vh;
  gap: 5px 10px;
  overflow: auto;
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
.grid-image {
}
</style>
