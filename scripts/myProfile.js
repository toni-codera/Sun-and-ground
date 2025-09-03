document.addEventListener('DOMContentLoaded', async function() {
    const profileRows = document.querySelectorAll('.profile-row');
    const profileContentSection = document.getElementById('profile-content');

    const userData = await(async()=>{
        try {
            const response = await fetch('/Sun_and_ground/includes/fetch_profile_data.inc.php');
            const data = await response.json();
            if (data.error) {
                console.error(data.error);
                return {};
            }
            return data;
        } catch(error) {
            console.error('Failed to fetch user data:', error);
            return {};
        }
    })();

    // Function to render orders
    async function renderOrders() {
        profileContentSection.innerHTML = '<h2>Моите поръчки</h2><p>Зарежда се...</p>';
        try {
            const response = await fetch('/Sun_and_ground/includes/fetch_orders.inc.php');
            const orders = await response.json();

            if (orders.error) {
                profileContentSection.innerHTML = `<p>${orders.error}</p>`;
                return;
            }

            if (orders.length === 0) {
                profileContentSection.innerHTML = `<h2>Моите поръчки</h2><p>Нямате минали поръчки.</p>`;
            } else {
                const deliveryFee = 5.00; // Define the delivery fee here
                let ordersHtml = '<h2>Моите поръчки</h2>';
                
                orders.forEach(order => {
                    const orderDate = new Date(order.order_date).toLocaleString('bg-BG');
                    const status = order.is_sent ? 'Изпратена' : 'В обработка';
                    let subtotalCents = 0;
                    
                    ordersHtml += `
                        <div class="order-summary">
                            <h3>Поръчка №${order.order_id}</h3>
                            <p><strong>Дата:</strong> ${orderDate}</p>
                            <p><strong>Статус:</strong> ${status}</p>
                            <hr>
                            <div class="order-items">
                    `;

                    order.items.forEach(item => {
                        const itemPrice = (item.price_cents / 100) * item.quantity;
                        subtotalCents += item.price_cents * item.quantity;
                        ordersHtml += `
                            <div class="order-item">
                                <span>${item.product_name} - ${item.weight_grams} гр. (x${item.quantity})</span>
                                <span class="item-price">${(itemPrice).toFixed(2)} лв.</span>
                            </div>
                        `;
                    });

                    const subtotal = (subtotalCents / 100).toFixed(2);
                    const total = (parseFloat(subtotal) + deliveryFee).toFixed(2);

                    ordersHtml += `
                            </div>
                            <div class="order-total-section">
                                <div class="price-line">
                                    <strong>Междинна сума:</strong>
                                    <span>${subtotal} лв.</span>
                                </div>
                                <div class="price-line">
                                    <strong>Доставка:</strong>
                                    <span>${deliveryFee.toFixed(2)} лв.</span>
                                </div>
                                <div class="price-line final-total">
                                    <strong>Обща сума:</strong>
                                    <span>${total} лв.</span>
                                </div>
                            </div>
                        </div>
                    `;
                });
                profileContentSection.innerHTML = ordersHtml;
            }

        } catch (error) {
            profileContentSection.innerHTML = `<p>Грешка при зареждане на поръчките.</p>`;
            console.error('Failed to fetch orders:', error);
        }
    }

    // Function to load content
    function loadContent(target) {
        if (target === 'my-orders') {
            renderOrders();
        } else if (target === 'personal-info') {
            profileContentSection.innerHTML = `
                <h2>Лична информация</h2>
                <p><strong>Име:</strong> ${userData.firstname}</p>
                <p><strong>Фамилия:</strong> ${userData.lastname}</p>
                <p><strong>Имейл:</strong> ${userData.email}</p>
                <p><strong>Телефон:</strong> ${userData.phone}</p>
                <p><strong>Град:</strong> ${userData.city}</p>
                <p><strong>Адрес:</strong> ${userData.home_address}</p>
                <p><em>(Данните по-горе се заредиха от базата данни)</em></p>
            `;
        } else if (target === 'logout') {
            profileContentSection.innerHTML = `
                <h2>Изход от профила</h2>
                <p>Сигурни ли сте, че искате да излезете от профила си?</p>
                <a href="includes/logout.inc.php" class="logout-link">Изход</a>
            `;
        } else {
            profileContentSection.innerHTML = `<p>Съдържанието за ${target} не е намерено.</p>`;
        }
    }

    // Function to set active class
    function setActiveRow(clickedRow) {
        profileRows.forEach(row => row.classList.remove('active'));
        clickedRow.classList.add('active');
    }

    // Add click event listeners to all profile rows
    profileRows.forEach(row => {
        row.addEventListener('click', function() {
            const target = this.dataset.target;
            loadContent(target);
            setActiveRow(this);
        });
    });

    // Load default content on page load
    const defaultTarget = document.querySelector('.profile-row.active').dataset.target;
    loadContent(defaultTarget);
});