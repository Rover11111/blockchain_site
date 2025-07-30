// รอให้ DOM โหลดก่อน
document.addEventListener('DOMContentLoaded', () => {
  const el = document.getElementById('visitor-count');
  if (!el) return;
  fetch('https://api.countapi.xyz/hit/blockchain2025-demo/visits')
    .then(response => {
      if (!response.ok) throw new Error('Status ' + response.status);
      return response.json();
    })
    .then(data => {
      el.textContent = data.value;
    })
    .catch(err => {
      console.error('CountAPI failed:', err);
      el.textContent = 'ไม่สามารถโหลดสถิติได้';
    });
});
