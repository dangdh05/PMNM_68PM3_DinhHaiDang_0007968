<header class="header">
    <div class="header-content">
        <h2 class="header-title">
            Hệ thống Quản lý Sinh viên
        </h2>
        <a href="<?= BASE_URL ?>/auth/logout" class="btn btn-danger">
            Đăng xuất
        </a>
    </div>
</header>

<style>
.header {
    width: 100%;
    background: #343a40; /* Đổi màu header sang tông xám đậm/đen */
    position: fixed;
    top: 0;
    z-index: 1000;
}

.header-content {
    max-width: 1000px;
    margin: 0 auto;
    height: 60px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
}

.header-title {
    margin: 0;
    font-size: 20px;
    color: #fff; /* Màu chữ trắng trên nền xám đậm */
}
</style>