
const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage() {
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}
window.addEventListener('resize', slideImage);






function responsiveSlider() {
    const slider = document.querySelector('.container_slider_h');
    let sliderWidth = slider.offsetWidth / 3;
    const sliderList = document.querySelector('.list_item_h');
    let items = sliderList.querySelectorAll('.item_slider_h').length - 2;
    let count = 1;

    window.addEventListener('resize', function () {
        sliderWidth = slider.offsetWidth;
    });

    function prevSlide() {
        if (count > 1) {
            count = count - 2;
            sliderList.style.left = '-' + count * sliderWidth + 'px';
            count++;
        } else if (count == 1) {
            count = items - 1;
            sliderList.style.left = '-' + count * sliderWidth + 'px';
            count++;
        }

    }

    function nextSlide() {
        if (count < items) {
            sliderList.style.left = '-' + count * sliderWidth + 'px';
            count++;

        } else if (count == items) {
            sliderList.style.left = '0px';
            count = 1;

        }
    }
    prev.addEventListener('click', prevSlide);
    next.addEventListener('click', nextSlide);
    // setInterval(function() {
    //     nextSlide();
    // }, 3000);
}

window.addEventListener('load', function () {
    responsiveSlider();
});