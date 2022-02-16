//lors de la création
function check_pass() {
    if (document.getElementById('pass').value ==
        document.getElementById('confirm_pass').value) {
        document.getElementById('submit').disabled = false;
    } else {
        document.getElementById('submit').disabled = true;
    }
}

//lors de la modification du mot de passe depuis les paramètres
function check_pass2() {
    if (document.getElementById('pass2').value ==
        document.getElementById('confirm_pass2').value) {
        document.getElementById('submit2').disabled = false;
    } else {
        document.getElementById('submit2').disabled = true;
    }
}


//script recherche
$(document).ready(function () {
    $('#productName').autocomplete({
        search: function (event, ui) {
            $('.container').hide();
        },
        source: "search.php"
    }).data('ui-autocomplete')._renderItem = function (ul, item) {
        return $('<div class="results">')
            .data('item.autocomplete', item)
            .append('<div class="card" id="card_recherche">' + '<div class="card-content">' + '<div class="media">' +
                '<div class="media-content">' +
                '<a href="index.php?module=mod_article&action=detail&id=' + item.value + '">' + item.label + '</a>' + '<date> ' + item.date + ' </date>' + '</div>' + '</div>' + '</div>' + '</div>'
            ).appendTo($('.result'));
    };
    $('#productName').keyup(function () {
        // If value is not empty
        if ($(this).val().length == 0) {
            // Hide the element
            $('.container').show();
            $('.results').hide();
        } else {
            // Otherwise show it
            $('.results').empty();
            $('.results').show();
        }
    }).keyup();
});

//affichage des abonnements
document.addEventListener('DOMContentLoaded', () => {
    // Functions to open and close a modal
    function openModal($el) {
        $el.classList.add('is-active');
    }

    function closeModal($el) {
        $el.classList.remove('is-active');
    }

    function closeAllModals() {
        (document.querySelectorAll('.modal') || []).forEach(($modal) => {
            closeModal($modal);
        });
    }

    // Add a click event on buttons to open a specific modal
    (document.querySelectorAll('.js-modal-trigger') || []).forEach(($trigger) => {
        const modal = $trigger.dataset.target;
        const $target = document.getElementById(modal);
        console.log($target);

        $trigger.addEventListener('click', () => {
            openModal($target);
        });
    });

    // Add a click event on various child elements to close the parent modal
    (document.querySelectorAll('.modal-background, .modal-close, .modal-card-head .delete, .modal-card-foot .button') || []).forEach(($close) => {
        const $target = $close.closest('.modal');

        $close.addEventListener('click', () => {
            closeModal($target);
        });
    });

    // Add a keyboard event to close all modals
    document.addEventListener('keydown', (event) => {
        const e = event || window.event;

        if (e.keyCode === 27) { // Escape key
            closeAllModals();
        }
    });
});