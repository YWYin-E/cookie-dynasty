// scripts.js

// Function to toggle FAQ Sections
function toggleSection(e) {
    e.preventDefault();
    this.classList.toggle('active');
    const faqItems = this.nextElementSibling;

    if (this.classList.contains('active')) {
        faqItems.style.display = "block";
    } else {
        faqItems.style.display = "none";
        
        // Additionally, collapse all open questions within the section
        const openQuestions = faqItems.querySelectorAll('.faq-question.active');
        openQuestions.forEach(question => {
            question.classList.remove('active');
            const answer = question.nextElementSibling;
            answer.style.maxHeight = null;
        });
    }
}



// Function to toggle individual questions
function toggleQuestion(e) {
    e.preventDefault();
    this.classList.toggle('active');
    const answer = this.nextElementSibling;

    if (this.classList.contains('active')) {
        // Set max-height to the scrollHeight to enable smooth expansion
        answer.style.maxHeight = answer.scrollHeight + "px";
    } else {
        // Collapse the answer
        answer.style.maxHeight = null;
    }
}

// Attach event listeners to FAQ Section Headers
document.querySelectorAll('.faq-section-header').forEach(header => {
    header.addEventListener('click', toggleSection);
    header.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            toggleSection.call(this, e);
        }
    });
});

// Attach event listeners to FAQ Questions
document.querySelectorAll('.faq-question').forEach(question => {
    question.addEventListener('click', toggleQuestion);
    question.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            toggleQuestion.call(this, e);
        }
    });
});

// Optional: Search Functionality
document.getElementById('faq-search').addEventListener('input', function() {
    const query = this.value.toLowerCase();
    document.querySelectorAll('.faq-section').forEach(section => {
        let sectionMatch = false;
        section.querySelectorAll('.faq-item').forEach(item => {
            const question = item.querySelector('.faq-question').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer').textContent.toLowerCase();
            if (question.includes(query) || answer.includes(query)) {
                item.style.display = 'block';
                sectionMatch = true;
            } else {
                item.style.display = 'none';
            }
        });
        // Show or hide the entire section based on matches
        if (sectionMatch) {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
        }
    });
});
