import './bootstrap.js';
import 'particles.js';

document.addEventListener('DOMContentLoaded', function () {
    setInterval(updateBottomPanel, 1000);
    vanishNotification();
    updateBottomPanel();
    animateLogoOnLoad();
    controllPhoto();
    doctorSearch();
    initMap();
});
function animateLogoOnLoad() {
    var logo = document.querySelector('.navbar-brand');
    if (logo) {
        logo.style.opacity = 0;
        logo.style.transform = 'scale(0.5)';
        setTimeout(function () {
            logo.style.transition = 'opacity 0.5s, transform 0.5s';
            logo.style.opacity = 1;
            logo.style.transform = 'scale(1)';
        }, 500);
    }
}

function controllPhoto() {
    var photoInput = document.getElementById('photo');
    if (photoInput) {
        photoInput.onchange = function() {
            var file = this.files[0];
            if (file && file.size > 2048 * 1024) {
                alert('Veľkosť fotky nesmie byť väčšia ako 2MB.');
                this.value = '';
            }
        };
    }
}
function vanishNotification() {
    var notification = document.getElementById('notification');
    if (notification) {
        setTimeout(function() {
            notification.style.display = 'none';
        }, 3000);
    }

    const flashMessage = document.getElementById('flash-message');
    if (flashMessage) {
        setTimeout(() => {
            flashMessage.style.display = 'none';
        }, 3000);
    }
}

function initMap() {
    var location = {lat: 49.211050, lng: 18.758048};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: location
    });
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
}

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('edit-comment-btn')) {
        var commentId = event.target.getAttribute('data-comment-id');
        var commentContent = document.querySelector('#comment-content-' + commentId).textContent;

        document.querySelector('#comment-content-' + commentId).innerHTML = `
            <textarea id="edit-comment-${commentId}" class="edit-comment-textarea" required>${commentContent}</textarea>
            <button class="save-edit-btn" data-comment-id="${commentId}">Uložiť zmeny</button>
        `;
    }


    if (event.target.classList.contains('.editPatientBtn')) {
        const editButtons = document.querySelectorAll('.editPatientBtn');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const patientId = this.getAttribute('data-patient-id');
            window.location.href = `/patients/${patientId}/edit`;
        });
    });
}




    if (event.target.classList.contains('save-edit-btn')) {
        var commentId = event.target.getAttribute('data-comment-id');
        var editedComment = document.querySelector('#edit-comment-' + commentId).value;
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $.ajax({
            url: `/comments/${commentId}`,
            type: 'POST',
            data: {
                _token: csrfToken,
                _method: 'PUT',
                comment: editedComment
            },
            success: function() {
                document.querySelector('#comment-content-' + commentId).textContent = editedComment;
            },
            error: function(error) {
                console.error('Chyba pri aktualizácii komentára: ', error);
            }
        });
    }
});

function doctorSearch() {
    const searchInput = document.getElementById('doctorSearch');

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.toLowerCase();
        const doctorCards = document.querySelectorAll('.doctor-card');

        doctorCards.forEach(function(card) {
            const doctorName = card.querySelector('.card-title').textContent.toLowerCase();

            if (doctorName.includes(searchTerm)) {
                card.parentElement.style.display = '';
            } else {
                card.parentElement.style.display = 'none';
            }
        });
    });
}


var navbarItems = document.querySelectorAll('.navbar-nav a');
navbarItems.forEach(function (item) {
    item.addEventListener('mouseover', function () {
        item.classList.add('animaciaNavbarItemu');
    });

    item.addEventListener('mouseout', function () {
        item.classList.remove('animaciaNavbarItemu');
    });
});

function updateBottomPanel() {
    var bottomPanel = document.querySelector('.bottom-panel');
    if (bottomPanel) {
        bottomPanel.querySelector('#current-time').textContent = new Date().toLocaleTimeString();
    }
}







