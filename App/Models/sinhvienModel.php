<?php
require_once '../app/core/DB.php';
class sinhvienModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = ConnectDB::Connect();
    }

    public function getAllSinhvien()
    {
        $query = "SELECT * FROM sinhvien";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create($HoTen, $GioiTinh, $MSSV, $MaLop)
    {
        $query = "INSERT INTO sinhvien (HoTen, GioiTinh, MSSV, MaLop) VALUES (:HoTen, :GioiTinh, :MSSV, :MaLop)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':HoTen', $HoTen);
        $stmt->bindParam(':GioiTinh', $GioiTinh);
        $stmt->bindParam(':MSSV', $MSSV);
        $stmt->bindParam(':MaLop', $MaLop);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function paging($limit = 5, $offset = 0, $search = '', $sort = 'id', $order = 'ASC')
    {
        $whereClause = "";
        if (!empty($search)) {
            $whereClause = " WHERE MSSV LIKE :search1 OR HoTen LIKE :search2 OR MaLop LIKE :search3 ";
        }

        $allowedSorts = ['id', 'MSSV', 'HoTen', 'MaLop'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }
        $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';

        $query = "SELECT * FROM sinhvien" . $whereClause . " ORDER BY " . $sort . " " . $order . " LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        if (!empty($search)) {
            $searchParam = "%" . $search . "%";
            $stmt->bindParam(':search1', $searchParam, PDO::PARAM_STR);
            $stmt->bindParam(':search2', $searchParam, PDO::PARAM_STR);
            $stmt->bindParam(':search3', $searchParam, PDO::PARAM_STR);
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Tính tổng số bản ghi
        $countQuery = "SELECT COUNT(*) FROM sinhvien" . $whereClause;
        $stmtCount = $this->conn->prepare($countQuery);
        if (!empty($search)) {
            $stmtCount->bindParam(':search1', $searchParam, PDO::PARAM_STR);
            $stmtCount->bindParam(':search2', $searchParam, PDO::PARAM_STR);
            $stmtCount->bindParam(':search3', $searchParam, PDO::PARAM_STR);
        }
        $stmtCount->execute();
        $totalRecord = $stmtCount->fetchColumn();

        $totalPage = ceil($totalRecord / $limit);

        return ['sinhvien' => $result, 'totalPage' => (int) $totalPage];
    }


    public function findById($id)
    {
        $query = "SELECT * FROM sinhvien WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $HoTen, $GioiTinh, $MSSV, $MaLop)
    {
        $query = "UPDATE sinhvien SET HoTen = :HoTen, GioiTinh = :GioiTinh, MSSV = :MSSV, MaLop = :MaLop WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':HoTen', $HoTen);
        $stmt->bindParam(':GioiTinh', $GioiTinh);
        $stmt->bindParam(':MSSV', $MSSV);
        $stmt->bindParam(':MaLop', $MaLop);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM sinhvien WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
