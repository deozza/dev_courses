module.exports = {
    content: ['./src/routes/**/*.{svelte,js,ts}'],
    plugins: [require('daisyui')],
    safelist: [
      'progress-info',
      'progress-warning',
      'progress-error'
    ]
  };
  