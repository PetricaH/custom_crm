<!-- resources/js/components/InteractionCard.vue -->
<template>
  <div class="interaction-card">
    <h4>{{ interaction.type | capitalize }}</h4>
    <p>{{ interaction.notes }}</p>
    <div class="actions">
      <button @click="editInteraction" class="btn">Edit</button>
      <button @click="deleteInteraction" class="btn btn-danger">Delete</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'InteractionCard',
  props: {
    interaction: {
      type: Object,
      required: true,
    },
  },
  methods: {
    editInteraction() {
      this.$emit('edit', this.interaction);
    },
    deleteInteraction() {
      this.$emit('delete', this.interaction);
    },
  },
  filters: {
    capitalize(value) {
      if (!value) return '';
      return value.charAt(0).toUpperCase() + value.slice(1);
    },
  },
};
</script>
