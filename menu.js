// Chức năng hiển thị hộp thoại tùy chỉnh (sao chép từ contact.js/order.js để thống nhất)
// Thêm trình lắng nghe sự kiện để hiển thị hộp thoại tùy chỉnh
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

// Chức năng ẩn hộp thoại tùy chỉnh (sao chép từ contact.js/order.js để thống nhất)
function hideModal() {
    document.getElementById('custom-modal-overlay').classList.remove('show');
}
// Thêm trình lắng nghe sự kiện để đóng modal khi nhấp vào bên ngoài hoặc trên nút đóng cho modal chung
document.addEventListener('DOMContentLoaded', () => {
    const modalOverlay = document.getElementById('custom-modal-overlay');
    if (modalOverlay) {
        modalOverlay.addEventListener('click', (event) => {
            if (event.target === modalOverlay) {
                hideModal();
            }
        });
    }
});

// Chức năng mới cho Modal Chi tiết mục các biến tham chiếu đến các phần tử trong modal chi tiết món ăn
function showItemDetailModal(item) {
    const itemDetailModalOverlay = document.getElementById('item-detail-modal-overlay');
    const detailItemImg = document.getElementById('detail-item-img');
    const detailItemTitle = document.getElementById('detail-item-title');
    const detailItemPrice = document.getElementById('detail-item-price');
    const detailItemDescription = document.getElementById('detail-item-description');
    const detailItemReviewsList = document.getElementById('detail-item-reviews-list');
    const itemQuantityInput = document.getElementById('item-quantity'); // Mới: Trường nhập số lượng
    const increaseQuantityBtn = document.getElementById('increase-quantity'); // New: Nút Tăng Số Lượng
    const decreaseQuantityBtn = document.getElementById('decrease-quantity'); // New: Nút Giảm Số Lượng
    // New: Nút Thêm vào Giỏ hàng và Đặt hàng ngay
    // Tham chiếu đến các nút trong modal chi tiết món ăn
    const addToCartFromDetailBtn = document.getElementById('add-to-cart-from-detail-btn');
    const orderFromDetailBtn = document.getElementById('order-from-detail-btn'); // New: Nút Đặt hàng ngay
    // Kiểm tra xem modal đã được tạo chưa, nếu chưa thì tạo mới

    // Cập nhật nội dung modal chi tiết món ăn
    detailItemImg.src = item.dataset.image;
    detailItemImg.alt = item.dataset.name;
    detailItemTitle.textContent = item.dataset.name;
    detailItemPrice.textContent = `${parseInt(item.dataset.price).toLocaleString('vi-VN')}đ`;
    detailItemDescription.textContent = item.dataset.description;

    // Đặt giá trị mặc định cho trường nhập số lượng
    itemQuantityInput.value = 1;

    // Xóa nội dung đánh giá cũ
    detailItemReviewsList.innerHTML = '';

    // Lấy đánh giá cho mục này và hiển thị chúng
    // Mô phỏng việc lấy đánh giá từ một nguồn dữ liệu (có thể là API hoặc dữ liệu tĩnh)
    const reviews = getItemReviews(item.dataset.id);
    if (reviews.length > 0) {
        reviews.forEach(review => {
            const reviewDiv = document.createElement('div');
            reviewDiv.classList.add('review-item');
            reviewDiv.innerHTML = `
                <p class="review-author"><strong>${review.author}</strong> - ${review.rating} sao</p>
                <p class="review-text">${review.text}</p>
            `;
            detailItemReviewsList.appendChild(reviewDiv);
        });
    } else {
        detailItemReviewsList.innerHTML = '<p class="review-text">Chưa có đánh giá nào cho món này.</p>';
    }

    //  Đặt dữ liệu cho các nút 'Thêm vào giỏ hàng' và 'Đặt hàng ngay' bên trong hộp thoại chi tiết
    addToCartFromDetailBtn.dataset.id = item.dataset.id;
    addToCartFromDetailBtn.dataset.name = item.dataset.name;
    addToCartFromDetailBtn.dataset.price = item.dataset.price;

    orderFromDetailBtn.dataset.id = item.dataset.id;
    orderFromDetailBtn.dataset.name = item.dataset.name;
    orderFromDetailBtn.dataset.price = item.dataset.price;

// Thêm trình lắng nghe sự kiện cho các nút số lượng
    increaseQuantityBtn.onclick = () => { // onclick trực tiếp gắn vào nút tăng/giảm số lượng
        itemQuantityInput.value = parseInt(itemQuantityInput.value) + 1;
    };
    decreaseQuantityBtn.onclick = () => {
        let currentValue = parseInt(itemQuantityInput.value);
        if (currentValue > 1) {
            itemQuantityInput.value = currentValue - 1;
        }
    };

    itemDetailModalOverlay.classList.add('show');
}
function hideItemDetailModal() { //
    document.getElementById('item-detail-modal-overlay').classList.remove('show');
}
// Thêm trình lắng nghe sự kiện để đóng cửa sổ chi tiết mục khi nhấp vào bên ngoài hoặc trên nút đóng
document.addEventListener('DOMContentLoaded', () => {
    const itemDetailModalOverlay = document.getElementById('item-detail-modal-overlay');
    if (itemDetailModalOverlay) {
        itemDetailModalOverlay.addEventListener('click', (event) => {
            if (event.target === itemDetailModalOverlay) {
                hideItemDetailModal();
            }
        });
    }
});

// Mô phỏng việc tìm nạp các đánh giá dựa trên ID mục
function getItemReviews(itemId) {
    const allReviews = {
        'bunbohue': [
            { author: 'Nguyễn Văn A', rating: 5, text: 'Bún bò Huế rất ngon, đậm đà chuẩn vị.' },
            { author: 'Trần Thị B', rating: 4, text: 'Nước dùng khá ổn, thịt bò mềm.' }
        ],
        'comtamsuon': [
            { author: 'Lê Văn C', rating: 5, text: 'Cơm tấm sườn nướng rất thơm và miếng sườn to.' },
            { author: 'Phạm Thị D', rating: 5, text: 'Ngon tuyệt, ăn kèm trứng lòng đào béo ngậy.' }
        ],
        'phoga': [
            { author: 'Hoàng Văn E', rating: 4, text: 'Phở gà thanh ngọt, ăn sáng rất hợp.' },
            { author: 'Đỗ Thị F', rating: 3, text: 'Nước dùng hơi nhạt một chút, nhưng gà mềm.' }
        ],
        'nemran': [
            { author: 'Vũ Văn G', rating: 5, text: 'Nem rán giòn rụm, bé nhà tôi rất thích.' },
            { author: 'Đặng Thị H', rating: 4, text: 'Ngon, nhưng hơi nhiều dầu một chút.' }
        ],
        'goicuon': [
            { author: 'Bùi Văn I', rating: 5, text: 'Gỏi cuốn thanh mát, rất tươi ngon.' },
            { author: 'Dương Thị K', rating: 5, text: 'Nước chấm ngon, cuốn rất đầy đặn.' }
        ],
        'banhcan': [
            { author: 'Minh Thư', rating: 5, text: 'Bánh căn giòn rụm, nước chấm ngon xuất sắc.' },
            { author: 'Quang Anh', rating: 4, text: 'Món ăn lạ miệng, rất đáng thử.' }
        ],
        'banhxeo': [
            { author: 'Ngọc Lan', rating: 5, text: 'Bánh xèo to, giòn, nhân tôm thịt đầy đặn. Rất ngon!' },
            { author: 'Tuấn Hưng', rating: 4, text: 'Bánh xèo khá ngon, rau sống tươi.' }
        ],
        'banhmithitnuong': [
            { author: 'Khánh Linh', rating: 5, text: 'Bánh mì giòn, thịt nướng đậm đà, rất vừa miệng.' },
            { author: 'Đức Huy', rating: 4, text: 'Nhanh gọn mà vẫn rất ngon, ăn sáng tiện lợi.' }
        ],
        'traoi': [
            { author: 'Mai Hương', rating: 5, text: 'Trà ổi rất thơm và mát, không quá ngọt.' },
            { author: 'Văn Chung', rating: 4, text: 'Thức uống giải khát tốt, hương vị tự nhiên.' }
        ],
        'nuoccam': [
            { author: 'Thu Phương', rating: 5, text: 'Nước cam ép tươi ngon, nguyên chất.' },
            { author: 'Gia Bảo', rating: 4, text: 'Vị cam chua ngọt vừa phải, dễ uống.' }
        ],
        'nuocdua': [
            { author: 'Thanh Nga', rating: 5, text: 'Nước dừa tươi ngon, giải khát tức thì.' },
            { author: 'Hoàng Minh', rating: 5, text: 'Rất tươi và mát, không pha đường.' }
        ],
    };
    return allReviews[itemId] || [];
}

// Logic để lọc danh mục (Lọc danh mục)
document.addEventListener('DOMContentLoaded', function() {
    // Logic để lọc danh mục (Lọc danh mục)
    const categoryBtns = document.querySelectorAll('.category-btn');
    const menuItems = document.querySelectorAll('.menu-item');
    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Xóa 'hoạt động' khỏi tất cả các nút
            categoryBtns.forEach(b => b.classList.remove('active'));
            // Thêm 'hoạt động' vào nút được nhấp
            this.classList.add('active'); // Thêm 'hoạt động' vào nút được nhấp
            // Lọc các mục menu dựa trên danh mục đã chọn

            const selectedCategory = this.dataset.category; // Lấy danh mục đã chọn từ thuộc tính dữ liệu của nút
            // Hiển thị hoặc ẩn các mục menu dựa trên danh mục đã chọn
            menuItems.forEach(item => { // Duyệt qua từng mục menu
                // Kiểm tra xem mục có thuộc danh mục đã chọn hay không
                if (selectedCategory === 'all' || item.dataset.category === selectedCategory) { 
                    item.style.display = 'flex'; // Hiển thị mục
                } else {
                    item.style.display = 'none'; // Ẩn mục
                }
            });
        });
    });
// Logic cho Thêm vào giỏ hàng (Thêm vào giỏ hàng) - được sửa đổi để hiển thị phương thức chi tiết mặt hàng
    const addToCartBtns = document.querySelectorAll('.add-to-cart-btn');
    addToCartBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Thay vì thêm trực tiếp vào giỏ hàng, hãy hiển thị chi tiết mặt hàng
            showItemDetailModal(this);
        });
    });

    // Chức năng thêm sản phẩm vào giỏ hàng
    function addItemToCart(itemId, itemName, itemPrice, itemQuantity) {
        let cartItems = JSON.parse(localStorage.getItem('cartItems') || '[]');

        const existingItemIndex = cartItems.findIndex(item => item.id === itemId);

        if (existingItemIndex > -1) {
            cartItems[existingItemIndex].quantity += itemQuantity;
        } else {
            cartItems.push({
                id: itemId,
                name: itemName,
                price: itemPrice,
                quantity: itemQuantity
            });
        }
        localStorage.setItem('cartItems', JSON.stringify(cartItems));
        console.log('menu.js: Cart items saved to localStorage:', cartItems); // Debug log
    }


    // Logic để Thêm vào Giỏ hàng từ Chi tiết Mặt hàng Modal
    const addToCartFromDetailBtn = document.getElementById('add-to-cart-from-detail-btn');
    addToCartFromDetailBtn.addEventListener('click', function() {
        const itemId = this.dataset.id;
        const itemName = this.dataset.name;
        const itemPrice = parseInt(this.dataset.price);
        const itemQuantity = parseInt(document.getElementById('item-quantity').value); // Get quantity from input

        addItemToCart(itemId, itemName, itemPrice, itemQuantity);

        // Ẩn chi tiết mục và hiển thị thành công
        hideItemDetailModal();
        showModal('Thành công!', `${itemName} (số lượng: ${itemQuantity}) đã được thêm vào giỏ hàng của bạn.`);
    });

    // Logic để Đặt hàng ngay từ Modal Chi tiết mặt hàng
    const orderFromDetailBtn = document.getElementById('order-from-detail-btn');
    orderFromDetailBtn.addEventListener('click', function() {
        const itemId = this.dataset.id;
        const itemName = this.dataset.name;
        const itemPrice = parseInt(this.dataset.price);
        const itemQuantity = parseInt(document.getElementById('item-quantity').value); // Get quantity from input

        addItemToCart(itemId, itemName, itemPrice, itemQuantity);

        // Ẩn chi tiết mục và điều hướng đến trang đặt hàng
        hideItemDetailModal();
        window.location.href = 'order.html'; // Redirect to order page
    });
});
