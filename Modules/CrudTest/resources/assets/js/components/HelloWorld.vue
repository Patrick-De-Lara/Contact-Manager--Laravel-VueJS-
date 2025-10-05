<template>
  <div class="hello-world">
    <h1>{{ message }}</h1>
    <p>{{ description }}</p>
  </div>

  <button @click="showModal = true">Add Contact</button>

  <div>
    <h2>Contact List</h2>
    <ul>
      <li v-for="contact in contacts" :key="contact.id">
        {{ contact.name }} - {{ contact.email }} - {{ contact.phone }}
      </li>
    </ul>
  </div>

  <div v-if="showModal" class="modal-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 1000;">
    <div class="modal" style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto;">
      <h3 style="margin-top: 0; margin-bottom: 1.5rem; color: #333;">Add Contact</h3>
      <form @submit.prevent="submitForm">
        <div class="form-group" style="margin-bottom: 1rem;">
          <label for="name" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #555;">Name:</label>
          <input 
            type="text" 
            id="name" 
            v-model="form.name" 
            required 
            style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem; box-sizing: border-box;"
          />
        </div>
        <div class="form-group" style="margin-bottom: 1rem;">
          <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #555;">Email:</label>
          <input 
            type="email" 
            id="email" 
            v-model="form.email" 
            required 
            style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem; box-sizing: border-box;"
          />
        </div>
        <div class="form-group" style="margin-bottom: 1.5rem;">
          <label for="phone" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #555;">Phone:</label>
          <input 
            type="tel" 
            id="phone" 
            v-model="form.phone" 
            required 
            style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem; box-sizing: border-box;"
          />
        </div>
        <div class="form-buttons" style="display: flex; gap: 1rem; justify-content: flex-end;">
          <button type="button" @click="closeModal" style="padding: 0.75rem 1.5rem; border: 1px solid #ddd; background: #f8f9fa; color: #6c757d; border-radius: 4px; cursor: pointer; font-size: 1rem;">Cancel</button>
          <button type="submit" style="padding: 0.75rem 1.5rem; border: none; background: #007bff; color: white; border-radius: 4px; cursor: pointer; font-size: 1rem;">Save</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  homeText: 'HelloWorld',

  data() {
    return {
      contacts: [],
      homeText: 'HelloWorld',
      message: 'Hello World from Vue.js!',
      description: 'This is a Vue 3 component integrated with Laravel CrudTest module.',
      loading: false,
      error: null,
      showModal: false,
      form: {
        name: '',
        email: '',
        phone: '',
      },
    };
  },

  mounted() {
    this.fetchContacts();
  },

  methods: {
    async fetchContacts() {
      try {
        const response = await fetch('/api/test/contacts');
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        this.contacts = await response.json();
      } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
      }
    },
    closeModal() {
      this.showModal = false;
      this.resetForm();
    },
    async submitForm() {
      try {
        const response = await fetch('/api/test/contacts', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.form),
        });
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        const newContact = await response.json();
        this.contacts.push(newContact);
        this.closeModal();
      } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
      }
    },
  },
};

</script>

