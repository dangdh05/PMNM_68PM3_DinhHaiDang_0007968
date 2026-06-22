<?php
require_once '../app/core/Controller.php';

class sinhvien extends Controller
{
    public function index($limit = 5, $offset = 0, $search = '')
    {
        $sinhvienModel = $this->model('sinhvienModel');
        $result = $sinhvienModel->paging($limit, $offset, $search);

        $sinhvien = $result['sinhvien'];
        $totalPage = $result['totalPage'];

        $this->view(
            'sinhvien/index',
            [
                'sinhvien' => $sinhvien,
                'totalPage' => $totalPage
            ],
            'Danh sách sinh viên'
        );
    }

    public function create()
    {
        $lophocModel = $this->model('lophocModel');
        $danhSachLop = $lophocModel->getAllLophoc();
        require_once '../app/views/sinhvien/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $MSSV = $_POST['MSSV'] ?? '';
            $MaLop = $_POST['MaLop'] ?? null;

            $sinhvienModel = $this->model('sinhvienModel');

            if ($sinhvienModel->create($HoTen, $GioiTinh, $MSSV, $MaLop)) {
                header('Location: ' . BASE_URL . '/sinhvien/index');
                exit();
            }

            echo "Lỗi khi thêm sinh viên!";
        }
    }

    public function edit($id)
    {
        $sinhvienModel = $this->model('sinhvienModel');
        $lophocModel = $this->model('lophocModel');

        $sinhvien = $sinhvienModel->findById($id);
        $danhSachLop = $lophocModel->getAllLophoc();

        require_once '../app/views/sinhvien/edit.php';
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $HoTen = $_POST['HoTen'] ?? '';
            $GioiTinh = $_POST['GioiTinh'] ?? '';
            $MSSV = $_POST['MSSV'] ?? '';
            $MaLop = $_POST['MaLop'] ?? null;

            $sinhvienModel = $this->model('sinhvienModel');

            if ($sinhvienModel->update($id, $HoTen, $GioiTinh, $MSSV, $MaLop)) {
                header('Location: ' . BASE_URL . '/sinhvien/index');
                exit();
            }

            echo "Lỗi cập nhật!";
        }
    }
    public function delete($id)
    {
        $sinhvienModel = $this->model('sinhvienModel');
        if ($sinhvienModel->delete($id)) {
            header('Location: ' . BASE_URL . '/sinhvien/index');
            exit();
        }
        echo "Lỗi khi xóa sinh viên!";
    }
}
