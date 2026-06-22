<?php
require_once '../app/core/Controller.php';

class lophoc extends Controller
{
    public function index($limit = 5, $offset = 0, $search = '')
    {
        $lophocModel = $this->model('lophocModel');
        $result = $lophocModel->paging($limit, $offset, $search);

        $lophoc = $result['lophoc'];
        $totalPage = $result['totalPage'];

        $this->view(
            'lophoc/index',
            [
                'lophoc' => $lophoc,
                'totalPage' => $totalPage
            ],
            'Danh sách lớp học'
        );
    }

    public function create()
    {
        require_once '../app/views/lophoc/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $MaLop = $_POST['MaLop'] ?? '';

            $lophocModel = $this->model('lophocModel');

            if ($lophocModel->create($MaLop)) {
                header('Location: ' . BASE_URL . '/lophoc/index');
                exit();
            }

            echo "Lỗi khi thêm lớp học (có thể mã lớp đã tồn tại)!";
        }
    }

    public function edit($MaLop)
    {
        $lophocModel = $this->model('lophocModel');
        
        // Handle URL encoding for MaLop if necessary
        $MaLop = urldecode($MaLop);

        $lophoc = $lophocModel->findById($MaLop);

        require_once '../app/views/lophoc/edit.php';
    }

    public function update($oldMaLop)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $oldMaLop = urldecode($oldMaLop);
            $newMaLop = $_POST['MaLop'] ?? '';

            $lophocModel = $this->model('lophocModel');

            if ($lophocModel->update($oldMaLop, $newMaLop)) {
                header('Location: ' . BASE_URL . '/lophoc/index');
                exit();
            }

            echo "Lỗi cập nhật (có thể mã lớp đã tồn tại)!";
        }
    }

    public function delete($MaLop)
    {
        $lophocModel = $this->model('lophocModel');
        $MaLop = urldecode($MaLop);
        
        if ($lophocModel->delete($MaLop)) {
            header('Location: ' . BASE_URL . '/lophoc/index');
            exit();
        }
        echo "Lỗi khi xóa lớp học!";
    }
}
