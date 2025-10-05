import { createApp } from 'vue';
import HelloWorld from './components/HelloWorld.vue';

console.log('Vue app.js loaded');

const app = createApp(HelloWorld);

console.log('Mounting Vue app...');
app.mount('#app');
console.log('Vue app mounted successfully');
