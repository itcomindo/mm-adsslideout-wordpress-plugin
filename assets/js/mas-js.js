window.addEventListener('DOMContentLoaded', (event) => {
    jQuery(function () {
        //JQuery start below.

        //masGetScreenWidht start
        function masGetScreenWidht() {
            var $screenWidth = jQuery(window).width();
            return $screenWidth;
        }
        //masGetScreenWidht End

        //Mas Condition Start
        function masCondition() {
            var $disableOn = jQuery('#mas-pr').attr('data-mas-disable-on');
            var $screenWidth = masGetScreenWidht();
            var $masPr = jQuery('#mas-pr');
            if ('769' === $disableOn && $screenWidth < 769) {
                $masPr.remove();
            } else if ('493' === $disableOn && $screenWidth < 493) {
                $masPr.remove();
            }
        }
        masCondition();
        //Mas Condition end


        //close masAds start
        function mas() {

            setTimeout(function () {
                jQuery('#mas-pr').removeClass('mas-sleep');
            }, 2000);

            var $masCloseBtn = jQuery('#mas-close');
            $masCloseBtn.on('click', function () {
                jQuery('#mas-pr').slideUp(500).addClass('mas-sleep');
            });
        }
        mas();
        //close masAds end


        //Mas Load Slick Slider start
        function masSlickSlider() {
            var $isSLide = jQuery('#mas-pr').attr('data-show-mas');
            console.log($isSLide);

            if ('slide' === $isSLide) {
                var $duration = jQuery('#mas-pr').attr('data-mas-duration');
                console.log($duration);
                jQuery('#mas-wr').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: $duration,
                    arrows: false,
                    dots: false,
                    infinite: true,
                    speed: 500,
                    draggable: false,
                });
            }


        }
        masSlickSlider();
        //Mas Load Slick Slider End

        //find this
        function masFindThis() {
            var imgs = jQuery('img.mas-find-this');
            imgs.each(function () {
                var ini = jQuery(this);
                var w = ini.width();
                var h = ini.height();
                ini.attr('width', w);
                ini.attr('height', h);
            });
        }
        // Fungsi debounce untuk membatasi frekuensi pemanggilan fungsi
        function mas_debounce(func, wait, immediate) {
            var timeout;
            return function () {
                var context = this, args = arguments;
                var later = function () {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
                };
                var callNow = immediate && !timeout;
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
                if (callNow) func.apply(context, args);
            };
        };
        masFindThis();
        jQuery(window).on('resize', mas_debounce(function () {
            masFindThis();
        }, 250));
        //find this




        //JQuery end above.
    });
});