<div class="simple-container" style="max-width: 1000px; margin: 0 auto;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 class="page-title" style="margin: 0;">Danh sách lớp học</h1>
        <a href="<?= BASE_URL ?>/lophoc/create" class="btn btn-success">
            Thêm lớp học
        </a>
    </div>

    <div style="overflow-x: auto; margin-bottom: 20px;">
        <table>
            <thead>
                <tr>
                    <th>Mã Lớp</th>
                    <th style="text-align: center;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($lophoc)): ?>
                    <tr><td colspan="2" style="text-align: center; padding: 20px;">Không có dữ liệu</td></tr>
                <?php else: ?>
                    <?php foreach ($lophoc as $lh): ?>
                        <tr>
                            <td style="font-weight: bold; color: #0d6efd;"><?php echo htmlspecialchars($lh['MaLop']); ?></td>
                            <td style="text-align: center;">
                                <a class="btn btn-warning" href="<?= BASE_URL ?>/lophoc/edit/<?php echo urlencode($lh['MaLop']); ?>" style="padding: 5px 10px; font-size: 13px;">
                                    Sửa
                                </a>
                                <a class="btn btn-danger" href="<?= BASE_URL ?>/lophoc/delete/<?php echo urlencode($lh['MaLop']); ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa lớp học này?')" style="padding: 5px 10px; font-size: 13px;">
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
        $pageSize = 5;
        for ($i = 1; $i <= $totalPage; $i++) {
            $offset = ($i - 1) * $pageSize;
            $isActive = (isset($_GET['url']) && strpos($_GET['url'], "index/$pageSize/$offset") !== false) || ($i == 1 && !isset($_GET['url']) && empty($offset));
            $btnClass = $isActive ? "background: #0d6efd; color: white;" : "background: #fff; color: #333; border: 1px solid #ccc;";
            echo '<a class="btn" style="min-width: 35px; text-align: center; border-radius: 4px; ' . $btnClass . '" href="' . BASE_URL . '/lophoc/index/' . $pageSize . '/' . $offset . '">' . $i . '</a>';
        }
        ?>
    </div>
</div>
