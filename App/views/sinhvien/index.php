<?php
$sort = $sort ?? 'id';
$order = $order ?? 'ASC';
?>
<div class="simple-container" style="max-width: 1000px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 class="page-title" style="margin: 0;">Danh sách sinh viên</h1>
        <a href="<?= BASE_URL ?>/sinhvien/create" class="btn btn-success">
            Thêm sinh viên
        </a>
    </div>

    <form action="<?= BASE_URL ?>/sinhvien/index" method="GET" style="margin-bottom: 20px;">
        <div style="display: flex; gap: 10px; margin-bottom: 10px;">
            <input type="text" name="search" value="<?php echo htmlspecialchars($search ?? ''); ?>" placeholder="Tìm theo MSSV, Họ tên, Lớp..." style="padding: 10px 15px; border: 1px solid #ced4da; border-radius: 4px; width: 350px; font-size: 15px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#86b7fe'" onblur="this.style.borderColor='#ced4da'">
            <button type="submit" class="btn btn-primary" style="padding: 10px 20px; font-size: 15px;">Tìm kiếm</button>
            <button type="button" class="btn btn-warning" onclick="document.getElementById('sort-panel').style.display = document.getElementById('sort-panel').style.display === 'none' ? 'flex' : 'none';" style="padding: 10px 20px; font-size: 15px; color: #000;">
                <i class="fas fa-filter"></i> Bộ lọc & Sắp xếp
            </button>
            <?php if (!empty($search)): ?>
                <a href="<?= BASE_URL ?>/sinhvien/index" class="btn" style="background: #6c757d; color: white; padding: 10px 20px; font-size: 15px; text-decoration: none;">Hủy</a>
            <?php endif; ?>
        </div>

        <div id="sort-panel" style="display: <?= ($sort != 'id' || $order != 'ASC') ? 'flex' : 'none' ?>; gap: 10px; background: #f8f9fa; padding: 15px; border-radius: 6px; border: 1px solid #e9ecef; align-items: center;">
            <span style="font-weight: bold; margin-right: 10px; color: #333;">Sắp xếp theo:</span>
            <select name="sort" class="form-control" style="width: 150px; display: inline-block;">
                <option value="id" <?= $sort == 'id' ? 'selected' : '' ?>>Mặc định (ID)</option>
                <option value="MSSV" <?= $sort == 'MSSV' ? 'selected' : '' ?>>MSSV</option>
                <option value="HoTen" <?= $sort == 'HoTen' ? 'selected' : '' ?>>Họ tên</option>
            </select>
            <select name="order" class="form-control" style="width: 150px; display: inline-block;">
                <option value="ASC" <?= $order == 'ASC' ? 'selected' : '' ?>>Tăng dần</option>
                <option value="DESC" <?= $order == 'DESC' ? 'selected' : '' ?>>Giảm dần</option>
            </select>
            <span style="font-weight: bold; margin-left: 10px; margin-right: 10px; color: #333;">Hiển thị:</span>
            <select name="limit" class="form-control" style="width: 120px; display: inline-block;">
                <option value="5" <?= $limit == 5 ? 'selected' : '' ?>>5 dòng</option>
                <option value="10" <?= $limit == 10 ? 'selected' : '' ?>>10 dòng</option>
                <option value="20" <?= $limit == 20 ? 'selected' : '' ?>>20 dòng</option>
                <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50 dòng</option>
            </select>
            <button type="submit" class="btn btn-success" style="padding: 8px 15px; margin-left: 10px;">Áp dụng</button>
        </div>
    </form>

    <div style="overflow-x: auto; margin-bottom: 20px;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>MSSV</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Lớp học</th>
                    <th style="text-align: center;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($sinhvien)): ?>
                    <tr><td colspan="6" style="text-align: center; padding: 20px;">Không có dữ liệu</td></tr>
                <?php else: ?>
                    <?php foreach ($sinhvien as $sv): ?>
                        <tr>
                            <td><?php echo $sv['id']; ?></td>
                            <td style="font-weight: bold; color: #0d6efd;"><?php echo htmlspecialchars($sv['MSSV']); ?></td>
                            <td><?php echo htmlspecialchars($sv['HoTen']); ?></td>
                            <td><?php echo htmlspecialchars($sv['GioiTinh']); ?></td>
                            <td><?php echo htmlspecialchars($sv['MaLop'] ?? 'Chưa xếp lớp'); ?></td>
                            <td style="text-align: center;">
                                <a class="btn btn-warning" href="<?= BASE_URL ?>/sinhvien/edit/<?php echo $sv['id']; ?>" style="padding: 5px 10px; font-size: 13px;">
                                    Sửa
                                </a>
                                <a class="btn btn-danger" href="<?= BASE_URL ?>/sinhvien/delete/<?php echo $sv['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')" style="padding: 5px 10px; font-size: 13px;">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div style="display: flex; justify-content: center; gap: 5px;">
        <?php
        $pageSize = $limit;
        for ($i = 1; $i <= $totalPage; $i++) {
            $offset = ($i - 1) * $pageSize;
            $isActive = (isset($_GET['url']) && strpos($_GET['url'], "index/$pageSize/$offset") !== false) || ($i == 1 && !isset($_GET['url']) && empty($offset));
            $btnClass = $isActive ? "background: #0d6efd; color: white;" : "background: #fff; color: #333; border: 1px solid #ccc;";
            $searchQuery = !empty($search) ? '?search=' . urlencode($search) : '';
            if (empty($searchQuery)) {
                $searchQuery = "?sort={$sort}&order={$order}&limit={$limit}";
            } else {
                $searchQuery .= "&sort={$sort}&order={$order}&limit={$limit}";
            }
            echo '<a class="btn" style="min-width: 35px; text-align: center; border-radius: 4px; ' . $btnClass . '" href="' . BASE_URL . '/sinhvien/index/' . $pageSize . '/' . $offset . $searchQuery . '">' . $i . '</a>';
        }
        ?>
    </div>
</div>