<?php
require_once '../app/core/DB.php';
class lophocModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = ConnectDB::Connect();
    }

    public function getAllLophoc()
    {
        $query = "SELECT * FROM LopHoc";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function create($MaLop)
    {
        $query = "INSERT INTO LopHoc (MaLop) VALUES (:MaLop)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaLop', $MaLop);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function paging($limit = 5, $offset = 0, $search = '')
    {
        $query = "SELECT * FROM LopHoc LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Tính tổng số bản ghi
        $selectAllQuery = $this->conn->query("SELECT COUNT(*) FROM LopHoc");
        $totalRecord = $selectAllQuery->fetchColumn();

        $totalPage = ceil($totalRecord / $limit);

        return ['lophoc' => $result, 'totalPage' => (int) $totalPage];
    }

    public function findById($MaLop)
    {
        $query = "SELECT * FROM LopHoc WHERE MaLop = :MaLop";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaLop', $MaLop, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($oldMaLop, $newMaLop)
    {
        $query = "UPDATE LopHoc SET MaLop = :newMaLop WHERE MaLop = :oldMaLop";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':newMaLop', $newMaLop);
        $stmt->bindParam(':oldMaLop', $oldMaLop);
        return $stmt->execute();
    }

    public function delete($MaLop)
    {
        $query = "DELETE FROM LopHoc WHERE MaLop = :MaLop";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaLop', $MaLop, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
