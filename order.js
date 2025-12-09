// Import Firebase modules
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
import { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
import { getFirestore, collection, addDoc, onSnapshot, query, where, serverTimestamp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

// Biến Firebase toàn cầu được cung cấp bởi môi trường Canvas
const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
const firebaseConfig = JSON.parse(typeof __firebase_config !== 'undefined' ? __firebase_config : '{}');
const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const db = getFirestore(app);
const auth = getAuth(app);

let currentUserId = null;

// Function to show custom modal
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

// Function to hide custom modal
function hideModal() {
    document.getElementById('custom-modal-overlay').classList.remove('show');
}

// Function to select payment method
window.selectPaymentMethod = function(method) {
    document.querySelectorAll('.payment-method').forEach(el => {
        el.classList.remove('selected');
    });
    document.querySelector(`.payment-method[data-method="${method}"]`).classList.add('selected');
    document.getElementById('selected-payment-method').value = method;
};

// Function to place an order
window.placeOrder = async function() {
    if (!currentUserId) {
        showModal('Lỗi xác thực', 'Vui lòng đợi quá trình xác thực hoàn tất trước khi đặt hàng.');
        return;
    }

    const customerName = document.getElementById('customer-name').value.trim();
    const customerPhone = document.getElementById('customer-phone').value.trim();
    const customerAddress = document.getElementById('customer-address').value.trim();
    const customerNote = document.getElementById('customer-note').value.trim();
    const paymentMethod = document.getElementById('selected-payment-method').value;

    if (!customerName || !customerPhone || !customerAddress) {
        showModal('Lỗi', 'Vui lòng điền đầy đủ thông tin giao hàng.');
        return;
    }
    if (!paymentMethod) {
        showModal('Lỗi', 'Vui lòng chọn phương thức thanh toán.');
        return;
    }

    showModal('Đang đặt hàng...', 'Vui lòng chờ trong giây lát...', true);

    try {
        // Get cart items from localStorage (or actual cart)
        const storedCartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');
        if (storedCartItems.length === 0) {
            showModal('Lỗi', 'Giỏ hàng của bạn đang trống. Vui lòng thêm món vào giỏ trước khi đặt hàng.');
            return;
        }

        const subtotal = storedCartItems.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const shippingFee = 15000; // Fixed shipping fee
        const grandTotal = subtotal + shippingFee;

        const orderData = {
            userId: currentUserId,
            customer: {
                name: customerName,
                phone: customerPhone,
                address: customerAddress,
                note: customerNote
            },
            items: storedCartItems,
            subtotal: subtotal,
            shippingFee: shippingFee,
            grandTotal: grandTotal,
            paymentMethod: paymentMethod,
            status: 'Đang chờ xác nhận',
            orderDate: serverTimestamp()
        };

        // Save order to Firestore
        const ordersCollectionRef = collection(db, `artifacts/${appId}/users/${currentUserId}/orders`);
        await addDoc(ordersCollectionRef, orderData);

        showModal('Đặt hàng thành công!', `Cảm ơn bạn, ${customerName}! Đơn hàng của bạn đã được tiếp nhận và sẽ được giao đến địa chỉ ${customerAddress} sớm nhất có thể. Tổng tiền: ${grandTotal.toLocaleString('vi-VN')}đ.`);

        // Clear cart after successful order
        localStorage.removeItem('cartItems');
        updateOrderSummary(); // Update order summary after clearing
        document.getElementById('customer-form').reset(); // Reset customer info form

    } catch (e) {
        console.error("Lỗi khi đặt hàng: ", e);
        showModal('Lỗi', 'Có lỗi xảy ra khi đặt hàng. Vui lòng thử lại.');
    }
};

// Update order summary from localStorage
function updateOrderSummary() {
    const orderItemsList = document.getElementById('order-items-list');
    const orderSubtotalElem = document.getElementById('order-subtotal');
    const orderShippingElem = document.getElementById('order-shipping');
    const orderGrandTotalElem = document.getElementById('order-grand-total');

    // Get cart data from localStorage
    const cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');

    orderItemsList.innerHTML = ''; // Clear old items
    let subtotal = 0;

    if (cartItems.length === 0) {
        orderItemsList.innerHTML = '<div class="order-item"><span>Giỏ hàng trống</span><span>0đ</span></div>';
    } else {
        cartItems.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.classList.add('order-item');
            itemElement.innerHTML = `
                <span>${item.name} (x${item.quantity})</span>
                <span>${(item.price * item.quantity).toLocaleString('vi-VN')}đ</span>
            `;
            orderItemsList.appendChild(itemElement);
            subtotal += item.price * item.quantity;
        });
    }

    const shippingFee = 15000; // Fixed shipping fee
    const grandTotal = subtotal + shippingFee;

    orderSubtotalElem.textContent = `Tổng phụ: ${subtotal.toLocaleString('vi-VN')}đ`;
    orderShippingElem.textContent = `Phí giao hàng: ${shippingFee.toLocaleString('vi-VN')}đ`;
    orderGrandTotalElem.textContent = `Tổng cộng: ${grandTotal.toLocaleString('vi-VN')}đ`;
}

// Listen for authentication state changes and update userId
onAuthStateChanged(auth, async (user) => {
    if (user) {
        currentUserId = user.uid;
        document.getElementById('user-id-display').textContent = `User ID của bạn: ${currentUserId}`;
        // Call updateOrderSummary after userId is available
        updateOrderSummary();
    } else {
        // Sign in anonymously if no custom token
        try {
            if (initialAuthToken) {
                await signInWithCustomToken(auth, initialAuthToken);
            } else {
                await signInAnonymously(auth);
            }
        } catch (error) {
            console.error("Firebase authentication error: ", error);
            showModal('Lỗi xác thực', 'Không thể đăng nhập vào hệ thống. Vui lòng tải lại trang.');
        }
    }
});

// Load summary when page is loaded
window.onload = function() {
    // onAuthStateChanged will update later, so just ensure this function is called
    // to start the authentication process and UI update
};
