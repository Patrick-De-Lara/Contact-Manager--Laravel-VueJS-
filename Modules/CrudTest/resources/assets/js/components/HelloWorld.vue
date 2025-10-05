<template>
  <div class="hello-world" style="max-width: 800px; margin: 0 auto; padding: 2rem; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #ffffff; min-height: 100vh; color: #333;">
    <div style="text-align: center; margin-bottom: 3rem; padding: 2rem;">
      <h1 style="font-size: 2rem; margin-bottom: 1rem; font-weight: 300; color: #2c3e50;">{{ message }}</h1>
      <p style="font-size: 1rem; margin-bottom: 2rem; color: #666;">{{ description }}</p>
    </div>

    <div style="text-align: center; margin-bottom: 2rem;">
      <button @click="showModal = true" style="background: #007bff; color: white; border: none; padding: 0.75rem 1.5rem; font-size: 0.9rem; border-radius: 4px; cursor: pointer; font-weight: 400;">
        Add Contact
      </button>
    </div>

    <div style="background: #ffffff; border: 1px solid #e1e5e9; border-radius: 8px; padding: 2rem;">
      <h2 style="color: #2c3e50; margin-bottom: 1.5rem; font-size: 1.5rem; font-weight: 400; text-align: center; border-bottom: 1px solid #e1e5e9; padding-bottom: 1rem;">Contact List</h2>
      <ul style="list-style: none; padding: 0; margin: 0;">
        <li v-for="contact in contacts" :key="contact.id" style="background: #f8f9fa; margin-bottom: 0.5rem; padding: 1rem; border-radius: 4px; border-left: 3px solid #007bff; color: #333;">
          <div style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: center;">
            <span style="font-weight: 500; color: #2c3e50;">{{ contact.name }}</span>
            <span style="color: #666; font-size: 0.9rem;">{{ contact.email }}</span>
            <span style="color: #666; font-size: 0.9rem;">{{ contact.phone }}</span>
          </div>
        </li>
      </ul>
      <div v-if="contacts.length === 0" style="text-align: center; padding: 3rem; color: #666;">
        <p style="font-size: 1rem; margin: 0;">No contacts found. Add your first contact!</p>
      </div>
    </div>
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
    resetForm() {
      this.form = {
        name: '',
        email: '',
        phone: '',
      };
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

