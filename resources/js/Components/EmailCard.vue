<!-- resources/js/components/EmailCard.vue -->
<template>
  <div class="email-card">
    <h4>Email Communication</h4>
    <form @submit.prevent="sendEmail">
      <div class="form-group">
        <label for="emailSubject">Subject</label>
        <input id="emailSubject" v-model="subject" type="text" placeholder="Subject" required />
      </div>
      <div class="form-group">
        <label for="emailBody">Message</label>
        <textarea id="emailBody" v-model="body" placeholder="Your message here" required></textarea>
      </div>
      <button type="submit" class="btn" :disabled="sending">
        {{ sending ? 'Sending...' : 'Send Email' }}
      </button>
      <p v-if="error" class="error">{{ error }}</p>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'EmailCard',
  data() {
    return {
      subject: '',
      body: '',
      sending: false,
      error: null,
    };
  },
  methods: {
    async sendEmail() {
      this.sending = true;
      this.error = null;
      try {
        const response = await axios.post('/api/send-email', {
          subject: this.subject,
          body: this.body,
        });
        if (response.status === 200) {
          this.subject = '';
          this.body = '';
        }
      } catch (err) {
        console.error('Error sending email:', err);
        this.error = 'Failed to send email.';
      } finally {
        this.sending = false;
      }
    },
  },
};
</script>