let buttons = document.querySelectorAll('.js-popup-open');
let popups = document.querySelectorAll('.js-popup-window');

Array.prototype.forEach.call(buttons, function (button) {
    let name = button.getAttribute('data-name');

    button.addEventListener('click', function () {
        var popup = document.querySelector('.js-popup-window[data-name="' + name + '"]');
        popup.classList.remove('b-hide');
    });
});

Array.prototype.forEach.call(popups, function (popup) {
        let buttons = popup.querySelectorAll('.js-popup-close');

        Array.prototype.forEach.call(buttons, function (button) {
            button.addEventListener('click', function () {
                popup.classList.add('b-hide');
            });
        });
    }
)

let tabs = document.querySelectorAll('.js-tabs');

Array.prototype.forEach.call(tabs, function (tab) {
    let buttons = tab.querySelectorAll('.js-tabs-button');
    let items = tab.querySelectorAll('.js-tabs-item');

    Array.prototype.forEach.call(buttons, function (button) {
        button.addEventListener('click', function (e) {
            let el = e.currentTarget;

            Array.prototype.forEach.call(buttons, function (button, i) {
                if (button !== el) {
                    button.classList.remove('b-active');
                    if (items[i]) {
                        items[i].classList.remove('b-active');
                    }
                } else {
                    button.classList.add('b-active');
                    if (items[i]) {
                        items[i].classList.add('b-active');
                    }
                }
            });
        });
    });
});

$(document).ready(function () {
    $('.sel').selectivity({
        showSearchInputInDropdown: false,
        allowClear: false
    });

    $('.sel-popup').selectivity({
        showSearchInputInDropdown: false,
        allowClear: false,
        dropdownCssClass: 'popup__dropdown',
        readOnly: true
    });
})

$('.sel').on('change', (e) => {
    const uid = e.currentTarget.dataset.uid;
    const id = e.currentTarget.value;
    const state = e.currentTarget.querySelector(`[data-id="${id}"]`).dataset.state;

    const request = fetch(`/state/${uid}/change/${state}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })

    request
        .then(response => response.json())
        .then((data) => {
            console.log(data)
        })
        .catch((err) => {
            console.log(err)
        })
});
