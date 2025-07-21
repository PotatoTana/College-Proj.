// function showToast(msg = "เพิ่มเมนูแล้ว") {
//   const toast = document.getElementById('toast');
//   if (!toast) return;
//   toast.textContent = msg;
//   toast.style.opacity = 1;
//   setTimeout(() => {
//     toast.style.opacity = 0;
//   }, 2000);
// }

// openOrderBtn.addEventListener('click', () => {
//     if (cart.length === 0) {
//         showToast("ไม่มีสินค้าในตะกร้า");
//         return;
//     }
//     orderModal.style.display = 'block';
//     renderCart();
// });

// openHistoryBtn.addEventListener('click', () => {
//     // สมมุติข้อมูล history ยังไม่มี
//     if (noHistoryCondition) { // เปลี่ยนตรงนี้เป็น logic ของคุณจริงๆ
//         showToast("ยังไม่มีประวัติการสั่งซื้อ");
//         return;
//     }
//     // ... แสดง historyModal ปกติ ...
// });

// document.addEventListener('DOMContentLoaded', function () {
//   document.querySelectorAll('.add-btn').forEach(btn => {
//     btn.addEventListener('click', function () {
//       showToast();
//     });
//   });
// });

// Toast.js
function showToast(msg = "เพิ่มเมนูแล้ว", type = "info", duration = 2200) {
    const toast = document.getElementById('toast');
    if (!toast) return;
    toast.textContent = msg;
    toast.className = `show ${type}`;
    clearTimeout(window._toastTimer);
    window._toastTimer = setTimeout(() => {
        toast.className = "";
    }, duration);
}