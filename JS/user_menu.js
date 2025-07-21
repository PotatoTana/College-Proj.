document.addEventListener('DOMContentLoaded', () => {
    let isEventAttached = false;
    // --- 1. Menu Switching System (Dynamic Rendering) ---
    const mainTabs = document.querySelectorAll('.tab-button');
    const subcategoryTabsContainer = document.getElementById('subcategoryTabs');
    const menuContainer = document.getElementById('menuContainer');
    const subcategories = {
        recommend: ["New", "Best Sale"],
        food: ["Pizza", "Pasta", "Burger", "Main"],
        drink: ["Coffee", "Milk", "Fruit", "Tea"],
        dessert: ["Cake", "Kaki", "Toast", "Crepe"],
        special: ["Special Drinks"]
    };

    let currentMain = 'recommend';
    let currentSub = 'new';

    function createGenericMenu(items, main, sub) {
        const ul = document.createElement('ul');
        ul.className = 'menu-list active slide-in-right';
        ul.dataset.main = main;
        ul.dataset.sub = sub;

        if (items.length === 0) {
            ul.innerHTML = `<li><p style="text-align:center; width:100%; color:#888;">- ไม่มีรายการในหมวดนี้ -</p></li>`;
            return ul;
        }

        items.forEach(item => {
            const li = document.createElement('li');
            li.className = item.is_closed === "1" ? "menu-closed" : "";
            li.innerHTML = `
                <img src="uploads/${item.image}" alt="${item.name}">
                <strong>${item.name}</strong><br>
                ${item.price} ฿
                ${sub === 'best sale' && item.total_ordered ? `<div style="color: #555; font-size: 12px;">🔥 ${item.total_ordered} orders</div>` : ''}
                <div class="button-row">
                    <button class="add-btn"
                        data-name="${item.name}"
                        data-price="${item.price}"
                        data-group="${item.menu_group}"
                        data-is-closed="${item.is_closed}"
                        ${item.is_closed === "1" ? "disabled" : ""}>
                        เพิ่มลงตะกร้า
                    </button>
                    <span class="soldout-label" style="display:${item.is_closed === "1" ? 'inline' : 'none'};color:red;font-weight:bold;">หมด</span>
                </div>
            `;
            ul.appendChild(li);
        });
        return ul;
    }

    function createDrinkMenu(items, main, sub) {
        const container = document.createElement('div');
        container.className = 'menu-list active slide-in-right';
        container.dataset.main = main;
        container.dataset.sub = sub;
        const grouped = { Hot: [], Iced: [], Smoothie: [] };
        items.forEach(item => {
            if (grouped[item.drink_type]) {
                grouped[item.drink_type].push(item);
            }
        });

        if (items.length === 0) {
            container.innerHTML = `<p style="text-align:center; width:100%; color:#888;">- ไม่มีรายการในหมวดนี้ -</p>`;
            return container;
        }
        
        for (const drinkType in grouped) {
            if (grouped[drinkType].length > 0) {
                const row = document.createElement('div');
                row.className = 'drink-row';
                const h3 = document.createElement('h3');
                h3.textContent = drinkType;
                row.appendChild(h3);
                const scrollDiv = document.createElement('div');
                scrollDiv.className = 'drink-scroll';
                
                grouped[drinkType].forEach(item => {
                    const card = document.createElement('div');
                    card.className = `drink-card ${item.is_closed === "1" ? "menu-closed" : ""}`;
                    card.innerHTML = `
                        <img src="uploads/${item.image}" alt="${item.name}">
                        <div class="name">${item.name}</div>
                        <div class="price">${item.price} ฿</div>
                        <button class="add-btn" 
                            data-name="${item.name}" 
                            data-price="${item.price}"
                            data-group="${item.menu_group}"
                            data-is-closed="${item.is_closed}"
                            ${item.is_closed === "1" ? "disabled" : ""}>
                            เพิ่มลงตะกร้า
                        </button>
                        <span class="soldout-label" style="display:${item.is_closed === "1" ? 'inline' : 'none'};color:red;font-weight:bold;">หมด</span>
                    `;
                    scrollDiv.appendChild(card);
                });
                row.appendChild(scrollDiv);
                container.appendChild(row);
            }
        }
        return container;
    }

    async function fetchAndRenderMenu(main, sub) {
        const menuContainer = document.getElementById('menuContainer');

        // ลบ element เดิมอย่างปลอดภัย (เคลียร์ทั้ง loader และเมนูเก่า)
        while (menuContainer.firstChild) {
            menuContainer.removeChild(menuContainer.firstChild);
        }

        // สร้าง loader ใหม่แบบปลอดภัย
        const loader = document.createElement('div');
        loader.className = 'loader';
        loader.textContent = 'Loading...';
        menuContainer.appendChild(loader);

        try {
            const response = await fetch(`get_menu.php?main=${main}&sub=${sub.toLowerCase()}`);
            if (!response.ok) throw new Error('Network error');
            const items = await response.json();
            if (items.error) throw new Error(items.error);

            // ลบ loader ออก
            menuContainer.removeChild(loader);

            let menuElement;
            if (main === 'drink') {
                menuElement = createDrinkMenu(items, main, sub);
            } else {
                menuElement = createGenericMenu(items, main, sub);
            }

            // เพิ่มอนิเมชันเข้าไป (โดยปลอดภัย)
            if (menuElement) {
                menuElement.classList.add('animate-slide-in');

                // แก้สำคัญที่สุด: ใช้ setTimeout เคลียร์ class animation หลังจบเพื่อไม่ให้ infinite
                setTimeout(() => {
                    menuElement.classList.remove('animate-slide-in');
                }, 500);

                menuContainer.appendChild(menuElement);
            } else {
                const noData = document.createElement('p');
                noData.style.color = 'red';
                noData.style.textAlign = 'center';
                noData.textContent = 'ไม่มีข้อมูลเมนู';
                menuContainer.appendChild(noData);
            }
        } catch (error) {
            console.error('Fetch error:', error);
            menuContainer.removeChild(loader); // ลบ loader เมื่อ error
            const errorMsg = document.createElement('p');
            errorMsg.style.color = 'red';
            errorMsg.style.textAlign = 'center';
            errorMsg.textContent = 'ไม่สามารถโหลดข้อมูลเมนูได้';
            menuContainer.appendChild(errorMsg);
        }
    }


    function renderSubTabs(mainCat) {
        subcategoryTabsContainer.innerHTML = '';
        subcategories[mainCat].forEach((sub, i) => {
            const btn = document.createElement('button');
            btn.className = 'sub-tab-button' + (i === 0 ? ' active' : '');
            btn.dataset.sub = sub.toLowerCase();
            btn.textContent = sub;
            subcategoryTabsContainer.appendChild(btn);
        });
    }

    mainTabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const newMain = tab.dataset.main;
            if (newMain === currentMain) return;
            currentMain = newMain;
            currentSub = subcategories[newMain][0].toLowerCase();
            mainTabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            renderSubTabs(newMain);
            fetchAndRenderMenu(newMain, currentSub);
        });
    });

    subcategoryTabsContainer.addEventListener('click', e => {
        if (!e.target.matches('.sub-tab-button')) return;
        const newSub = e.target.dataset.sub;
        if (newSub === currentSub) return;
        currentSub = newSub;
        subcategoryTabsContainer.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
        e.target.classList.add('active');
        fetchAndRenderMenu(currentMain, newSub);
    });

    // Initial Load
    renderSubTabs(currentMain);
    fetchAndRenderMenu(currentMain, currentSub);


    // --- 2. Cart System ---
    const cart = [];
    const orderModal = document.getElementById('orderModal');
    const orderContent = document.getElementById('orderContent');
    const openOrderBtn = document.getElementById('openOrderBtn');
    const closeOrderBtn = document.querySelector('.close-order');

    function renderCart() {
        orderContent.innerHTML = '';
        if (cart.length === 0) {
            orderContent.innerHTML = '<p style="text-align: center; color: #888;">ยังไม่มีรายการในตะกร้า</p>';
            return;
        }

        const grouped = {};
        cart.forEach(item => {
            const key = item.name + '|' + (item.group || '');
            if (!grouped[key]) {
                grouped[key] = { ...item, qty: 1, comment: item.comment || '' };
            } else {
                grouped[key].qty++;
            }
        });

        let total = 0;
        let index = 1;
        for (const key in grouped) {
            const item = grouped[key];
            const subtotal = item.qty * parseFloat(item.price);
            total += subtotal;

            const row = document.createElement('div');
            row.className = 'order-row';
            row.innerHTML = `
                <div class="order-name">${index++}. ${item.name}</div>
                <div class="order-qty">
                    <button class="qty-btn decrease" data-name="${item.name}" data-group="${item.group || ''}">-</button>
                    <span>${item.qty}</span>
                    <button class="qty-btn increase" data-name="${item.name}" data-group="${item.group || ''}">+</button>
                </div>
                <div class="order-subtotal">${subtotal.toFixed(2)} ฿</div>
                <textarea class="comment-box" placeholder="รายละเอียดเพิ่มเติม..." data-name="${item.name}" data-group="${item.group || ''}">${item.comment}</textarea>
            `;
            orderContent.appendChild(row);
        }

        const totalP = document.createElement('p');
        totalP.className = 'order-total';
        totalP.innerHTML = `<strong>Total: ${total.toFixed(2)} ฿</strong>`;
        orderContent.appendChild(totalP);

        const orderBtn = document.createElement('button');
        orderBtn.className = 'checkout-btn';
        orderBtn.textContent = 'สั่งออเดอร์';
        orderContent.appendChild(orderBtn);
    }
    
    // Event listener สำหรับปุ่มเพิ่ม-ลดในตะกร้า และปุ่มสั่งซื้อ
    orderContent.addEventListener('click', e => {
        if (e.target.classList.contains('qty-btn')) {
            const { name, group = '' } = e.target.dataset;
            const isIncrease = e.target.classList.contains('increase');
            const index = cart.findIndex(item => item.name === name && (item.group || '') === group);

            if (index !== -1) {
                if (isIncrease) {
                    cart.push({ ...cart[index] });
                } else {
                    cart.splice(index, 1);
                }
                renderCart();
            }
        }
        if (e.target.classList.contains('checkout-btn')) {
            if (cart.length === 0) return alert('Cart is empty.');

            // Logic for submitting order
            const finalItems = [];
            orderContent.querySelectorAll('.order-row').forEach(row => {
                const name = row.querySelector('.qty-btn').dataset.name;
                const group = row.querySelector('.qty-btn').dataset.group;
                const qty = parseInt(row.querySelector('.order-qty span').textContent);
                const price = cart.find(i => i.name === name).price;
                const comment = row.querySelector('.comment-box').value.trim();

                finalItems.push({ name, price, group, qty, comment });
            });
            
            const payload = {
                customer: window.CURRENT_USERNAME || 'Guest',
                items: finalItems,
                table: window.TABLE_ID || ''
            };

            fetch('submit_order.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('ส่งออเดอร์เรียบร้อยแล้ว!');
                    cart.length = 0;
                    renderCart();
                    orderModal.style.display = 'none';
                } else {
                    alert(data.error || 'Failed to place order.');
                }
            })
            .catch(err => {
                console.error('Error placing order:', err);
                alert('Failed to place order.');
            });
        }
    });

    // ใช้ Event Delegation กับ menuContainer สำหรับปุ่ม "เพิ่มลงตะกร้า"
    menuContainer.addEventListener('click', e => {
        if (e.target.classList.contains('add-btn')) {
            const { name, price, group = '' } = e.target.dataset;
            cart.push({ name, price, group });
            showToast('เพิ่มเมนูแล้ว'); 
        }
    });

    openOrderBtn.addEventListener('click', () => {
        if (cart.length === 0) {
        showToast("ไม่มีสินค้าในตะกร้า", "error");
        return;
    }
    orderModal.style.display = 'block';
    renderCart();
});

    closeOrderBtn.addEventListener('click', () => {
        orderModal.style.display = 'none';
    });


    // --- 3. Order History Modal ---
    const historyModal = document.getElementById('historyModal');
    const openHistoryBtn = document.getElementById('orderHistoryBtn');
    const closeHistoryBtn = document.querySelector('.close-history');

   openHistoryBtn.addEventListener('click', () => {
    const historyContent = document.getElementById('historyContent');
    historyContent.innerHTML = '<div class="loader">Loading history...</div>';

    fetch('user_history.php')
    .then(res => res.json())
    .then(data => {
        const orders = data.orders || [];
        if (orders.length === 0) {
            showToast("ยังไม่มีประวัติการสั่งซื้อ", "info");
            return;
        }

        historyModal.style.display = 'block';
        historyContent.innerHTML = '';

        if (data.cancelled) {
            showToast('❌ ออเดอร์ของคุณถูกยกเลิกแล้ว', 'error');
        }

        if (orders.length === 0) {
            historyContent.innerHTML = '<p style="color: #888; text-align: center;">ไม่มีประวัติการสั่งซื้อ</p>';
            return;
        }

        orders.forEach(order => {
            const div = document.createElement('div');
            div.className = 'receipt';
            
            // สร้างแสดงสถานะ
            let statusBadge = '';
            const status = order.raw_status || order.status.toLowerCase();
            
            switch (status) {
                case 'pending':
                case 'รอดำเนินการ':
                    statusBadge = '<span class="status-badge status-pending">⏳ รอดำเนินการ</span>';
                    break;
                case 'accepted':
                case 'กำลังเตรียม':
                    statusBadge = '<span class="status-badge status-accepted">👨‍🍳 กำลังเตรียม</span>';
                    break;
                case 'completed':
                case 'เสร็จสิ้น':
                    statusBadge = '<span class="status-badge status-completed">✅ รับออเดอร์แล้ว</span>';
                    break;
                case 'cancelled':
                case 'ยกเลิกแล้ว':
                    statusBadge = '<span class="status-badge status-cancelled">❌ ยกเลิกแล้ว</span>';
                    break;
                default:
                    statusBadge = `<span class="status-badge">${order.status}</span>`;
            }

            div.innerHTML = `
                <div class="receipt-header">
                    <h4>Order #${order.id}</h4>
                    <small>${order.created_at}</small>
                    ${statusBadge}
                </div>
                <hr>
                <div class="receipt-details">
                    <pre>${order.details}</pre>
                </div>
                <div class="receipt-total">
                    <strong>รวม: ${parseFloat(order.total).toFixed(2)} ฿</strong>
                </div>
            `;
            historyContent.appendChild(div);
        });

        // เพิ่ม CSS สำหรับ status badge ถ้ายังไม่มี
        if (!document.querySelector('#historyStatusCSS')) {
            const style = document.createElement('style');
            style.id = 'historyStatusCSS';
            style.textContent = `
                .status-badge {
                    display: inline-block;
                    padding: 4px 8px;
                    border-radius: 12px;
                    font-size: 12px;
                    font-weight: bold;
                    margin-left: 10px;
                }
                .status-pending { background-color: #fff3cd; color: #856404; }
                .status-accepted { background-color: #d1ecf1; color: #0c5460; }
                .status-completed { background-color: #d4edda; color: #155724; }
                .status-cancelled { background-color: #f8d7da; color: #721c24; }
                
                .receipt-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 10px;
                }
                .receipt-details {
                    margin: 10px 0;
                    background-color: #f8f9fa;
                    padding: 10px;
                    border-radius: 5px;
                }
                .receipt-total {
                    text-align: right;
                    font-size: 16px;
                    margin-top: 10px;
                    padding-top: 10px;
                    border-top: 2px solid #dee2e6;
                }
            `;
            document.head.appendChild(style);
        }
    })
    .catch(err => {
        console.error('Error loading history:', err);
        historyContent.innerHTML = '<p style="color:red;">ไม่สามารถโหลดข้อมูลได้: ' + err.message + '</p>';
    });
});

    closeHistoryBtn.addEventListener('click', () => {
        historyModal.style.display = 'none';
    });

    // Close modals on outside click
    window.addEventListener('click', e => {
        if (e.target === orderModal) {
            orderModal.style.display = 'none';
        }
        if (e.target === historyModal) {
            historyModal.style.display = 'none';
        }
    });
});