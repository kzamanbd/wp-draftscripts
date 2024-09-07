console.log('Hello, world! 🌍');

// add nav
document.addEventListener('DOMContentLoaded', function () {
    // based on https://getbootstrap.com/docs/5.0/components/navs-tabs/
    document.querySelectorAll('.nav-tabs').forEach(function (elem) {
        elem.querySelectorAll('[data-tw-toggle="tab"]').forEach(function (item) {
            item.addEventListener('click', function () {
                var tabID = item.getAttribute('data-tw-target')?.toString();
                var tabContents = elem.querySelectorAll('.tab-content > .tab-pane');

                var activeElem = elem.querySelector('[data-tw-toggle="tab"].active');
                if (activeElem) activeElem.classList.remove('active');

                // clear value
                for (let i = 0; i < tabContents.length; i++) {
                    tabContents[i].classList.add('hidden');
                    tabContents[i].classList.remove('block');
                }

                // change value
                item.classList.add('active');
                if (tabID) {
                    document.getElementById(tabID)?.classList.remove('hidden');
                    document.getElementById(tabID)?.classList.add('block');
                }
            });
        });
    });
});
