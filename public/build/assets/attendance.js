document.addEventListener('DOMContentLoaded', function() {
    // get references to the modal and buttons
    const attendanceButton = document.getElementById('attendance_button');
    const attendanceModal = document.getElementById('attendance_modal');
    const closeModalButton = document.getElementById('close_modal_btn');
    const modalContent = document.getElementById('modalContent'); // for transitions

    // display the modal with fade-in effect when the "+" button is clicked
    attendanceButton.addEventListener('click', function() {
        attendanceModal.classList.remove('hidden'); // display the modal by removing the 'hidden' class
        modalContent.classList.remove('fade-out'); // ensure fade-out is removed before fade-in
        modalContent.classList.add('fade-in'); // apply fade-in animation
    });

    // close the modal with fade-out effect when the "Close" button is clicked
    closeModalButton.addEventListener('click', function() {
        modalContent.classList.remove('fade-in'); // remove fade-in effect
        modalContent.classList.add('fade-out'); // apply fade-out effect
        modalContent.addEventListener('animationend', function() {
            attendanceModal.classList.add('hidden'); // hide the modal after fade-out ends
        }, { once: true });
    });

    // close the modal if clicked outside the modal
    window.addEventListener('click', function(event) {
        if (event.target === attendanceModal) {
            modalContent.classList.remove('fade-in'); // remove fade-in if clicked outside
            modalContent.classList.add('fade-out'); // apply fade-out effect
            modalContent.addEventListener('animationend', function() {
                attendanceModal.classList.add('hidden'); // hide the modal after fade-out ends
            }, { once: true });
        }
    });
});
