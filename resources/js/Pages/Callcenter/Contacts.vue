<!-- This file is used to create, edit and delete contacts and add them to the database -->
<template>
  <div>
    <Head title="Datenbank" />
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Datenbank
        </h2>
      </template>
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <div class="wrapper">
                <div style="display: block; text-align: center">
                  <button
                    class="custom"
                    @click="showOverlay = true"
                    style="margin: auto; width: 300px"
                  >
                    Neuer Eintrag
                  </button>
                  <div v-if="contacts.length >= 1">
                    <table style="text-align: left; margin: 20px 0 0 0">
                      <tr>
                        <th>Zuordnung</th>
                        <th>Ort</th>
                        <th>Straße</th>
                        <th>Nummer</th>
                        <th>Schlüsselwörter</th>
                        <th>Erstellt am</th>
                      </tr>
                      <tr v-for="item in contacts" :key="item.id">
                        <td>
                          <div class="content">{{ item.assignment }}</div>
                        </td>
                        <td>
                          <div class="content">{{ item.city }}</div>
                        </td>
                        <td>
                          <div class="content">{{ item.street }}</div>
                        </td>
                        <td>
                          <div class="content">{{ item.number }}</div>
                        </td>
                        <td>
                          <div class="content">{{ item.keywords }}</div>
                        </td>
                        <td>
                          <div class="content">
                            {{ new Date(item.created_at).toLocaleString() }}
                          </div>
                        </td>
                        <td style="width: auto">
                          <button
                            class="custom small"
                            style="margin: auto"
                            @click="editContact(item.id)"
                          >
                            Bearbeiten
                          </button>
                        </td>
                        <td style="width: auto">
                          <button
                            class="custom small"
                            style="margin: auto"
                            @click="deleteContact(item.id)"
                          >
                            Löschen
                          </button>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
    <div v-if="showOverlay" class="overlay" @keydown.esc="showOverlay = false">
      <div class="form" @keydown.ctrl.enter="createContactEntry">
        <h2>Neuer Eintrag</h2>
        <input
          v-model="contactEntry.image"
          type="text"
          placeholder="Bild Link"
          style="width: 100%"
        />
        <input
          v-model="contactEntry.assignment"
          type="text"
          placeholder="Zuordnung"
          style="width: 100%"
        />
        <input
          v-model="contactEntry.city"
          type="text"
          placeholder="Ort"
          style="width: 100%"
        />
        <input
          v-model="contactEntry.street"
          type="text"
          placeholder="Straße"
          style="width: 100%"
        />
        <input
          v-model="contactEntry.number"
          type="text"
          placeholder="Nummer"
          style="width: 100%"
        />
        <input
          v-model="contactEntry.personone"
          type="text"
          placeholder="Ansprechpartner 1"
          style="width: 100%"
        />
        <input
          v-model="contactEntry.phoneone"
          type="text"
          placeholder="Telefon 1"
          style="width: 100%"
        />
        <input
          v-model="contactEntry.emailone"
          type="text"
          placeholder="Email 1"
          style="width: 100%"
        />
        <input
          v-model="contactEntry.persontwo"
          type="text"
          placeholder="Ansprechpartner 2"
          style="width: 100%"
        />
        <input
          v-model="contactEntry.phonetwo"
          type="text"
          placeholder="Telefon 2"
          style="width: 100%"
        />
        <input
          v-model="contactEntry.emailtwo"
          type="text"
          placeholder="Email 2"
          style="width: 100%"
        />
        <input
          v-model="contactEntry.emergency"
          type="text"
          placeholder="Notfallnummer"
          style="width: 100%"
        />
        <input
          v-model="contactEntry.keywords"
          type="text"
          placeholder="Schlüsselwörter"
          style="width: 100%"
        />
        <div class="action-wrapper">
          <button class="custom" @click="showOverlay = false">Schließen</button>
          <button class="custom" @click="createContactEntry">Erstellen</button>
        </div>
      </div>
    </div>
    <div
      v-if="showUpdateOverlay"
      class="overlay"
      @keydown.esc="showUpdateOverlay = false"
    >
      <div class="form" @keydown.ctrl.enter="updateContactEntry">
        <h2>Eintrag bearbeiten</h2>
        <input
          v-model="selectedContact.image"
          type="text"
          placeholder="Bild Link"
          style="width: 100%"
        />
        <input
          v-model="selectedContact.assignment"
          type="text"
          placeholder="Zuordnung"
          style="width: 100%"
        />
        <input
          v-model="selectedContact.city"
          type="text"
          placeholder="Ort"
          style="width: 100%"
        />
        <input
          v-model="selectedContact.street"
          type="text"
          placeholder="Straße"
          style="width: 100%"
        />
        <input
          v-model="selectedContact.number"
          type="text"
          placeholder="Nummer"
          style="width: 100%"
        />
        <input
          v-model="selectedContact.personone"
          type="text"
          placeholder="Ansprechpartner 1"
          style="width: 100%"
        />
        <input
          v-model="selectedContact.phoneone"
          type="text"
          placeholder="Telefon 1"
          style="width: 100%"
        />
        <input
          v-model="selectedContact.emailone"
          type="text"
          placeholder="Email 1"
          style="width: 100%"
        />
        <input
          v-model="selectedContact.persontwo"
          type="text"
          placeholder="Ansprechpartner 2"
          style="width: 100%"
        />
        <input
          v-model="selectedContact.phonetwo"
          type="text"
          placeholder="Telefon 2"
          style="width: 100%"
        />
        <input
          v-model="selectedContact.emailtwo"
          type="text"
          placeholder="Email 2"
          style="width: 100%"
        />
        <input
          v-model="selectedContact.emergency"
          type="text"
          placeholder="Notfallnummer"
          style="width: 100%"
        />
        <input
          v-model="selectedContact.keywords"
          type="text"
          placeholder="Schlüsselwörter"
          style="width: 100%"
        />
        <span
          >Zuletzt aktualisiert:
          {{ new Date(selectedContact.updated_at).toLocaleString() }}</span
        >
        <div class="action-wrapper">
          <button class="custom" @click="showUpdateOverlay = false">
            Schließen
          </button>
          <button class="custom" @click="updateContactEntry">Speichern</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
export default {
  components: {
    AuthenticatedLayout,
    Head,
  },
  data() {
    return {
      showOverlay: false,
      showUpdateOverlay: false,
      selectedContact: {},
      contacts: [],
      contactEntry: {
        image: "",
        assignment: "",
        city: "",
        street: "",
        number: "",
        personone: "",
        phoneone: "",
        emailone: "",
        persontwo: "",
        phonetwo: "",
        emailtwo: "",
        emergency: "",
        keywords: "",
      },
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
    // This method is used to create a contact
    async createContactEntry() {
      if (
        this.contactEntry.image != "" &&
        this.contactEntry.assignment != "" &&
        this.contactEntry.city != "" &&
        this.contactEntry.street != "" &&
        this.contactEntry.number != "" &&
        this.contactEntry.personone != "" &&
        this.contactEntry.phoneone != "" &&
        this.contactEntry.emailone != "" &&
        this.contactEntry.persontwo != "" &&
        this.contactEntry.phonetwo != "" &&
        this.contactEntry.emailtwo != "" &&
        this.contactEntry.emergency != "" &&
        this.contactEntry.keywords != ""
      ) {
        await axios
          .post("/api/create_contact", this.contactEntry)
          .then((response) => {
            this.load();
            this.showOverlay = false;
            this.contactEntry = {
              image: "",
              assignment: "",
              city: "",
              street: "",
              number: "",
              personone: "",
              phoneone: "",
              emailone: "",
              persontwo: "",
              phonetwo: "",
              emailtwo: "",
              emergency: "",
              keywords: "",
            };
          });
      } else {
        console.log("fill");
      }
    },
    // This method is used to update a contact
    editContact(id) {
      this.selectedContact = this.contacts.find((contact) => contact.id == id);
      this.showUpdateOverlay = true;
    },
    async updateContactEntry() {
      if (this.selectedContact) {
        await axios
          .post("/api/update_contact", this.selectedContact)
          .then((response) => {
            this.load();
            this.showUpdateOverlay = false;
          });
      }
    },
    // This method is used to delete a contact
    async deleteContact(id) {
      await axios.post("/api/delete_contact", { id }).then((response) => {
        this.load();
      });
    },
  },
};
</script>

<style scoped>
.header {
  display: flex;
  justify-content: center;
  margin: 10px 0;
  font-weight: 500;
  font-size: larger;
}
.wrapper {
  display: flex;
  justify-content: center;
}
</style>
