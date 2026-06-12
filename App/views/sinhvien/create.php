<div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden;">
    <div style="background: #f8f9fa; padding: 20px 30px; border-bottom: 1px solid #e9ecef;">
        <h1 style="margin: 0; font-size: 22px; color: #2c3e50;">Thêm sinh viên mới</h1>
        <p style="margin: 5px 0 0; color: #6c757d; font-size: 14px;">Vui lòng điền đầy đủ thông tin bên dưới</p>
    </div>

    <form action="<?= BASE_URL ?>/sinhvien/store" method="POST" style="padding: 30px;">
        <div class="form-group" style="margin-bottom: 20px;">
            <label for="HoTen" style="display: block; margin-bottom: 8px; font-weight: 600; color: #34495e;">Họ và tên</label>
            <input type="text" id="HoTen" name="HoTen" class="form-control" placeholder="Nhập họ và tên..." required style="padding: 12px; font-size: 15px; border-radius: 6px; border: 1px solid #dce1e6; width: 100%; transition: border-color 0.2s;">
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label for="MSSV" style="display: block; margin-bottom: 8px; font-weight: 600; color: #34495e;">Mã số sinh viên (MSSV)</label>
            <input type="text" id="MSSV" name="MSSV" class="form-control" placeholder="Ví dụ: 20210001" required style="padding: 12px; font-size: 15px; border-radius: 6px; border: 1px solid #dce1e6; width: 100%;">
        </div>

        <div class="form-group" style="margin-bottom: 25px;">
            <label for="GioiTinh" style="display: block; margin-bottom: 8px; font-weight: 600; color: #34495e;">Giới tính</label>
            <select id="GioiTinh" name="GioiTinh" class="form-control" required style="padding: 12px; font-size: 15px; border-radius: 6px; border: 1px solid #dce1e6; width: 100%; background-color: #fff;">
                <option value="">-- Chọn giới tính --</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
                <option value="Khác">Khác</option>
            </select>
        </div>

        <div style="display: flex; gap: 15px; border-top: 1px solid #e9ecef; padding-top: 20px;">
            <button type="submit" class="btn btn-success" style="padding: 10px 25px; font-size: 15px; font-weight: 500; border-radius: 6px;">Lưu thông tin</button>
            <a href="<?= BASE_URL ?>/sinhvien/index" class="btn" style="padding: 10px 25px; font-size: 15px; background: #e2e8f0; color: #475569; text-decoration: none; border-radius: 6px; font-weight: 500;">Hủy bỏ</a>
        </div>
    </form>
</div>
<style>
    .form-control:focus { outline: none; border-color: #3498db !important; box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2); }
</style>