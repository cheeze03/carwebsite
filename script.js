document.getElementById('contact-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();
    const status = document.getElementById('form-status');

    if (name === '' || email === '' || message === '') {
        status.textContent = 'All fields are required.';
        return;
    }

    if (!/\S+@\S+\.\S+/.test(email)) {
        status.textContent = 'Please enter a valid email address.';
        return;
    }

    status.textContent = 'Thank you for contacting us!';
    status.style.color = 'green';
    document.getElementById('contact-form').reset();
});

async function fetchQuote() {
    const quoteElement = document.getElementById('quote');
    try {
        const response = await fetch('https://api.quotable.io/random');
        const data = await response.json();
        quoteElement.textContent = `"${data.content}" - ${data.author}`;
    } catch (error) {
        quoteElement.textContent = 'Failed to load quote. Please try again later.';
    }
}

fetchQuote();

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
