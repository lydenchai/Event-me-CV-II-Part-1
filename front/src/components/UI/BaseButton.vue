<template>
  <button :class="mode">
    <slot></slot>
  </button>
</template>

<script>
  export default {
    props: ['mode'],
  };
</script>

<style scoped>

  button {
    padding: 0.75rem 1.5rem;
    font-family: inherit;
    background-color: var(--main-color);
    border: 1px solid var(--main-color);
    color: white;
    cursor: pointer;
  }

  button:hover,
  button:active {
    background-color: var(--main-color-light);
    border-color: var(--main-color-light);
  }

  .flat {
    background-color: transparent;
    color: var(--main-color);
    border: none;
  }

  .flat:hover,
  .flat:active {
    background-color: #edd2ff;
  }
</style>