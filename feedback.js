const rating = document.querySelector('.rating');
const children = document.querySelectorAll('.child');
const btn = document.querySelector('#btn');
const feedbackSection = document.querySelector('.feedback-section');
let parentN;

rating.addEventListener('click', (event) => {
   parentN = event.target.closest('.child');
   if (parentN) {
      children.forEach(child => {
         child.classList.remove('active');
      });
      parentN.classList.add('active');
      console.log(parentN);
   }
});

btn.addEventListener('click', () => {
   console.log(parentN);
   let userFeedback = '';
   let userFeedbackIcon = '';
   if (parentN) {
      userFeedback = parentN.children[1].innerText;
      userFeedbackIcon = parentN.children[0].innerText;
   }
   if (userFeedback.trim() !== "") {
      feedbackSection.innerHTML = `
        <div class="response-screen">
            <p>${userFeedbackIcon}</p>
            <h3>Your feedback: ${userFeedback}</h3>
            <p>Thank you for your response..✨!!!</p>
            <p>We will work and do better...</p>
            <br><br>
            <div class="feedback-button">
                <button class="button-89" role="button"><a href="feedback.php">Back</a></button>
            </div>
        </div>`;
   }
});



