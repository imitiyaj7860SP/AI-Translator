document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('translator-form');
    const resultDiv = document.getElementById('translation-result');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        resultDiv.innerHTML = '<p>Translating...</p>';
        
        fetch(window.location.href, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.translation) {
                resultDiv.innerHTML = `
                    <div class="result-box">
                        <h3>Translation Result:</h3>
                        <p>${data.translation}</p>
                    </div>
                `;
            } else if (data.error) {
                resultDiv.innerHTML = `<p class="error">Error: ${data.error}</p>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            resultDiv.innerHTML = `<p class="error">An error occurred during translation. Please try again.</p>`;
        });
    });
});