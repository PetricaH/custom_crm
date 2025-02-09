<!-- resources/js/components/WhatsAppChat.vue -->
<template>
  <div class="whatsapp-chat">
    <h4>WhatsApp Communication</h4>
    <div v-if="!chatInitiated">
      <p>Send initial template message to start chat with {{ phone }}</p>
      <button @click="sendTemplate" class="btn">Send Template</button>
    </div>
    <div v-else>
      <textarea v-model="message" placeholder="Type your message" rows="3"></textarea>
      <button @click="sendMessage" class="btn">Send Message</button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'WhatsAppChat',
  props: {
    phone: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      chatInitiated: false,
      message: '',
    };
  },
  methods: {
    async sendTemplate() {
      try {
        const response = await axios.post('/api/whatsapp/send-template', {
          phone: this.phone,
          template: 'initial_template',
          parameters: [],
        });
        if (response.status === 200) {
          this.chatInitiated = true;
        }
      } catch (error) {
        console.error('Error sending WhatsApp template:', error);
      }
    },
    async sendMessage() {
      try {
        const response = await axios.post('/api/whatsapp/send-message', {
          phone: this.phone,
          message: this.message,
        });
        if (response.status === 200) {
          this.message = '';
        }
      } catch (error) {
        console.error('Error sending WhatsApp message:', error);
      }
    },
  },
};
</script>
