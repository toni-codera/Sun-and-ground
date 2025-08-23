document.addEventListener('DOMContentLoaded', function() {
    const profileRows = document.querySelectorAll('.profile-row');
    const profileContentSection = document.getElementById('profile-content');

    // Access the userData object globally (defined in profile.php)
    // console.log(userData); // You can uncomment this to see the data in your browser console

    // Define the content for each section
    const sectionsContent = {
        'personal-info': `
            <h2>Лична информация</h2>
            <p><strong>Име:</strong> ${userData.firstName}</p>
            <p><strong>Фамилия:</strong> ${userData.lastName}</p>
            <p><strong>Имейл:</strong> ${userData.email}</p>
            <p><strong>Телефон:</strong> ${userData.phone}</p>
            <p><strong>Град:</strong> ${userData.city}</p>
            <p><strong>Адрес:</strong> ${userData.address}</p>
            <p><em>(Данните по-горе се заредиха от базата данни)</em></p>
        `,
        'my-orders': `
            <h2>Моите поръчки</h2>
            <p>Тук ще видите списък с вашите минали поръчки.</p>
            <ul>
                <li>Поръчка #12345 - Дата: 01.01.2024 - Статус: Изпълнена</li>
                <li>Поръчка #12346 - Дата: 15.02.2024 - Статус: В обработка</li>
            </ul>
        `,
        'change-name': `
            <h2>Смяна на име</h2>
            <form action="includes/update_name.php" method="post">
                <label for="firstName">Ново Първо име:</label>
                <input type="text" id="firstName" name="firstName" placeholder="Въведете новото си първо име" required>
                <label for="lastName">Нова Фамилия:</label>
                <input type="text" id="lastName" name="lastName" placeholder="Въведете новата си фамилия" required>
                <button type="submit">Запази промените</button>
            </form>
        `,
        'change-password': `
            <h2>Смяна на парола</h2>
            <form action="includes/update_password.php" method="post">
                <label for="currentPwd">Текуща парола:</label>
                <input type="password" id="currentPwd" name="currentPwd" required>
                <label for="newPwd">Нова парола:</label>
                <input type="password" id="newPwd" name="newPwd" required>
                <label for="confirmNewPwd">Потвърдете нова парола:</label>
                <input type="password" id="confirmNewPwd" name="confirmNewPwd" required>
                <button type="submit">Смени паролата</button>
            </form>
        `,
        'change-email': `
            <h2>Смяна на имейл</h2>
            <form action="includes/update_email.php" method="post">
                <label for="newEmail">Нов имейл адрес:</label>
                <input type="email" id="newEmail" name="newEmail" placeholder="Въведете новия си имейл" required>
                <button type="submit">Запази промените</button>
            </form>
        `,
        'change-address': `
            <h2>Смяна на адрес</h2>
            <form action="includes/update_address.php" method="post">
                <label for="newCity">Нов Град:</label>
                <input type="text" id="newCity" name="newCity" placeholder="Въведете новия си град" required>
                <label for="newHomeAddress">Нов Домашен Адрес:</label>
                <input type="text" id="newHomeAddress" name="newHomeAddress" placeholder="Въведете новия си адрес" required>
                <button type="submit">Запази промените</button>
            </form>
        `,
        'change-phone': `
            <h2>Смяна на телефон</h2>
            <form action="includes/update_phone.php" method="post">
                <label for="newPhone">Нов Телефонен Номер:</label>
                <input type="tel" id="newPhone" name="newPhone" placeholder="Въведете новия си телефон" required>
                <button type="submit">Запази промените</button>
            </form>
        `,
        'logout': `
            <h2>Изход от профила</h2>
            <p>Сигурни ли сте, че искате да излезете от профила си?</p>
            <a href="includes/logout.inc.php" class="logout-link">Изход</a>
        `
    };

    // Function to load content
    function loadContent(target) {
        profileContentSection.innerHTML = sectionsContent[target] || `<p>Съдържанието за ${target} не е намерено.</p>`;
    }

    // Function to set active class
    function setActiveRow(clickedRow) {
        profileRows.forEach(row => row.classList.remove('active'));
        clickedRow.classList.add('active');
    }

    // Add click event listeners to all profile rows
    profileRows.forEach(row => {
        row.addEventListener('click', function() {
            const target = this.dataset.target; // Get the data-target attribute
            loadContent(target);
            setActiveRow(this);
        });
    });

    // Load default content on page load (Personal Information)
    const defaultTarget = document.querySelector('.profile-row.active').dataset.target;
    loadContent(defaultTarget);
});