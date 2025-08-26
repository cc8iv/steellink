(function () {
    emailjs.init("-YtRAfpms_MlTpqFx"); // Replace with your public key
})();

function sendMail(event) {
    event.preventDefault();

    emailjs.sendForm("service_qz0h6xv", "template_d5pdbwn", "#contactForm")
        .then(function (response) {
            alert("Message sent successfully!");
        }, function (error) {
            alert("Failed to send message. Please try again.");
        });
}