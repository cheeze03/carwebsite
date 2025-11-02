document.addEventListener('DOMContentLoaded', function() {
    // Add event listeners to all 'Read More' buttons
    document.querySelectorAll('.read-more').forEach(button => {
        button.addEventListener('click', function() {
            const paragraph = this.previousElementSibling; // Get the <p> element (the paragraph)
            const moreText = paragraph.querySelector('.more-text'); // Get the hidden part of the paragraph

            // Toggle the visibility of the extra text
            if (moreText.style.display === 'none' || moreText.style.display === '') {
                moreText.style.display = 'inline'; // Show the extra text
                this.textContent = 'Read Less'; // Change button text to 'Read Less'
            } else {
                moreText.style.display = 'none'; // Hide the extra text
                this.textContent = 'Read More'; // Change button text back to 'Read More'
            }
        });
    });
});
