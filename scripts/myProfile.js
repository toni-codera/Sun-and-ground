document.addEventListener('DOMContentLoaded', async function() {
    const profileRows = document.querySelectorAll('.profile-row');
    const profileContentSection = document.getElementById('profile-content');

    // Access the userData object globally (defined in profileUser.php)
    // console.log(userData); // You can uncomment this to see the data in your browser console
    const userData = await(async()=>{
        try{
            const response = await fetch('/Sun_and_ground/includes/fetch_profile_data.inc.php');
            const data = await response.json();
            if(data.error){
                console.error(data.error);
                return {} //empty object return to avoid errors
            }
            return data;
        } catch(error){
            console.error('Failed to fetch user data:', error);
            return {}
        }
    })();

    // Define the content for each section
    const sectionsContent = {
        'personal-info': `
            <h2>Лична информация</h2>
            <p><strong>Име:</strong> ${userData.firstname}</p>
            <p><strong>Фамилия:</strong> ${userData.lastname}</p>
            <p><strong>Имейл:</strong> ${userData.email}</p>
            <p><strong>Телефон:</strong> ${userData.phone}</p>
            <p><strong>Град:</strong> ${userData.city}</p>
            <p><strong>Адрес:</strong> ${userData.home_address}</p>
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