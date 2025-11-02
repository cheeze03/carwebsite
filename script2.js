const slides = document.querySelectorAll('.slides img');
let currentIndex = 0;

document.querySelector('.prev').addEventListener('click', () => {
    slides[currentIndex].style.display = 'none';
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    slides[currentIndex].style.display = 'block';
});

document.querySelector('.next').addEventListener('click', () => {
    slides[currentIndex].style.display = 'none';
    currentIndex = (currentIndex + 1) % slides.length;
    slides[currentIndex].style.display = 'block';
});
