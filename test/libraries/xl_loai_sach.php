<?php
include_once 'database.php';
class xl_loai_sach extends Database
{
    function danh_sach_loai_sach_cha()
    {
        $lenh_sql = "SELECT * FROM bs_loai_sach WHERE id_loai_cha = 0";
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();

        //load tat ca danh sach loai con vao trong loai cha
        foreach($result as $item)
        {
            $ds_con = $this->danh_sach_loai_sach_con($item->id);
            if($ds_con)
            {
                $item->ds_con = $ds_con;
            }
        }

        return $result;
    }

    function danh_sach_loai_sach_con($id_loai_sach_cha)
    {
        $lenh_sql = "SELECT * FROM bs_loai_sach WHERE id_loai_cha = $id_loai_sach_cha";
        $this->setQuery($lenh_sql);
        $result = $this->loadAllRow();
        return $result;
    }

    function thong_tin_loai_sach_theo_id($id_loai)
    {
        $lenh_sql = "SELECT * FROM bs_loai_sach WHERE id = $id_loai";
        $this->setQuery($lenh_sql);
        $result = $this->loadRow();
        return $result;
    }

    function them_loai_sach_moi($ten_loai_sach, $id_loai_cha, $trang_thai)
    {
        $lenh_sql = "INSERT INTO bs_loai_sach(ten_loai_sach,id_loai_cha,trang_thai)
                        VALUES('$ten_loai_sach', '$id_loai_cha', '$trang_thai');";
        //echo $lenh_sql."<br/>";exit;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function cap_nhat_loai_sach($id_loai_sach, $ten_loai_sach, $id_loai_cha, $trang_thai)
    {
        $lenh_sql = "UPDATE  bs_loai_sach SET 
                    ten_loai_sach = '$ten_loai_sach',
                    id_loai_cha = '$id_loai_cha',
                    trang_thai = '$trang_thai'
                    WHERE id = '$id_loai_sach'
                    ";
        //echo $lenh_sql."<br/>";exit;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }

    function lay_1_sach_de_kiem_tra_loai_sach($id_loai_sach)
    {
        $lenh_sql = "SELECT * FROM bs_sach WHERE id_loai_sach = $id_loai_sach";
        $this->setQuery($lenh_sql);
        $result = $this->loadRow();
        return $result;
    }

    function xoa_loai_sach_theo_id($id_loai_sach)
    {
        $lenh_sql = "DELETE FROM bs_loai_sach WHERE id = '$id_loai_sach'";
        //echo $lenh_sql;
        $this->setQuery($lenh_sql);
        $result = $this->execute();
        return $result;
    }
}
?>