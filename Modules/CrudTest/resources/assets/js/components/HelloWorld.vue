<template>

  <div class="hello-world" style="max-width: 800px; margin: 0 auto; padding: 2rem; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #ffffff; min-height: 100vh; color: #333;">
    <div style="text-align: center; padding: 2rem;">
      <h1 style="font-size: 2rem; font-weight: 300; color: #2c3e50;">{{ message }}</h1>
      <p style="font-size: 1rem; color: #666;">{{ description }}</p>
    </div>

    <!-- - Add Contact Button -->
    <div style="text-align: center; margin-bottom: 1rem;">
      <button @click="showModal = true" style="background: #007bff; color: white; border: none; padding: 0.75rem 1.5rem; font-size: 0.9rem; border-radius: 4px; cursor: pointer; font-weight: 400;">
        Add Contact
      </button>
    </div>

    <!-- - Contact List -->
    <div style="background: #ffffff; border: 1px solid #e1e5e9; border-radius: 8px; padding: 2rem;">
      <h2 style="color: #2c3e50; margin-bottom: 1.5rem; font-size: 1.5rem; font-weight: 400; text-align: center; border-bottom: 1px solid #e1e5e9; padding-bottom: 1rem;">Contact List</h2>
      <div style="max-height: 500px; overflow-y: auto;">
        <ul style="list-style: none; padding: 0; margin: 0;">
          <li v-for="contact in contacts" :key="contact.id" style="background: #f8f9fa; margin-bottom: 1rem; padding: 1.5rem; border-radius: 8px; border-left: 4px solid #007bff; color: #333; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div style="display: flex; align-items: center; justify-content: space-between;">
              <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                <!-- Avatar -->
                <div style="flex-shrink: 0;">
                  <img v-if="contact.profile_image" :src="contact.profile_image_url" alt="Avatar" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 3px solid #e9ecef;" />
                  <div v-else style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; border: 3px solid #e9ecef; color: white; font-size: 24px; font-weight: bold;">
                    {{ contact.name.charAt(0).toUpperCase() }}
                  </div>
                </div>
                
                <!-- Contact Info -->
                <div style="flex: 1;">
                  <h3 style="margin: 0 0 0.5rem 0; font-size: 1.2rem; font-weight: 600; color: #2c3e50;">{{ contact.name }}</h3>
                  <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #6c757d; font-size: 0.9rem;">
                      <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                      </svg>
                      <span>{{ contact.email }}</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; color: #6c757d; font-size: 0.9rem;">
                      <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                      </svg>
                      <span>{{ contact.phone }}</span>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Action Buttons -->
              <div style="display: flex; gap: 0.5rem; align-items: center; flex-shrink: 0;">
                <button @click="editContact(contact)" style="background: #28a745; color: white; border: none; padding: 0.5rem; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; transition: background-color 0.2s;">
                  <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                  </svg>
                </button>
                <button @click="deleteContact(contact.id)" style="background: #dc3545; color: white; border: none; padding: 0.5rem; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; transition: background-color 0.2s;">
                  <svg style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9zM4 5a2 2 0 012-2h8a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 102 0v-1a1 1 0 10-2 0v1zm4 0a1 1 0 102 0v-1a1 1 0 10-2 0v1z" clip-rule="evenodd"></path>
                  </svg>
                </button>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div v-if="contacts.length === 0" style="text-align: center; padding: 3rem; color: #666;">
        <p style="font-size: 1rem; margin: 0;">No contacts found. Add your first contact!</p>
      </div>
    </div>
  </div>

  <!-- - Modal for Adding Contact -->
  <div v-if="showModal" class="modal-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 1000;">
    <div class="modal" style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto;">
      <h3 style="margin-top: 0; margin-bottom: 1.5rem; color: #333;">
      {{ isEditing ? 'Edit Contact' : 'Add Contact' }}
      </h3>
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
        <div class="form-group" style="margin-bottom: 1rem;">
          <label for="phone" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #555;">Phone:</label>
          <input 
            type="tel" 
            id="phone" 
            v-model="form.phone" 
            required 
            style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem; box-sizing: border-box;"
          />
        </div>
        <div class="form-group" style="margin-bottom: 1.5rem;">
          <label for="avatar" style="display: block; margin-bottom: 0.5rem; font-weight: bold; color: #555;">Avatar:</label>
          <input 
            type="file" 
            id="profile_image" 
            @change="handleFileUpload"
            accept="image/*"
            style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 1rem; box-sizing: border-box;"
          />
          <div v-if="form.profile_image" style="margin-top: 0.5rem; font-size: 0.9rem; color: #666;">
            Selected: {{ form.profile_image.name }}
          </div>
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
      isEditing: false,
      form: {
        id: null,
        name: '',
        email: '',
        phone: '',
        profile_image: null,
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
      this.isEditing = false;
      this.resetForm();
    },
    resetForm() {
      this.form = {
        id: null,
        name: '',
        email: '',
        phone: '',
        profile_image: null,
      };
      const fileInput = document.getElementById('profile_image');
      if (fileInput) fileInput.value = '';
    },
    handleFileUpload(event) {
      this.form.profile_image = event.target.files[0];
    },
    async submitForm() {
      try {
        const formData = new FormData();
        
        // Add ID if editing
        if (this.form.id) {
          formData.append('id', this.form.id);
        }
        
        formData.append('name', this.form.name);
        formData.append('email', this.form.email);
        formData.append('phone', this.form.phone);
        
        // Append file if selected (for both create and update)
        if (this.form.profile_image) {
          formData.append('profile_image', this.form.profile_image);
        }

        const response = await fetch('/api/test/contacts', {
          method: 'POST',
          body: formData,
        });
        
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        
        const updatedContact = await response.json();
        
        if (this.form.id) 
        {
          // Update existing contact in the list
          const index = this.contacts.findIndex(c => c.id === this.form.id);
          if (index !== -1) {
            this.contacts[index] = updatedContact;
          }
        } else {
          this.contacts.push(updatedContact);
        }
        
        this.closeModal();
      } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
      }
    },
    async editContact(contact) {
      this.isEditing = true;
      this.form = {
        id: contact.id,
        name: contact.name,
        email: contact.email,
        phone: contact.phone,
        profile_image: null // Reset file input but keep existing image reference
      };
      this.showModal = true;
    },
    async deleteContact(id) {
      if (!confirm('Are you sure you want to delete this contact?')) {
        return;
      }
      
      try {
        const response = await fetch(`/api/test/contacts/${id}`, {
          method: 'DELETE',
        });
        
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        
        this.contacts = this.contacts.filter(c => c.id !== id);
      } catch (error) {
        console.error('There was a problem with the delete operation:', error);
      }
    },

  },
};

</script>

