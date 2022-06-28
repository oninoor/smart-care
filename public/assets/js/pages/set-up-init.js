/*
Template Name: Minia - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Form wizard Js File
*/


$(document).ready(function () {
    $('#basic-pills-wizard').bootstrapWizard({
        'tabClass': 'nav nav-pills nav-justified'
    });

    $('#progrss-wizard').bootstrapWizard({
        onTabShow: function (tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index + 1;
            var $percent = ($current / $total) * 100;
            $('#progrss-wizard').find('.progress-bar').css({ width: $percent + '%' });
        }
    });

});

// Active tab pane on nav link

var triggerTabList = [].slice.call(document.querySelectorAll('.twitter-bs-wizard-nav .nav-link'))
triggerTabList.forEach(function (triggerEl) {
    var tabTrigger = new bootstrap.Tab(triggerEl)

    triggerEl.addEventListener('click', function (event) {
        event.preventDefault()
        tabTrigger.show()
    })
})

// Inisialisasi Choices.js
var singleNoSearch
document.addEventListener('DOMContentLoaded', function () {

    // Ambil data penyakit
    const href = $("#hospital").data("href");
    const keyword = ''

    $.ajax({
        url: href,
        type: 'post',
        data: { keyword: keyword },
        success: function (data) {
            // singleNoSearch
            console.log(data)
            singleNoSearch = new Choices('#hospital', {
                searchEnabled: true,
                removeItemButton: true,
                searchPlaceholderValue: 'Cari disini',
                searchResultLimit: 50
            }).setChoices(
                data,
                'value',
                'label',
                true
            );

            $("input.choices__input").addClass("keyword");
        }
    });
});

// Tambah event listener ketika diagnosa diketik
$(document).on('keyup', '.keyword', function (e) {
    // Ambil data penyakit
    const href = $("#hospital").data("href");
    let keyword = $(".keyword").val();

    $.ajax({
        url: href,
        type: 'post',
        data: { keyword: keyword },
        success: function (data) {
            singleNoSearch.clearChoices()
            singleNoSearch.setChoices(
                data,
                'value',
                'label',
                false
            );
        }
    });
});