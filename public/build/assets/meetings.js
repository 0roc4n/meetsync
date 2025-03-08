// add meeting button - modal  
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.querySelector('#add_meeting_modal');
    const add_meeting_button = document.querySelector('#add_meeting_btn');
    const close_modal_button = document.querySelector('#close_modal_btn');
    const modal_content = document.querySelector('#modalContent');

    const open_modal = () => {
        modal.classList.remove('hidden');
        modal_content.classList.remove('fade-out');
        modal_content.classList.add('fade-in');
    };

    const close_modal = () => {
        modal_content.classList.remove('fade-in');
        modal_content.classList.add('fade-out');
        modal_content.addEventListener('animationend', () => {
            modal.classList.add('hidden');
        }, { once: true });
    };

    add_meeting_button.addEventListener('click', open_modal);
    close_modal_button.addEventListener('click', close_modal);

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            close_modal();
        }
    });
});


// search bar - dropdown  
document.addEventListener('DOMContentLoaded', () => {
    const dropdownButton = document.getElementById('dropdown-button');
    const dropdownMenu = document.getElementById('dropdown-menu');

    dropdownButton.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    // hide the dropdown menu when clicking outside of it
    document.addEventListener('click', (event) => {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});


// cards - dropdown
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.dropdown-toggle').forEach(button => {
        button.addEventListener('click', function () {
            // hide all dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== this.nextElementSibling) {
                    menu.classList.add('hidden');
                }
            });

            // toggle visibility of the clicked dropdown
            const menu = this.nextElementSibling;
            menu.classList.toggle('hidden');
        });
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.dropdown-toggle')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.add('hidden');
            });
        }
    });
});



