function showModal(title, message, isLoading = false) {
    const modalOverlay = document.getElementById('custom-modal-overlay');
    const modalTitle = document.getElementById('modal-title');
    const modalMessage = document.getElementById('modal-message');
    const modalSpinner = document.getElementById('modal-spinner');

    modalTitle.textContent = title;
    modalMessage.innerHTML = message;
    modalSpinner.style.display = isLoading ? 'block' : 'none';
    modalMessage.style.display = isLoading ? 'none' : 'block';
    modalOverlay.classList.add('show');
}

function hideModal() {
    document.getElementById('custom-modal-overlay').classList.remove('show');
}

function submitContactForm() {
    const name = document.getElementById('contact-name').value;
    const email = document.getElementById('contact-email').value;
    const message = document.getElementById('contact-message').value;

    if (!name.trim() || !email.trim() || !message.trim()) {
        showModal('Lỗi', 'Vui lòng điền đầy đủ các trường.');
        return;
    }

    // Simulate sending message
    showModal('Gửi tin nhắn thành công', `Cảm ơn ${name} đã liên hệ! Chúng tôi sẽ phản hồi qua email ${email} sớm nhất có thể.`);
    document.getElementById('contact-form').reset();
}
